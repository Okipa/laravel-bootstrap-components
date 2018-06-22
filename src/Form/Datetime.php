<?php

namespace Okipa\LaravelBootstrapComponents\Form;

use Carbon\Carbon;
use Exception;

class Datetime extends Input
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'form.datetime';
    /**
     * The input type.
     *
     * @property string $type
     */
    protected $type = 'datetime-local';

    /**
     * Set the input values.
     *
     * @return array
     */
    protected function values(): array
    {
        if (is_a($this->value, 'DateTime')) {
            $value = $this->value->format('Y-m-d\TH:i:s');
        } else {
            $value = Carbon::parse($this->value)->format('Y-m-d\TH:i:s');
        }

        return array_merge(parent::values(), [
            'value' => $value,
        ]);
    }

    /**
     * Check the component values validity
     *
     * @throws \Exception
     * @return void
     */
    protected function checkValuesValidity(): void
    {
        parent::checkValuesValidity();
        $this->value = $this->value ? $this->value : ($this->model ? $this->model->{$this->name} : null);
        if ($this->value && is_string($this->value) && ! is_a($this->value, 'DateTime')) {
            try {
                Carbon::createFromFormat('Y-m-d\TH:i:s', $this->value);
            } catch (Exception $e) {
                throw new Exception(
                    get_class($this)
                    . ' : the value must be a valid datetime with datetime-local format (Y-m-dTH:i:s), « '
                    . $this->value . ' » given.'
                );
            }
        }
    }
}
