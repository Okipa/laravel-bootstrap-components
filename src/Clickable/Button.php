<?php

namespace Okipa\LaravelBootstrapComponents\Clickable;

use Exception;
use InvalidArgumentException;
use Okipa\LaravelBootstrapComponents\Component;

class Button extends Component
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'button';
    /**
     * The button accepted types.
     *
     * @property array $acceptedTypes
     */
    protected $acceptedTypes = ['button', 'submit'];
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
    /**.
     * The button icon show status.
     *
     * @property bool $showIcon
     */
    protected $showIcon = true;
    /**
     * The button icon.
     *
     * @property string $icon
     */
    protected $icon;
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
     * @return \Okipa\LaravelBootstrapComponents\Clickable\Button
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
     * @return \Okipa\LaravelBootstrapComponents\Clickable\Button
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
     *
     * @return \Okipa\LaravelBootstrapComponents\Clickable\Button
     */
    public function route(string $route): Button
    {
        $this->url = route($route);

        return $this;
    }

    /**
     * Set the button icon.
     *
     * @param string $icon
     *
     * @return \Okipa\LaravelBootstrapComponents\Clickable\Button
     */
    public function icon(string $icon): Button
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Hide the button icon.
     *
     * @return \Okipa\LaravelBootstrapComponents\Clickable\Button
     */
    public function hideIcon(): Button
    {
        $this->showIcon = false;

        return $this;
    }

    /**
     * Set the button label.
     *
     * @param string $label
     *
     * @return \Okipa\LaravelBootstrapComponents\Clickable\Button
     */
    public function label(string $label): Button
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Hide the button label.
     *
     * @return \Okipa\LaravelBootstrapComponents\Clickable\Button
     */
    public function hideLabel(): Button
    {
        $this->showLabel = false;

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
            'url'   => $this->url ? $this->url : url()->previous(),
            'icon'  => $this->showIcon ? ($this->icon ? $this->icon : $this->defaultIcon()) : '',
            'label' => $this->showLabel ? ($this->label
                ? $this->label
                : $this->defaultLabel()
            ) : '',
        ]);
    }

    /**
     * Set the input default icon
     *
     * @return string
     */
    protected function defaultIcon(): string
    {
        $icon = config('bootstrap-components.' . $this->configKey . '.icon');

        return $icon ? $icon : '';
    }

    /**
     * Set the button default label.
     *
     * @return string
     */
    public function defaultLabel()
    {
        $label = config('bootstrap-components.' . $this->configKey . '.label');

        return $label ? trans('bootstrap-components::' . $label) : null;
    }

    /**
     * Check the component values validity
     *
     * @throws \Exception
     */
    protected function checkValuesValidity(): void
    {
        if (! $this->type) {
            throw new Exception('Type must be declared for the ' . get_class($this) . ' component generation.');
        }
        if (! in_array($this->type, $this->acceptedTypes)) {
            throw new InvalidArgumentException(
                get_class($this) . ' : the given « ' . $this->type
                . ' » type is invalid and should be one of the following : '
                . implode(', ', $this->acceptedTypes)
            );
        }
    }
}
