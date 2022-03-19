<?php

namespace Nimaw\Logviewer;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Nimaw\Logviewer\Http\Livewire\Index;

class LogviewerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/logviewer.php', 'logviewer');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->mergePublishes();
        }

        if ($this->app->environment('local')) {
            $this->loadViewsFrom(__DIR__ . '/../resources/views', 'logviewer');
            $this->loadRoutesFrom(__DIR__ . '/../routes/logviewer.php');

            $this->publishes([
                __DIR__ . '/../config' => config_path()
            ], 'logviewer-config');

            $this->registerLivewireComponents();
        }
    }

    private function mergePublishes()
    {
        $this->publishes([__DIR__ . '/../config/logviewer.php' => config_path('logviewer.php')], 'logviewer-config');

        $this->publishes([__DIR__ . '/../resources/views' => resource_path('/views/vendor/logviewer')], 'logviewer-views');

        $this->publishes([__DIR__ . '/../resources/assets' => public_path('/assets/vendor/logviewer')], 'logviewer-assets');
    }

    private function registerLivewireComponents()
    {
        Livewire::component('logviewer::livewire.logviewer.index', Index::class);
    }
}
