<?php

namespace Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts;

use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;

abstract class SubmitAbstract extends ComponentAbstract
{
    /** @property string|null $prepend */
    protected $prepend;

    /** @property string|null $append */
    protected $append;

    /** @property string $label */
    protected $label;

    /**
     * ButtonAbstract constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->prepend = $this->setPrepend();
        $this->append = $this->setAppend();
        $this->label = $this->setLabel();
    }

    /**
     * Prepend HTML to the button component label.
     * Set false to hide it.
     *
     * @param string|null $html
     *
     * @return $this
     */
    public function prepend(?string $html): self
    {
        $this->prepend = $html;

        return $this;
    }

    /**
     * Append HTML to the button component label.
     * Set false to hide it.
     *
     * @param string|null $html
     *
     * @return $this
     */
    public function append(?string $html): self
    {
        $this->append = $html;

        return $this;
    }

    /**
     * Set the button component label.
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

    /** @inheritDoc */
    protected function getValues(): array
    {
        return array_merge(parent::getValues(), $this->getParameters());
    }

    /**
     * @return array
     */
    protected function getParameters(): array
    {
        $type = $this->getType();
        $url = null;
        $prepend = $this->getPrepend();
        $append = $this->getAppend();
        $label = $this->getLabel();

        return compact('type', 'url', 'prepend', 'append', 'label');
    }

    /**
     * @return string|null
     */
    protected function getPrepend(): ?string
    {
        return $this->prepend;
    }

    /**
     * Set the component prepended HTML.
     *
     * @return string
     */
    abstract protected function setPrepend(): ?string;

    /**
     * @return string|null
     */
    protected function getAppend(): ?string
    {
        return $this->append;
    }

    /**
     * Set the component appended HTML.
     *
     * @return string|null
     */
    abstract protected function setAppend(): ?string;

    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * Set the component label.
     *
     * @return string|null
     */
    abstract protected function setLabel(): ?string;

    /**
     * Check the component values validity
     *
     * @throws \Exception
     */
    protected function checkValuesValidity(): void
    {
        return;
    }
}
