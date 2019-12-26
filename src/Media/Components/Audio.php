<?php

namespace Okipa\LaravelBootstrapComponents\Media\Components;

use Okipa\LaravelBootstrapComponents\Media\Abstracts\MediaAbstract;

class Audio extends MediaAbstract
{
    /**
     * @inheritDoc
     */
    protected function setType(): string
    {
        return 'audio';
    }

    /**
     * @inheritDoc
     */
    protected function setView(): string
    {
        return 'bootstrap-components.media.audio';
    }

    /**
     * @inheritDoc
     */
    protected function setLegend(): ?string
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    protected function setComponentClasses(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    protected function setContainerClasses(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    protected function setComponentHtmlAttributes(): array
    {
        return ['controls', 'preload' => true];
    }

    /**
     * @inheritDoc
     */
    protected function setContainerHtmlAttributes(): array
    {
        return [];
    }
}
