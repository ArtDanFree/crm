<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\Lead;
use App\Observers\ClientObservers;
use App\Observers\LeadObservers;
use View;
use Illuminate\Support\ServiceProvider;
use App\Http\Composers\ViewComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.app', ViewComposer::class);
        Lead::observe(LeadObservers::class);
        Client::observe(ClientObservers::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
