<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\VacancyRepositoryInterface',
            'App\Repositories\VacancyRepository'
        );
        $this->app->bind(
            'App\Repositories\SourceRepositoryInterface',
            'App\Repositories\SourceRepository'
        );
    }
}
