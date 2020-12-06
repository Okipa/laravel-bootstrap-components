<?php

namespace Okipa\LaravelBootstrapComponents\Components\Media\Abstracts;

abstract class VideoAbstract extends MediaAbstract
{
    protected ?string $poster;

    public function __construct()
    {
        parent::__construct();
        $this->poster = $this->setPoster();
    }

    public function poster(string $poster): self
    {
        $this->poster = $poster;

        return $this;
    }

    protected function getViewParams(): array
    {
        return array_merge(parent::getViewParams(), ['poster' => $this->getPoster()]);
    }

    protected function getPoster(): ?string
    {
        return $this->poster;
    }

    abstract protected function setPoster(): ?string;
}
