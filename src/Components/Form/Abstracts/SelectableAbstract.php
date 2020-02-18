<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form\Abstracts;

use Illuminate\Support\Arr;
use Okipa\LaravelBootstrapComponents\Components\Form\Traits\SelectValidityChecks;

abstract class SelectableAbstract extends FormAbstract
{
    use SelectValidityChecks;

    /**
     * The select options list.
     *
     * @property iterable $options
     */
    protected $options;

    /**
     * The select options value field.
     *
     * @property string $optionValueField
     */
    protected $optionValueField;

    /**
     * The select options label field.
     *
     * @property string $optionLabelField
     */
    protected $optionLabelField;

    /**
     * The selected options value field.
     *
     * @property string $optionSelectedValueField
     */
    protected $selectedFieldToCompare;

    /**
     * The selected options value field.
     *
     * @property string $optionSelectedValueField
     */
    protected $selectedValueToCompare;

    /**
     * The selected options value field.
     *
     * @property string $optionSelectedValueField
     */
    protected $multiple = false;

    /**
     * Set the select options and the fields that will be use for the selection comparison and for the label displaying.
     *
     * @param iterable $optionsList
     * @param string $optionValueField
     * @param string $optionLabelField
     *
     * @return $this
     */
    public function options(iterable $optionsList, string $optionValueField, string $optionLabelField): self
    {
        $this->options = json_decode(json_encode($optionsList), true);
        $this->optionValueField = $optionValueField;
        $this->optionLabelField = $optionLabelField;

        return $this;
    }

    /**
     * Set the selected option.
     *
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

    /**
     * Set the select multiple mode.
     *
     * @param bool $multiple
     *
     * @return $this
     */
    public function multiple(bool $multiple = true): self
    {
        $this->multiple = $multiple;

        return $this;
    }

    /**
     * Define the component parameters.
     *
     * @return array
     */
    protected function getParameters(): array
    {
        $this->setOptionsSelectedStatus();
        $options = $this->getOptions();
        $optionValueField = $this->optionValueField;
        $optionLabelField = $this->optionLabelField;
        $multiple = $this->multiple;

        return array_merge(
            parent::getParameters(),
            compact('options', 'optionValueField', 'optionLabelField', 'multiple')
        );
    }

    /**
     * Set selected options statuses.
     *
     * @return void
     */
    protected function setOptionsSelectedStatus(): void
    {
        if ($this->options) {
            if ($this->multiple) {
                $selectedOptions = $this->getMultipleSelectedOptions();
                if ($selectedOptions) {
                    foreach ($selectedOptions as $key => $selectedOption) {
                        $this->options[$key]['selected'] = true;
                    }
                }
            } else {
                $selectedOption = $this->getSelectedOption();
                if ($selectedOption) {
                    $selectedKey = head(array_keys($selectedOption));
                    $this->options[$selectedKey]['selected'] = true;
                }
            }
        }
    }

    /**
     * Get the multiple selected options.
     *
     * @return array|null
     */
    protected function getMultipleSelectedOptions(): ?array
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

        return null;
    }

    /**
     * Search the selected multiple options from the old() request value.
     *
     * @return array|null
     */
    protected function searchMultipleSelectedOptionFromOldValue(): ?array
    {
        $oldValue = old($this->getName());
        if ($oldValue) {
            $selectedMultipleOptions = Arr::where($this->options, function ($option) use ($oldValue) {
                return in_array($option[$this->optionValueField], $oldValue);
            });
            if (! empty($selectedMultipleOptions)) {
                return $selectedMultipleOptions;
            }
        }

        return null;
    }

    /**
     * Search the selected multiple options from the selected() method.
     *
     * @return array|null
     */
    protected function searchMultipleSelectedOptionsFromSelectedMethod(): ?array
    {
        if (isset($this->selectedFieldToCompare) && isset($this->selectedValueToCompare)) {
            $selectedMultipleOptions = Arr::where($this->options, function ($option) {
                return in_array($option[$this->selectedFieldToCompare], $this->selectedValueToCompare);
            });
            if (! empty($selectedMultipleOptions)) {
                return $selectedMultipleOptions;
            }
        }

        return null;
    }

    /**
     * Search the selected multiple options from the model values.
     *
     * @return array|null
     */
    protected function searchMultipleSelectedOptionsFromModel(): ?array
    {
        if ($this->model && $this->model->{$this->getName()}) {
            $multipleSelectedOptions = Arr::where($this->options, function ($option) {
                return in_array($option[$this->optionValueField], $this->model->{$this->getName()});
            });
            if (! empty($multipleSelectedOptions)) {
                return $multipleSelectedOptions;
            }
        }

        return null;
    }

    /**
     * Get the selected option.
     *
     * @return array|null
     */
    protected function getSelectedOption(): ?array
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

        return null;
    }

    /**
     * Search the selected option from the old() request value.
     *
     * @return array|null
     */
    protected function searchSelectedOptionFromOldValue(): ?array
    {
        $oldValue = old($this->getName());
        if ($oldValue) {
            $selectedOption = Arr::where($this->options, function ($option) use ($oldValue) {
                return $option[$this->optionValueField] === $oldValue;
            });
            if (! empty($selectedOption)) {
                return $selectedOption;
            }
        }

        return null;
    }

    /**
     * Search the selected option from the selected() method.
     *
     * @return array|null
     */
    protected function searchSelectedOptionFromSelectedMethod(): ?array
    {
        if (isset($this->selectedFieldToCompare) && isset($this->selectedValueToCompare)) {
            $selectedOption = Arr::where($this->options, function ($option) {
                return $option[$this->selectedFieldToCompare] === $this->selectedValueToCompare;
            });
            if (! empty($selectedOption)) {
                return $selectedOption;
            }
        }

        return null;
    }

    /**
     * Search the selected option from the model values.
     *
     * @return array|null
     */
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

    /**
     * @return array
     */
    protected function getOptions(): array
    {
        return $this->options ?? [];
    }
}
