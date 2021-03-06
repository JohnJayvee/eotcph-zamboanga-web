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
     * @var array
     */
    protected $listen = [
        // Registered::class => [
        //     SendEmailVerificationNotification::class,
        // ],
        // \SocialiteProviders\Manager\SocialiteWasCalled::class => [
        //     // add your listeners (aka providers) here
        //     'SocialiteProviders\\Graph\\GraphExtendSocialite@handle',
        // ],
        'send-sms-processor' => [
            'App\Laravel\Listeners\SendProcessorReferenceListener'
        ],
        'send-sms-violation' => [
            'App\Laravel\Listeners\SendViolationListener'
        ],
        'send-sms' => [
            'App\Laravel\Listeners\SendReferenceListener'
        ],
        'send-sms-tax' => [
            'App\Laravel\Listeners\SendTaxListener'
        ],
        'send-application' => [
            'App\Laravel\Listeners\SendApplicationListener'
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
