<?php

namespace Okipa\LaravelBootstrapComponents\Form;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
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
     * The component legend.
     *
     * @property string|false $legend
     */
    protected $legend;
    /**
     * The component label.
     *
     * @property string|false $label
     */
    protected $label;
    /**
     * The component label above-positioning status.
     *
     * @property boolean $labelPositionedAbove
     */
    protected $labelPositionedAbove;
    /**
     * The component input value.
     *
     * @property string $value
     */
    protected $value;
    /**
     * The component input placeholder.
     *
     * @property string|false $placeholder
     */
    protected $placeholder;
    /**
     * The component form validation success display status.
     *
     * @property boolean $displaySuccess
     */
    protected $displaySuccess;
    /**
     * The component form validation failure display status.
     *
     * @property boolean $displayFailure
     */
    protected $displayFailure;

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
     * Set the component input name tag.
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
     * Prepend html to the component input group.
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
     * Append html to the component input group.
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
     * @param string|null $legend
     *
     * @return \Okipa\LaravelBootstrapComponents\Form\Input
     */
    public function legend(?string $legend): Input
    {
        $this->legend = $legend;

        return $this;
    }

    /**
     * Set the component input placeholder.
     *
     * @param string|null $placeholder
     *
     * @return \Okipa\LaravelBootstrapComponents\Form\Input
     */
    public function placeholder(?string $placeholder): Input
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
     * Set the component input label.
     *
     * @param string|null $label
     *
     * @return \Okipa\LaravelBootstrapComponents\Form\Input
     */
    public function label(?string $label): Input
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Set the label above-positioning status.
     * If not positioned above, the label will be positioned under the input.
     *
     * @param bool $positionedAbove
     *
     * @return \Okipa\LaravelBootstrapComponents\Form\Input
     */
    public function labelPositionedAbove(bool $positionedAbove = true): Input
    {
        $this->labelPositionedAbove = $positionedAbove;

        return $this;
    }

    /**
     * Set the component input validation success display status.
     *
     * @param bool $displaySuccess
     *
     * @return \Okipa\LaravelBootstrapComponents\Form\Input
     */
    public function displaySuccess(bool $displaySuccess): Input
    {
        $this->displaySuccess = $displaySuccess;

        return $this;
    }

    /**
     * Set the component input validation failure display status.
     *
     * @param bool $displayFailure
     *
     * @return \Okipa\LaravelBootstrapComponents\Form\Input
     */
    public function displayFailure(bool $displayFailure): Input
    {
        $this->displayFailure = $displayFailure;

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
     * Define the component values.
     *
     * @return array
     */
    protected function defineValues(): array
    {
//        dd($this->label, $this->defaultLabel(), $this->label ?? $this->defaultLabel());
        return [
            'model'                => $this->model,
            'type'                 => $this->type,
            'name'                 => $this->name,
            'prepend'              => $this->prepend ?? $this->defaultPrepend(),
            'append'               => $this->append ?? $this->defaultAppend(),
            'legend'               => $this->legend ?? $this->defaultLegend(),
            'label'                => $this->label ?? $this->defaultLabel(),
            'labelPositionedAbove' => $this->labelPositionedAbove ?? $this->defaultLabelPositionedAbove(),
            'value'                => $this->defineValue(),
            'placeholder'          => $this->placeholder ?? ($this->label ?: $this->defaultLabel()),
            'displaySuccess'       => $this->displaySuccess ?? $this->defaultDisplaySuccess(),
            'displayFailure'       => $this->displayFailure ?? $this->defaultDisplayFailure(),
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
    protected function defaultLegend(): ?string
    {
        return config('bootstrap-components.' . $this->configKey . '.legend');
    }

    /**
     * @return string
     */
    protected function defaultLabel(): string
    {
        return 'validation.attributes.' . Str::slug($this->name, '_');
    }

    /**
     * @return bool
     */
    protected function defaultLabelPositionedAbove(): bool
    {
        return config('bootstrap-components.' . $this->configKey . '.labelPositionedAbove') ?? true;
    }

    /**
     * @return mixed
     */
    protected function defineValue()
    {
        return isset($this->value) ? $this->value : ($this->model ? $this->model->{$this->name} : null);
    }

    /**
     * @return bool
     */
    protected function defaultDisplaySuccess(): bool
    {
        return config('bootstrap-components.' . $this->configKey . '.formValidation.displaySuccess');
    }

    /**
     * @return bool
     */
    protected function defaultDisplayFailure(): bool
    {
        return config('bootstrap-components.' . $this->configKey . '.formValidation.displayFailure');
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
