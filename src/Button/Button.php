<?php

namespace Okipa\LaravelBootstrapComponents\Button;

use Okipa\LaravelBootstrapComponents\Component;

abstract class Button extends Component
{
    /**
     * The button url.
     *
     * @property string $url
     */
    protected $url;

    /**
     * The component prepended html.
     *
     * @property string|false $prepend
     */
    protected $prepend;

    /**
     * The component appended html.
     *
     * @property string|false $append
     */
    protected $append;

    /**
     * The button label.
     *
     * @property string|false $label
     */
    protected $label;

    /**
     * Set the button type.
     *
     * @param string $type
     *
     * @return $this
     */
    public function type(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Set the button component url.
     * Will only be effective for « button » typed button components.
     *
     * @param string $url
     *
     * @return $this
     */
    public function url(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Set the button component route.
     * Will only be effective for « button » typed button components.
     *
     * @param string $route
     * @param array $params
     *
     * @return $this
     */
    public function route(string $route, array $params = []): self
    {
        $this->url = route($route, $params);

        return $this;
    }

    /**
     * Prepend html to the button component label.
     *
     * @param string|null $html
     *
     * @return $this
     */
    public function prepend(?string $html): self
    {
        $this->prepend = $html;

        return $this;
    }

    /**
     * Append html to the button component label.
     *
     * @param string|null $html
     *
     * @return $this
     */
    public function append(?string $html): self
    {
        $this->append = $html;

        return $this;
    }

    /**
     * Set the button component label.
     *
     * @param string|null $label
     *
     * @return $this
     */
    public function label(?string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Set the values for the view.
     *
     * @return array
     */
    protected function getValues(): array
    {
        return array_merge(parent::getValues(), $this->getParameters());
    }

    /**
     * @return array
     */
    protected function getParameters(): array
    {
        $type = $this->getType();
        $url = $this->getUrl();
        $prepend = $this->getPrepend();
        $append = $this->getAppend();
        $label = $this->getLabel();

        return compact('type', 'url', 'prepend', 'append', 'label');
    }

    /**
     * @return string
     */
    protected function getUrl(): string
    {
        return $this->url ?: url()->previous();
    }

    /**
     * @return string|null
     */
    protected function getPrepend(): ?string
    {
        return $this->prepend ?? config('bootstrap-components.' . $this->configKey . '.prepend');
    }

    /**
     * @return string|null
     */
    protected function getAppend(): ?string
    {
        return $this->append ?? config('bootstrap-components.' . $this->configKey . '.append');
    }

    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        $configLabel = config('bootstrap-components.' . $this->configKey . '.label');

        return $this->label ?? ($configLabel ? (string) __('bootstrap-components::' . $configLabel) : null);
    }

    /**
     * Check the component values validity
     *
     * @throws \Exception
     */
    protected function checkValuesValidity(): void
    {
        //
    }
}
