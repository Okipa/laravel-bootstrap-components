<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form\Traits;

use Exception;
use InvalidArgumentException;

trait MultilingualValidityChecks
{
    /**
     * Check the component values validity
     *
     * @return void
     * @throws \Exception
     */
    protected function checkValuesValidity(): void
    {
        parent::checkValuesValidity();
        if ($this->multilingualMode() && $this->value && ! is_callable($this->value)) {
            throw new InvalidArgumentException(get_class($this) . ' : A multilingual component value has to
            be set from this callable result : « ->value(function($locale){}) ».');
        }
    }
}
