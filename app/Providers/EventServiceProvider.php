<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\MemberCreated' => [
            'App\Listeners\SendMemberRegisteredNotification',
        ],
        'App\Events\MemberVerified' => [
            'App\Listeners\SendMemberVerifiedNotification',
        ],
        'App\Events\MemberRejected' => [
            'App\Listeners\SendMemberRejectedNotification',
        ],
        'App\Events\MemberReappply' => [
            'App\Listeners\SendMemberReapplyNotification',
        ],
        'App\Events\UserRegistered' => [
            'App\Listeners\SendUserRegisteredEmail',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
