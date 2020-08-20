<?php

namespace Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts;

abstract class ButtonAbstract extends SubmitAbstract
{
    protected ?string $url;

    public function __construct()
    {
        parent::__construct();
        $this->url = $this->setUrl();
    }

    public function url(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function route(string $route, array $params = []): self
    {
        $this->url = route($route, $params);

        return $this;
    }

    protected function getParameters(): array
    {
        $url = $this->getUrl();

        return array_merge(parent::getParameters(), compact('url'));
    }

    protected function getUrl(): ?string
    {
        return $this->url;
    }

    abstract protected function setUrl(): ?string;
}
