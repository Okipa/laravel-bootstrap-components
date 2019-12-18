<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents;

use Okipa\LaravelBootstrapComponents\Form\Components\Email;

class CustomEmail extends Email
{
    /**
     * @inheritDoc
     */
    protected function setPrepend(): ?string
    {
        return 'default-prepend';
    }

    /**
     * @inheritDoc
     */
    protected function setAppend(): ?string
    {
        return 'default-append';
    }

    /**
     * @inheritDoc
     */
    protected function setLabelPositionedAbove(): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    protected function setLegend(): ?string
    {
        return 'default-legend';
    }

    /**
     * @inheritDoc
     */
    protected function setComponentClasses(): array
    {
        return ['default', 'component', 'classes'];
    }

    /**
     * @inheritDoc
     */
    protected function setContainerClasses(): array
    {
        return ['default', 'container', 'classes'];
    }

    /**
     * @inheritDoc
     */
    protected function setComponentHtmlAttributes(): array
    {
        return ['default' => 'component', 'html' => 'attributes'];
    }

    /**
     * @inheritDoc
     */
    protected function setContainerHtmlAttributes(): array
    {
        return ['default' => 'container', 'html' => 'attributes'];
    }

    /**
     * @inheritDoc
     */
    protected function setDisplaySuccess(): bool
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    protected function setDisplayFailure(): bool
    {
        return true;
    }
}
