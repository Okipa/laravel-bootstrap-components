<?php

namespace Okipa\LaravelBootstrapComponents\Form\Components;

use Okipa\LaravelBootstrapComponents\Form\Abstracts\Temporal;

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
