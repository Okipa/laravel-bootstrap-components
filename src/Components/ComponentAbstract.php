<?php

namespace Okipa\LaravelBootstrapComponents\Components;

use Illuminate\Contracts\Support\Htmlable;

abstract class ComponentAbstract implements Htmlable
{
    /** @property string $type */
    protected $type;

    /** @property string $view */
    protected $view;

    /** @property string $componentId */
    protected $componentId;

    /** @property array $containerId */
    protected $containerId;

    /** @property array $componentClasses */
    protected $componentClasses;

    /** @property array $containerClasses */
    protected $containerClasses;

    /** @property array $componentHtmlAttributes */
    protected $componentHtmlAttributes;

    /** @property array $containerHtmlAttributes */
    protected $containerHtmlAttributes;

    /**
     * Component constructor.
     */
    public function __construct()
    {
        $this->type = $this->setType();
        $this->view = $this->setView();
        $this->componentClasses = $this->setComponentClasses();
        $this->componentHtmlAttributes = $this->setComponentHtmlAttributes();
        $this->containerClasses = $this->setContainerClasses();
        $this->containerHtmlAttributes = $this->setContainerHtmlAttributes();
    }

    /**
     * Set the component id.
     *
     * @param string $componentId
     *
     * @return $this
     */
    public function componentId(string $componentId): self
    {
        $this->componentId = $componentId;

        return $this;
    }

    /**
     * Set the component classes.
     *
     * @param array $componentClasses
     *
     * @return $this
     */
    public function componentClasses(array $componentClasses): self
    {
        $this->componentClasses = $componentClasses;

        return $this;
    }

    /**
     * Set the component container id.
     *
     * @param string $containerId
     *
     * @return $this
     */
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

    /**
     * Set the component html attributes.
     *
     * @param array $componentHtmlAttributes
     *
     * @return $this
     */
    public function componentHtmlAttributes(array $componentHtmlAttributes): self
    {
        $this->componentHtmlAttributes = $componentHtmlAttributes;

        return $this;
    }

    /**
     * Set the component container html attributes.
     *
     * @param array $containerHtmlAttributes
     *
     * @return $this
     */
    public function containerHtmlAttributes(array $containerHtmlAttributes): self
    {
        $this->containerHtmlAttributes = $containerHtmlAttributes;

        return $this;
    }

    /**
     * Render the component html.
     *
     * @return string
     * @throws \Throwable
     */
    public function toHtml(): string
    {
        return $this->render();
    }

    /**
     * Render the component html.
     *
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

    /**
     * Check the component values validity
     */
    abstract protected function checkValuesValidity(): void;

    /**
     * Set the component view.
     *
     * @return string
     */
    protected function getView(): string
    {
        return $this->view;
    }

    /**
     * Set the component view path.
     *
     * @return string
     */
    abstract protected function setView(): string;

    /**
     * Get values for the view.
     *
     * @return array
     */
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

    /**
     * @return string|null
     */
    protected function getComponentId(): ?string
    {
        return $this->componentId;
    }

    /**
     * @return string|null
     */
    protected function getContainerId(): ?string
    {
        return $this->containerId;
    }

    /**
     * @return array
     */
    protected function getComponentClasses(): array
    {
        return $this->componentClasses;
    }

    /**
     * Set the component classes.
     *
     * @return array
     */
    abstract protected function setComponentClasses(): array;

    /**
     * @return array
     */
    protected function getContainerClasses(): array
    {
        return $this->containerClasses;
    }

    /**
     * Set the container classes.
     *
     * @return array
     */
    abstract protected function setContainerClasses(): array;

    /**
     * @return array
     */
    protected function getComponentHtmlAttributes(): array
    {
        return $this->componentHtmlAttributes;
    }

    /**
     * Set the component html attributes.
     *
     * @return array
     */
    abstract protected function setComponentHtmlAttributes(): array;

    /**
     * @return array
     */
    protected function getContainerHtmlAttributes(): array
    {
        return $this->containerHtmlAttributes;
    }

    /**
     * Set the container html attributes.
     *
     * @return array
     */
    abstract protected function setContainerHtmlAttributes(): array;

    /**
     * @return string
     */
    protected function getType(): string
    {
        return $this->type;
    }

    /**
     * Set the component type.
     *
     * @return string
     */
    abstract protected function setType(): string;
}
