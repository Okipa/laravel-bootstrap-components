<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form;

use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\FormAbstract;

class InputPassword extends FormAbstract
{
    protected function setType(): string
    {
        return 'password';
    }

    protected function setView(): string
    {
        return 'bootstrap-components.form.input';
    }

    protected function setPrepend(): ?string
    {
        return '<i class="fas fa-user-secret"></i>';
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
        return ['autocomplete' => 'on'];
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
