<?php

use Okipa\LaravelBootstrapComponents\Components\Component;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\CheckableAbstract;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\InputAbstract;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\MultilingualAbstract;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\RadioAbstract;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\SelectableAbstract;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\TemporalAbstract;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\UploadableAbstract;

if (! function_exists('inputText')) {
    function inputText(): MultilingualAbstract
    {
        return (new Component())->inputText();
    }
}

if (! function_exists('inputEmail')) {
    function inputEmail(): InputAbstract
    {
        return (new Component())->inputEmail();
    }
}

if (! function_exists('inputPassword')) {
    function inputPassword(): InputAbstract
    {
        return (new Component())->inputPassword();
    }
}

if (! function_exists('inputUrl')) {
    function inputUrl(): InputAbstract
    {
        return (new Component())->inputUrl();
    }
}

if (! function_exists('inputTel')) {
    function inputTel(): InputAbstract
    {
        return (new Component())->inputTel();
    }
}

if (! function_exists('inputNumber')) {
    function inputNumber(): InputAbstract
    {
        return (new Component())->inputNumber();
    }
}

if (! function_exists('inputColor')) {
    function inputColor(): InputAbstract
    {
        return (new Component())->inputColor();
    }
}

if (! function_exists('inputDate')) {
    function inputDate(): TemporalAbstract
    {
        return (new Component())->inputDate();
    }
}

if (! function_exists('inputTime')) {
    function inputTime(): TemporalAbstract
    {
        return (new Component())->inputTime();
    }
}

if (! function_exists('inputDatetime')) {
    function inputDatetime(): TemporalAbstract
    {
        return (new Component())->inputDatetime();
    }
}

if (! function_exists('inputFile')) {
    function inputFile(): UploadableAbstract
    {
        return (new Component())->inputFile();
    }
}

if (! function_exists('inputCheckbox')) {
    function inputCheckbox(): CheckableAbstract
    {
        return (new Component())->inputCheckbox();
    }
}

if (! function_exists('inputSwitch')) {
    function inputSwitch(): CheckableAbstract
    {
        return (new Component())->inputSwitch();
    }
}

if (! function_exists('inputRadio')) {
    function inputRadio(): RadioAbstract
    {
        return (new Component())->inputRadio();
    }
}

if (! function_exists('textarea')) {
    function textarea(): MultilingualAbstract
    {
        return (new Component())->textarea();
    }
}

if (! function_exists('select')) {
    function select(): SelectableAbstract
    {
        return (new Component())->select();
    }
}
