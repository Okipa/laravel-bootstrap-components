<?php

namespace Okipa\LaravelBootstrapComponents\Buttons\Components;

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
        return __('bootstrap-components::bootstrap-components.label.validate');
    }
}
