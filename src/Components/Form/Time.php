<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form;

use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\TemporalAbstract;

class Time extends TemporalAbstract
{
    /** @inheritDoc */
    protected function setType(): string
    {
        return 'time';
    }

    /** @inheritDoc */
    protected function setView(): string
    {
        return 'bootstrap-components.form.input';
    }

    /** @inheritDoc */
    protected function setPrepend(): ?string
    {
        return '<i class="fas fa-clock"></i>';
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
        return __('Awaited format: Hour:Minutes.');
    }

    /** @inheritDoc */
    protected function setComponentClasses(): array
    {
        return ['form-group'];
    }

    /** @inheritDoc */
    protected function setContainerClasses(): array
    {
        return [];
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

    /** @inheritDoc */
    protected function setFormat(): string
    {
        return 'H:i:s';
    }
}
