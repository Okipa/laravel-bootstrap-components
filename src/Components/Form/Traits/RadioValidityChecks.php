<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form\Traits;

use InvalidArgumentException;

trait RadioValidityChecks
{
    protected function checkValuesValidity(): void
    {
        parent::checkValuesValidity();
        $value = $this->getValue();
        if (! isset($value) || $value === '') {
            throw new InvalidArgumentException(
                get_class($this) . ' : Missing $value property. Please use the value() method to set a value.'
            );
        }
    }
}
