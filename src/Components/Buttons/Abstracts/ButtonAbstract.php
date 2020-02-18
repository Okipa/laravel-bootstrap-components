<?php

namespace Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts;

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
     * Set the button component route.
     * Will only be effective for « button » typed button components.
     *
     * @param string $route
     * @param array $params
     *
     * @return $this
     */
    public function route(string $route, array $params = []): self
    {
        $this->url = route($route, $params);

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
