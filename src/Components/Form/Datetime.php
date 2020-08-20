<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form;

use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\TemporalAbstract;

class Datetime extends TemporalAbstract
{

    protected function setType(): string
    {
        return 'datetime-local';
    }

    protected function setView(): string
    {
        return 'bootstrap-components.form.input';
    }

    protected function setPrepend(): ?string
    {
        return '<i class="fas fa-calendar-alt"></i>';
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
        return (string) __('Awaited format: Day/Month/Year Hour:Minutes.');
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

    protected function setFormat(): string
    {
        return 'Y-m-d\TH:i';
    }
}
