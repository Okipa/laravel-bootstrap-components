<?php

namespace Okipa\LaravelBootstrapComponents\Media;

class Image extends Media
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'media.image';
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
     * The image link id.
     *
     * @property string $linkId
     */
    protected $linkId;
    /**
     * The image link class.
     *
     * @property array $linkClasses
     */
    protected $linkClasses;
    /**
     * The image link html attributes.
     *
     * @property array $containerHtmlAttributes
     */
    protected $linkHtmlAttributes;

    /**
     * Set the image component link id.
     *
     * @param string $linkId
     *
     * @return $this
     */
    public function linkId(string $linkId): self
    {
        $this->linkId = $linkId;

        return $this;
    }

    /**
     * Wrap the component image html tag in a link and set its url.
     *
     * @param string $linkUrl
     *
     * @return $this
     */
    public function linkUrl(string $linkUrl): self
    {
        $this->linkUrl = $linkUrl;

        return $this;
    }

    /**
     * Define the image component alt html tag.
     *
     * @param string $alt
     *
     * @return $this
     */
    public function alt(string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Define the component image html tag width.
     *
     * @param int $width
     *
     * @return $this
     */
    public function width(int $width): self
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Define the component image html tag height.
     *
     * @param int $height
     *
     * @return $this
     */
    public function height(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Set the image component link classes.
     *
     * @param array $linkClasses
     *
     * @return $this
     */
    public function linkClasses(array $linkClasses): self
    {
        $this->linkClasses = $linkClasses;

        return $this;
    }

    /**
     * Set the image component link html attributes.
     *
     * @param array $linkHtmlAttributes
     *
     * @return $this
     */
    public function linkHtmlAttributes(array $linkHtmlAttributes): self
    {
        $this->linkHtmlAttributes = $linkHtmlAttributes;

        return $this;
    }

    /**
     * Set the image values.
     *
     * @return array
     */
    protected function getValues(): array
    {
        return array_merge(parent::getValues(), [
            'linkUrl'            => $this->linkUrl,
            'alt'                => $this->alt,
            'width'              => $this->width,
            'height'             => $this->height,
            'linkId'             => $this->linkId ? $this->linkId : $this->defaultLinkId(),
            'linkClasses'        => $this->linkClasses ? $this->linkClasses : $this->defaultLinkClasses(),
            'linkHtmlAttributes' => $this->linkHtmlAttributes
                ? $this->linkHtmlAttributes
                : $this->defaultLinkHtmlAttributes(),
        ]);
    }

    /**
     * Set the default component id.
     *
     * @return string
     */
    protected function defaultLinkId(): string
    {
        return '';
    }

    /**
     * Set the default container class.
     *
     * @return array
     */
    protected function defaultLinkClasses(): array
    {
        $linkClasses = config('bootstrap-components.' . $this->configKey . '.classes.link');

        return $linkClasses ? $linkClasses : [];
    }

    /**
     * Set the default component html attributes.
     *
     * @return array
     */
    protected function defaultLinkHtmlAttributes(): array
    {
        $linkHtmlAttributes = config('bootstrap-components.' . $this->configKey . '.htmlAttributes.link');

        return $linkHtmlAttributes ? $linkHtmlAttributes : [];
    }
}
