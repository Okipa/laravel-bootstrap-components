<?php

namespace Okipa\LaravelBootstrapComponents\Form;

use Illuminate\Database\Eloquent\Model;
use Okipa\LaravelBootstrapComponents\Component;
use Okipa\LaravelBootstrapComponents\Form\Traits\InputValidityChecks;

abstract class Input extends Component
{
    use InputValidityChecks;
    /**
     * The component config key.
     *
     * @property string $configKey
     */
    protected $configKey;
    /**
     * The component associated model.
     *
     * @property \Illuminate\Database\Eloquent\Model $model
     */
    protected $model;
    /**
     * The component input type.
     *
     * @property string $type
     */
    protected $type;
    /**
     * The component input name.
     *
     * @property string $name
     */
    protected $name;
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
     * The component legend show status.
     *
     * @property bool $showLabel
     */
    protected $showLegend = true;
    /**
     * The component legend.
     *
     * @property string $legend
     */
    protected $legend;
    /**.
     * The component label show status.
     *
     * @property bool $showLabel
     */
    protected $showLabel = true;
    /**
     * The component label.
     *
     * @property string $label
     */
    protected $label;
    /**
     * The component input value.
     *
     * @property string $value
     */
    protected $value;
    /**
     * The component input placeholder.
     *
     * @property string $placeholder
     */
    protected $placeholder;

    /**
     * Set the component associated model.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return \Okipa\LaravelBootstrapComponents\Form\Input
     */
    public function model(Model $model = null): Input
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Set the component input name.
     *
     * @param string $name
     *
     * @return \Okipa\LaravelBootstrapComponents\Form\Input
     */
    public function name(string $name): Input
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Prepend html to the component.
     *
     * @param string|null $html
     *
     * @return \Okipa\LaravelBootstrapComponents\Form\Input
     */
    public function prepend(?string $html): Input
    {
        $this->prepend = $html;

        return $this;
    }

    /**
     * Append html to the component.
     *
     * @param string|null $html
     *
     * @return \Okipa\LaravelBootstrapComponents\Form\Input
     */
    public function append(?string $html): Input
    {
        $this->append = $html;

        return $this;
    }

    /**
     * Set the component legend.
     *
     * @param string $legend
     *
     * @return \Okipa\LaravelBootstrapComponents\Form\Input
     */
    public function legend(string $legend): Input
    {
        $this->legend = $legend;

        return $this;
    }

    /**
     * Hide the component legend.
     *
     * @return \Okipa\LaravelBootstrapComponents\Form\Input
     */
    public function hideLegend(): Input
    {
        $this->showLegend = false;

        return $this;
    }

    /**
     * Set the component input placeholder.
     *
     * @param string $placeholder
     *
     * @return \Okipa\LaravelBootstrapComponents\Form\Input
     */
    public function placeholder(string $placeholder): Input
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * Set the component input value.
     *
     * @param mixed $value
     *
     * @return \Okipa\LaravelBootstrapComponents\Form\Input
     */
    public function value($value): Input
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Set the component label.
     *
     * @param string $label
     *
     * @return \Okipa\LaravelBootstrapComponents\Form\Input
     */
    public function label(string $label): Input
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Hide the component label.
     *
     * @return \Okipa\LaravelBootstrapComponents\Form\Input
     */
    public function hideLabel(): Input
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
            'model'       => $this->model,
            'type'        => $this->type,
            'name'        => $this->name,
            'prepend'     => $this->prepend ?? $this->defaultPrepend(),
            'append'      => $this->append ?? $this->defaultAppend(),
            'legend'      => $this->defineLegend(),
            'label'       => $this->showLabel ? $this->defineLabel() : null,
            'value'       => $this->defineValue(),
            'placeholder' => $this->definePlaceholder(),
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
     * @return string|null
     */
    protected function defineLegend(): ?string
    {
        return $this->showLegend
            ? ($this->legend ? trans($this->legend) : $this->defaultLegend())
            : null;
    }

    /**
     * @return string|null
     */
    protected function defaultLegend(): ?string
    {
        $legend = config('bootstrap-components.' . $this->configKey . '.legend');

        return $legend ? trans('bootstrap-components::' . $legend) : null;
    }

    /**
     * @return string
     */
    protected function defineLabel(): string
    {
        return $this->label
            ? $this->label
            : trans('validation.attributes.' . Str::slug($this->name, '_'));
    }

    /**
     * @return mixed
     */
    protected function defineValue()
    {
        return $this->value ? $this->value : ($this->model ? $this->model->{$this->name} : null);
    }

    /**
     * @return string|null
     */
    protected function definePlaceholder(): ?string
    {
        return $this->placeholder ? $this->placeholder : $this->defineLabel();
    }

    /**
     * Set the default component id.
     *
     * @return string
     */
    protected function defaultComponentId(): string
    {
        return $this->type . '-' . Str::slug($this->name);
    }
}
