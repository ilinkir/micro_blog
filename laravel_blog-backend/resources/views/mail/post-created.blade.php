@component('mail::message')
    # Создана новая новость {{ $post->title }}

    Текст новости -> {{ $post->text }}

    @component('mail::button', ['url' => '/news/'. $post->id ])
        Ссылка на новость
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
