<?php

namespace Okipa\LaravelBootstrapComponents\Form\Traits;

use Carbon\Carbon;
use Exception;

trait TimeValidityChecks
{
    /**
     * Check the component values validity
     *
     * @return void
     * @throws Exception
     */
    protected function checkValuesValidity(): void
    {
        parent::checkValuesValidity();
        $this->value = $this->value ? $this->value : ($this->model ? $this->model->{$this->name} : null);
        $this->format = $this->format ? $this->format : $this->defaultFormat();
        if (! $this->format) {
            throw new Exception(
                get_class($this) . ' : No config or custom format is given for the bsTime() component.'
            );
        }
        if ($this->value && is_string($this->value) && ! is_a($this->value, 'DateTime')) {
            try {
                Carbon::parse($this->value);
            } catch (Exception $e) {
                throw new Exception(
                    get_class($this) . ' : the value must be a valid DateTime object or formatted string, « '
                    . $this->value . ' » given.'
                );
            }
        }
    }

    /**
     * Set the datetime default format
     *
     * @return string
     */
    abstract protected function defaultFormat(): string;
}
