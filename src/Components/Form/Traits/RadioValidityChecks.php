<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form\Traits;

use InvalidArgumentException;

trait RadioValidityChecks
{
    protected function checkValuesValidity(): void
    {
        parent::checkValuesValidity();
        if (! isset($this->value) || $this->value === '') {
            throw new InvalidArgumentException(
                get_class($this) . ' : Missing $value property. Please use the value() method to set a value.'
            );
        }
    }
}
