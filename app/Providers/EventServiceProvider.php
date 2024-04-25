<?php

namespace App\Providers;

use App\Events\RepaymentUpdated;
use App\Listeners\UpdateLoanAmount;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        RepaymentUpdated::class => [
            UpdateLoanAmount::class
        ]
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
