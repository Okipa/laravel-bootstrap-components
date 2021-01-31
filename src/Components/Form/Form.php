<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form;

use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\FormAbstract;

class Form extends FormAbstract
{
    protected function setView(): string
    {
        return 'bootstrap-components.form.form';
    }

    protected function setLabelPositionedAbove(): bool
    {
        return config('bootstrap-components.form.labelPositionedAbove');
    }

    protected function setComponentClasses(): array
    {
        return [];
    }

    protected function setContainerClasses(): array
    {
        return [];
    }

    protected function setComponentHtmlAttributes(): array
    {
        return ['novalidate'];
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
