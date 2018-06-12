<?php

namespace Okipa\LaravelBootstrapComponents\Clickable;

class ButtonCancel extends Button
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'button_cancel';

    /**
     * Set the button values.
     *
     * @return array
     */
    protected function values(): array
    {
        return array_merge(parent::values(), [
            'type'  => 'button',
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
