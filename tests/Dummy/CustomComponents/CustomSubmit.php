<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents;

use Okipa\LaravelBootstrapComponents\Components\Buttons\Submit;

class CustomSubmit extends Submit
{
    protected function setPrepend(): ?string
    {
        return 'default-prepend';
    }

    protected function setAppend(): ?string
    {
        return 'default-append';
    }

    protected function setLabel(): ?string
    {
        return 'default-label';
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
}
