<?php

namespace Okipa\LaravelBootstrapComponents;

use Illuminate\Support\ServiceProvider;

class ComponentServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'bootstrap-components');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'bootstrap-components');
        $this->publishes([
            __DIR__ . '/../config/laravel-bootstrap-components.php.php' => config_path('components.php'),
        ], 'bootstrap-components::config');
        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang'),
        ], 'bootstrap-components::translations');
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/components'),
        ], 'bootstrap-components::views');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/bootstrap-components.php', 'bootstrap-components'
        );
    }
}
