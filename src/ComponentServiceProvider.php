<?php

namespace Okipa\LaravelBootstrapComponents;

use Illuminate\Support\ServiceProvider;
use Okipa\LaravelBootstrapComponents\Form\Components\Checkbox;
use Okipa\LaravelBootstrapComponents\Form\Components\Color;
use Okipa\LaravelBootstrapComponents\Form\Components\Date;
use Okipa\LaravelBootstrapComponents\Form\Components\Datetime;
use Okipa\LaravelBootstrapComponents\Form\Components\Email;
use Okipa\LaravelBootstrapComponents\Form\Components\File;
use Okipa\LaravelBootstrapComponents\Form\Components\Form;
use Okipa\LaravelBootstrapComponents\Form\Components\Number;
use Okipa\LaravelBootstrapComponents\Form\Components\Password;
use Okipa\LaravelBootstrapComponents\Form\Components\Radio;
use Okipa\LaravelBootstrapComponents\Form\Components\Tel;
use Okipa\LaravelBootstrapComponents\Form\Components\Text;
use Okipa\LaravelBootstrapComponents\Form\Components\Time;
use Okipa\LaravelBootstrapComponents\Form\Components\Toggle;
use Okipa\LaravelBootstrapComponents\Form\Components\Url;
use Okipa\LaravelHtmlHelper\HtmlHelperServiceProvider;

class ComponentServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/bootstrap-components.php',
            'bootstrap-components'
        );
        $this->registerFacades();
    }

    /**
     * Register package facades.
     */
    protected function registerFacades(): void
    {
        $this->registerFormComponentsFacades();
    }

    /**
     * Register form components facades.
     */
    protected function registerFormComponentsFacades(): void
    {
        $this->app->bind('InputText', Text::class);
        $this->app->bind('InputEmail', Email::class);
        $this->app->bind('InputPassword', Password::class);
        $this->app->bind('InputUrl', Url::class);
        $this->app->bind('InputTel', Tel::class);
        $this->app->bind('InputNumber', Number::class);
        $this->app->bind('InputColor', Color::class);
        $this->app->bind('InputDate', Date::class);
        $this->app->bind('InputTime', Time::class);
        $this->app->bind('InputDatetime', Datetime::class);
        $this->app->bind('InputFile', File::class);
        $this->app->bind('InputCheckbox', Checkbox::class);
        $this->app->bind('InputToggle', Toggle::class);
        $this->app->bind('InputRadio', Radio::class);
    }
}
