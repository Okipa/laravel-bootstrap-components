<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form;

use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\MultilingualAbstract;

class Text extends MultilingualAbstract
{
    protected function setType(): string
    {
        return 'text';
    }

    protected function setView(): string
    {
        return 'bootstrap-components.form.input';
    }

    protected function setPrepend(): ?string
    {
        return '<i class="fas fa-font"></i>';
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
