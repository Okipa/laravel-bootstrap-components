<?php

namespace Okipa\LaravelBootstrapComponents\Form;

class Date extends Temporal
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'form.date';

    /**
     * The input type.
     *
     * @property string $type
     */
    protected $type = 'date';
}
