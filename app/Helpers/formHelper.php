<?php

use Okipa\LaravelBootstrapComponents\Form\Checkbox;
use Okipa\LaravelBootstrapComponents\Form\Color;
use Okipa\LaravelBootstrapComponents\Form\Date;
use \Okipa\LaravelBootstrapComponents\Form\Datetime as bsDatetime;
use Okipa\LaravelBootstrapComponents\Form\Email;
use Okipa\LaravelBootstrapComponents\Form\Number as bsNumber;
use Okipa\LaravelBootstrapComponents\Form\Password;
use \Okipa\LaravelBootstrapComponents\Form\File as bsFile;
use Okipa\LaravelBootstrapComponents\Form\Radio;
use Okipa\LaravelBootstrapComponents\Form\Select;
use Okipa\LaravelBootstrapComponents\Form\Tel;
use Okipa\LaravelBootstrapComponents\Form\Text;
use Okipa\LaravelBootstrapComponents\Form\Textarea;
use Okipa\LaravelBootstrapComponents\Form\Time;
use Okipa\LaravelBootstrapComponents\Form\Toggle;
use Okipa\LaravelBootstrapComponents\Form\Url;

if (! function_exists('bsText')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Text
     */
    function bsText(): Text
    {
        return (new Text);
    }
}

if (! function_exists('bsNumber')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Number
     */
    function bsNumber(): bsNumber
    {
        return (new bsNumber);
    }
}

if (! function_exists('bsTel')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Tel
     */
    function bsTel(): Tel
    {
        return (new Tel);
    }
}

if (! function_exists('bsDatetime')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Datetime
     */
    function bsDatetime(): bsDatetime
    {
        return (new bsDatetime);
    }
}

if (! function_exists('bsDate')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Date
     */
    function bsDate(): Date
    {
        return (new Date);
    }
}

if (! function_exists('bsTime')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Time
     */
    function bsTime(): Time
    {
        return (new Time);
    }
}

if (! function_exists('bsUrl')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Url
     */
    function bsUrl(): Url
    {
        return (new Url);
    }
}

if (! function_exists('bsEmail')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Email
     */
    function bsEmail(): Email
    {
        return (new Email);
    }
}

if (! function_exists('bsColor')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Color
     */
    function bsColor(): Color
    {
        return (new Color);
    }
}


if (! function_exists('bsPassword')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Password
     */
    function bsPassword(): Password
    {
        return (new Password);
    }
}

if (! function_exists('bsFile')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\File
     */
    function bsFile(): bsFile
    {
        return (new bsFile);
    }
}

if (! function_exists('bsTextarea')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Textarea
     */
    function bsTextarea(): Textarea
    {
        return (new Textarea);
    }
}

if (! function_exists('bsCheckbox')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Checkbox
     */
    function bsCheckbox(): Checkbox
    {
        return (new Checkbox);
    }
}

if (! function_exists('bsToggle')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Toggle
     */
    function bsToggle(): Toggle
    {
        return (new Toggle);
    }
}

if (! function_exists('bsRadio')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Radio
     */
    function bsRadio(): Radio
    {
        return (new Radio);
    }
}

if (! function_exists('bsSelect')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Select
     */
    function bsSelect(): Select
    {
        return (new Select);
    }
}
