<?php

namespace Okipa\LaravelBootstrapComponents\Buttons\Components;

class Create extends Submit
{
    /**
     * @inheritDoc
     */
    protected function setPrepend(): ?string
    {
        return '<i class="fas fa-plus-circle fa-fw"></i>';
    }

    /**
     * @inheritDoc
     */
    protected function setLabel(): ?string
    {
        return __('bootstrap-components::bootstrap-components.label.create');
    }
}
