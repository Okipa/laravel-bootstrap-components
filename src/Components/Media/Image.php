<?php

namespace Okipa\LaravelBootstrapComponents\Components\Media;

use Okipa\LaravelBootstrapComponents\Components\Media\Abstracts\ImageAbstract;

class Image extends ImageAbstract
{
    protected function setType(): string
    {
        return 'image';
    }

    protected function setView(): string
    {
        return 'bootstrap-components.media.image';
    }

    protected function setCaption(): ?string
    {
        return null;
    }

    protected function setComponentClasses(): array
    {
        return [];
    }

    protected function setLinkClasses(): array
    {
        return [];
    }

    protected function setContainerClasses(): array
    {
        return [];
    }

    protected function setComponentHtmlAttributes(): array
    {
        return [];
    }

    protected function setLinkHtmlAttributes(): array
    {
        return [];
    }

    protected function setContainerHtmlAttributes(): array
    {
        return [];
    }
}
