<?php

namespace Okipa\LaravelBootstrapComponents\Clickable;

class ButtonValidate extends Button
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'button_validate';
    /**
     * Set the button values.
     *
     * @return array
     */
    protected function values(): array
    {
        return array_merge(parent::values(), [
            'type'  => 'submit',
        ]);
    }

    /**
     * Check the component values validity
     *
     * @throws \Exception
     */
    protected function checkValuesValidity(): void
    {
        //
    }
}
