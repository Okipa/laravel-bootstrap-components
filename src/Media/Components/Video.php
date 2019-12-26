<?php

namespace Okipa\LaravelBootstrapComponents\Media\Components;

use Okipa\LaravelBootstrapComponents\Media\Abstracts\VideoAbstract;

class Video extends VideoAbstract
{
    /**
     * @inheritDoc
     */
    protected function setType(): string
    {
        return 'video';
    }

    /**
     * @inheritDoc
     */
    protected function setView(): string
    {
        return 'bootstrap-components.media.video';
    }

    /**
     * @inheritDoc
     */
    protected function setPoster(): ?string
    {
        return null;
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
