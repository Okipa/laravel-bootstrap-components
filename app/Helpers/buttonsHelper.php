<?php

use Okipa\LaravelBootstrapComponents\Button\Back as bsBack;
use Okipa\LaravelBootstrapComponents\Button\Cancel as bsCancel;
use Okipa\LaravelBootstrapComponents\Button\Create as bsCreate;
use Okipa\LaravelBootstrapComponents\Button\Update as bsUpdate;
use Okipa\LaravelBootstrapComponents\Button\Validate as bsValidate;

if (! function_exists('bsValidate')) {
    /**
     * @return bsValidate
     */
    function bsValidate(): bsValidate
    {
        return (new bsValidate);
    }
}

if (! function_exists('bsCreate')) {
    /**
     * @return bsCreate
     */
    function bsCreate(): bsCreate
    {
        return (new bsCreate);
    }
}

if (! function_exists('bsUpdate')) {
    /**
     * @return bsUpdate
     */
    function bsUpdate(): bsUpdate
    {
        return (new bsUpdate);
    }
}

if (! function_exists('bsCancel')) {
    /**
     * @return bsCancel
     */
    function bsCancel(): bsCancel
    {
        return (new bsCancel);
    }
}

if (! function_exists('bsBack')) {
    /**
     * @return bsBack
     */
    function bsBack(): bsBack
    {
        return (new bsBack);
    }
}
