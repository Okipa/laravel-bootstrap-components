<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Facades\InputNumber;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomNumber;
use Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts\InputTestAbstract;

class InputNumberTest extends InputTestAbstract
{
    protected function getComponent(): ComponentAbstract
    {
        return app(config('bootstrap-components.components.number'));
    }

    protected function getHelper(): ComponentAbstract
    {
        return inputNumber();
    }

    protected function getFacade(): ComponentAbstract
    {
        return InputNumber::getFacadeRoot();
    }

    protected function getCustomComponent(): ComponentAbstract
    {
        return (new CustomNumber());
    }

    protected function getComponentType(): string
    {
        return 'number';
    }
}
