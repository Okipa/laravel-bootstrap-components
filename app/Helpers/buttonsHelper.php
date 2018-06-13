<?php

if (! function_exists('buttonValidate')) {
    function buttonValidate()
    {
        return app(\Okipa\LaravelBootstrapComponents\Button\Validate::class);
    }
}

if (! function_exists('buttonCreate')) {
    function buttonCreate()
    {
        return app(\Okipa\LaravelBootstrapComponents\Button\Create::class);
    }
}

if (! function_exists('buttonUpdate')) {
    function buttonUpdate()
    {
        return app(\Okipa\LaravelBootstrapComponents\Button\Update::class);
    }
}

if (! function_exists('buttonCancel')) {
    function buttonCancel()
    {
        return app(\Okipa\LaravelBootstrapComponents\Button\Cancel::class);
    }
}

if (! function_exists('buttonBack')) {
    function buttonBack()
    {
        return app(\Okipa\LaravelBootstrapComponents\Button\Back::class);
    }
}
