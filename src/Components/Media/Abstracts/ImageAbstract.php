<?php

namespace Okipa\LaravelBootstrapComponents\Components\Media\Abstracts;

abstract class ImageAbstract extends MediaAbstract
{
    /** @property string $alt */
    protected $alt;

    /** @property int $width */
    protected $width;

    /** @property int $height */
    protected $height;

    /** @property string $linkId */
    protected $linkId;

    /** @property array $linkClasses */
    protected $linkClasses;

    /** @property string $linkUrl */
    protected $linkUrl;

    /** @property string $linkTitle */
    protected $linkTitle;

    /** @property array $linkHtmlAttributes */
    protected $linkHtmlAttributes;

    /**
     * ImageAbstract constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->linkClasses = $this->setLinkClasses();
        $this->linkHtmlAttributes = $this->setLinkHtmlAttributes();
    }

    /**
     * Define the image component alt HTML tag.
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
     * Define the component image HTML tag width.
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
     * Define the component image HTML tag height.
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
     * Set the image component link URL.
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
     * Set the image component link title.
     *
     * @param string $linkTitle
     *
     * @return $this
     */
    public function linkTitle(string $linkTitle): self
    {
        $this->linkTitle = $linkTitle;

        return $this;
    }

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
     * Set the image component link HTML attributes.
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

    /** @inheritDoc */
    protected function getValues(): array
    {
        $alt = $this->getAlt();
        $width = $this->getWidth();
        $height = $this->getHeight();
        $linkId = $this->getLinkId();
        $linkClasses = $this->getLinkClasses();
        $linkUrl = $this->getLinkUrl();
        $linkTitle = $this->getLinkTitle();
        $linkHtmlAttributes = $this->getLinkHtmlAttributes();

        return array_merge(
            parent::getValues(),
            compact('alt', 'width', 'height', 'linkId', 'linkClasses', 'linkUrl', 'linkTitle', 'linkHtmlAttributes')
        );
    }

    /**
     * Get the image component alt attribute.
     *
     * @return string|null
     */
    protected function getAlt(): ?string
    {
        return $this->alt ?: $this->getLabel() ?: $this->linkTitle;
    }

    /**
     * Get the image component width attribute.
     *
     * @return string|null
     */
    protected function getWidth(): ?string
    {
        return $this->width;
    }

    /**
     * Get the image component height attribute.
     *
     * @return string|null
     */
    protected function getHeight(): ?string
    {
        return $this->height;
    }

    /**
     * Set the default component id.
     *
     * @return string|null
     */
    protected function getLinkId(): ?string
    {
        return $this->linkId;
    }

    /**
     * Set the default container class.
     *
     * @return array
     */
    protected function getLinkClasses(): array
    {
        return $this->linkClasses;
    }

    /**
     * Set the image component link classes.
     *
     * @return array
     */
    abstract protected function setLinkClasses(): array;

    /**
     * Get the image component link url.
     *
     * @return string|null
     */
    protected function getLinkUrl(): ?string
    {
        return $this->linkUrl;
    }

    /**
     * Get the image component link url.
     *
     * @return string|null
     */
    protected function getLinkTitle(): ?string
    {
        return $this->linkTitle ?: $this->getLabel() ?: $this->alt;
    }

    /**
     * Set the default component HTML attributes.
     *
     * @return array
     */
    protected function getLinkHtmlAttributes(): array
    {
        return $this->linkHtmlAttributes;
    }

    /**
     * Set the image component link HTML attributes.
     *
     * @return array
     */
    abstract protected function setLinkHtmlAttributes(): array;
}
