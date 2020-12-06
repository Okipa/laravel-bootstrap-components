<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form\Traits;

use Carbon\Carbon;
use Exception;
use RuntimeException;

trait TemporalValidityChecks
{
    protected function checkValuesValidity(): void
    {
        parent::checkValuesValidity();
        $this->checkFormat();
        $this->checkValue();
    }

    protected function checkFormat(): void
    {
        if (! $this->getFormat()) {
            throw new RuntimeException(get_class($this) . ' : No config or custom format given for the input'
                . ucfirst($this->getType()) . ' component.');
        }
    }

    protected function checkValue(): void
    {
        try {
            Carbon::parse(parent::getValue());
        } catch (Exception $exception) {
            throw new RuntimeException(get_class($this) . ' : The value for the input' . ucfirst($this->getType())
                . ' component must be a valid DateTime object or a formatted string, « ' . parent::getValue()
                . ' » given.');
        }
    }
}
