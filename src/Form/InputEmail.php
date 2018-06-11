<?php

namespace Okipa\LaravelBootstrapComponents\Form;

class InputEmail extends Input
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'input_email';
    /**
     * The input type.
     *
     * @property string $type
     */
    protected $type = 'email';

    /**
     * Set the input values.
     *
     * @return array
     * @throws \Exception
     */
    protected function values(): array
    {
        return array_merge(parent::values(), [
            'type' => 'email',
        ]);
    }
}
