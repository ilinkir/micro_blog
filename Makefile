# Build and up docker containers
build:
	docker-compose up -d --build


# Install the environment
install: build prepare-laravel prepare-nuxt restart

# Laravel
prepare-laravel:
	docker-compose down
	docker-compose up -d
	sudo chown ${USER}:${USER} -R laravel_blog-backend
	sudo chmod -R 777 laravel_blog-backend/bootstrap/cache
	sudo chmod -R 777 laravel_blog-backend/storage
	sudo rm laravel_blog-backend/.env
	cp .env.laravel laravel_blog-backend/.env
	docker-compose exec laravel_blog-backend php artisan key:generate --ansi
	#docker-compose exec php composer require predis/predis
	docker-compose exec laravel_blog-backend php artisan --version

# Nuxt
prepare-nuxt:
	docker-compose down
	sudo chown ${USER}:${USER} -R nuxt-frontend
	cp .env.nuxt-frontend nuxt-frontend/.env
	sed -i "1i require('dotenv').config()" nuxt-frontend/nuxt.config.js
	docker-compose up -d
	docker-compose exec nuxt-frontend yarn info nuxt version

# Restart all containers
restart: down up

# Wake up docker containers
up:
	docker-compose up -d

# Shut down docker containers
down:
	docker-compose down

prepare-composer:
	docker-compose exec laravel_blog-backend composer install
	docker-compose exec laravel_blog-backend cd /var/www/laravel_blog-backend/ && composer install && chown ${UID}:${UID} vendor/ -R

# Run terminal of the php container
laravel:
	docker-compose exec laravel_blog-backend bash
