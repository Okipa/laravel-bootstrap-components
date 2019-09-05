<?php

namespace Okipa\LaravelBootstrapComponents;

use Illuminate\Contracts\Support\Htmlable;

abstract class Component implements Htmlable
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey;
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
     * @return \Okipa\LaravelBootstrapComponents\Component
     */
    public function componentId(string $componentId): Component
    {
        $this->componentId = $componentId;

        return $this;
    }

    /**
     * Set the component classes.
     *
     * @param array $componentClasses
     *
     * @return \Okipa\LaravelBootstrapComponents\Component
     */
    public function componentClasses(array $componentClasses): Component
    {
        $this->componentClasses = $componentClasses;

        return $this;
    }

    /**
     * Set the component container id.
     *
     * @param string $containerId
     *
     * @return \Okipa\LaravelBootstrapComponents\Component
     */
    public function containerId(string $containerId): Component
    {
        $this->containerId = $containerId;

        return $this;
    }

    /**
     * Set the component container classes.
     *
     * @param array $containerClasses
     *
     * @return \Okipa\LaravelBootstrapComponents\Component
     */
    public function containerClasses(array $containerClasses): Component
    {
        $this->containerClasses = $containerClasses;

        return $this;
    }

    /**
     * Set the component html attributes.
     *
     * @param array $componentHtmlAttributes
     *
     * @return \Okipa\LaravelBootstrapComponents\Component
     */
    public function componentHtmlAttributes(array $componentHtmlAttributes): Component
    {
        $this->componentHtmlAttributes = $componentHtmlAttributes;

        return $this;
    }

    /**
     * Set the component container html attributes.
     *
     * @param array $containerHtmlAttributes
     *
     * @return \Okipa\LaravelBootstrapComponents\Component
     */
    public function containerHtmlAttributes(array $containerHtmlAttributes): Component
    {
        $this->containerHtmlAttributes = $containerHtmlAttributes;

        return $this;
    }

    /**
     * Render the component html.
     *
     * @return string|null
     * @throws \Throwable
     */
    public function toHtml(): ?string
    {
        return (string) $this->render();
    }

    /**
     * Render the component html.
     *
     * @param array $data
     *
     * @return string|null
     * @throws \Throwable
     */
    public function render(array $data = []): ?string
    {
        $this->checkValuesValidity();
        $view = $this->view();
        if ($view) {
            return (string) view('bootstrap-components::' . $view, $this->values(), $data)->render();
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
    protected function view(): string
    {
        return config('bootstrap-components.' . $this->configKey . '.view', '');
    }

    /**
     * Set the component values.
     *
     * @return array
     */
    protected function values(): array
    {
        return [
            'componentId'             => $this->componentId ? $this->componentId : $this->defaultComponentId(),
            'containerId'             => $this->containerId ? $this->containerId : $this->defaultContainerId(),
            'componentClasses'        => $this->componentClasses ? $this->componentClasses
                : $this->defaultComponentClass(),
            'containerClasses'        => $this->containerClasses
                ? $this->containerClasses
                : $this->defaultContainerClasses(),
            'componentHtmlAttributes' => $this->componentHtmlAttributes
                ? $this->componentHtmlAttributes
                : $this->defaultComponentHtmlAttributes(),
            'containerHtmlAttributes' => $this->containerHtmlAttributes
                ? $this->containerHtmlAttributes
                : $this->defaultContainerHtmlAttributes(),
        ];
    }

    /**
     * Set the default component id.
     *
     * @return string
     */
    protected function defaultComponentId(): string
    {
        return '';
    }

    /**
     * Set the default container id.
     *
     * @return string
     */
    protected function defaultContainerId(): string
    {
        return '';
    }

    /**
     * Set the default component class.
     *
     * @return array
     */
    protected function defaultComponentClass(): array
    {
        $componentClasses = config('bootstrap-components.' . $this->configKey . '.classes.component');

        return $componentClasses ? $componentClasses : [];
    }

    /**
     * Set the default container class.
     *
     * @return array
     */
    protected function defaultContainerClasses(): array
    {
        $containerClasses = config('bootstrap-components.' . $this->configKey . '.classes.container');

        return $containerClasses ? $containerClasses : [];
    }

    /**
     * Set the default component html attributes.
     *
     * @return array
     */
    protected function defaultComponentHtmlAttributes(): array
    {
        $componentHtmlAttributes = config('bootstrap-components.' . $this->configKey . '.htmlAttributes.component');

        return $componentHtmlAttributes ? $componentHtmlAttributes : [];
    }

    /**
     * Set the default container html attributes.
     *
     * @return array
     */
    protected function defaultContainerHtmlAttributes(): array
    {
        $containerHtmlAttributes = config('bootstrap-components.' . $this->configKey . '.htmlAttributes.container');

        return $containerHtmlAttributes ? $containerHtmlAttributes : [];
    }
}
