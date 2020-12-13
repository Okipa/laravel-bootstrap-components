<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form\Abstracts;

use Closure;
use Illuminate\Support\Arr;
use Okipa\LaravelBootstrapComponents\Components\Form\Traits\SelectValidityChecks;

abstract class SelectableAbstract extends InputAbstract
{
    use SelectValidityChecks;

    protected array $options = [];

    protected ?string $optionValueField = null;

    protected ?string $optionLabelField = null;

    protected ?string $selectedFieldToCompare = null;

    /** @property int|string|array $selectedValueToCompare */
    protected $selectedValueToCompare;

    protected ?Closure $disabledOptionsClosure = null;

    protected bool $multiple = false;

    /**
     * @param iterable $optionsList
     * @param string $optionValueField
     * @param string $optionLabelField
     *
     * @return $this
     * @throws \JsonException
     */
    public function options(iterable $optionsList, string $optionValueField, string $optionLabelField): self
    {
        $this->options = json_decode(json_encode($optionsList, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);
        $this->optionValueField = $optionValueField;
        $this->optionLabelField = $optionLabelField;

        return $this;
    }

    /**
     * @param string $fieldToCompare
     * @param int|string|array $valueToCompare
     *
     * @return $this
     */
    public function selected(string $fieldToCompare, $valueToCompare): self
    {
        $this->selectedFieldToCompare = $fieldToCompare;
        $this->selectedValueToCompare = $valueToCompare;

        return $this;
    }

    public function disabled(Closure $disabledOptions): self
    {
        $this->disabledOptionsClosure = $disabledOptions;

        return $this;
    }

    public function multiple(bool $multiple = true): self
    {
        $this->multiple = $multiple;

        return $this;
    }

    protected function getViewParams(): array
    {
        return array_merge(parent::getViewParams(), [
            'options' => $this->getOptions(),
            'optionValueField' => $this->getOptionValueField(),
            'optionLabelField' => $this->getOptionLabelField(),
            'multiple' => $this->getMultiple(),
        ]);
    }

    protected function getOptions(): array
    {
        $this->setOptionsSelectedStatus();
        $this->setOptionsDisabledStatus();

        return $this->options ?? [];
    }

    protected function setOptionsSelectedStatus(): void
    {
        if ($this->options) {
            if ($this->multiple) {
                $selectedOptions = $this->getMultipleSelectedOptions();
                if (count($selectedOptions)) {
                    foreach ($selectedOptions as $key => $selectedOption) {
                        $this->options[$key]['selected'] = true;
                    }
                }
            } else {
                $selectedOption = $this->getSelectedOption();
                if (count($selectedOption)) {
                    $selectedKey = head(array_keys($selectedOption));
                    $this->options[$selectedKey]['selected'] = true;
                }
            }
        }
    }

    protected function getMultipleSelectedOptions(): array
    {
        $oldValueMultipleSelectedOptions = $this->searchMultipleSelectedOptionFromOldValue();
        if ($oldValueMultipleSelectedOptions) {
            return $oldValueMultipleSelectedOptions;
        }
        $manuallyMultipleSelectedOptions = $this->searchMultipleSelectedOptionsFromSelectedMethod();
        if ($manuallyMultipleSelectedOptions) {
            return $manuallyMultipleSelectedOptions;
        }
        $modelMultipleSelectedOptions = $this->searchMultipleSelectedOptionsFromModel();
        if ($modelMultipleSelectedOptions) {
            return $modelMultipleSelectedOptions;
        }

        return [];
    }

    protected function searchMultipleSelectedOptionFromOldValue(): ?array
    {
        $oldValue = old($this->convertArrayNameInNotation());
        if (! $oldValue) {
            return null;
        }
        $selectedMultipleOptions = Arr::where($this->options, function ($option) use ($oldValue) {
            return in_array((string) $option[$this->optionValueField], $oldValue, true);
        });

        return $selectedMultipleOptions ?: null;
    }

    protected function searchMultipleSelectedOptionsFromSelectedMethod(): ?array
    {
        if (isset($this->selectedFieldToCompare, $this->selectedValueToCompare)) {
            $selectedMultipleOptions = Arr::where($this->options, function (array $option) {
                return in_array($option[$this->selectedFieldToCompare], is_array($this->selectedValueToCompare)
                    ? $this->selectedValueToCompare
                    : [$this->selectedValueToCompare], true);
            });
            if (! empty($selectedMultipleOptions)) {
                return $selectedMultipleOptions;
            }
        }

        return null;
    }

    protected function searchMultipleSelectedOptionsFromModel(): ?array
    {
        if ($this->model && $this->model->{$this->getName()}) {
            $multipleSelectedOptions = Arr::where($this->options, function ($option) {
                return in_array($option[$this->optionValueField], $this->model->{$this->getName()}, true);
            });
            if (! empty($multipleSelectedOptions)) {
                return $multipleSelectedOptions;
            }
        }

        return null;
    }

    protected function getSelectedOption(): array
    {
        $oldValueSelectedOption = $this->searchSelectedOptionFromOldValue();
        if ($oldValueSelectedOption) {
            return $oldValueSelectedOption;
        }
        $manuallySelectedOption = $this->searchSelectedOptionFromSelectedMethod();
        if ($manuallySelectedOption) {
            return $manuallySelectedOption;
        }
        $modelSelectedOption = $this->searchSelectedOptionFromModel();
        if ($modelSelectedOption) {
            return $modelSelectedOption;
        }

        return [];
    }

    protected function searchSelectedOptionFromOldValue(): ?array
    {
        $oldValue = old($this->convertArrayNameInNotation());
        if ($oldValue) {
            $selectedOption = Arr::where($this->options, function ($option) use ($oldValue) {
                return (string) $option[$this->optionValueField] === $oldValue;
            });
            if (! empty($selectedOption)) {
                return $selectedOption;
            }
        }

        return null;
    }

    protected function searchSelectedOptionFromSelectedMethod(): ?array
    {
        if (isset($this->selectedFieldToCompare, $this->selectedValueToCompare)) {
            $selectedOption = Arr::where($this->options, function ($option) {
                return $option[$this->selectedFieldToCompare] === $this->selectedValueToCompare;
            });
            if (! empty($selectedOption)) {
                return $selectedOption;
            }
        }

        return null;
    }

    protected function searchSelectedOptionFromModel(): ?array
    {
        if ($this->model) {
            $selectedOption = Arr::where($this->options, function ($option) {
                return $option[$this->optionValueField] === $this->model->{$this->getName()};
            });
            if (! empty($selectedOption)) {
                return $selectedOption;
            }
        }

        return null;
    }

    protected function setOptionsDisabledStatus(): void
    {
        if ($this->disabledOptionsClosure && count($this->options)) {
            $disabledOptionsClosure = $this->disabledOptionsClosure;
            foreach ($this->options as $key => $option) {
                if ($disabledOptionsClosure($option)) {
                    $this->options[$key]['disabled'] = true;
                }
            }
        }
    }

    protected function getOptionValueField(): ?string
    {
        return $this->optionValueField;
    }

    protected function getOptionLabelField(): ?string
    {
        return $this->optionLabelField;
    }

    protected function getMultiple(): bool
    {
        return $this->multiple;
    }
}
