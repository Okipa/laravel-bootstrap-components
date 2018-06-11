<?php

namespace Okipa\LaravelBootstrapComponents;

use Illuminate\Support\ServiceProvider;
use Okipa\LaravelHtmlHelper\HtmlHelperServiceProvider;
use Okipa\LaravelToggleSwitchButton\ToggleSwitchButtonServiceProvider;

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
        // we load the laravel html helper package
        // https://github.com/Okipa/laravel-html-helper
        $this->app->register(HtmlHelperServiceProvider::class);
        // we load the laravel toggle switch button
        // https://github.com/Okipa/laravel-toggle-switch-button
        $this->app->register(ToggleSwitchButtonServiceProvider::class);
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/bootstrap-components.php', 'bootstrap-components'
        );
    }
}
