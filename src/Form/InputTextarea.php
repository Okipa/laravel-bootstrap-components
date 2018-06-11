<?php

namespace Okipa\LaravelBootstrapComponents\Form;

class InputTextarea extends Input
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'input_textarea';
    /**
     * The input type.
     *
     * @property string $type
     */
    protected $type = 'textarea';

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
}
