<?php

if (! function_exists('image')) {
    function image()
    {
        return app(\Okipa\LaravelBootstrapComponents\File\Image::class);
    }
}

if (! function_exists('audio')) {
    function audio()
    {
        return app(\Okipa\LaravelBootstrapComponents\File\Audio::class);
    }
}

if (! function_exists('video')) {
    function video()
    {
        return app(\Okipa\LaravelBootstrapComponents\File\Video::class);
    }
}