<?php

namespace Okipa\LaravelBootstrapComponents\Media;

class Video extends Media
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'media.video';

    /**
     * The button type.
     *
     * @property string $type
     */
    protected $type = 'video';

    /**
     * The video poster.
     *
     * @property string $poster
     */
    protected $poster;

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

    /**
     * Set the video values.
     *
     * @return array
     */
    protected function getValues(): array
    {
        $poster = $this->getPoster();

        return array_merge(parent::getValues(), compact('poster'));
    }

    /**
     * Set the default video poster.
     *
     * @return string
     */
    protected function getPoster(): string
    {
        return $this->poster ?? config('bootstrap-components.' . $this->configKey . '.poster', '');
    }
}
