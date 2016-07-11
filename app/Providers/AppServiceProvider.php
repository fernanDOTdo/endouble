<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Source;
use Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Whenever a Source is added to DB, remove the sources cache
        Source::created(function ($source) {
            Cache::forget('source.all');
        });
        // Whenever a Source is updated, remove the sources cache
        Source::updated(function ($source) {
            Cache::forget('source.all');
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
