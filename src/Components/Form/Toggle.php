<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form;

use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\CheckableAbstract;

class Toggle extends CheckableAbstract
{
    /** @inheritDoc */
    protected function setType(): string
    {
        return 'toggle';
    }

    /** @inheritDoc */
    protected function setView(): string
    {
        return 'bootstrap-components.form.toggle';
    }

    /** @inheritDoc */
    protected function setPrepend(): ?string
    {
        return null;
    }

    /** @inheritDoc */
    protected function setAppend(): ?string
    {
        return null;
    }

    /** @inheritDoc */
    protected function setLabelPositionedAbove(): bool
    {
        return config('bootstrap-components.form.labelPositionedAbove');
    }

    /** @inheritDoc */
    protected function setCaption(): ?string
    {
        return null;
    }

    /** @inheritDoc */
    protected function setComponentClasses(): array
    {
        return [];
    }

    /** @inheritDoc */
    protected function setContainerClasses(): array
    {
        return ['form-group'];
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

    /** @inheritDoc */
    protected function setDisplaySuccess(): bool
    {
        return config('bootstrap-components.form.formValidation.displaySuccess');
    }

    /** @inheritDoc */
    protected function setDisplayFailure(): bool
    {
        return config('bootstrap-components.form.formValidation.displayFailure');
    }
}
