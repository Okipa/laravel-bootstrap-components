<?php

namespace Okipa\LaravelBootstrapComponents\Form\Components;

use Okipa\LaravelBootstrapComponents\Form\Abstracts\Form;

class Password extends Form
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'form.password';

    /**
     * The input type.
     *
     * @property string $type
     */
    protected $type = 'password';
}
