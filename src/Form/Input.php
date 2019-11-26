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
     * @return $this
     */
    public function model(Model $model = null): self
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Set the component input name tag.
     *
     * @param string $name
     *
     * @return $this
     */
    public function name(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Prepend html to the component input group.
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
     * Append html to the component input group.
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
     * Set the component legend.
     *
     * @param string|null $legend
     *
     * @return $this
     */
    public function legend(?string $legend): self
    {
        $this->legend = $legend;

        return $this;
    }

    /**
     * Set the component input placeholder.
     *
     * @param string|null $placeholder
     *
     * @return $this
     */
    public function placeholder(?string $placeholder): self
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * Set the component input value.
     *
     * @param mixed $value
     *
     * @return $this
     */
    public function value($value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Set the component input label.
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
     * Set the label above-positioning status.
     * If not positioned above, the label will be positioned under the input.
     *
     * @param bool $positionedAbove
     *
     * @return $this
     */
    public function labelPositionedAbove(bool $positionedAbove = true): self
    {
        $this->labelPositionedAbove = $positionedAbove;

        return $this;
    }

    /**
     * Set the component input validation success display status.
     *
     * @param bool|null $displaySuccess
     *
     * @return $this
     */
    public function displaySuccess(?bool $displaySuccess = true): self
    {
        $this->displaySuccess = $displaySuccess;

        return $this;
    }

    /**
     * Set the component input validation failure display status.
     *
     * @param bool|null $displayFailure
     *
     * @return $this
     */
    public function displayFailure(?bool $displayFailure = true): self
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
        $model = $this->model;
        $type = $this->type;
        $name = $this->name;
        $prepend = $this->prepend ?? $this->defaultPrepend();
        $append = $this->append ?? $this->defaultAppend();
        $legend = $this->legend ?? $this->defaultLegend();
        $label = $this->label ?? $this->defaultLabel();
        $labelPositionedAbove = $this->labelPositionedAbove ?? $this->defaultLabelPositionedAbove();
        $value = $this->defineValue();
        $placeholder = $this->placeholder ?? ($this->label ?: $this->defaultLabel());
        $displaySuccess = $this->displaySuccess ?? $this->defaultDisplaySuccess();
        $displayFailure = $this->displayFailure ?? $this->defaultDisplayFailure();
        $validationClass = $this->validationClass($name, $displaySuccess, $displayFailure);

        return compact(
            'model',
            'type',
            'name',
            'prepend',
            'append',
            'legend',
            'label',
            'labelPositionedAbove',
            'value',
            'placeholder',
            'displaySuccess',
            'displayFailure',
            'validationClass'
        );
    }

    /**
     * @return string|null
     */
    protected function defaultPrepend(): ?string
    {
        return $this->prepend ?? config('bootstrap-components.' . $this->configKey . '.prepend');
    }

    /**
     * @return string|null
     */
    protected function defaultAppend(): ?string
    {
        return config('bootstrap-components.' . $this->configKey . '.append');
    }

    /**
     * @return string|null
     */
    protected function defaultLegend(): ?string
    {
        $legend = config('bootstrap-components.' . $this->configKey . '.legend');

        return $legend ? 'bootstrap-components::' . $legend : null;
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
     * @param string $name
     * @param bool $displaySuccess
     * @param bool $displayFailure
     *
     * @return string|null
     */
    protected function validationClass(string $name, bool $displaySuccess, bool $displayFailure): ?string
    {
        if (session()->has('errors')) {
            return session()->get('errors')->has($name)
                ? ($displayFailure ? 'is-invalid' : null)
                : ($displaySuccess ? 'is-valid' : null);
        }

        return null;
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
