<?php

namespace Okipa\LaravelBootstrapComponents\Form\Traits;

use Exception;

trait InputValidityChecks
{
    /**
     * Check the component values validity
     *
     * @throws \Exception
     * @return void
     */
    protected function checkValuesValidity(): void
    {
        if (! $this->name) {
            throw new Exception(
                get_class($this) . ' : Missing $name property. Please use the name() method to set a name.'
            );
        }
    }
}
