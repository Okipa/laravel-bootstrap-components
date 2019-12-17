<?php

namespace Okipa\LaravelBootstrapComponents\Form\Components;

use Okipa\LaravelBootstrapComponents\Form\Abstracts\Checkable;

class Checkbox extends Checkable
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'form.checkbox';

    /**
     * The input type.
     *
     * @property string $type
     */
    protected $type = 'checkbox';
}
