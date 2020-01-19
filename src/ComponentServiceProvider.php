<?php

namespace Okipa\LaravelBootstrapComponents;

use Illuminate\Support\ServiceProvider;
use Okipa\LaravelBootstrapComponents\Components\Component;
use Okipa\LaravelHtmlHelper\HtmlHelperServiceProvider;

class ComponentServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'bootstrap-components');
        $this->publishes([
            __DIR__ . '/../config/bootstrap-components.php' => config_path('bootstrap-components.php'),
        ], 'bootstrap-components:config');
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
        $this->mergeConfigFrom(__DIR__ . '/../config/bootstrap-components.php', 'bootstrap-components');
        $this->registerFacades();
    }

    /**
     * Register package facades.
     */
    protected function registerFacades(): void
    {
        $this->registerFormComponentsFacades();
        $this->registerButtonComponentsFacades();
        $this->registerMediaComponentsFacades();
    }

    /**
     * Register form components facades.
     */
    protected function registerFormComponentsFacades(): void
    {
        $this->app->bind('InputText', function () {
            return (new Component)->inputText();
        });
        $this->app->bind('InputEmail', function () {
            return (new Component)->inputEmail();
        });
        $this->app->bind('InputPassword', function () {
            return (new Component)->inputPassword();
        });
        $this->app->bind('InputUrl', function () {
            return (new Component)->inputUrl();
        });
        $this->app->bind('InputTel', function () {
            return (new Component)->inputTel();
        });
        $this->app->bind('InputNumber', function () {
            return (new Component)->inputNumber();
        });
        $this->app->bind('InputColor', function () {
            return (new Component)->inputColor();
        });
        $this->app->bind('InputDate', function () {
            return (new Component)->inputDate();
        });
        $this->app->bind('InputTime', function () {
            return (new Component)->inputTime();
        });
        $this->app->bind('InputDatetime', function () {
            return (new Component)->inputDatetime();
        });
        $this->app->bind('InputFile', function () {
            return (new Component)->inputFile();
        });
        $this->app->bind('InputCheckbox', function () {
            return (new Component)->inputCheckbox();
        });
        $this->app->bind('InputToggle', function () {
            return (new Component)->inputToggle();
        });
        $this->app->bind('InputRadio', function () {
            return (new Component)->inputRadio();
        });
        $this->app->bind('Textarea', function () {
            return (new Component)->textarea();
        });
        $this->app->bind('Select', function () {
            return (new Component)->select();
        });
    }

    /**
     * Register button components facades.
     */
    protected function registerButtonComponentsFacades(): void
    {
        $this->app->bind('Submit', function () {
            return (new Component)->submit();
        });
        $this->app->bind('SubmitCreate', function () {
            return (new Component)->submitCreate();
        });
        $this->app->bind('SubmitUpdate', function () {
            return (new Component)->submitUpdate();
        });
        $this->app->bind('SubmitValidate', function () {
            return (new Component)->submitValidate();
        });
        $this->app->bind('Button', function () {
            return (new Component)->button();
        });
        $this->app->bind('ButtonLink', function () {
            return (new Component)->buttonLink();
        });
        $this->app->bind('ButtonBack', function () {
            return (new Component)->buttonBack();
        });
        $this->app->bind('ButtonCancel', function () {
            return (new Component)->buttonCancel();
        });
    }

    /**
     * Register media components facades.
     */
    protected function registerMediaComponentsFacades(): void
    {
        $this->app->bind('Image', function () {
            return (new Component)->image();
        });
        $this->app->bind('Audio', function () {
            return (new Component)->audio();
        });
        $this->app->bind('Video', function () {
            return (new Component)->video();
        });
    }
}
