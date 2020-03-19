<?php

namespace Okipa\LaravelBootstrapComponents\Components\Media\Abstracts;

use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;

abstract class MediaAbstract extends ComponentAbstract
{
    /** @property string $label */
    protected $label;

    /** @property string|null $caption */
    protected $caption;

    /** @property string $src */
    protected $src;

    /**
     * MediaAbstract constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->caption = $this->setCaption();
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
     * Set the component caption.
     *
     * @param string|null $caption
     *
     * @return $this
     */
    public function caption(?string $caption): self
    {
        $this->caption = $caption;

        return $this;
    }

    /** @inheritDoc */
    protected function getValues(): array
    {
        $label = $this->getLabel();
        $src = $this->getSrc();
        $caption = $this->getCaption();

        return array_merge(parent::getValues(), compact('label', 'src', 'caption'));
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
    protected function getCaption(): ?string
    {
        return (string) __($this->caption);
    }

    /**
     * Set the component caption.
     *
     * @return string|null
     */
    abstract protected function setCaption(): ?string;

    /** @inheritDoc */
    protected function checkValuesValidity(): void
    {
        return;
    }
}
