<?php

use Okipa\LaravelBootstrapComponents\Components\Component;
use Okipa\LaravelBootstrapComponents\Components\Media\Abstracts\ImageAbstract;
use Okipa\LaravelBootstrapComponents\Components\Media\Abstracts\MediaAbstract;
use Okipa\LaravelBootstrapComponents\Components\Media\Abstracts\VideoAbstract;

if (! function_exists('image')) {
    function image(): ImageAbstract
    {
        return (new Component())->image();
    }
}

if (! function_exists('audio')) {
    function audio(): MediaAbstract
    {
        return (new Component())->audio();
    }
}

if (! function_exists('video')) {
    function video(): VideoAbstract
    {
        return (new Component())->video();
    }
}
