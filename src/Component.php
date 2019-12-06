<?php

namespace Okipa\LaravelBootstrapComponents;

use Illuminate\Contracts\Support\Htmlable;
use Throwable;

abstract class Component implements Htmlable
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey;
    /**
     * The component type.
     *
     * @property string $type
     */
    protected $type;
    /**
     * The component view.
     *
     * @property string $view
     */
    protected $view;
    /**
     * The component id.
     *
     * @property string $componentId
     */
    protected $componentId;
    /**
     * The component container id.
     *
     * @property array $containerId
     */
    protected $containerId;
    /**
     * The component class.
     *
     * @property array $componentClasses
     */
    protected $componentClasses;
    /**
     * The component container class.
     *
     * @property array $containerClasses
     */
    protected $containerClasses;
    /**
     * The component html attributes.
     *
     * @property array $componentHtmlAttributes
     */
    protected $componentHtmlAttributes;
    /**
     * The component container html attributes.
     *
     * @property array $containerHtmlAttributes
     */
    protected $containerHtmlAttributes;

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
     * @return string|null
     * @throws Throwable
     */
    public function toHtml(): ?string
    {
        return (string)$this->render();
    }

    /**
     * Render the component html.
     *
     * @param array $extraData
     *
     * @return string
     * @throws Throwable
     */
    public function render(array $extraData = []): string
    {
        $this->checkValuesValidity();
        $view = $this->getView();
        if ($view) {
            $html = view('bootstrap-components::' . $view, array_merge($this->getValues(), $extraData))->render();

            return is_string($html) ? trim($html) : '';
        }
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
        return config('bootstrap-components.' . $this->configKey . '.view', '');
    }

    /**
     * Get values for the view.
     *
     * @return array
     */
    protected function getValues(): array
    {
        $htmlIdentifier = $this->getHtmlIdentifier();
        $componentId = $this->getComponentId();
        $containerId = $this->getContainerId();
        $componentClasses = $this->getComponentClasses();
        $containerClasses = $this->getContainerClasses();
        $componentHtmlAttributes = $this->getComponentHtmlAttributes();
        $containerHtmlAttributes = $this->getContainerHtmlAttributes();

        return compact(
            'htmlIdentifier',
            'componentId',
            'containerId',
            'componentClasses',
            'containerClasses',
            'componentHtmlAttributes',
            'containerHtmlAttributes'
        );
    }

    /**
     * @return string
     */
    protected function getHtmlIdentifier(): string
    {
        return $this->type;
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
        return $this->componentClasses
            ?? config('bootstrap-components.' . $this->configKey . '.classes.component', []);
    }

    /**
     * @return array
     */
    protected function getContainerClasses(): array
    {
        return $this->containerClasses
            ?? config('bootstrap-components.' . $this->configKey . '.classes.container', []);
    }

    /**
     * @return array
     */
    protected function getComponentHtmlAttributes(): array
    {
        return $this->componentHtmlAttributes
            ?? config('bootstrap-components.' . $this->configKey . '.htmlAttributes.component', []);
    }

    /**
     * @return array
     */
    protected function getContainerHtmlAttributes(): array
    {
        return $this->containerHtmlAttributes
            ?? config('bootstrap-components.' . $this->configKey . '.htmlAttributes.container', []);
    }

    /**
     * @return string
     */
    protected function getType(): string
    {
        return $this->type;
    }
}
