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
     * The input associated model.
     *
     * @property \Illuminate\Database\Eloquent\Model $model
     */
    protected $model;
    /**
     * The input type.
     *
     * @property string $type
     */
    protected $type;
    /**
     * The input name.
     *
     * @property string $name
     */
    protected $name;
    /**.
     * The input icon show status.
     *
     * @property bool $showIcon
     */
    protected $showIcon = true;
    /**
     * The input icon.
     *
     * @property string $icon
     */
    protected $icon;
    /**.
     * The input legend show status.
     *
     * @property bool $showLabel
     */
    protected $showLegend = true;
    /**
     * The input legend.
     *
     * @property string $legend
     */
    protected $legend;
    /**.
     * The input label show status.
     *
     * @property bool $showLabel
     */
    protected $showLabel = true;
    /**
     * The input label.
     *
     * @property string $label
     */
    protected $label;
    /**
     * The input value.
     *
     * @property string $value
     */
    protected $value;
    /**
     * The input placeholder.
     *
     * @property string $placeholder
     */
    protected $placeholder;

    /**
     * Set the input associated model.
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
     * Set the input name.
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
     * Set the input icon.
     *
     * @param string $icon
     *
     * @return \Okipa\LaravelBootstrapComponents\Form\Input
     */
    public function icon(string $icon): Input
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Hide the input icon.
     *
     * @return \Okipa\LaravelBootstrapComponents\Form\Input
     */
    public function hideIcon(): Input
    {
        $this->showIcon = false;

        return $this;
    }

    /**
     * Set the input legend.
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
     * Hide the input legend.
     *
     * @return \Okipa\LaravelBootstrapComponents\Form\Input
     */
    public function hideLegend(): Input
    {
        $this->showLegend = false;

        return $this;
    }

    /**
     * Set the input placeholder.
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
     * Set the input Value.
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
     * Set the input label.
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
     * Hide the input label.
     *
     * @return \Okipa\LaravelBootstrapComponents\Form\Input
     */
    public function hideLabel(): Input
    {
        $this->showLabel = false;

        return $this;
    }

    /**
     * Set the input values.
     *
     * @return array
     */
    protected function values(): array
    {
        return array_merge(parent::values(), $this->defineValues());
    }

    /**
     * @return string|null
     */
    protected function defineIcon(): ?string
    {
        return $this->showIcon ? ($this->icon ? $this->icon : $this->defaultIcon()) : null;
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
     * @return string
     */
    protected function defineLabel(): string
    {
        return $this->label
            ? $this->label
            : trans('validation.attributes.' . str_slug($this->name, '_'));
    }

    /**
     * @return mixed
     */
    protected function defineValue()
    {
        return $this->value ? $this->value : ($this->model ? $this->model->{$this->name} : null);
    }
    
    /**
     * @return array
     */
    protected function defineValues()
    {
        $model = $this->model;
        $type = $this->type;
        $name = $this->name;
        $icon = $this->defineIcon();
        $legend = $this->defineLegend();
        $label = $this->showLabel ? $this->defineLabel() : null;
        $value = $this->defineValue();
        $placeholder = $this->definePlaceholder();
        
        return compact('model', 'type', 'name', 'icon', 'legend', 'label', 'value', 'placeholder');
    }

    /**
     * @return string|null
     */
    protected function definePlaceholder(): ?string
    {
        return $this->placeholder ? $this->placeholder : $this->defineLabel();
    }
    
    /**
     * Set the input default icon
     *
     * @return string|null
     */
    protected function defaultIcon(): ?string
    {
        $icon = config('bootstrap-components.' . $this->configKey . '.icon');

        return $icon ? $icon : null;
    }

    /**
     * Set the input default icon
     *
     * @return string|null
     */
    protected function defaultLegend(): ?string
    {
        $legend = config('bootstrap-components.' . $this->configKey . '.legend');

        return $legend ? trans('bootstrap-components::' . $legend) : null;
    }

    /**
     * Set the default component id.
     *
     * @return string
     */
    protected function defaultComponentId(): string
    {
        return $this->type . '-' . str_slug($this->name);
    }
}
