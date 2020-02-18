<?php

namespace Okipa\LaravelBootstrapComponents\Components\Buttons;

use Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts\SubmitAbstract;

class Update extends SubmitAbstract
{
    /**
     * @inheritDoc
     */
    protected function setType(): string
    {
        return 'submit';
    }

    /**
     * @inheritDoc
     */
    protected function setView(): string
    {
        return 'bootstrap-components.buttons.button';
    }

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
    protected function setAppend(): ?string
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    protected function setLabel(): ?string
    {
        return (string) __('Update');
    }

    /**
     * @inheritDoc
     */
    protected function setComponentClasses(): array
    {
        return ['btn-primary'];
    }

    /**
     * @inheritDoc
     */
    protected function setContainerClasses(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    protected function setComponentHtmlAttributes(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    protected function setContainerHtmlAttributes(): array
    {
        return [];
    }
}
