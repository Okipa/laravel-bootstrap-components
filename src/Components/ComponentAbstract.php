<?php

namespace Okipa\LaravelBootstrapComponents\Components;

use Illuminate\Contracts\Support\Htmlable;

abstract class ComponentAbstract implements Htmlable
{
    protected string $type;

    protected string $view;

    protected string $componentId;

    protected string $containerId;

    protected array $componentClasses;

    protected array $containerClasses;

    protected array $componentHtmlAttributes;

    protected array $containerHtmlAttributes;

    public function __construct()
    {
        $this->type = $this->setType();
        $this->view = $this->setView();
        $this->componentClasses = $this->setComponentClasses();
        $this->componentHtmlAttributes = $this->setComponentHtmlAttributes();
        $this->containerClasses = $this->setContainerClasses();
        $this->containerHtmlAttributes = $this->setContainerHtmlAttributes();
    }

    public function componentId(string $componentId): self
    {
        $this->componentId = $componentId;

        return $this;
    }

    public function componentClasses(array $componentClasses): self
    {
        $this->componentClasses = $componentClasses;

        return $this;
    }

    public function containerId(string $containerId): self
    {
        $this->containerId = $containerId;

        return $this;
    }

    /**
     * Set the component container classes.
     *
     * @param array $containerClasses
     *
     * @return $this
     */
    public function containerClasses(array $containerClasses): self
    {
        $this->containerClasses = $containerClasses;

        return $this;
    }

    public function componentHtmlAttributes(array $componentHtmlAttributes): self
    {
        $this->componentHtmlAttributes = $componentHtmlAttributes;

        return $this;
    }

    public function containerHtmlAttributes(array $containerHtmlAttributes): self
    {
        $this->containerHtmlAttributes = $containerHtmlAttributes;

        return $this;
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
            ? (string) view('bootstrap-components::' . $view, array_merge($this->getValues(), $extraData))->render()
            : '';

        return trim($html);
    }

    abstract protected function checkValuesValidity(): void;

    protected function getView(): string
    {
        return $this->view;
    }

    abstract protected function setView(): string;

    protected function getValues(): array
    {
        $componentId = $this->getComponentId();
        $containerId = $this->getContainerId();
        $componentClasses = $this->getComponentClasses();
        $containerClasses = $this->getContainerClasses();
        $componentHtmlAttributes = $this->getComponentHtmlAttributes();
        $containerHtmlAttributes = $this->getContainerHtmlAttributes();

        return compact(
            'componentId',
            'containerId',
            'componentClasses',
            'containerClasses',
            'componentHtmlAttributes',
            'containerHtmlAttributes'
        );
    }

    protected function getComponentId(): ?string
    {
        return $this->componentId;
    }

    protected function getContainerId(): ?string
    {
        return $this->containerId;
    }

    protected function getComponentClasses(): array
    {
        return $this->componentClasses;
    }

    abstract protected function setComponentClasses(): array;

    protected function getContainerClasses(): array
    {
        return $this->containerClasses;
    }

    abstract protected function setContainerClasses(): array;

    protected function getComponentHtmlAttributes(): array
    {
        return $this->componentHtmlAttributes;
    }

    abstract protected function setComponentHtmlAttributes(): array;

    protected function getContainerHtmlAttributes(): array
    {
        return $this->containerHtmlAttributes;
    }

    abstract protected function setContainerHtmlAttributes(): array;

    protected function getType(): string
    {
        return $this->type;
    }

    abstract protected function setType(): string;
}
