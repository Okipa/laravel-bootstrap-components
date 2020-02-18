<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Media;

use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Facades\Audio;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomAudio;
use Okipa\LaravelBootstrapComponents\Tests\Unit\Media\Abstracts\MediaTestAbstract;

class AudioTest extends MediaTestAbstract
{
    protected function getComponent(): ComponentAbstract
    {
        return app(config('bootstrap-components.components.audio'));
    }

    protected function getHelper(): ComponentAbstract
    {
        return audio();
    }

    protected function getFacade(): ComponentAbstract
    {
        return Audio::getFacadeRoot();
    }

    protected function getComponentType(): string
    {
        return 'audio';
    }

    protected function getCustomComponent(): ComponentAbstract
    {
        return (new CustomAudio);
    }
}
