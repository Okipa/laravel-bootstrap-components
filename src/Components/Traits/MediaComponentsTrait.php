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
        return app(config('bootstrap-components.components.image'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Media\Abstracts\MediaAbstract
     */
    public function audio(): MediaAbstract
    {
        return app(config('bootstrap-components.components.audio'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Media\Abstracts\MediaAbstract
     */
    public function video(): MediaAbstract
    {
        return app(config('bootstrap-components.components.video'));
    }
}
