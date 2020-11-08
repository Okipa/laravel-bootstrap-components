<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form\Traits;

use RuntimeException;

trait FormValidityChecks
{
    protected function checkValuesValidity(): void
    {
        if (! $this->getName()) {
            throw new RuntimeException(
                get_class($this) . ' : Missing $name property. Please use the name() method to set a name.'
            );
        }
    }
}
