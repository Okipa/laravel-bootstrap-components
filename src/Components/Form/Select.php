<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form;

use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\SelectableAbstract;

class Select extends SelectableAbstract
{

    protected function setType(): string
    {
        return 'select';
    }

    protected function setView(): string
    {
        return 'bootstrap-components.form.select';
    }

    protected function setPrepend(): ?string
    {
        return '<i class="fas fa-hand-pointer"></i>';
    }

    protected function setAppend(): ?string
    {
        return null;
    }

    protected function setLabelPositionedAbove(): bool
    {
        return config('bootstrap-components.form.labelPositionedAbove');
    }

    protected function setCaption(): ?string
    {
        return null;
    }

    protected function setComponentClasses(): array
    {
        return [];
    }

    protected function setContainerClasses(): array
    {
        return ['form-group'];
    }

    protected function setComponentHtmlAttributes(): array
    {
        return [];
    }

    protected function setContainerHtmlAttributes(): array
    {
        return [];
    }

    protected function setDisplaySuccess(): bool
    {
        return config('bootstrap-components.form.formValidation.displaySuccess');
    }

    protected function setDisplayFailure(): bool
    {
        return config('bootstrap-components.form.formValidation.displayFailure');
    }
}
