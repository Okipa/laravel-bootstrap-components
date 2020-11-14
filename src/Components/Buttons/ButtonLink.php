<?php

namespace Okipa\LaravelBootstrapComponents\Components\Buttons;

use Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts\ButtonAbstract;

class ButtonLink extends ButtonAbstract
{
    protected function setType(): string
    {
        return 'button';
    }

    protected function setView(): string
    {
        return 'bootstrap-components.buttons.button';
    }

    protected function setUrl(): ?string
    {
        return null;
    }

    protected function setPrepend(): ?string
    {
        return null;
    }

    protected function setAppend(): ?string
    {
        return null;
    }

    protected function setLabel(): ?string
    {
        return null;
    }

    protected function setComponentClasses(): array
    {
        return ['btn-link'];
    }

    protected function setContainerClasses(): array
    {
        return [];
    }

    protected function setComponentHtmlAttributes(): array
    {
        return [];
    }

    protected function setContainerHtmlAttributes(): array
    {
        return [];
    }
}
