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
     * @property array $componentClass
     */
    protected $componentClass;
    /**
     * The component container class.
     *
     * @property array $containerClass
     */
    protected $containerClass;
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
     * Set the component class.
     *
     * @param array $componentClass
     *
     * @return \Okipa\LaravelBootstrapComponents\Component
     */
    public function componentClass(array $componentClass): Component
    {
        $this->componentClass = $componentClass;

        return $this;
    }

    /**
     * Set the container id.
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
     * Set the component container class.
     *
     * @param array $containerClass
     *
     * @return \Okipa\LaravelBootstrapComponents\Component
     */
    public function containerClass(array $containerClass): Component
    {
        $this->containerClass = $containerClass;

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
     * @return string
     * @throws \Throwable
     */
    public function toHtml()
    {
        return (string) $this->render();
    }

    /**
     * Render the component html.
     *
     * @param array $data
     *
     * @return string
     * @throws \Throwable
     */
    public function render(array $data = [])
    {
        $this->checkValuesValidity();
        if ($view = $this->view()) {
            return view('bootstrap-components::' . $view, $this->values(), $data)->render();
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
        $componentId = $this->componentId
            ? $this->componentId
            : $this->defaultComponentId();
        $containerId = $this->containerId
            ? $this->containerId
            : $this->defaultContainerId();
        $componentClass = $this->componentClass
            ? $this->componentClass
            : $this->defaultComponentClass();
        $containerClass = $this->containerClass
            ? $this->containerClass
            : $this->defaultContainerClass();
        $componentHtmlAttributes = $this->componentHtmlAttributes
            ? $this->componentHtmlAttributes
            : $this->defaultComponentHtmlAttributes();
        $containerHtmlAttributes = $this->containerHtmlAttributes
            ? $this->containerHtmlAttributes
            : $this->defaultContainerHtmlAttributes();

        return compact(
            'componentId',
            'containerId',
            'componentClass',
            'containerClass',
            'componentHtmlAttributes',
            'containerHtmlAttributes'
        );
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
        $componentClass = config('bootstrap-components.' . $this->configKey . '.class.component');

        return $componentClass ? $componentClass : [];
    }

    /**
     * Set the default container class.
     *
     * @return array
     */
    protected function defaultContainerClass(): array
    {
        $containerClass = config('bootstrap-components.' . $this->configKey . '.class.container');

        return $containerClass ? $containerClass : [];
    }

    /**
     * Set the default component html attributes.
     *
     * @return array
     */
    protected function defaultComponentHtmlAttributes(): array
    {
        $componentHtmlAttributes = config('bootstrap-components.' . $this->configKey . '.html_attributes.component');

        return $componentHtmlAttributes ? $componentHtmlAttributes : [];
    }

    /**
     * Set the default container html attributes.
     *
     * @return array
     */
    protected function defaultContainerHtmlAttributes(): array
    {
        $containerHtmlAttributes = config('bootstrap-components.' . $this->configKey . '.html_attributes.container');

        return $containerHtmlAttributes ? $containerHtmlAttributes : [];
    }
}
