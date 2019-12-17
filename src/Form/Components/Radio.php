<?php

namespace Okipa\LaravelBootstrapComponents\Form\Components;

use Okipa\LaravelBootstrapComponents\Form\Abstracts\Radio as AbstractRadio;

class Radio extends AbstractRadio
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'form.radio';

    /**
     * The input type.
     *
     * @property string $type
     */
    protected $type = 'radio';

}
