<?php

namespace Okipa\LaravelBootstrapComponents\Form;

use Carbon\Carbon;
use Okipa\LaravelBootstrapComponents\Form\Traits\DatetimeValidityChecks;

class Datetime extends Input
{
    use DatetimeValidityChecks;
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
     * The datetime format.
     *
     * @property string $format
     */
    protected $format;

    /**
     * Set the datetime format.
     *
     * @param string $format
     *
     * @return $this
     */
    public function format(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    /**
     * Set the input values.
     *
     * @return array
     */
    protected function getValues(): array
    {
        if (is_a($this->value, 'DateTime')) {
            $value = $this->value->format($this->format);
        } else {
            $value = Carbon::parse($this->value)->format($this->format);
        }

        return array_merge(parent::getValues(), [
            'value' => $value,
        ]);
    }

    /**
     * Set the datetime default format
     *
     * @return string
     */
    protected function defaultFormat(): string
    {
        $format = config('bootstrap-components.' . $this->configKey . '.format');

        return $format ? $format : '';
    }
}
