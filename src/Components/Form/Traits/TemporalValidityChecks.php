<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form\Traits;

use Carbon\Carbon;
use Exception;

trait TemporalValidityChecks
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
        if (! $this->format) {
            throw new Exception(get_class($this) . ' : No config or custom format given for the bs'
                . ucfirst($this->type) . ' component.');
        }
        $this->value = $this->value ? $this->value : ($this->model ? $this->model->{$this->getName()} : null);
        if ($this->value && is_string($this->value) && ! is_a($this->value, 'DateTime')) {
            try {
                Carbon::parse($this->value);
            } catch (Exception $e) {
                throw new Exception(get_class($this) . ' : The value for the bs' . ucfirst($this->type)
                    . ' component must be a valid DateTime object or formatted string, « '
                    . $this->value . ' » given.');
            }
        }
    }
}
