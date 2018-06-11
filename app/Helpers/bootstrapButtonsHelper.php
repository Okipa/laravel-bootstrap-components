<?php

if (! function_exists('button')) {
    function button()
    {
        return app(\Okipa\LaravelBootstrapComponents\Button\Button::class);
    }
}

if (! function_exists('buttonValidate')) {
    function buttonValidate()
    {
        return app(\Okipa\LaravelBootstrapComponents\Button\ButtonValidate::class);
    }
}

if (! function_exists('buttonCreate')) {
    function buttonCreate()
    {
        return app(\Okipa\LaravelBootstrapComponents\Button\ButtonCreate::class);
    }
}

if (! function_exists('buttonUpdate')) {
    function buttonUpdate()
    {
        return app(\Okipa\LaravelBootstrapComponents\Button\ButtonUpdate::class);
    }
}

if (! function_exists('buttonCancel')) {
    function buttonCancel()
    {
        return app(\Okipa\LaravelBootstrapComponents\Button\ButtonCancel::class);
    }
}

if (! function_exists('buttonBack')) {
    function buttonBack()
    {
        return app(\Okipa\LaravelBootstrapComponents\Button\ButtonBack::class);
    }
}