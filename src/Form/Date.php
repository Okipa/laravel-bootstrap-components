<?php

namespace Okipa\LaravelBootstrapComponents\Form;

use Carbon\Carbon;
use Okipa\LaravelBootstrapComponents\Form\Traits\DateValidityChecks;

class Date extends Input
{
    use DateValidityChecks;
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
     * The date format.
     *
     * @property string $format
     */
    protected $format;

    /**
     * Set the date format.
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
     * Set the date default format
     *
     * @return string
     */
    protected function defaultFormat(): string
    {
        $format = config('bootstrap-components.' . $this->configKey . '.format');

        return $format ? $format : '';
    }
}
