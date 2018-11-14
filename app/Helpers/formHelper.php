<?php

if (! function_exists('bsText')) {
    function bsText()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\Text::class);
    }
}

if (! function_exists('bsTel')) {
    function bsTel()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\Tel::class);
    }
}

if (! function_exists('bsDatetime')) {
    function bsDatetime()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\Datetime::class);
    }
}

if (! function_exists('bsDate')) {
    function bsDate()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\Date::class);
    }
}

if (! function_exists('bsTime')) {
    function bsTime()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\Time::class);
    }
}

if (! function_exists('bsUrl')) {
    function bsUrl()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\Url::class);
    }
}

if (! function_exists('bsEmail')) {
    function bsEmail()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\Email::class);
    }
}

if (! function_exists('bsColor')) {
    function bsColor()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\Color::class);
    }
}


if (! function_exists('bsPassword')) {
    function bsPassword()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\Password::class);
    }
}

if (! function_exists('bsFile')) {
    function bsFile()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\File::class);
    }
}

if (! function_exists('bsTextarea')) {
    function bsTextarea()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\Textarea::class);
    }
}

if (! function_exists('bsCheckbox')) {
    function bsCheckbox()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\Checkbox::class);
    }
}

if (! function_exists('bsToggle')) {
    function bsToggle()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\Toggle::class);
    }
}

if (! function_exists('bsRadio')) {
    function bsRadio()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\Radio::class);
    }
}

if (! function_exists('bsSelect')) {
    function bsSelect()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\Select::class);
    }
}
