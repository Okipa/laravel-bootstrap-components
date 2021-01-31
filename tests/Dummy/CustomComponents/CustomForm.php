<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents;

use Okipa\LaravelBootstrapComponents\Components\Form\Form;

class CustomForm extends Form
{
    protected function setLabelPositionedAbove(): bool
    {
        return false;
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
