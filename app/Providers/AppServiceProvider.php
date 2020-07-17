<?php

namespace App\Providers;

use App\Models\Gidrant;
use App\Models\Operplan;
use App\Observers\GidrantObserver;
use App\Observers\OperplanObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Operplan::observe(OperplanObserver::class);
        Gidrant::observe(GidrantObserver::class);
    }



}
