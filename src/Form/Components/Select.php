<?php

namespace Okipa\LaravelBootstrapComponents\Form\Components;

use Okipa\LaravelBootstrapComponents\Form\Abstracts\SelectAbstract as AbstractSelect;

class Select extends AbstractSelect
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'form.select';

    /**
     * The input type.
     *
     * @property string $type
     */
    protected $type = 'select';

}
