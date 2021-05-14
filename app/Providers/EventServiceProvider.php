<?php

namespace App\Providers;

use App\Jobs\ProductLikedJob;
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
    /*protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];*/

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        // product liked
        \App::bindMethod(ProductLikedJob::class . '@handle', function ($job) {
            return $job->handle();
        });
    }
}
