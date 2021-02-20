<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form\Traits;

use InvalidArgumentException;

trait SelectValidityChecks
{
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

    protected function checkOptionValueFieldExistence(array $option): void
    {
        if (empty($option[$this->optionValueField])) {
            throw new InvalidArgumentException(
                get_class($this) . ' : Invalid options() second $optionValueField argument. « '
                . $this->optionValueField . ' »  does not exist the given first $optionsList argument.'
            );
        }
    }

    protected function checkOptionLabelFieldExistence(array $option): void
    {
        if (empty($option[$this->optionLabelField])) {
            throw new InvalidArgumentException(
                get_class($this) . ' : Invalid options() third $optionLabelField argument. « '
                . $this->optionLabelField . ' »  does not exist the given first $optionsList argument.'
            );
        }
    }

    protected function checkSelectedFieldToCompareExistenceInOption(array $option): void
    {
        if ($this->selectedFieldToCompare && empty($option[$this->selectedFieldToCompare])) {
            throw new InvalidArgumentException(
                get_class($this) . ' : Invalid selectOptions() first $fieldToCompare argument. « '
                . $this->selectedFieldToCompare . ' »  does not exist the given first options() '
                . '$optionsList argument.'
            );
        }
    }

    protected function checkMultipleModeModelAttributeType(): void
    {
        if (
            $this->getModel()
            && $this->getModel()->{$this->getName()}
            && ! is_array($this->getModel()->{$this->getName()})
        ) {
            throw new InvalidArgumentException(
                get_class($this) . ' : The « ' . $this->getName() . ' » attribute from the given « '
                . $this->getModel()->getMorphClass()
                . ' » model has to be an array when the select() component is in multiple mode : « '
                . gettype($this->getModel()->{$this->getName()}) . ' » type given.'
            );
        }
    }

    protected function checkMultipleModeSelectedValueToCompareType(): void
    {
        if ($this->selectedValueToCompare && ! is_array($this->selectedValueToCompare)) {
            throw new InvalidArgumentException(
                get_class($this) . ' : Invalid selectOptions() second $valueToCompare argument. '
                . 'This argument has to be an array when the select() component is in multiple mode : « '
                . gettype($this->selectedValueToCompare) . ' » type given.'
            );
        }
    }

    protected function checkSingleModeSelectedValueToCompareType(): void
    {
        if (
            $this->selectedValueToCompare
            && ! is_string($this->selectedValueToCompare)
            && ! is_int($this->selectedValueToCompare)
        ) {
            throw new InvalidArgumentException(
                get_class($this) . ' : Invalid selectOptions() second $valueToCompare argument. '
                . 'This argument has to be a string or an integer when the select() component is not '
                . 'in multiple mode : « ' . gettype($this->selectedValueToCompare) . ' » type given.'
            );
        }
    }
}
