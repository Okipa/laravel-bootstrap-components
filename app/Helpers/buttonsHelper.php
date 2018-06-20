<?php

if (! function_exists('bsValidate')) {
    function bsValidate()
    {
        return app(\Okipa\LaravelBootstrapComponents\Button\Validate::class);
    }
}

if (! function_exists('bsCreate')) {
    function bsCreate()
    {
        return app(\Okipa\LaravelBootstrapComponents\Button\Create::class);
    }
}

if (! function_exists('bsUpdate')) {
    function bsUpdate()
    {
        return app(\Okipa\LaravelBootstrapComponents\Button\Update::class);
    }
}

if (! function_exists('bsCancel')) {
    function bsCancel()
    {
        return app(\Okipa\LaravelBootstrapComponents\Button\Cancel::class);
    }
}

if (! function_exists('bsBack')) {
    function bsBack()
    {
        return app(\Okipa\LaravelBootstrapComponents\Button\Back::class);
    }
}
