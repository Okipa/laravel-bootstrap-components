<?php

use Okipa\LaravelBootstrapComponents\Form\Checkbox as CheckboxComponent;
use Okipa\LaravelBootstrapComponents\Form\Color as ColorComponent;
use Okipa\LaravelBootstrapComponents\Form\Date as DateComponent;
use Okipa\LaravelBootstrapComponents\Form\Datetime as DateTimeComponent;
use Okipa\LaravelBootstrapComponents\Form\Email as EmailComponent;
use Okipa\LaravelBootstrapComponents\Form\File as FileComponent;
use Okipa\LaravelBootstrapComponents\Form\Number as NumberComponent;
use Okipa\LaravelBootstrapComponents\Form\Password as PasswordComponent;
use Okipa\LaravelBootstrapComponents\Form\Radio as RadioComponent;
use Okipa\LaravelBootstrapComponents\Form\Select as SelectComponent;
use Okipa\LaravelBootstrapComponents\Form\Tel as TelComponent;
use Okipa\LaravelBootstrapComponents\Form\Text as TextComponent;
use Okipa\LaravelBootstrapComponents\Form\Textarea as TextareaComponent;
use Okipa\LaravelBootstrapComponents\Form\Time as TimeComponent;
use Okipa\LaravelBootstrapComponents\Form\Toggle as ToggleComponent;
use Okipa\LaravelBootstrapComponents\Form\Url as UrlComponent;

if (! function_exists('bsText')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Text
     */
    function bsText(): TextComponent
    {
        return (new TextComponent);
    }
}

if (! function_exists('bsNumber')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Number
     */
    function bsNumber(): NumberComponent
    {
        return (new NumberComponent);
    }
}

if (! function_exists('bsTel')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Tel
     */
    function bsTel(): TelComponent
    {
        return (new TelComponent);
    }
}

if (! function_exists('bsDatetime')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Datetime
     */
    function bsDatetime(): DateTimeComponent
    {
        return (new DateTimeComponent);
    }
}

if (! function_exists('bsDate')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Date
     */
    function bsDate(): DateComponent
    {
        return (new DateComponent);
    }
}

if (! function_exists('bsTime')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Time
     */
    function bsTime(): TimeComponent
    {
        return (new TimeComponent);
    }
}

if (! function_exists('bsUrl')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Url
     */
    function bsUrl(): UrlComponent
    {
        return (new UrlComponent);
    }
}

if (! function_exists('bsEmail')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Email
     */
    function bsEmail(): EmailComponent
    {
        return (new EmailComponent);
    }
}

if (! function_exists('bsColor')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Color
     */
    function bsColor(): ColorComponent
    {
        return (new ColorComponent);
    }
}

if (! function_exists('bsPassword')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Password
     */
    function bsPassword(): PasswordComponent
    {
        return (new PasswordComponent);
    }
}

if (! function_exists('bsFile')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\File
     */
    function bsFile(): FileComponent
    {
        return (new FileComponent);
    }
}

if (! function_exists('bsTextarea')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Textarea
     */
    function bsTextarea(): TextareaComponent
    {
        return (new TextareaComponent);
    }
}

if (! function_exists('bsCheckbox')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Checkbox
     */
    function bsCheckbox(): CheckboxComponent
    {
        return (new CheckboxComponent);
    }
}

if (! function_exists('bsToggle')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Toggle
     */
    function bsToggle(): ToggleComponent
    {
        return (new ToggleComponent);
    }
}

if (! function_exists('bsRadio')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Radio
     */
    function bsRadio(): RadioComponent
    {
        return (new RadioComponent);
    }
}

if (! function_exists('bsSelect')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Select
     */
    function bsSelect(): SelectComponent
    {
        return (new SelectComponent);
    }
}
