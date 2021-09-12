<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPostsCreatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        \Mail::to($event->posts->owner->email)->send(
            new \App\Mail\PostCreated($event->posts)
        ); // Почтовая отбивка при добавлении новости
        \Mail::to(env('MAIL_ADMIN'))->send(
            new \App\Mail\PostCreated($event->posts)
        ); // Почтовая отбивка при добавлении новости

    }
}
