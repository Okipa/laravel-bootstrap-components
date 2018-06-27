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
     * @param string $fieldToCompare
     * @param        $valueToCompare
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
            $selectedOption = $this->getSelectedOption();
            if ($selectedOption) {
                $selectedKey = head(array_keys($selectedOption));
                $this->options[$selectedKey]['selected'] = true;
            }
        }
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
        if ($oldValue = old($this->optionValueField)) {
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
                return $option[$this->optionValueField] == $this->model->{$this->optionValueField};
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
                if (empty($option[$this->optionValueField])) {
                    throw new InvalidArgumentException(
                        get_class($this) . ' : Invalid options() second $optionValueField argument. « '
                        . $this->optionValueField . ' »  does not exist the given first $optionsList argument.'
                    );
                }
                if (empty($option[$this->optionLabelField])) {
                    throw new InvalidArgumentException(
                        get_class($this) . ' : Invalid options() third $optionLabelField argument. « '
                        . $this->optionLabelField . ' »  does not exist the given first $optionsList argument.');
                }
                if ($this->selectedFieldToCompare && empty($option[$this->selectedFieldToCompare])) {
                    throw new InvalidArgumentException(
                        get_class($this) . ' : Invalid selected() first $fieldToCompare argument. « '
                        . $this->selectedFieldToCompare
                        . ' »  does not exist the given first options() $optionsList argument.'
                    );
                }
            }
        }
    }
}
