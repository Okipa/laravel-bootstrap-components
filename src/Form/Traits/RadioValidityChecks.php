<?php

namespace Okipa\LaravelBootstrapComponents\Form\Traits;

use Exception;

trait RadioValidityChecks
{
    /**
     * @return string
     */
    abstract protected function getName(): string;
    
    /**
     * Check the component values validity
     *
     * @return void
     * @throws Exception
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
