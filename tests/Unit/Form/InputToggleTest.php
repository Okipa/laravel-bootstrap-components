<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Facades\InputToggle;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomToggle;
use Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts\InputCheckableTestAbstract;

class InputToggleTest extends InputCheckableTestAbstract
{
    protected function getComponent(): ComponentAbstract
    {
        return app(config('bootstrap-components.form.components.toggle'));
    }

    protected function getHelper(): ComponentAbstract
    {
        return inputToggle();
    }

    protected function getFacade()
    {
        return InputToggle::getFacadeRoot();
    }

    protected function getComponentType(): string
    {
        return 'toggle';
    }

    protected function getCustomComponent(): ComponentAbstract
    {
        return (new CustomToggle);
    }
}
