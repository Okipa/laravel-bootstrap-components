<?php

namespace Okipa\LaravelBootstrapComponents\Form;

class InputPassword extends Input
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'input_password';
    /**
     * The input type.
     *
     * @property string $type
     */
    protected $type = 'password';

    /**
     * Set the input values.
     *
     * @return array
     * @throws \Exception
     */
    protected function values(): array
    {
        return array_merge(parent::values(), [
            'type' => 'password',
        ]);
    }
}