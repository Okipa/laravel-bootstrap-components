<?php

namespace Okipa\LaravelBootstrapComponents\Components\Media;

use Okipa\LaravelBootstrapComponents\Components\Media\Abstracts\ImageAbstract;

class Image extends ImageAbstract
{
    /**
     * @inheritDoc
     */
    protected function setType(): string
    {
        return 'image';
    }

    /**
     * @inheritDoc
     */
    protected function setView(): string
    {
        return 'bootstrap-components.media.image';
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
    protected function setLinkClasses(): array
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
        return [];
    }

    /**
     * @inheritDoc
     */
    protected function setLinkHtmlAttributes(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    protected function setContainerHtmlAttributes(): array
    {
        return [];
    }
}
