<?php

use Okipa\LaravelBootstrapComponents\Media\Audio;
use Okipa\LaravelBootstrapComponents\Media\Image;
use Okipa\LaravelBootstrapComponents\Media\Video;

if (! function_exists('image')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Media\Image
     */
    function image(): Image
    {
        return (new Image);
    }
}

if (! function_exists('audio')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Media\Audio
     */
    function audio(): Audio
    {
        return (new Audio);
    }
}

if (! function_exists('video')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Media\Video
     */
    function video(): Video
    {
        return (new Video);
    }
}
