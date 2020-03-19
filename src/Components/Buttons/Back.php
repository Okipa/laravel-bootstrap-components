<?php

namespace Okipa\LaravelBootstrapComponents\Components\Buttons;

use Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts\ButtonAbstract;

class Back extends ButtonAbstract
{
    /** @inheritDoc */
    protected function setType(): string
    {
        return 'button';
    }

    /** @inheritDoc */
    protected function setView(): string
    {
        return 'bootstrap-components.buttons.button';
    }

    /** @inheritDoc */
    protected function setUrl(): ?string
    {
        return url()->previous();
    }

    /** @inheritDoc */
    protected function setPrepend(): ?string
    {
        return '<i class="fas fa-undo fa-fw"></i>';
    }

    /** @inheritDoc */
    protected function setAppend(): ?string
    {
        return null;
    }

    /** @inheritDoc */
    protected function setLabel(): ?string
    {
        return (string) __('Back');
    }

    /** @inheritDoc */
    protected function setComponentClasses(): array
    {
        return ['btn-secondary'];
    }

    /** @inheritDoc */
    protected function setContainerClasses(): array
    {
        return [];
    }

    /** @inheritDoc */
    protected function setComponentHtmlAttributes(): array
    {
        return [];
    }

    /** @inheritDoc */
    protected function setContainerHtmlAttributes(): array
    {
        return [];
    }
}
