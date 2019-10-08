<?php

use Okipa\LaravelBootstrapComponents\Media\Audio as AudioComponent;
use Okipa\LaravelBootstrapComponents\Media\Image as ImageComponent;
use Okipa\LaravelBootstrapComponents\Media\Video as VideoComponent;

if (! function_exists('image')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Media\Image
     */
    function image(): ImageComponent
    {
        return (new ImageComponent);
    }
}

if (! function_exists('audio')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Media\Audio
     */
    function audio(): AudioComponent
    {
        return (new AudioComponent);
    }
}

if (! function_exists('video')) {
    /**
     * @return \Okipa\LaravelBootstrapComponents\Media\Video
     */
    function video(): VideoComponent
    {
        return (new VideoComponent);
    }
}
