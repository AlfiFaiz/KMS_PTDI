<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Company;
use App\Models\Qms;
use App\Models\Certificate;
use App\Models\AircraftProgram;
use App\Models\Task;
use App\Models\EngineeringOrder;
use App\Observers\GenericObserver;
use App\Observers\NotificationObserver;




class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */


    public function boot()
    {
        User::observe(GenericObserver::class);
        Company::observe(GenericObserver::class);
        Qms::observe(GenericObserver::class);
        Certificate::observe(GenericObserver::class);
        AircraftProgram::observe(GenericObserver::class);
        Task::observe(GenericObserver::class);
        Qms::observe(NotificationObserver::class);
        AircraftProgram::observe(NotificationObserver::class);
        EngineeringOrder::observe(NotificationObserver::class);


    }
}
