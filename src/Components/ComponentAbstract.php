<?php

namespace Okipa\LaravelBootstrapComponents\Components;

use Illuminate\Contracts\Support\Htmlable;

abstract class ComponentAbstract implements Htmlable
{
    protected string $type;

    protected string $view;

    protected ?string $componentId = null;

    protected ?string $containerId = null;

    protected array $componentClasses;

    protected array $containerClasses;

    protected array $componentHtmlAttributes;

    protected array $containerHtmlAttributes;

    public function __construct()
    {
        $this->type = $this->setType();
        $this->view = $this->setView();
        $this->containerClasses = $this->setContainerClasses();
        $this->containerHtmlAttributes = $this->setContainerHtmlAttributes();
        $this->componentClasses = $this->setComponentClasses();
        $this->componentHtmlAttributes = $this->setComponentHtmlAttributes();
    }

    /**
     * @return string
     * @throws \Throwable
     */
    public function toHtml(): string
    {
        return $this->render();
    }

    /**
     * @param array $extraData
     *
     * @return string
     * @throws \Throwable
     */
    public function render(array $extraData = []): string
    {
        $this->checkValuesValidity();
        $view = $this->getView();
        $html = $view
            ? (string) view('bootstrap-components::' . $view, array_merge($this->getViewParams(), $extraData))->render()
            : '';

        return trim($html);
    }

    public function containerId(string $containerId): self
    {
        $this->containerId = $containerId;

        return $this;
    }

    public function componentId(string $componentId): self
    {
        $this->componentId = $componentId;

        return $this;
    }

    public function componentClasses(array $componentClasses, bool $mergeMode = false): self
    {
        $this->componentClasses = $mergeMode
            ? array_merge($this->componentClasses, $componentClasses)
            : $componentClasses;

        return $this;
    }

    public function containerClasses(array $containerClasses, bool $mergeMode = false): self
    {
        $this->containerClasses = $mergeMode
            ? array_merge($this->containerClasses, $containerClasses)
            : $containerClasses;

        return $this;
    }

    public function componentHtmlAttributes(array $componentHtmlAttributes, bool $mergeMode = false): self
    {
        $this->componentHtmlAttributes = $mergeMode
            ? array_merge($this->componentHtmlAttributes, $componentHtmlAttributes)
            : $componentHtmlAttributes;

        return $this;
    }

    public function containerHtmlAttributes(array $containerHtmlAttributes, bool $mergeMode = false): self
    {
        $this->containerHtmlAttributes = $mergeMode
            ? array_merge($this->containerHtmlAttributes, $containerHtmlAttributes)
            : $containerHtmlAttributes;

        return $this;
    }

    abstract protected function checkValuesValidity(): void;

    protected function getView(): string
    {
        return $this->view;
    }

    abstract protected function setView(): string;

    protected function getViewParams(): array
    {
        return [
            'containerId' => $this->getContainerId(),
            'containerClasses' => $this->getContainerClasses(),
            'containerHtmlAttributes' => $this->getContainerHtmlAttributes(),
            'componentId' => $this->getComponentId(),
            'componentClasses' => $this->getComponentClasses(),
            'componentHtmlAttributes' => $this->getComponentHtmlAttributes(),
        ];
    }

    protected function getContainerId(): ?string
    {
        return $this->containerId;
    }

    protected function getComponentId(): ?string
    {
        return $this->componentId;
    }

    protected function getContainerClasses(): array
    {
        return $this->containerClasses;
    }

    abstract protected function setContainerClasses(): array;

    protected function getComponentClasses(): array
    {
        return $this->componentClasses;
    }

    abstract protected function setComponentClasses(): array;

    protected function getContainerHtmlAttributes(): array
    {
        return $this->containerHtmlAttributes;
    }

    abstract protected function setContainerHtmlAttributes(): array;

    protected function getComponentHtmlAttributes(): array
    {
        return $this->componentHtmlAttributes;
    }

    abstract protected function setComponentHtmlAttributes(): array;

    protected function getType(): string
    {
        return $this->type;
    }

    abstract protected function setType(): string;
}
