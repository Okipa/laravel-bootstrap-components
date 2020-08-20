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

    protected function getValues(): array
    {
        $poster = $this->getPoster();

        return array_merge(parent::getValues(), compact('poster'));
    }

    protected function getPoster(): ?string
    {
        return $this->poster;
    }

    abstract protected function setPoster(): ?string;
}
