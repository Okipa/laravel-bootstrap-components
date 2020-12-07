<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form\Abstracts;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Components\Form\Traits\FormValidityChecks;

abstract class FormAbstract extends ComponentAbstract
{
    use FormValidityChecks;

    /** @property mixed $value */
    protected $value;

    protected ?Model $model = null;

    protected string $name;

    /** @property string|Closure|null $prepend */
    protected $prepend;

    /** @property string|Closure|null $append */
    protected $append;

    protected ?string $label = null;

    protected ?string $caption;

    protected bool $hideLabel = false;

    protected bool $labelPositionedAbove;

    protected ?string $placeholder = null;

    protected bool $displaySuccess;

    protected bool $displayFailure;

    protected string $errorBag = 'default';

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

    public function model(?Model $model): self
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
        $this->prepend = $prepend;

        return $this;
    }

    /**
     * @param string|Closure|null $append
     *
     * @return $this
     */
    public function append($append): self
    {
        $this->append = $append;

        return $this;
    }

    public function caption(?string $caption): self
    {
        $this->caption = $caption;

        return $this;
    }

    public function placeholder(?string $placeholder): self
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * @param mixed $value
     *
     * @return $this
     */
    public function value($value): self
    {
        $this->value = $value;

        return $this;
    }

    public function label(?string $label): self
    {
        $this->hideLabel = ! $label;
        $this->label = $label;

        return $this;
    }

    public function labelPositionedAbove(bool $positionedAbove = true): self
    {
        $this->labelPositionedAbove = $positionedAbove;

        return $this;
    }

    public function displaySuccess(bool $displaySuccess = true): self
    {
        $this->displaySuccess = $displaySuccess;

        return $this;
    }

    public function displayFailure(bool $displayFailure = true): self
    {
        $this->displayFailure = $displayFailure;

        return $this;
    }

    public function errorBag(string $errorBag): self
    {
        $this->errorBag = $errorBag;

        return $this;
    }

    protected function getViewParams(): array
    {
        return array_merge(parent::getViewParams(), [
            'validationClass' => fn(?ViewErrorBag $errors) => $this->getValidationClass($errors),
            'errorMessage' => fn(?ViewErrorBag $errors) => $this->getErrorMessage($errors),
            'successMessage' => fn() => $this->getSuccessMessage(),
            'labelPositionedAbove' => $this->getLabelPositionedAbove(),
            'label' => $this->getLabel(),
            'type' => $this->getType(),
            'name' => $this->getName(),
            'value' => $this->getValue(),
            'placeholder' => $this->getPlaceholder(),
            'prepend' => $this->getPrepend(),
            'append' => $this->getAppend(),
            'caption' => $this->getCaption(),
        ]);
    }

    protected function getValidationClass(?ViewErrorBag $errors): ?string
    {
        if (! $errors) {
            return null;
        }
        if ($this->getErrorMessageBag($errors)->isEmpty()) {
            return null;
        }
        if ($this->getErrorMessageBag($errors)->has($this->convertArrayNameInNotation())) {
            return $this->getDisplayFailure() ? 'is-invalid' : null;
        }

        // Only highlight valid fields if there are invalid fields.
        return $this->getDisplaySuccess() ? 'is-valid' : null;
    }

    protected function getErrorMessageBag(ViewErrorBag $errors): MessageBag
    {
        return $errors->{$this->errorBag};
    }

    protected function convertArrayNameInNotation(string $notation = '.'): string
    {
        return str_replace(['[', ']'], [$notation, ''], $this->getName());
    }

    protected function getName(): string
    {
        return $this->name ?? '';
    }

    protected function getDisplayFailure(): bool
    {
        return $this->displayFailure;
    }

    abstract protected function setDisplayFailure(): bool;

    protected function getDisplaySuccess(): bool
    {
        return $this->displaySuccess;
    }

    abstract protected function setDisplaySuccess(): bool;

    protected function getErrorMessage(?ViewErrorBag $errors): ?string
    {
        if (! $errors) {
            return null;
        }
        if (! $this->getDisplayFailure()) {
            return null;
        }

        return $this->getErrorMessageBag($errors)->first($this->convertArrayNameInNotation());
    }

    protected function getSuccessMessage(): ?string
    {
        if ($this->getDisplaySuccess()) {
            return (string) __('Field correctly filled.');
        }

        return null;
    }

    protected function getLabelPositionedAbove(): bool
    {
        return $this->labelPositionedAbove;
    }

    abstract protected function setLabelPositionedAbove(): bool;

    protected function getLabel(): ?string
    {
        if ($this->hideLabel) {
            return null;
        }
        if ($this->label) {
            return $this->label;
        }

        return (string) __('validation.attributes.' . $this->removeArrayCharactersFromName());
    }

    protected function removeArrayCharactersFromName(): string
    {
        return strstr($this->getName(), '[', true) ?: $this->getName();
    }

    /** @return mixed */
    protected function getValue()
    {
        $oldValue = old($this->convertArrayNameInNotation());
        if ($oldValue) {
            return $oldValue;
        }
        // Fallback for usage of closure with multilingual disabled.
        if ($this->value instanceof Closure) {
            return ($this->value)(app()->getLocale());
        }
        if (isset($this->value)) {
            return $this->value;
        }

        return optional($this->model)->{$this->convertArrayNameInNotation()};
    }

    protected function getPlaceholder(): ?string
    {
        if (isset($this->placeholder)) {
            return $this->placeholder;
        }
        $label = $this->getLabel();
        if ($label) {
            return $label;
        }

        return (string) __('validation.attributes.' . $this->removeArrayCharactersFromName());
    }

    protected function getPrepend(): ?string
    {
        // Fallback for usage of closure with multilingual disabled.
        if ($this->prepend instanceof Closure) {
            return ($this->prepend)(app()->getLocale());
        }

        return $this->prepend;
    }

    abstract protected function setPrepend(): ?string;

    protected function getAppend(): ?string
    {
        // Fallback for usage of closure with multilingual disabled.
        if ($this->append instanceof Closure) {
            return ($this->append)(app()->getLocale());
        }

        return $this->append;
    }

    abstract protected function setAppend(): ?string;

    protected function getCaption(): ?string
    {
        return $this->caption;
    }

    abstract protected function setCaption(): ?string;

    protected function getComponentId(): string
    {
        if ($this->componentId) {
            return $this->componentId;
        }

        return $this->getType() . '-' . Str::slug(Str::snake($this->convertArrayNameInNotation('-'), '-'));
    }

    protected function getModel(): ?Model
    {
        return $this->model;
    }
}
