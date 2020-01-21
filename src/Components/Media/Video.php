<?php

namespace Okipa\LaravelBootstrapComponents\Components\Media;

use Okipa\LaravelBootstrapComponents\Components\Media\Abstracts\VideoAbstract;

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
    protected function setCaption(): ?string
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
