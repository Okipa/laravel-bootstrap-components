<?php

namespace Okipa\LaravelBootstrapComponents\Form;

class Time extends Temporal
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'form.time';

    /**
     * The input type.
     *
     * @property string $type
     */
    protected $type = 'time';
}
