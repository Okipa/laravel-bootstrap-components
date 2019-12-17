<?php

namespace Okipa\LaravelBootstrapComponents\Form\Components;

use Okipa\LaravelBootstrapComponents\Form\Abstracts\Form;

class Color extends Form
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'form.color';

    /**
     * The input type.
     *
     * @property string $type
     */
    protected $type = 'color';
}
