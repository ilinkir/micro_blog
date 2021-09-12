require('dotenv').config()
export default {
  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: 'nuxt-frontend',
    htmlAttrs: {
      lang: 'en'
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },
  // runtime config
  publicRuntimeConfig: {
    apiURL: process.env.API_URL,
  },
  privateRuntimeConfig: {
    apiId: process.env.PASSPORT_CLIENT_ID,
    apiSecret: process.env.PASSPORT_CLIENT_SECRET,
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
    '@/assets/css/bootstrap/bootstrap.min.css',
  ],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    // https://go.nuxtjs.dev/eslint
    '@nuxtjs/eslint-module',
  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    // https://go.nuxtjs.dev/axios
    '@nuxtjs/axios',
    '@nuxtjs/auth-next',
    // '@nuxtjs/dotenv',
  ],
  // Axios module configuration: https://go.nuxtjs.dev/config-axios
  axios: {
    proxy: true,
    baseURL: process.env.API_URL,
  },

  router: {
    middleware: ["auth"]
  },

  auth: {
    redirect: {
      home: '/profile',
    },
    strategies: {
      laravelPassportPasswordGrant: {
        name: 'laravelPassportPassword',
        provider: 'laravel/passport',
        url: '/api',
        endpoints: {
          login: {
            url : '/api/oauth/token'
          },
          logout: {
            url: '/api/user/logout'
          },
          user: {
            url: '/api/user/info',
          },
          refresh: {
            url: '/api/auth/refresh'
          },
        },
        clientId: process.env.PASSPORT_CLIENT_ID,
        clientSecret: process.env.PASSPORT_CLIENT_SECRET,
        grantType: 'password',
      },
    },
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
  }
}
