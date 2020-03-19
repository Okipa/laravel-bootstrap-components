<?php

namespace Okipa\LaravelBootstrapComponents\Components\Media\Abstracts;

abstract class VideoAbstract extends MediaAbstract
{
    /** @property string $poster */
    protected $poster;

    /**
     * VideoAbstract constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->poster = $this->setPoster();
    }

    /**
     * Set the video component poster.
     *
     * @param string $poster
     *
     * @return $this
     */
    public function poster(string $poster): self
    {
        $this->poster = $poster;

        return $this;
    }

    /** @inheritDoc */
    protected function getValues(): array
    {
        $poster = $this->getPoster();

        return array_merge(parent::getValues(), compact('poster'));
    }

    /**
     * Set the default video poster.
     *
     * @return string|null
     */
    protected function getPoster(): ?string
    {
        return $this->poster;
    }

    /**
     * Set the video component poster path.
     *
     * @return string|null
     */
    abstract protected function setPoster(): ?string;
}
