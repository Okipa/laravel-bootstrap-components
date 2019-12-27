<?php

namespace Okipa\LaravelBootstrapComponents\Components\Buttons;

class Cancel extends Button
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
        return '<i class="fas fa-ban fa-fw"></i>';
    }

    /**
     * @inheritDoc
     */
    protected function setLabel(): ?string
    {
        return __('bootstrap-components::bootstrap-components.label.cancel');
    }

    /**
     * @inheritDoc
     */
    protected function setComponentClasses(): array
    {
        return ['btn-secondary'];
    }
}
