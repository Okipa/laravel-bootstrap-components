<?php

if (! function_exists('text')) {
    function text()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\Text::class);
    }
}

if (! function_exists('tel')) {
    function tel()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\Tel::class);
    }
}

if (! function_exists('email')) {
    function email()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\Email::class);
    }
}


if (! function_exists('password')) {
    function password()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\Password::class);
    }
}

if (! function_exists('fileUpload')) {
    function fileUpload()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\File::class);
    }
}

if (! function_exists('textarea')) {
    function textarea()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\Textarea::class);
    }
}

if (! function_exists('checkbox')) {
    function checkbox()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\Checkbox::class);
    }
}

if (! function_exists('toggle')) {
    function toggle()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\Toggle::class);
    }
}

if (! function_exists('radio')) {
    function radio()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\Radio::class);
    }
}

if (! function_exists('select')) {
    function select()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\Select::class);
    }
}
