<?php

namespace Okipa\LaravelBootstrapComponents\Buttons\Components;

class Back extends Button
{
    /**
     * @inheritDoc
     */
    protected function setUrl(): ?string
    {
        return url()->previous();
    }

    /**
     * @inheritDoc
     */
    protected function setPrepend(): ?string
    {
        return '<i class="fas fa-undo fa-fw"></i>';
    }

    /**
     * @inheritDoc
     */
    protected function setLabel(): ?string
    {
        return __('bootstrap-components::bootstrap-components.label.back');
    }

    /**
     * @inheritDoc
     */
    protected function setComponentClasses(): array
    {
        return ['btn-secondary'];
    }
}
