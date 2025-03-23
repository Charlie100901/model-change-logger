<?php

namespace CarlosDev\ModelChangeLogger;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class ModelChangeLoggerServiceProvider extends ServiceProvider
{
    public function register()
    {
        
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations'),
        ], 'model-changes-notifier');

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }
}