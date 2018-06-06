<?php

namespace Okipa\LaravelBootstrapComponents;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class TableListServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'components');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'components');
        $this->publishes([
            __DIR__ . '/../config/components.php.php' => config_path('components.php'),
        ], 'components::config');
        $this->publishes([
            __DIR__ . '/../resources/lang'  => resource_path('lang'),
        ], 'components::translations');
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/components'),
        ], 'components::views');
    }
    
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/components.php.php', 'components'
        );
    }
}
