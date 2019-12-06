<?php

namespace Okipa\LaravelBootstrapComponents\Form;

class Datetime extends Temporal
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'form.datetime';

    /**
     * The input type.
     *
     * @property string $type
     */
    protected $type = 'datetime-local';
}
