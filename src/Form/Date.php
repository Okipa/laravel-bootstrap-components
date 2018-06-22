<?php

namespace Okipa\LaravelBootstrapComponents\Form;

use Carbon\Carbon;
use Exception;

class Date extends Input
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'form.date';
    /**
     * The input type.
     *
     * @property string $type
     */
    protected $type = 'date';

    /**
     * Set the input values.
     *
     * @return array
     */
    protected function values(): array
    {
        if (is_a($this->value, 'DateTime')) {
            $value = $this->value->format('Y-m-d');
        } else {
            $value = Carbon::parse($this->value)->format('Y-m-d');
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
                Carbon::createFromFormat('Y-m-d', $this->value);
            } catch (Exception $e) {
                throw new Exception(
                    get_class($this)
                    . ' : the value must be a valid date (Y-m-d), « '
                    . $this->value . ' » given.'
                );
            }
        }
    }
}
