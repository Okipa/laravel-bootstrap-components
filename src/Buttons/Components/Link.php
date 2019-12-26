<?php

namespace Okipa\LaravelBootstrapComponents\Buttons\Components;

use Okipa\LaravelBootstrapComponents\Buttons\Components\Button;

class Link extends Button
{
    /**
     * @inheritDoc
     */
    protected function setComponentClasses(): array
    {
        return ['btn-link'];
    }
}
