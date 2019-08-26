<?php

namespace Okipa\LaravelBootstrapComponents\Form;

use Illuminate\Support\Arr;
use Okipa\LaravelBootstrapComponents\Form\Traits\SelectValidityChecks;

class Select extends Input
{
    use SelectValidityChecks;
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'form.select';
    /**
     * The input type.
     *
     * @property string $type
     */
    protected $type = 'select';
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
     * @return \Okipa\LaravelBootstrapComponents\Form\Select
     */
    public function options(iterable $optionsList, string $optionValueField, string $optionLabelField): Select
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
     * @return \Okipa\LaravelBootstrapComponents\Form\Select
     */
    public function selected(string $fieldToCompare, $valueToCompare): Select
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
     * @return \Okipa\LaravelBootstrapComponents\Form\Select
     */
    public function multiple(bool $multiple = true): Select
    {
        $this->multiple = $multiple;

        return $this;
    }

    /**
     * Set the input values.
     *
     * @return array
     */
    protected function values(): array
    {
        $this->setOptionsSelectedStatus();

        return array_merge(parent::values(), [
            'options'          => $this->options ? $this->options : [],
            'optionValueField' => $this->optionValueField,
            'optionLabelField' => $this->optionLabelField,
            'multiple'         => $this->multiple,
        ]);
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
    protected function getMultipleSelectedOptions()
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
    protected function searchMultipleSelectedOptionFromOldValue()
    {
        $oldValue = old($this->name);
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
    protected function searchMultipleSelectedOptionsFromSelectedMethod()
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
    protected function searchMultipleSelectedOptionsFromModel()
    {
        if ($this->model && $this->model->{$this->name}) {
            $multipleSelectedOptions = Arr::where($this->options, function ($option) {
                return in_array(
                    $option[$this->optionValueField],
                    $this->model->{$this->name}
                );
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
    protected function getSelectedOption()
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
    protected function searchSelectedOptionFromOldValue()
    {
        $oldValue = old($this->name);
        if ($oldValue) {
            $selectedOption = Arr::where($this->options, function ($option) use ($oldValue) {
                return $option[$this->optionValueField] == $oldValue;
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
    protected function searchSelectedOptionFromSelectedMethod()
    {
        if (isset($this->selectedFieldToCompare) && isset($this->selectedValueToCompare)) {
            $selectedOption = Arr::where($this->options, function ($option) {
                return $option[$this->selectedFieldToCompare] == $this->selectedValueToCompare;
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
    protected function searchSelectedOptionFromModel()
    {
        if ($this->model) {
            $selectedOption = Arr::where($this->options, function ($option) {
                return $option[$this->optionValueField] == $this->model->{$this->name};
            });
            if (! empty($selectedOption)) {
                return $selectedOption;
            }
        }

        return null;
    }
}
