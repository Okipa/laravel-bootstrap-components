<?php

namespace Okipa\LaravelBootstrapComponents\Form\Components;

use Okipa\LaravelBootstrapComponents\Form\Abstracts\Form;

class Number extends Form
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'form.number';

    /**
     * The input type.
     *
     * @property string $type
     */
    protected $type = 'number';
}
