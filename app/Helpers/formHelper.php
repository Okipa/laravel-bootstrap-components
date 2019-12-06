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
     * @return TextComponent
     */
    function bsText(): TextComponent
    {
        return (new TextComponent);
    }
}

if (! function_exists('bsNumber')) {
    /**
     * @return NumberComponent
     */
    function bsNumber(): NumberComponent
    {
        return (new NumberComponent);
    }
}

if (! function_exists('bsTel')) {
    /**
     * @return TelComponent
     */
    function bsTel(): TelComponent
    {
        return (new TelComponent);
    }
}

if (! function_exists('bsDatetime')) {
    /**
     * @return DateTimeComponent
     */
    function bsDatetime(): DateTimeComponent
    {
        return (new DateTimeComponent);
    }
}

if (! function_exists('bsDate')) {
    /**
     * @return DateComponent
     */
    function bsDate(): DateComponent
    {
        return (new DateComponent);
    }
}

if (! function_exists('bsTime')) {
    /**
     * @return TimeComponent
     */
    function bsTime(): TimeComponent
    {
        return (new TimeComponent);
    }
}

if (! function_exists('bsUrl')) {
    /**
     * @return UrlComponent
     */
    function bsUrl(): UrlComponent
    {
        return (new UrlComponent);
    }
}

if (! function_exists('bsEmail')) {
    /**
     * @return EmailComponent
     */
    function bsEmail(): EmailComponent
    {
        return (new EmailComponent);
    }
}

if (! function_exists('bsColor')) {
    /**
     * @return ColorComponent
     */
    function bsColor(): ColorComponent
    {
        return (new ColorComponent);
    }
}

if (! function_exists('bsPassword')) {
    /**
     * @return PasswordComponent
     */
    function bsPassword(): PasswordComponent
    {
        return (new PasswordComponent);
    }
}

if (! function_exists('bsFile')) {
    /**
     * @return FileComponent
     */
    function bsFile(): FileComponent
    {
        return (new FileComponent);
    }
}

if (! function_exists('bsTextarea')) {
    /**
     * @return TextareaComponent
     */
    function bsTextarea(): TextareaComponent
    {
        return (new TextareaComponent);
    }
}

if (! function_exists('bsCheckbox')) {
    /**
     * @return CheckboxComponent
     */
    function bsCheckbox(): CheckboxComponent
    {
        return (new CheckboxComponent);
    }
}

if (! function_exists('bsToggle')) {
    /**
     * @return ToggleComponent
     */
    function bsToggle(): ToggleComponent
    {
        return (new ToggleComponent);
    }
}

if (! function_exists('bsRadio')) {
    /**
     * @return RadioComponent
     */
    function bsRadio(): RadioComponent
    {
        return (new RadioComponent);
    }
}

if (! function_exists('bsSelect')) {
    /**
     * @return SelectComponent
     */
    function bsSelect(): SelectComponent
    {
        return (new SelectComponent);
    }
}
