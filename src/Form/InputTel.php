<?php

namespace Okipa\LaravelBootstrapComponents\Form;

class InputTel extends Input
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'input_tel';
    /**
     * The input type.
     *
     * @property string $type
     */
    protected $type = 'tel';

    /**
     * Set the input values.
     *
     * @return array
     * @throws \Exception
     */
    protected function values(): array
    {
        return array_merge(parent::values(), [
            'type' => 'tel',
        ]);
    }
}
