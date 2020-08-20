<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form\Abstracts;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Components\Form\Traits\FormValidityChecks;

abstract class FormAbstract extends ComponentAbstract
{
    use FormValidityChecks;

    protected ?Model $model;

    protected string $name;

    /** @property string|Closure|null $prepend */
    protected $prepend;

    /** @property string|Closure|null $append */
    protected $append;

    protected string $label;

    protected ?string $caption;

    protected bool $labelPositionedAbove;

    /** @property mixed $value */
    protected $value;

    protected ?string $placeholder;

    protected bool $displaySuccess;

    protected bool $displayFailure;

    public function __construct()
    {
        parent::__construct();
        $this->prepend = $this->setPrepend();
        $this->append = $this->setAppend();
        $this->labelPositionedAbove = $this->setLabelPositionedAbove();
        $this->caption = $this->setCaption();
        $this->displaySuccess = $this->setDisplaySuccess();
        $this->displayFailure = $this->setDisplayFailure();
    }

    public function name(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function model(Model $model): self
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @param string|Closure|null $prepend
     *
     * @return $this
     */
    public function prepend($prepend): self
    {
        if (! is_null($prepend) && ! is_string($prepend) && ! $prepend instanceof Closure) {
            throw new InvalidArgumentException('Invalid $prepend argument provided: null, string or ' .
                '\Closure value awaited. ' . gettype($prepend) . ' given.');
        }
        $this->prepend = $prepend;

        return $this;
    }

    /**
     * Append HTML to the component input group.
     * Set null to hide it.
     *
     * @param string|Closure|null $append
     *
     * @return $this
     */
    public function append($append): self
    {
        if (! is_null($append) && ! is_string($append) && ! $append instanceof Closure) {
            throw new InvalidArgumentException('Invalid $append argument provided: null, string or '
                . '\Closure value awaited. ' . gettype($append) . ' given.');
        }
        $this->append = $append;

        return $this;
    }

    /**
     * Set the component caption.
     *
     * @param string|null $caption
     *
     * @return $this
     */
    public function caption(?string $caption): self
    {
        $this->caption = $caption;

        return $this;
    }

    /**
     * Set the component placeholder.
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
     * Set the component input value by returning it from this closure result :
     * ->value(function(string $locale){}).
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
     * Set the component label.
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
     * If not positioned above, the label will be positioned under the input
     * (may be useful for bootstrap 4 floating labels).
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
     * Set the component validation success display status.
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
     * Set the component validation failure display status.
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
        $caption = $this->getCaption();
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
            'caption',
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

    protected function getModel(): ?Model
    {
        return $this->model;
    }

    protected function getName(): string
    {
        return $this->name ?? '';
    }

    protected function getPrepend(): ?string
    {
        $prepend = $this->prepend;

        // fallback for usage of closure with multilingual disabled
        return $prepend instanceof Closure ? $prepend(app()->getLocale()) : $prepend;
    }

    /**
     * Set the component prepended HTML.
     *
     * @return string
     */
    abstract protected function setPrepend(): ?string;

    protected function getAppend(): ?string
    {
        $append = $this->append;

        // fallback for usage of closure with multilingual disabled
        return $append instanceof Closure ? $append(app()->getLocale()) : $append;
    }

    /**
     * Set the component appended HTML.
     *
     * @return string|null
     */
    abstract protected function setAppend(): ?string;

    protected function getCaption(): ?string
    {
        return $this->caption;
    }

    /**
     * Set the component caption.
     *
     * @return string|null
     */
    abstract protected function setCaption(): ?string;

    protected function getLabel(): string
    {
        return $this->label ?? (string) __('validation.attributes.' . $this->removeArrayCharactersFromName());
    }

    protected function removeArrayCharactersFromName(): string
    {
        return strstr($this->getName(), '[', true) ?: $this->getName();
    }

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
        $value = old($this->convertArrayNameInNotation()) ?: $this->value;
        // fallback for usage of closure with multilingual disabled
        $value = $value instanceof Closure ? $value(app()->getLocale()) : $value;

        return $value ?? optional($this->getModel())->{$this->convertArrayNameInNotation()};
    }

    protected function convertArrayNameInNotation(string $notation = '.'): string
    {
        return str_replace(['[', ']'], [$notation, ''], $this->getName());
    }

    protected function getPlaceholder(): ?string
    {
        return $this->placeholder
            ?? ($this->getLabel() ?: (string) __('validation.attributes.' . $this->removeArrayCharactersFromName()));
    }

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

    protected function getValidationClass(): ?string
    {
        if (session()->has('errors')) {
            return session()->get('errors')->has($this->convertArrayNameInNotation())
                ? ($this->getDisplayFailure() ? 'is-invalid' : null)
                : ($this->getDisplaySuccess() ? 'is-valid' : null);
        }

        return null;
    }

    protected function getErrorMessage(): ?string
    {
        return optional(session()->get('errors'))->first($this->convertArrayNameInNotation());
    }

    protected function getComponentId(): string
    {
        return parent::getComponentId()
            ?? $this->getType() . '-' . Str::slug(Str::snake($this->convertArrayNameInNotation('-'), '-'));
    }
}
