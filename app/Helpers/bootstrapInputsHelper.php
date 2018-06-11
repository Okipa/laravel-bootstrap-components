<?php

if (! function_exists('input')) {
    function input()
    {
        return app(Okipa\LaravelBootstrapComponents\Form\Input::class);
    }
}

if (! function_exists('inputText')) {
    function inputText()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\InputText::class);
    }
}

if (! function_exists('inputTel')) {
    function inputTel()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\InputTel::class);
    }
}

if (! function_exists('inputEmail')) {
    function inputEmail()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\InputEmail::class);
    }
}


if (! function_exists('inputPassword')) {
    function inputPassword()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\InputPassword::class);
    }
}

if (! function_exists('inputFile')) {
    function inputFile()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\InputFile::class);
    }
}

if (! function_exists('inputToggle')) {
    function inputToggle()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\InputToggle::class);
    }
}

if (! function_exists('inputTextarea')) {
    function inputTextarea()
    {
        return app(\Okipa\LaravelBootstrapComponents\Form\InputTextarea::class);
    }
}
