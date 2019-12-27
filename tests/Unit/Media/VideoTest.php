<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Media;

use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Facades\Video;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomVideo;
use Okipa\LaravelBootstrapComponents\Tests\Unit\Media\Abstracts\VideoTestAbstract;

class VideoTest extends VideoTestAbstract
{
    protected function getComponent(): ComponentAbstract
    {
        return app(config('bootstrap-components.components.video'));
    }

    protected function getHelper(): ComponentAbstract
    {
        return video();
    }

    protected function getFacade(): ComponentAbstract
    {
        return Video::getFacadeRoot();
    }

    protected function getComponentType(): string
    {
        return 'video';
    }

    protected function getCustomComponent(): ComponentAbstract
    {
        return (new CustomVideo);
    }
}
