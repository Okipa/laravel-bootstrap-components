<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents;

use Okipa\LaravelBootstrapComponents\Components\Form\Time;

class CustomTime extends Time
{
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
    protected function setLabelPositionedAbove(): bool
    {
        return false;
    }

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

    /** @inheritDoc */
    protected function setDisplaySuccess(): bool
    {
        return true;
    }

    /** @inheritDoc */
    protected function setDisplayFailure(): bool
    {
        return true;
    }

    /** @inheritDoc */
    protected function setFormat(): string
    {
        return 'd/m/Y H-i-s';
    }
}
