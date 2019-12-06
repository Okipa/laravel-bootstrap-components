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
     * @property Model $model
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
     * @property bool $labelPositionedAbove
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
     * @property bool $displaySuccess
     */
    protected $displaySuccess;

    /**
     * The component form validation failure display status.
     *
     * @property bool $displayFailure
     */
    protected $displayFailure;

    /**
     * Set the component associated model.
     *
     * @param Model $model
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
     * Get values for the view.
     *
     * @return array
     */
    protected function getValues(): array
    {
        return array_merge(parent::getValues(), $this->getParameters());
    }

    /**
     * Define the component parameters.
     *
     * @return array
     */
    protected function getParameters(): array
    {
        $model = $this->model;
        $type = $this->getType();
        $name = $this->getName();
        $prepend = $this->getPrepend();
        $append = $this->getAppend();
        $legend = $this->getLegend();
        $label = $this->getLabel();
        $labelPositionedAbove = $this->getLabelPositionedAbove();
        $value = $this->getValue();
        $placeholder = $this->getPlaceholder();
        $displaySuccess = $this->getDisplaySuccess();
        $displayFailure = $this->getDisplayFailure();
        $validationClass = $this->getValidationClass($name, $displaySuccess, $displayFailure);
        $errorMessageBagKey = $name;

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
            'validationClass',
            'errorMessageBagKey'
        );
    }

    /**
     * @return string
     */
    protected function getName(): string
    {
        return Str::snake($this->name);
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
    protected function getLegend(): ?string
    {
        $configLegend = config('bootstrap-components.' . $this->configKey . '.legend');
        $defaultLegend = $configLegend ? 'bootstrap-components::' . $configLegend : null;

        return $this->legend ?? $defaultLegend;
    }

    /**
     * @return string|null
     */
    protected function getLabel(): ?string
    {
        $label = $this->label ?? 'validation.attributes.' . $this->getName();

        return $label ? (string)__($label) : null;
    }

    /**
     * @return bool
     */
    protected function getLabelPositionedAbove(): bool
    {
        $labelPositionedAbove = $this->labelPositionedAbove
            ?? config('bootstrap-components.' . $this->configKey . '.labelPositionedAbove');

        return $labelPositionedAbove ?? true;
    }

    /**
     * @return mixed
     */
    protected function getValue()
    {
        $value = old($this->getName()) ?: $this->value;

        return $value ?? ($this->model ? $this->model->{$this->getName()} : null);
    }

    /**
     * @return string|null
     */
    protected function getPlaceholder(): ?string
    {
        $placeholder = $this->placeholder ?? $this->getLabel();
        $placeholder = $placeholder ?? 'validation.attributes.' . $this->getName();

        return $placeholder ? (string)__($placeholder) : null;
    }

    /**
     * @return bool
     */
    protected function getDisplaySuccess(): bool
    {
        return $this->displaySuccess
            ?? config('bootstrap-components.' . $this->configKey . '.formValidation.displaySuccess');
    }

    /**
     * @return bool
     */
    protected function getDisplayFailure(): bool
    {
        return $this->displayFailure
            ?? config('bootstrap-components.' . $this->configKey . '.formValidation.displayFailure');
    }

    /**
     * @param string $name
     * @param bool $displaySuccess
     * @param bool $displayFailure
     *
     * @return string|null
     */
    protected function getValidationClass(string $name, bool $displaySuccess, bool $displayFailure): ?string
    {
        if (session()->has('errors')) {
            return session()->get('errors')->has($name)
                ? ($displayFailure ? 'is-invalid' : null)
                : ($displaySuccess ? 'is-valid' : null);
        }

        return null;
    }

    /**
     * @return string
     */
    protected function getHtmlIdentifier(): string
    {
        return $this->getType() . '-' . Str::slug($this->getName());
    }

    /**
     * @return string
     */
    protected function getComponentId(): string
    {
        return parent::getComponentId() ?? $this->getType() . '-' . Str::slug($this->getName());
    }
}
