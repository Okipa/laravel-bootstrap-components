<?php

use Okipa\LaravelBootstrapComponents\Components\Component;
use Okipa\LaravelBootstrapComponents\Components\Media\Abstracts\MediaAbstract;

if (! function_exists('image')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Media\Abstracts\MediaAbstract
     */
    function image(): MediaAbstract
    {
        return (new Component)->image();
    }
}

if (! function_exists('audio')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Media\Abstracts\MediaAbstract
     */
    function audio(): MediaAbstract
    {
        return (new Component)->audio();
    }
}

if (! function_exists('video')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Media\Abstracts\MediaAbstract
     */
    function video(): MediaAbstract
    {
        return (new Component)->video();
    }
}
