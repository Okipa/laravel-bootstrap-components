<?php

namespace Okipa\LaravelBootstrapComponents\Form\Abstracts;

use Carbon\Carbon;
use Okipa\LaravelBootstrapComponents\Form\Traits\TemporalValidityChecks;

abstract class Temporal extends Form
{
    use TemporalValidityChecks;

    /**
     * The temporal format.
     *
     * @property string $format
     */
    protected $format;

    /**
     * Temporal constructor.
     */
    public function __construct()
    {
        $this->format = $this->getFormat();
    }

    /**
     * Get the time format
     *
     * @return string
     */
    protected function getFormat(): string
    {
        return $this->format ?: (config('bootstrap-components.' . $this->configKey . '.format') ?: '');
    }

    /**
     * Set the time format.
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
     * @return mixed
     */
    protected function getValue()
    {
        $value = parent::getValue();

        return is_a($value, 'DateTime')
            ? $value->format($this->getFormat())
            : Carbon::parse($value)->format($this->getFormat());
    }
}
