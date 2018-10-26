<?php

namespace Okipa\LaravelBootstrapComponents\Form;

use Carbon\Carbon;
use Exception;

class Time extends Input
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'form.time';
    /**
     * The input type.
     *
     * @property string $type
     */
    protected $type = 'time';
    /**
     * The time format.
     *
     * @property string $format
     */
    protected $format;

    /**
     * Set the time format.
     *
     * @param string $format
     *
     * @return \Okipa\LaravelBootstrapComponents\Form\Input
     */
    public function format(string $format): Input
    {
        $this->format = $format;

        return $this;
    }

    /**
     * Set the input values.
     *
     * @return array
     */
    protected function values(): array
    {
        if (is_a($this->value, 'DateTime')) {
            $value = $this->value->format($this->format);
        } else {
            $value = Carbon::parse($this->value)->format($this->format);
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
     * Set the time default format
     *
     * @return string
     */
    protected function defaultFormat(): string
    {
        $format = config('bootstrap-components.' . $this->configKey . '.format');

        return $format ? $format : '';
    }
}
