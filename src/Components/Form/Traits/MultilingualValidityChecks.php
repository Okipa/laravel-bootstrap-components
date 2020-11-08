<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form\Traits;

use InvalidArgumentException;

trait MultilingualValidityChecks
{
    protected function checkValuesValidity(): void
    {
        parent::checkValuesValidity();
        if (! is_callable($this->value) && $this->value && $this->multilingualMode()) {
            throw new InvalidArgumentException(get_class($this) . ' : A multilingual component value has to
            be set from this callable result : « ->value(function($locale){}) ».');
        }
    }
}
