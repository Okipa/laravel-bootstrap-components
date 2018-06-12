<?php

if (! function_exists('button')) {
    function button()
    {
        return app(\Okipa\LaravelBootstrapComponents\Clickable\Button::class);
    }
}

if (! function_exists('buttonValidate')) {
    function buttonValidate()
    {
        return app(\Okipa\LaravelBootstrapComponents\Clickable\ButtonValidate::class);
    }
}

if (! function_exists('buttonCreate')) {
    function buttonCreate()
    {
        return app(\Okipa\LaravelBootstrapComponents\Clickable\ButtonCreate::class);
    }
}

if (! function_exists('buttonUpdate')) {
    function buttonUpdate()
    {
        return app(\Okipa\LaravelBootstrapComponents\Clickable\ButtonUpdate::class);
    }
}

if (! function_exists('buttonCancel')) {
    function buttonCancel()
    {
        return app(\Okipa\LaravelBootstrapComponents\Clickable\ButtonCancel::class);
    }
}

if (! function_exists('buttonBack')) {
    function buttonBack()
    {
        return app(\Okipa\LaravelBootstrapComponents\Clickable\ButtonBack::class);
    }
}
