<?php

namespace Okipa\LaravelBootstrapComponents\Components\Media\Abstracts;

abstract class ImageAbstract extends MediaAbstract
{
    protected ?string $alt;

    protected ?int $width;

    protected ?int $height;

    protected string $linkId;

    protected array $linkClasses;

    protected ?string $linkUrl;

    protected string $linkTitle;

    protected array $linkHtmlAttributes;

    public function __construct()
    {
        parent::__construct();
        $this->linkClasses = $this->setLinkClasses();
        $this->linkHtmlAttributes = $this->setLinkHtmlAttributes();
    }

    public function alt(string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    public function width(int $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function height(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function linkUrl(string $linkUrl): self
    {
        $this->linkUrl = $linkUrl;

        return $this;
    }

    public function linkTitle(string $linkTitle): self
    {
        $this->linkTitle = $linkTitle;

        return $this;
    }

    public function linkId(string $linkId): self
    {
        $this->linkId = $linkId;

        return $this;
    }

    public function linkClasses(array $linkClasses): self
    {
        $this->linkClasses = $linkClasses;

        return $this;
    }

    public function linkHtmlAttributes(array $linkHtmlAttributes): self
    {
        $this->linkHtmlAttributes = $linkHtmlAttributes;

        return $this;
    }

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

    protected function getAlt(): ?string
    {
        return $this->alt ?: $this->getLabel() ?: $this->linkTitle;
    }

    protected function getWidth(): ?string
    {
        return $this->width;
    }

    protected function getHeight(): ?string
    {
        return $this->height;
    }

    protected function getLinkId(): ?string
    {
        return $this->linkId;
    }

    protected function getLinkClasses(): array
    {
        return $this->linkClasses;
    }

    abstract protected function setLinkClasses(): array;

    protected function getLinkUrl(): ?string
    {
        return $this->linkUrl;
    }

    protected function getLinkTitle(): ?string
    {
        return $this->linkTitle ?: $this->getLabel() ?: $this->alt;
    }

    protected function getLinkHtmlAttributes(): array
    {
        return $this->linkHtmlAttributes;
    }

    abstract protected function setLinkHtmlAttributes(): array;
}
