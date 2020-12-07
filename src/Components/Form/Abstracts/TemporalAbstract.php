<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form\Abstracts;

use Carbon\Carbon;
use Okipa\LaravelBootstrapComponents\Components\Form\Traits\TemporalValidityChecks;

abstract class TemporalAbstract extends FormAbstract
{
    use TemporalValidityChecks;

    protected string $format;

    public function __construct()
    {
        parent::__construct();
        $this->format = $this->setFormat();
    }

    public function format(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    protected function getValue(): ?string
    {
        $value = parent::getValue();
        if (! $value) {
            return null;
        }

        return is_a($value, 'DateTime')
            ? $value->format($this->getFormat())
            : Carbon::parse($value)->format($this->getFormat());
    }

    protected function getFormat(): string
    {
        return $this->format;
    }

    abstract protected function setFormat(): string;
}
