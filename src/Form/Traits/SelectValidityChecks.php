<?php

namespace Okipa\LaravelBootstrapComponents\Form\Traits;

use Exception;
use InvalidArgumentException;

trait SelectValidityChecks
{
    /**
     * Check the component values validity
     *
     * @return void
     * @throws Exception
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
                . $this->optionLabelField . ' »  does not exist the given first $optionsList argument.'
            );
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
        if ($this->model && isset($this->model->{$this->getName()}) && ! is_array($this->model->{$this->getName()})) {
            throw new InvalidArgumentException(
                get_class($this) . ' : The « ' . $this->getName() . ' » attribute from the given « '
                . $this->model->getMorphClass()
                . ' » model has to be an array when the bsSelect() component is in multiple mode : « '
                . gettype($this->model->{$this->getName()}) . ' » type given.'
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
