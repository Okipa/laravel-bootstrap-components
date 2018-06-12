<?php

if (! function_exists('image')) {
    function image()
    {
        return app(\Okipa\LaravelBootstrapComponents\Media\Image::class);
    }
}

if (! function_exists('audio')) {
    function audio()
    {
        return app(\Okipa\LaravelBootstrapComponents\Media\Audio::class);
    }
}

if (! function_exists('video')) {
    function video()
    {
        return app(\Okipa\LaravelBootstrapComponents\Media\Video::class);
    }
}
