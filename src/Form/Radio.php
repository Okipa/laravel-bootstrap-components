<?php

namespace Okipa\LaravelBootstrapComponents\Form;

class Radio extends Input
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'form.radio';
    /**
     * The input type.
     *
     * @property string $type
     */
    protected $type = 'radio';

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
            'checked' => $parentValues['value'] ? true : false,
        ]);
    }
}
