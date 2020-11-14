<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Facades\InputSwitch;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomInputSwitch;
use Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts\InputCheckableTestAbstract;

class InputSwitchTest extends InputCheckableTestAbstract
{
    protected function getComponent(): ComponentAbstract
    {
        return app(config('bootstrap-components.components.switch'));
    }

    protected function getHelper(): ComponentAbstract
    {
        return inputSwitch();
    }

    protected function getFacade(): ComponentAbstract
    {
        return InputSwitch::getFacadeRoot();
    }

    protected function getComponentType(): string
    {
        return 'switch';
    }

    protected function getCustomComponent(): ComponentAbstract
    {
        return (new CustomInputSwitch());
    }
}
