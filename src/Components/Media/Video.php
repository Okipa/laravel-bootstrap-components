<?php

namespace Okipa\LaravelBootstrapComponents\Components\Media;

use Okipa\LaravelBootstrapComponents\Components\Media\Abstracts\VideoAbstract;

class Video extends VideoAbstract
{
    protected function setType(): string
    {
        return 'video';
    }

    protected function setView(): string
    {
        return 'bootstrap-components.media.video';
    }

    protected function setPoster(): ?string
    {
        return null;
    }

    protected function setCaption(): ?string
    {
        return null;
    }

    protected function setComponentClasses(): array
    {
        return [];
    }

    protected function setContainerClasses(): array
    {
        return [];
    }

    protected function setComponentHtmlAttributes(): array
    {
        return ['controls', 'preload' => true];
    }

    protected function setContainerHtmlAttributes(): array
    {
        return [];
    }
}
