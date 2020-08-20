<?php

namespace Okipa\LaravelBootstrapComponents\Components\Traits;

use Okipa\LaravelBootstrapComponents\Components\Media\Abstracts\ImageAbstract;
use Okipa\LaravelBootstrapComponents\Components\Media\Abstracts\MediaAbstract;
use Okipa\LaravelBootstrapComponents\Components\Media\Abstracts\VideoAbstract;

trait MediaComponentsTrait
{
    public function image(): ImageAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Media\Abstracts\ImageAbstract $image */
        $image = app(config('bootstrap-components.components.image'));

        return $image;
    }

    public function audio(): MediaAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Media\Abstracts\MediaAbstract $audio */
        $audio = app(config('bootstrap-components.components.audio'));

        return $audio;
    }

    public function video(): VideoAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Media\Abstracts\VideoAbstract $video */
        $video = app(config('bootstrap-components.components.video'));

        return $video;
    }
}
