<?php

namespace Okipa\LaravelBootstrapComponents\Form\Components;

use Okipa\LaravelBootstrapComponents\Form\Abstracts\Checkable;

class Toggle extends Checkable
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'form.toggle';

    /**
     * The input type.
     *
     * @property string $type
     */
    protected $type = 'toggle';
}
