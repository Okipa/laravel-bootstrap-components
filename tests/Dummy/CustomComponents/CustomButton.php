<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents;

use Okipa\LaravelBootstrapComponents\Components\Buttons\Button;

class CustomButton extends Button
{
    /** @inheritDoc */
    protected function setUrl(): ?string
    {
        return 'default-url';
    }

    /** @inheritDoc */
    protected function setPrepend(): ?string
    {
        return 'default-prepend';
    }

    /** @inheritDoc */
    protected function setAppend(): ?string
    {
        return 'default-append';
    }

    /** @inheritDoc */
    protected function setLabel(): ?string
    {
        return 'default-label';
    }

    /** @inheritDoc */
    protected function setComponentClasses(): array
    {
        return ['default', 'component', 'classes'];
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
    protected function setContainerHtmlAttributes(): array
    {
        return ['default' => 'container', 'html' => 'attributes'];
    }
}
