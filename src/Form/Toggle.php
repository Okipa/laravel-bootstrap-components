<?php

namespace Okipa\LaravelBootstrapComponents\Form;

class Toggle extends Checkable
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'form.toggle';
    /**
     * The input type.
     *
     * @property string $type
     */
    protected $type = 'toggle';

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
