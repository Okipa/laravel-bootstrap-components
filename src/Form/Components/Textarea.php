<?php

namespace Okipa\LaravelBootstrapComponents\Form\Components;

use Okipa\LaravelBootstrapComponents\Form\Abstracts\Multilingual;

class Textarea extends Multilingual
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'form.textarea';

    /**
     * The input type.
     *
     * @property string $type
     */
    protected $type = 'textarea';
}
