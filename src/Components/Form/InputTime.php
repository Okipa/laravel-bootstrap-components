<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form;

use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\TemporalAbstract;

class InputTime extends TemporalAbstract
{
    protected function setType(): string
    {
        return 'time';
    }

    protected function setView(): string
    {
        return 'bootstrap-components.form.input';
    }

    protected function setPrepend(): ?string
    {
        return '<i class="fas fa-clock"></i>';
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
        return (string) __('Awaited format: Hour:Minutes.');
    }

    protected function setComponentClasses(): array
    {
        return ['form-group'];
    }

    protected function setContainerClasses(): array
    {
        return [];
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

    protected function setFormat(): string
    {
        return 'H:i:s';
    }
}
