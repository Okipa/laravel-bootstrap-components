<?php

namespace Okipa\LaravelBootstrapComponents\Button;

use App\Components\Component;

class Button extends Component
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'button';
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
     * The button icon.
     *
     * @property string $icon
     */
    protected $icon;
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
     * @return \App\Components\Button\Button
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
     * @return \App\Components\Button\Button
     */
    public function url(string $url): Button
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Set the button icon.
     *
     * @param string $icon
     *
     * @return \App\Components\Button\Button
     */
    public function icon(string $icon): Button
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Set the button label.
     *
     * @param string $label
     *
     * @return \App\Components\Button\Button
     */
    public function label(string $label): Button
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Set the button values.
     *
     * @return array
     */
    protected function values(): array
    {
        return array_merge(parent::values(), [
            'type'  => $this->type,
            'url'   => $this->url,
            'icon'  => $this->icon ? $this->icon : $this->defaultIcon(),
            'label' => $this->label ? $this->label : $this->defaultLabel(),
        ]);
    }

    /**
     * Set the input default icon
     *
     * @return string
     */
    protected function defaultIcon(): string
    {
        return config($this->configFile . '.' . $this->configKey . '.icon');
    }

    /**
     * Set the button default label.
     *
     * @return string
     */
    public function defaultLabel()
    {
        return __(config($this->configFile . '.' . $this->configKey . '.label'));
    }
}
