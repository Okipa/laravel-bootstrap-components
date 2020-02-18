<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form;

use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\TemporalAbstract;

class Datetime extends TemporalAbstract
{
    /**
     * @inheritDoc
     */
    protected function setType(): string
    {
        return 'datetime-local';
    }

    /**
     * @inheritDoc
     */
    protected function setView(): string
    {
        return 'bootstrap-components.form.input';
    }

    /**
     * @inheritDoc
     */
    protected function setPrepend(): ?string
    {
        return '<i class="fas fa-calendar-alt"></i>';
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
    protected function setLabelPositionedAbove(): bool
    {
        return config('bootstrap-components.form.labelPositionedAbove');
    }

    /**
     * @inheritDoc
     */
    protected function setCaption(): ?string
    {
        return 'Awaited format: Day/Month/Year Hour:Minutes.';
    }

    /**
     * @inheritDoc
     */
    protected function setComponentClasses(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    protected function setContainerClasses(): array
    {
        return ['form-group'];
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

    /**
     * @inheritDoc
     */
    protected function setDisplaySuccess(): bool
    {
        return config('bootstrap-components.form.formValidation.displaySuccess');
    }

    /**
     * @inheritDoc
     */
    protected function setDisplayFailure(): bool
    {
        return config('bootstrap-components.form.formValidation.displayFailure');
    }

    /**
     * @inheritDoc
     */
    protected function setFormat(): string
    {
        return 'Y-m-d H:i:s';
    }
}
