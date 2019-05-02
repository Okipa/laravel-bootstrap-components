<?php

namespace Okipa\LaravelBootstrapComponents\Button;

use Okipa\LaravelBootstrapComponents\Component;

abstract class Button extends Component
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey;
    /**
     * The button type.
     *
     * @property string $type
     */
    protected $type;
    /**
     * The button url.
     *
     * @property string $url
     */
    protected $url;
    /**
     * The component prepended html.
     *
     * @property string $prepend
     */
    protected $prepend;
    /**
     * The component appended html.
     *
     * @property string $append
     */
    protected $append;
    /**.
     * The button label show status.
     *
     * @property bool $showLabel
     */
    protected $showLabel = true;
    /**
     * The button label.
     *
     * @property string $label
     */
    protected $label;

    /**
     * Set the button type.
     *
     * @param string $type
     *
     * @return \Okipa\LaravelBootstrapComponents\Button\Button
     */
    public function type(string $type): Button
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Set the button url (only used for « button » type).
     *
     * @param string $url
     *
     * @return \Okipa\LaravelBootstrapComponents\Button\Button
     */
    public function url(string $url): Button
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Set the button route (only used for « button » type).
     *
     * @param string $route
     * @param array $params
     *
     * @return \Okipa\LaravelBootstrapComponents\Button\Button
     */
    public function route(string $route, array $params = []): Button
    {
        $this->url = route($route, $params);

        return $this;
    }

    /**
     * Prepend html to the component label.
     *
     * @param string|null $html
     *
     * @return \Okipa\LaravelBootstrapComponents\Button\Button
     */
    public function prepend(?string $html): Button
    {
        $this->prepend = $html;

        return $this;
    }

    /**
     * Append html to the component label.
     *
     * @param string|null $html
     *
     * @return \Okipa\LaravelBootstrapComponents\Button\Button
     */
    public function append(?string $html): Button
    {
        $this->append = $html;

        return $this;
    }

    /**
     * Set the button label.
     *
     * @param string $label
     *
     * @return \Okipa\LaravelBootstrapComponents\Button\Button
     */
    public function label(string $label): Button
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Hide the button label.
     *
     * @return \Okipa\LaravelBootstrapComponents\Button\Button
     */
    public function hideLabel(): Button
    {
        $this->showLabel = false;

        return $this;
    }

    /**
     * Set the values for the view.
     *
     * @return array
     */
    protected function values(): array
    {
        return array_merge(parent::values(), $this->defineValues());
    }

    /**
     * @return array
     */
    protected function defineValues(): array
    {
        return [
            'type'    => $this->type,
            'url'     => $this->url ? $this->url : url()->previous(),
            'prepend' => $this->prepend ?? $this->defaultPrepend(),
            'append'  => $this->append ?? $this->defaultAppend(),
            'label'   => $this->showLabel ? ($this->label ? $this->label : $this->defaultLabel()) : '',
        ];
    }

    /**
     * @return string|null
     */
    protected function defaultPrepend(): ?string
    {
        return config('bootstrap-components.' . $this->configKey . '.prepend') ?? null;
    }

    /**
     * @return string|null
     */
    protected function defaultAppend(): ?string
    {
        return config('bootstrap-components.' . $this->configKey . '.append') ?? null;
    }

    /**
     * Set the button default label.
     *
     * @return string
     */
    public function defaultLabel()
    {
        $label = config('bootstrap-components.' . $this->configKey . '.label');

        return $label ? trans('bootstrap-components::' . $label) : '';
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
