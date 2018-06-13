<?php

namespace Okipa\LaravelBootstrapComponents\Form;

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

    protected $options;
    protected $optionValueField;
    protected $optionLabelField;
    
    public function options(iterable $optionsList, string $optionValueField, string $optionLabelField)
    {
        $this->options = json_decode(json_encode($optionsList), true);
        $this->optionValueField = $optionValueField;
        $this->optionLabelField = $optionLabelField;
        
        return $this;
    }

    /**
     * Set the input values.
     *
     * @return array
     */
    protected function values(): array
    {
        $parentValues = parent::values();
        return array_merge($parentValues, [
            'options' => $this->options ? $this->options : [],
            'optionValueField' => $this->optionValueField,
            'optionLabelField' => $this->optionLabelField,
        ]);
    }
}
