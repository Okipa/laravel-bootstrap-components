<?php

namespace Okipa\LaravelBootstrapComponents;

use Illuminate\Support\ServiceProvider;
use Okipa\LaravelHtmlHelper\HtmlHelperServiceProvider;

class ComponentServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'bootstrap-components');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'bootstrap-components');
        $this->publishes([
            __DIR__ . '/../config/bootstrap-components.php' => config_path('bootstrap-components.php'),
        ], 'bootstrap-components:config');
        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/bootstrap-components'),
        ], 'bootstrap-components:translations');
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/bootstrap-components'),
        ], 'bootstrap-components:views');
        // we load the laravel html helper package
        // https://github.com/Okipa/laravel-html-helper
        $this->app->register(HtmlHelperServiceProvider::class);
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/bootstrap-components.php',
            'bootstrap-components'
        );
    }
}
