<?php

namespace Okipa\LaravelBootstrapComponents\Clickable;

class ButtonCreate extends Button
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'button_create';

    /**
     * Set the button values.
     *
     * @return array
     */
    protected function values(): array
    {
        return array_merge(parent::values(), [
            'type' => 'submit',
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
