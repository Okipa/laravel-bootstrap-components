<?php

namespace Okipa\LaravelBootstrapComponents\Form;

use InvalidArgumentException;

class Select extends Input
{
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
     * @param iterable $optionsList
     * @param string   $optionValueField
     * @param string   $optionLabelField
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
     * @param string           $fieldToCompare
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
        if ($oldValueMultipleSelectedOptions = $this->searchMultipleSelectedOptionFromOldValue()) {
            return $oldValueMultipleSelectedOptions;
        }
        if ($manuallyMultipleSelectedOptions = $this->searchMultipleSelectedOptionsFromSelectedMethod()) {
            return $manuallyMultipleSelectedOptions;
        }
        if ($modelMultipleSelectedOptions = $this->searchMultipleSelectedOptionsFromModel()) {
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
        if ($oldValue = old($this->name)) {
            $selectedMultipleOptions = array_where($this->options, function($option) use ($oldValue) {
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
            $selectedMultipleOptions = array_where($this->options, function($option) {
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
            $multipleSelectedOptions = array_where($this->options, function($option) {
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
        if ($oldValueSelectedOption = $this->searchSelectedOptionFromOldValue()) {
            return $oldValueSelectedOption;
        }
        if ($manuallySelectedOption = $this->searchSelectedOptionFromSelectedMethod()) {
            return $manuallySelectedOption;
        }
        if ($modelSelectedOption = $this->searchSelectedOptionFromModel()) {
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
        if ($oldValue = old($this->name)) {
            $selectedOption = array_where($this->options, function($option) use ($oldValue) {
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
            $selectedOption = array_where($this->options, function($option) {
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
            $selectedOption = array_where($this->options, function($option) {
                return $option[$this->optionValueField] == $this->model->{$this->name};
            });
            if (! empty($selectedOption)) {
                return $selectedOption;
            }
        }

        return null;
    }

    /**
     * Check the component values validity
     *
     * @throws \Exception
     * @return void
     */
    protected function checkValuesValidity(): void
    {
        parent::checkValuesValidity();
        if ($this->options) {
            foreach ($this->options as $option) {
                $this->checkOptionValueFieldExistence($option);
                $this->checkOptionLabelFieldExistence($option);
                $this->checkSelectedFieldToCompareExistenceInOption($option);
            }
            if ($this->multiple) {
                $this->checkMultipleModeModelAttributeType();
                $this->checkMultipleModeSelectedValueToCompareType();
            } else {
                $this->checkSingleModeSelectedValueToCompareType();
            }
        }
    }

    /**
     * Set the defined option value field.
     *
     * @param array $option
     *
     * @return void
     */
    protected function checkOptionValueFieldExistence(array $option): void
    {
        if (empty($option[$this->optionValueField])) {
            throw new InvalidArgumentException(
                get_class($this) . ' : Invalid options() second $optionValueField argument. « '
                . $this->optionValueField . ' »  does not exist the given first $optionsList argument.'
            );
        }
    }

    /**
     * Set the defined option label field.
     *
     * @param array $option
     *
     * @return void
     */
    protected function checkOptionLabelFieldExistence(array $option): void
    {
        if (empty($option[$this->optionLabelField])) {
            throw new InvalidArgumentException(
                get_class($this) . ' : Invalid options() third $optionLabelField argument. « '
                . $this->optionLabelField . ' »  does not exist the given first $optionsList argument.');
        }
    }

    /**
     * Check the defined selected field to compare existence in option.
     *
     * @param array $option
     *
     * @return void
     */
    protected function checkSelectedFieldToCompareExistenceInOption(array $option): void
    {
        if ($this->selectedFieldToCompare && empty($option[$this->selectedFieldToCompare])) {
            throw new InvalidArgumentException(
                get_class($this) . ' : Invalid selected() first $fieldToCompare argument. « '
                . $this->selectedFieldToCompare . ' »  does not exist the given first options() '
                . '$optionsList argument.'
            );
        }
    }

    /**
     * Check the model attribute type on multiple mode.
     *
     * @return void
     */
    protected function checkMultipleModeModelAttributeType(): void
    {
        if ($this->model && isset($this->model->{$this->name}) && ! is_array($this->model->{$this->name})) {
            throw new InvalidArgumentException(
                get_class($this) . ' : The « ' . $this->name . ' » attribute from the given « '
                . $this->model->getMorphClass()
                . ' » model has to be an array when the bsSelect() component is in multiple mode : « '
                . gettype($this->model->{$this->name}) . ' » type given.'
            );
        }
    }

    /**
     * Check the selected value to compare type on multiple mode.
     *
     * @return void
     */
    protected function checkMultipleModeSelectedValueToCompareType(): void
    {
        if ($this->selectedValueToCompare && ! is_array($this->selectedValueToCompare)) {
            throw new InvalidArgumentException(
                get_class($this) . ' : Invalid selected() second $valueToCompare argument. '
                . 'This argument has to be an array when the bsSelect() component is in multiple mode : « '
                . gettype($this->selectedValueToCompare) . ' » type given.'
            );
        }
    }

    /**
     * Check the selected value to compare type on single mode.
     *
     * @return void
     */
    protected function checkSingleModeSelectedValueToCompareType(): void
    {
        if ($this->selectedValueToCompare
            && ! is_string($this->selectedValueToCompare)
            && ! is_integer($this->selectedValueToCompare)) {
            throw new InvalidArgumentException(
                get_class($this) . ' : Invalid selected() second $valueToCompare argument. '
                . 'This argument has to be a string or an integer when the bsSelect() component is not '
                . 'in multiple mode : « ' . gettype($this->selectedValueToCompare) . ' » type given.'
            );
        }
    }
}
