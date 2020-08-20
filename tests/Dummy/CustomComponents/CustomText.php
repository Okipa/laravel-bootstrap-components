<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents;

use Okipa\LaravelBootstrapComponents\Components\Form\Text;

class CustomText extends Text
{
    protected function setPrepend(): ?string
    {
        return 'default-prepend';
    }

    protected function setAppend(): ?string
    {
        return 'default-append';
    }

    protected function setLabelPositionedAbove(): bool
    {
        return false;
    }

    protected function setCaption(): ?string
    {
        return 'default-caption';
    }

    protected function setComponentClasses(): array
    {
        return ['default', 'component', 'classes'];
    }

    protected function setContainerClasses(): array
    {
        return ['default', 'container', 'classes'];
    }

    protected function setComponentHtmlAttributes(): array
    {
        return ['default' => 'component', 'html' => 'attributes'];
    }

    protected function setContainerHtmlAttributes(): array
    {
        return ['default' => 'container', 'html' => 'attributes'];
    }

    protected function setDisplaySuccess(): bool
    {
        return true;
    }

    protected function setDisplayFailure(): bool
    {
        return true;
    }
}
