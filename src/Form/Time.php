<?php

namespace Okipa\LaravelBootstrapComponents\Form;

use Carbon\Carbon;
use Okipa\LaravelBootstrapComponents\Form\Traits\TimeValidityChecks;

class Time extends Input
{
    use TimeValidityChecks;
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
