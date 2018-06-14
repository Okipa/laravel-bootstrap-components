<?php

namespace Okipa\LaravelBootstrapComponents;

use Illuminate\Contracts\Support\Htmlable;

Interface ComponentInterface extends Htmlable
{
    /**
     * Set the component class tag.
     *
     * @param array $componentClass
     *
     * @return \Okipa\LaravelBootstrapComponents\Component
     */
    public function componentClass(array $componentClass): Component;

    /**
     * Set the component container class tag.
     *
     * @param array $containerClass
     *
     * @return \Okipa\LaravelBootstrapComponents\Component
     */
    public function containerClass(array $containerClass): Component;

    /**
     * Set the component html attributes.
     *
     * @param array $componentHtmlAttributes
     *
     * @return \Okipa\LaravelBootstrapComponents\Component
     */
    public function componentHtmlAttributes(array $componentHtmlAttributes): Component;

    /**
     * Set the component container html attributes.
     *
     * @param array $containerHtmlAttributes
     *
     * @return \Okipa\LaravelBootstrapComponents\Component
     */
    public function containerHtmlAttributes(array $containerHtmlAttributes): Component;

    /**
     * Render the component html.
     *
     * @return string
     * @throws \Throwable
     */
    public function toHtml();

    /**
     * Render the component html.
     *
     * @param array $data
     *
     * @return string
     * @throws \Throwable
     */
    public function render(array $data = []);
}
