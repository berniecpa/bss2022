<?php

namespace App\Providers;

use App\Events\EstimateApprovedEvent;
use App\Events\EstimateRejectedEvent;
use App\Events\EstimateSentEvent;
use App\Events\EstimateViewedEvent;
use App\Events\InvoiceSentEvent;
use App\Listeners\InvoiceSentListener;
use App\Events\InvoiceViewedEvent;
use App\Listeners\InvoiceViewedListener;
use App\Events\InvoicePaidEvent;
use App\Listeners\EstimateApprovedListener;
use App\Listeners\EstimateRejectedListener;
use App\Listeners\EstimateSentListener;
use App\Listeners\EstimateViewedListener;
use App\Listeners\InvoicePaidListener;
use App\Models\Company;
use App\Observers\CompanyObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        EstimateApprovedEvent::class => [
            EstimateApprovedListener::class,
        ],
        EstimateRejectedEvent::class => [
            EstimateRejectedListener::class,
        ],
        EstimateSentEvent::class => [
            EstimateSentListener::class,
        ],
        EstimateViewedEvent::class => [
            EstimateViewedListener::class,
        ],
        InvoiceSentEvent::class => [
            InvoiceSentListener::class,
        ],
        InvoiceViewedEvent::class => [
            InvoiceViewedListener::class,
        ],
        InvoicePaidEvent::class => [
            InvoicePaidListener::class,
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

        // Observers
        Company::observe(CompanyObserver::class);
    }
}
