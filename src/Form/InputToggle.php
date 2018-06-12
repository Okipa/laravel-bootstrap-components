<?php

namespace Okipa\LaravelBootstrapComponents\Form;

use Exception;

class InputToggle extends Input
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'input_toggle';

    /**
     * Set the input values.
     *
     * @return array
     * @throws \Exception
     */
    protected function values(): array
    {
        $parentValues = parent::values();

        return array_merge($parentValues, [
            'type'    => 'toggle',
            'checked' => $parentValues['value'] ? true : false,
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
