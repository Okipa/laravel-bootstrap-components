<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents;

use Okipa\LaravelBootstrapComponents\Components\Media\Image;

class CustomImage extends Image
{
    /** @inheritDoc */
    protected function setCaption(): ?string
    {
        return 'default-caption';
    }

    /** @inheritDoc */
    protected function setComponentClasses(): array
    {
        return ['default', 'component', 'classes'];
    }

    /** @inheritDoc */
    protected function setLinkClasses(): array
    {
        return ['default', 'link', 'classes'];
    }

    /** @inheritDoc */
    protected function setContainerClasses(): array
    {
        return ['default', 'container', 'classes'];
    }

    /** @inheritDoc */
    protected function setComponentHtmlAttributes(): array
    {
        return ['default' => 'component', 'html' => 'attributes'];
    }

    /** @inheritDoc */
    protected function setLinkHtmlAttributes(): array
    {
        return ['default' => 'link', 'html' => 'attributes'];
    }

    /** @inheritDoc */
    protected function setContainerHtmlAttributes(): array
    {
        return ['default' => 'container', 'html' => 'attributes'];
    }
}
