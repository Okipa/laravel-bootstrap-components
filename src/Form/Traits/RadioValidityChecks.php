<?php

namespace Okipa\LaravelBootstrapComponents\Form\Traits;

use Exception;

trait RadioValidityChecks
{
    /**
     * Check the component values validity
     *
     * @throws \Exception
     * @return void
     */
    protected function checkValuesValidity(): void
    {
        parent::checkValuesValidity();
        if (! $this->value) {
            throw new Exception(
                get_class($this) . ' : Missing $value property. Please use the value() method to set a value.'
            );
        }
    }
}
