<?php

namespace Okipa\LaravelBootstrapComponents\Form;

use Exception;

class InputTextarea extends Input
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'input_textarea';

    /**
     * Set the input values.
     *
     * @return array
     * @throws \Exception
     */
    protected function values(): array
    {
        return array_merge(parent::values(), [
            'type'    => 'textarea',
        ]);
    }

    /**
     * Check the component values validity
     *
     * @throws \Exception
     */
    protected function checkValuesValidity(): void
    {
        if (! $this->name) {
            throw new Exception('Name must be declared for the ' . get_class($this) . ' component generation.');
        }
    }
}
