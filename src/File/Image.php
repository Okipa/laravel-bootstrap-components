<?php

namespace Okipa\LaravelBootstrapComponents\File;

class Image extends Media
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'image';
    /**
     * The image link url.
     *
     * @property string $linkUrl
     */
    protected $linkUrl;
    /**
     * The image alt.
     *
     * @property string $alt
     */
    protected $alt;
    /**
     * The image width.
     *
     * @property int $width
     */
    protected $width;
    /**
     * The image height.
     *
     * @property int $height
     */
    protected $height;
    /**
     * The image link class.
     *
     * @property array $linkClass
     */
    protected $linkClass = [];
    /**
     * The image link html attributes.
     *
     * @property array $containerHtmlAttributes
     */
    protected $linkHtmlAttributes = [];

    /**
     * Set the image link url.
     *
     * @param string $linkUrl
     *
     * @return \App\Components\File\Image
     */
    public function linkUrl(string $linkUrl): Image
    {
        $this->linkUrl = $linkUrl;

        return $this;
    }

    /**
     * Set the image alt.
     *
     * @param string $alt
     *
     * @return \App\Components\File\Image
     */
    public function alt(string $alt): Image
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Set the image width.
     *
     * @param int $width
     *
     * @return \App\Components\File\Image
     */
    public function width(int $width): Image
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Set the image height.
     *
     * @param int $height
     *
     * @return \App\Components\File\Image
     */
    public function height(int $height): Image
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Set the image link class tag.
     *
     * @param array $linkClass
     *
     * @return $this
     */
    public function linkClass(array $linkClass): Image
    {
        $this->linkClass = $linkClass;

        return $this;
    }

    /**
     * Set the component html attributes.
     *
     * @param array $linkHtmlAttributes
     *
     * @return \App\Components\File\Image
     */
    public function linkHtmlAttributes(array $linkHtmlAttributes): Image
    {
        $this->linkHtmlAttributes = $linkHtmlAttributes;

        return $this;
    }

    /**
     * Set the image values.
     *
     * @return array
     */
    protected function values(): array
    {
        return array_merge(parent::values(), [
            'linkUrl'            => $this->linkUrl,
            'alt'                => $this->alt,
            'width'              => $this->width,
            'height'             => $this->height,
            'linkClass'          => array_merge($this->defaultLinkClass(), $this->linkClass),
            'linkHtmlAttributes' => array_merge($this->defaultLinkHtmlAttributes(), $this->linkHtmlAttributes),
        ]);
    }

    /**
     * Set the default container class.
     *
     * @return array
     */
    protected function defaultLinkClass(): array
    {
        return config('components.' . $this->configKey . '.class.link');
    }

    /**
     * Set the default component html attributes.
     *
     * @return array
     */
    protected function defaultLinkHtmlAttributes(): array
    {
        return config('components.' . $this->configKey . '.attributes.link');
    }
}
