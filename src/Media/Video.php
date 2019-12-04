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
        return array_merge(parent::getValues(), [
            'poster' => $this->poster ? $this->poster : $this->defaultPoster(),
        ]);
    }

    /**
     * Set the default video poster.
     *
     * @return string
     */
    protected function defaultPoster(): string
    {
        $poster = config('bootstrap-components.' . $this->configKey . '.poster');

        return $poster ? $poster : '';
    }
}
