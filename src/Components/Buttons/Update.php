<?php

namespace Okipa\LaravelBootstrapComponents\Components\Buttons;

class Update extends Submit
{
    /**
     * @inheritDoc
     */
    protected function setPrepend(): ?string
    {
        return '<i class="fas fa-save fa-fw"></i>';
    }

    /**
     * @inheritDoc
     */
    protected function setLabel(): ?string
    {
        return __('bootstrap-components::bootstrap-components.label.update');
    }
}
