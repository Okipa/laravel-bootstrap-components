<?php

namespace Okipa\LaravelBootstrapComponents\Components\Media;

use Okipa\LaravelBootstrapComponents\Components\Media\Abstracts\MediaAbstract;

class Audio extends MediaAbstract
{
    protected function setType(): string
    {
        return 'audio';
    }

    protected function setView(): string
    {
        return 'bootstrap-components.media.audio';
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
