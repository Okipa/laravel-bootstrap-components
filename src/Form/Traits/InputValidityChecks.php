<?php

namespace Okipa\LaravelBootstrapComponents\Form\Traits;

use Exception;

trait InputValidityChecks
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
        if (! $this->getName()) {
            throw new Exception(
                get_class($this) . ' : Missing $name property. Please use the name() method to set a name.'
            );
        }
    }
}
