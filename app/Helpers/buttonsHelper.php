<?php

use Okipa\LaravelBootstrapComponents\Button\Back;
use Okipa\LaravelBootstrapComponents\Button\Cancel;
use Okipa\LaravelBootstrapComponents\Button\Create;
use Okipa\LaravelBootstrapComponents\Button\Update;
use Okipa\LaravelBootstrapComponents\Button\Validate;

if (! function_exists('bsValidate')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Button\Validate
     */
    function bsValidate(): Validate
    {
        return (new Validate);
    }
}

if (! function_exists('bsCreate')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Button\Create
     */
    function bsCreate(): Create
    {
        return (new Create);
    }
}

if (! function_exists('bsUpdate')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Button\Update
     */
    function bsUpdate(): Update
    {
        return (new Update);
    }
}

if (! function_exists('bsCancel')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Button\Cancel
     */
    function bsCancel(): Cancel
    {
        return (new Cancel);
    }
}

if (! function_exists('bsBack')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Button\Back
     */
    function bsBack(): Back
    {
        return (new Back);
    }
}
