<?php

namespace Okipa\LaravelBootstrapComponents\Components\Buttons;

class Link extends Button
{
    /**
     * @inheritDoc
     */
    protected function setComponentClasses(): array
    {
        return ['btn-primary', 'btn-link'];
    }
}
