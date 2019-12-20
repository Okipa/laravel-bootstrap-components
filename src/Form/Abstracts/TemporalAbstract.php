<?php

namespace Okipa\LaravelBootstrapComponents\Form\Abstracts;

use Carbon\Carbon;
use Okipa\LaravelBootstrapComponents\Form\Traits\TemporalValidityChecks;

abstract class TemporalAbstract extends FormAbstract
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
        parent::__construct();
        $this->format = $this->setFormat();
    }

    /**
     * Set the temporal format.
     *
     * @return string
     */
    abstract protected function setFormat(): string;

    /**
     * Get the temporal format.
     *
     * @return string
     */
    protected function getFormat(): string
    {
        return $this->format;
    }

    /**
     * Set the temporal format.
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
