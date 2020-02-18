<?php

namespace Okipa\LaravelBootstrapComponents\Components\Traits;

use Okipa\LaravelBootstrapComponents\Components\Media\Abstracts\MediaAbstract;

trait MediaComponentsTrait
{
    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Media\Abstracts\MediaAbstract
     */
    public function image(): MediaAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Media\Abstracts\MediaAbstract $image */
        $image = app(config('bootstrap-components.components.image'));

        return $image;
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Media\Abstracts\MediaAbstract
     */
    public function audio(): MediaAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Media\Abstracts\MediaAbstract $audio */
        $audio = app(config('bootstrap-components.components.audio'));

        return $audio;
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Media\Abstracts\MediaAbstract
     */
    public function video(): MediaAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Media\Abstracts\MediaAbstract $video */
        $video = app(config('bootstrap-components.components.video'));

        return $video;
    }
}
