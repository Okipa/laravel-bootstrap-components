<?php

namespace Okipa\LaravelBootstrapComponents\Components\Media\Abstracts;

use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;

abstract class MediaAbstract extends ComponentAbstract
{
    /** @property string $label */
    protected $label;

    /** @property string|null $legend */
    protected $legend;

    /** @property string $src */
    protected $src;

    /**
     * MediaAbstract constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->legend = $this->setLegend();
    }

    /**
     * Set the component label.
     *
     * @param string|null $label
     *
     * @return $this
     */
    public function label(?string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Set the component src attribute.
     *
     * @param string $src
     *
     * @return $this
     */
    public function src(string $src): self
    {
        $this->src = $src;

        return $this;
    }

    /**
     * Set the component legend.
     *
     * @param string|null $legend
     *
     * @return $this
     */
    public function legend(?string $legend): self
    {
        $this->legend = $legend;

        return $this;
    }

    /**
     * @inheritDoc
     */
    protected function getValues(): array
    {
        $label = $this->getLabel();
        $src = $this->getSrc();
        $legend = $this->getLegend();

        return array_merge(parent::getValues(), compact('label', 'src', 'legend'));
    }

    /**
     * @return string|null
     */
    protected function getLabel(): ?string
    {
        return (string) __($this->label);
    }

    /**
     * @return string|null
     */
    protected function getSrc(): ?string
    {
        return $this->src;
    }

    /**
     * @return string|null
     */
    protected function getLegend(): ?string
    {
        return (string) __($this->legend);
    }

    /**
     * Set the component legend.
     *
     * @return string|null
     */
    abstract protected function setLegend(): ?string;

    /**
     * @inheritDoc
     */
    protected function checkValuesValidity(): void
    {
        return;
    }
}
