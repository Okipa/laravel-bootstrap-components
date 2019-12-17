<?php

namespace Okipa\LaravelBootstrapComponents\Form\Abstracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Okipa\LaravelBootstrapComponents\Component;
use Okipa\LaravelBootstrapComponents\Form\Traits\FormValidityChecks;

abstract class Form extends Component
{
    use FormValidityChecks;

    /** @property Model|null $model */
    protected $model;

    /** @property string $name */
    protected $name;

    /** @property string|null $prepend */
    protected $prepend;

    /** @property string|null $append */
    protected $append;

    /** @property string|null $legend */
    protected $legend;

    /** @property string $label */
    protected $label;

    /** @property bool $labelPositionedAbove */
    protected $labelPositionedAbove;

    /** @property mixed $value */
    protected $value;

    /** @property string|null $placeholder */
    protected $placeholder;

    /** @property bool $displaySuccess */
    protected $displaySuccess;

    /** @property bool $displayFailure */
    protected $displayFailure;

    /**
     * Form constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->prepend = $this->setPrepend();
        $this->append = $this->setAppend();
        $this->labelPositionedAbove = $this->setLabelPositionedAbove();
        $this->legend = $this->setLegend();
        $this->displaySuccess = $this->setDisplaySuccess();
        $this->displayFailure = $this->setDisplayFailure();
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
        $model = $this->getModel();
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
        $validationClass = $this->getValidationClass();
        $errorMessage = $this->getErrorMessage();

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
            'errorMessage'
        );
    }

    /**
     * @return Model|null
     */
    protected function getModel(): ?Model
    {
        return $this->model;
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
        return $this->prepend;
    }

    /**
     * Set the component prepended html.
     *
     * @return string
     */
    abstract protected function setPrepend(): ?string;

    /**
     * @return string|null
     */
    protected function getAppend(): ?string
    {
        return $this->append;
    }

    /**
     * Set the component appended html.
     *
     * @return string|null
     */
    abstract protected function setAppend(): ?string;

    /**
     * @return string|null
     */
    protected function getLegend(): ?string
    {
        return $this->legend ? __($this->legend) : null;
    }

    /**
     * Set the component legend.
     *
     * @return string|null
     */
    abstract protected function setLegend(): ?string;

    /**
     * @return string|null
     */
    protected function getLabel(): ?string
    {
        $label = $this->label ?? 'validation.attributes.' . $this->getName();

        return $label ? (string) __($label) : null;
    }

    /**
     * @return bool
     */
    protected function getLabelPositionedAbove(): bool
    {
        return $this->labelPositionedAbove;
    }

    /**
     * Set the component label above-positioning status
     *
     * @return bool
     */
    abstract protected function setLabelPositionedAbove(): bool;

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

        return $placeholder ? (string) __($placeholder) : null;
    }

    /**
     * @return bool
     */
    protected function getDisplaySuccess(): bool
    {
        return $this->displaySuccess;
    }

    /**
     * Set the component input validation success display status.
     *
     * @return bool
     */
    abstract protected function setDisplaySuccess(): bool;

    /**
     * @return bool
     */
    protected function getDisplayFailure(): bool
    {
        return $this->displayFailure;
    }

    /**
     * Set the component input validation failure display status.
     *
     * @return bool
     */
    abstract protected function setDisplayFailure(): bool;

    /**
     * @return string|null
     */
    protected function getValidationClass(): ?string
    {
        if (session()->has('errors')) {
            return session()->get('errors')->has($this->getName())
                ? ($this->getDisplayFailure() ? 'is-invalid' : null)
                : ($this->getDisplaySuccess() ? 'is-valid' : null);
        }

        return null;
    }

    /**
     * @return string|null
     */
    protected function getErrorMessage(): ?string
    {
        return optional(session()->get('errors'))->first($this->getName());
    }

    /**
     * @return string
     */
    protected function getComponentId(): string
    {
        return parent::getComponentId() ?? $this->getType() . '-' . Str::slug($this->getName());
    }
}
