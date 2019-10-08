<?php

use Okipa\LaravelBootstrapComponents\Button\Back as bsBack;
use Okipa\LaravelBootstrapComponents\Button\Cancel as bsCancel;
use Okipa\LaravelBootstrapComponents\Button\Create as bsCreate;
use Okipa\LaravelBootstrapComponents\Button\Update as bsUpdate;
use Okipa\LaravelBootstrapComponents\Button\Validate as bsValidate;

if (! function_exists('bsValidate')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Button\Validate
     */
    function bsValidate(): bsValidate
    {
        return (new bsValidate);
    }
}

if (! function_exists('bsCreate')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Button\Create
     */
    function bsCreate(): bsCreate
    {
        return (new bsCreate);
    }
}

if (! function_exists('bsUpdate')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Button\Update
     */
    function bsUpdate(): bsUpdate
    {
        return (new bsUpdate);
    }
}

if (! function_exists('bsCancel')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Button\Cancel
     */
    function bsCancel(): bsCancel
    {
        return (new bsCancel);
    }
}

if (! function_exists('bsBack')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Button\Back
     */
    function bsBack(): bsBack
    {
        return (new bsBack);
    }
}
