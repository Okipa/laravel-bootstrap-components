<?php

namespace Okipa\LaravelBootstrapComponents\Form\Components;

use Okipa\LaravelBootstrapComponents\Form\Abstracts\Form;

class Email extends Form
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'form.email';

    /**
     * The input type.
     *
     * @property string $type
     */
    protected $type = 'email';
}
