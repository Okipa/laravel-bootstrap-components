<?php

namespace Okipa\LaravelBootstrapComponents\Form\Components;

use Okipa\LaravelBootstrapComponents\Form\Abstracts\Form;

class Tel extends Form
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'form.tel';

    /**
     * The input type.
     *
     * @property string $type
     */
    protected $type = 'tel';
}
