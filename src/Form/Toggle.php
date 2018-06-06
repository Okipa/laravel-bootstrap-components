<?php

namespace Okipa\LaravelBootstrapComponents\Form;

class Toggle extends Input
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'toggle';
    /**.
     * The input show icon status.
     *
     * @property bool $hideIcon
     */
    protected $showIcon = false;
    /**
     * The toggle check status.
     *
     * @property string $checked
     */
    protected $checked;

    /**
     * Hide the input icon.
     *
     * @return \App\Components\Form\Toggle
     */
    public function hideIcon(): Toggle
    {
        $this->showIcon = false;

        return $this;
    }

    /**
     * Set the input Value.
     *
     * @param bool $status
     *
     * @return \App\Components\Form\Toggle
     */
    public function checked(bool $status): Toggle
    {
        $this->checked = $status;

        return $this;
    }

    /**
     * Set the input values.
     *
     * @return array
     */
    protected function values(): array
    {
        return array_merge(parent::values(), [
            'model'   => $this->model,
            'name'    => $this->name,
            'icon'    => $this->showIcon === true
                ? ($this->icon ? $this->icon : $this->defaultIcon())
                : '',
            'legend'  => $this->legend,
            'label'   => $this->showLabel === false
                ? ($this->label ? $this->label : __('validation.attributes.' . $this->name))
                : '',
            'checked' => isset($this->checked)
                ? $this->checked
                : ($this->model ? boolval($this->model->{$this->name}) : false),
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
}
