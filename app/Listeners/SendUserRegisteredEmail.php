<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;
class SendUserRegisteredEmail
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
        $user = $event->user;
        $data['full_name'] = $user->full_name;
        $data['email'] = $user->email;
        Mail::send('user_welcome_email', $data, function ($message) use ($user) {
            $message->to($user->email, $user->full_name)
            ->subject('Welcome to NRNA App');
    });
    }
}
