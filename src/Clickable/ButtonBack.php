<?php

namespace Okipa\LaravelBootstrapComponents\Clickable;

class ButtonBack extends Button
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'button_back';

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
