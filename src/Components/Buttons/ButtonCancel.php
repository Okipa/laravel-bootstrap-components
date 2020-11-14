<?php

namespace Okipa\LaravelBootstrapComponents\Components\Buttons;

use Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts\ButtonAbstract;

class ButtonCancel extends ButtonAbstract
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
        return url()->previous();
    }

    protected function setPrepend(): ?string
    {
        return '<i class="fas fa-ban fa-fw"></i>';
    }

    protected function setAppend(): ?string
    {
        return null;
    }

    protected function setLabel(): ?string
    {
        return (string) __('Cancel');
    }

    protected function setComponentClasses(): array
    {
        return ['btn-danger'];
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
