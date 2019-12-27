<?php

namespace Okipa\LaravelBootstrapComponents\Components\Buttons;

class Validate extends Submit
{
    /**
     * @inheritDoc
     */
    protected function setPrepend(): ?string
    {
        return '<i class="fas fa-check fa-fw"></i>';
    }

    /**
     * @inheritDoc
     */
    protected function setLabel(): ?string
    {
        return (string) __('bootstrap-components::bootstrap-components.label.validate');
    }
}
