<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form\Traits;

use InvalidArgumentException;

trait SelectValidityChecks
{
    /**
     * @throws \Exception
     * @throws \InvalidArgumentException
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
     * @param array $option
     *
     * @throws \InvalidArgumentException
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
     * @param array $option
     *
     * @throws \InvalidArgumentException
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
     * @param array $option
     *
     * @throws \InvalidArgumentException
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

    /** @throws \InvalidArgumentException */
    protected function checkMultipleModeModelAttributeType(): void
    {
        if ($this->model && isset($this->model->{$this->getName()}) && ! is_array($this->model->{$this->getName()})) {
            throw new InvalidArgumentException(
                get_class($this) . ' : The « ' . $this->getName() . ' » attribute from the given « '
                . $this->model->getMorphClass()
                . ' » model has to be an array when the select() component is in multiple mode : « '
                . gettype($this->model->{$this->getName()}) . ' » type given.'
            );
        }
    }

    /** @throws \InvalidArgumentException */
    protected function checkMultipleModeSelectedValueToCompareType(): void
    {
        if ($this->selectedValueToCompare && ! is_array($this->selectedValueToCompare)) {
            throw new InvalidArgumentException(
                get_class($this) . ' : Invalid selected() second $valueToCompare argument. '
                . 'This argument has to be an array when the select() component is in multiple mode : « '
                . gettype($this->selectedValueToCompare) . ' » type given.'
            );
        }
    }

    /** @throws \InvalidArgumentException */
    protected function checkSingleModeSelectedValueToCompareType(): void
    {
        if ($this->selectedValueToCompare
            && ! is_string($this->selectedValueToCompare)
            && ! is_integer($this->selectedValueToCompare)) {
            throw new InvalidArgumentException(
                get_class($this) . ' : Invalid selected() second $valueToCompare argument. '
                . 'This argument has to be a string or an integer when the select() component is not '
                . 'in multiple mode : « ' . gettype($this->selectedValueToCompare) . ' » type given.'
            );
        }
    }
}
