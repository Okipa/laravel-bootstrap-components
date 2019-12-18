<?php

use Okipa\LaravelBootstrapComponents\Form\Components\Input;

require_once(__DIR__ . '/buttonsHelper.php');
require_once(__DIR__ . '/mediaHelper.php');

if (! function_exists('input')) {
    /**
     * @return Okipa\LaravelBootstrapComponents\Form\Components\Input
     */
    function input(): Input
    {
        return (new Input);
    }
}
