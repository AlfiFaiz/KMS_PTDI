<?php

namespace App\Providers;
use App\Observers\GenericObserver;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Observers\NotificationObserver;
use App\Models\Wiki;
use App\Models\Knowledge;
use App\Models\Qms;
use App\Models\Certificate;
use App\Models\AircraftProgram;
use App\Models\EngineeringOrder;
use App\Models\Info;
use App\Models\Task;
use App\Models\Company;





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
        $models = [
            Wiki::class,
            Knowledge::class,
            Qms::class,
            Certificate::class,
            AircraftProgram::class,
            EngineeringOrder::class,
            Info::class,
            Task::class,
            Company::class,
        ];

        foreach ($models as $model) {
            $model::observe(GenericObserver::class);
        }
        Qms::observe(NotificationObserver::class);
        AircraftProgram::observe(NotificationObserver::class);
        EngineeringOrder::observe(NotificationObserver::class);

        date_default_timezone_set('Asia/Jakarta');

    }


}
