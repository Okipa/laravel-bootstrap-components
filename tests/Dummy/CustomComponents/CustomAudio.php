<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents;

use Okipa\LaravelBootstrapComponents\Components\Media\Audio;

class CustomAudio extends Audio
{
    protected function setCaption(): ?string
    {
        return 'default-caption';
    }

    protected function setComponentClasses(): array
    {
        return ['default', 'component', 'classes'];
    }

    protected function setContainerClasses(): array
    {
        return ['default', 'container', 'classes'];
    }

    protected function setComponentHtmlAttributes(): array
    {
        return ['default' => 'component', 'html' => 'attributes'];
    }

    protected function setContainerHtmlAttributes(): array
    {
        return ['default' => 'container', 'html' => 'attributes'];
    }
}
