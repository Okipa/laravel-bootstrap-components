<?php

namespace Okipa\LaravelBootstrapComponents\Components\Media\Abstracts;

abstract class ImageAbstract extends MediaAbstract
{
    protected ?string $alt = null;

    protected ?int $width = null;

    protected ?int $height = null;

    protected ?string $linkId = null;

    protected array $linkClasses = [];

    protected ?string $linkUrl = null;

    protected ?string $linkTitle = null;

    protected array $linkHtmlAttributes = [];

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

    protected function getViewParams(): array
    {
        return array_merge(parent::getViewParams(), [
            'alt' => $this->getAlt(),
            'width' => $this->getWidth(),
            'height' => $this->getHeight(),
            'linkId' => $this->getLinkId(),
            'linkClasses' => $this->getLinkClasses(),
            'linkUrl' => $this->getLinkUrl(),
            'linkTitle' => $this->getLinkTitle(),
            'linkHtmlAttributes' => $this->getLinkHtmlAttributes(),
        ]);
    }

    protected function getAlt(): ?string
    {
        if ($this->alt) {
            return $this->alt;
        }
        $label = $this->getLabel();
        if ($label) {
            return $label;
        }

        return $this->linkTitle;
    }

    protected function getWidth(): ?int
    {
        return $this->width;
    }

    protected function getHeight(): ?int
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
        if ($this->linkTitle) {
            return $this->linkTitle;
        }
        $label = $this->getLabel();
        if ($label) {
            return $label;
        }

        return $this->alt;
    }

    protected function getLinkHtmlAttributes(): array
    {
        return $this->linkHtmlAttributes;
    }

    abstract protected function setLinkHtmlAttributes(): array;
}
