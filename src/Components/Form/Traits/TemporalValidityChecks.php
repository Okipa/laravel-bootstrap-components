<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form\Traits;

use Carbon\Carbon;
use Exception;

trait TemporalValidityChecks
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
        $this->checkFormat();
        $this->checkValue();
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function checkFormat(): void
    {
        if (! $this->format) {
            throw new Exception(get_class($this) . ' : No config or custom format given for the input'
                . ucfirst($this->type) . ' component.');
        }
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function checkValue(): void
    {
        try {
            Carbon::parse(parent::getValue());
        } catch (Exception $exception) {
            throw new Exception(get_class($this) . ' : The value for the input' . ucfirst($this->type)
                . ' component must be a valid DateTime object or a formatted string, « ' . parent::getValue()
                . ' » given.');
        }
    }

    /**
     * @return string|null
     */
    abstract protected function getName(): ?string;
}
