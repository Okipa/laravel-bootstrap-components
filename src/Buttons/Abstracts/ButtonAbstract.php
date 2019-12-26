<?php

namespace Okipa\LaravelBootstrapComponents\Buttons\Abstracts;

abstract class ButtonAbstract extends SubmitAbstract
{
    /** @property string $url */
    protected $url;

    /**
     * ButtonAbstract constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->url = $this->setUrl();
    }

    /**
     * Set the button component url.
     *
     * @param string $url
     *
     * @return $this
     */
    public function url(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return array
     */
    protected function getParameters(): array
    {
        $url = $this->getUrl();

        return array_merge(parent::getParameters(), compact('url'));
    }

    /**
     * @return string|null
     */
    protected function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * Set the button component Url.
     *
     * @return string|null
     */
    abstract protected function setUrl(): ?string;
}
