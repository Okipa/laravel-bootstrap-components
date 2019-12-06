<?php

use Okipa\LaravelBootstrapComponents\Media\Audio as AudioComponent;
use Okipa\LaravelBootstrapComponents\Media\Image as ImageComponent;
use Okipa\LaravelBootstrapComponents\Media\Video as VideoComponent;

if (! function_exists('image')) {
    /**
     * @return ImageComponent
     */
    function image(): ImageComponent
    {
        return (new ImageComponent);
    }
}

if (! function_exists('audio')) {
    /**
     * @return AudioComponent
     */
    function audio(): AudioComponent
    {
        return (new AudioComponent);
    }
}

if (! function_exists('video')) {
    /**
     * @return VideoComponent
     */
    function video(): VideoComponent
    {
        return (new VideoComponent);
    }
}
