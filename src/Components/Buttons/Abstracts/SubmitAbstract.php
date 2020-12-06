<?php

namespace Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts;

use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;

abstract class SubmitAbstract extends ComponentAbstract
{
    protected ?string $prepend;

    protected ?string $append;

    protected ?string $label = null;

    public function __construct()
    {
        parent::__construct();
        $this->prepend = $this->setPrepend();
        $this->append = $this->setAppend();
        $this->label = $this->setLabel();
    }

    public function prepend(?string $html): self
    {
        $this->prepend = $html;

        return $this;
    }

    public function append(?string $html): self
    {
        $this->append = $html;

        return $this;
    }

    public function label(?string $label): self
    {
        $this->label = $label;

        return $this;
    }

    protected function getViewParams(): array
    {
        return array_merge(parent::getViewParams(), [
            'type' => $this->getType(),
            'url' => $this->getType(),
            'prepend' => $this->getPrepend(),
            'append' => $this->getAppend(),
            'label' => $this->getLabel(),
        ]);
    }

    protected function getPrepend(): ?string
    {
        return $this->prepend;
    }

    abstract protected function setPrepend(): ?string;

    protected function getAppend(): ?string
    {
        return $this->append;
    }

    abstract protected function setAppend(): ?string;

    public function getLabel(): ?string
    {
        return $this->label;
    }

    abstract protected function setLabel(): ?string;

    protected function checkValuesValidity(): void
    {
        //
    }
}
