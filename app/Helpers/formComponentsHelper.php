<?php

use Okipa\LaravelBootstrapComponents\Component;
use Okipa\LaravelBootstrapComponents\Form\Abstracts\FormAbstract;
use Okipa\LaravelBootstrapComponents\Form\Abstracts\MultilingualAbstract;
use Okipa\LaravelBootstrapComponents\Form\Abstracts\SelectAbstract;

if (! function_exists('inputText')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\MultilingualAbstract
     */
    function inputText(): MultilingualAbstract
    {
        return (new Component)->inputText();
    }
}

if (! function_exists('inputEmail')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\FormAbstract
     */
    function inputEmail(): FormAbstract
    {
        return (new Component)->inputEmail();
    }
}

if (! function_exists('inputPassword')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\FormAbstract
     */
    function inputPassword(): FormAbstract
    {
        return (new Component)->inputPassword();
    }
}

if (! function_exists('inputUrl')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\FormAbstract
     */
    function inputUrl(): FormAbstract
    {
        return (new Component)->inputUrl();
    }
}

if (! function_exists('inputTel')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\FormAbstract
     */
    function inputTel(): FormAbstract
    {
        return (new Component)->inputTel();
    }
}

if (! function_exists('inputNumber')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\FormAbstract
     */
    function inputNumber(): FormAbstract
    {
        return (new Component)->inputNumber();
    }
}

if (! function_exists('inputColor')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\FormAbstract
     */
    function inputColor(): FormAbstract
    {
        return (new Component)->inputColor();
    }
}

if (! function_exists('inputDate')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\FormAbstract
     */
    function inputDate(): FormAbstract
    {
        return (new Component)->inputDate();
    }
}

if (! function_exists('inputTime')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\FormAbstract
     */
    function inputTime(): FormAbstract
    {
        return (new Component)->inputTime();
    }
}

if (! function_exists('inputDatetime')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\FormAbstract
     */
    function inputDatetime(): FormAbstract
    {
        return (new Component)->inputDatetime();
    }
}

if (! function_exists('inputFile')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\FormAbstract
     */
    function inputFile(): FormAbstract
    {
        return (new Component)->inputFile();
    }
}

if (! function_exists('inputCheckbox')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\FormAbstract
     */
    function inputCheckbox(): FormAbstract
    {
        return (new Component)->inputCheckbox();
    }
}

if (! function_exists('inputToggle')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\FormAbstract
     */
    function inputToggle(): FormAbstract
    {
        return (new Component)->inputToggle();
    }
}

if (! function_exists('inputRadio')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\FormAbstract
     */
    function inputRadio(): FormAbstract
    {
        return (new Component)->inputRadio();
    }
}

if (! function_exists('textarea')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\MultilingualAbstract
     */
    function textarea(): MultilingualAbstract
    {
        return (new Component)->textarea();
    }
}

if (! function_exists('select')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\SelectAbstract
     */
    function select(): SelectAbstract
    {
        return (new Component)->select();
    }
}
