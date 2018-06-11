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
     * The component class.
     *
     * @property array $componentClass
     */
    protected $componentClass = [];
    /**
     * The component container class.
     *
     * @property array $containerClass
     */
    protected $containerClass = [];
    /**
     * The component html attributes.
     *
     * @property array $componentHtmlAttributes
     */
    protected $componentHtmlAttributes = [];
    /**
     * The component container html attributes.
     *
     * @property array $containerHtmlAttributes
     */
    protected $containerHtmlAttributes = [];

    /**
     * Set the component class tag.
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
     * Set the component container class tag.
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
        if ($view = $this->view()) {
            return view('bootstrap-components::' . $view, $this->values(), $data)->render();
        }
    }

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

        return compact('componentClass', 'containerClass', 'componentHtmlAttributes', 'containerHtmlAttributes');
    }

    /**
     * Set the default component class.
     *
     * @return array
     */
    protected function defaultComponentClass(): array
    {
        return config('bootstrap-components.' . $this->configKey . '.class.component', []);
    }

    /**
     * Set the default container class.
     *
     * @return array
     */
    protected function defaultContainerClass(): array
    {
        return config('bootstrap-components.' . $this->configKey . '.class.container', []);
    }

    /**
     * Set the default component html attributes.
     *
     * @return array
     */
    protected function defaultComponentHtmlAttributes(): array
    {
        return config('bootstrap-components.' . $this->configKey . '.html_attributes.component', []);
    }

    /**
     * Set the default container html attributes.
     *
     * @return array
     */
    protected function defaultContainerHtmlAttributes(): array
    {
        return config('bootstrap-components.' . $this->configKey . '.html_attributes.container', []);
    }
}
