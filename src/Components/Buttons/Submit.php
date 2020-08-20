<?php

namespace Okipa\LaravelBootstrapComponents\Components\Buttons;

use Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts\SubmitAbstract;

class Submit extends SubmitAbstract
{
    protected function setType(): string
    {
        return 'submit';
    }

    protected function setView(): string
    {
        return 'bootstrap-components.buttons.button';
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
        return ['btn-primary'];
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
