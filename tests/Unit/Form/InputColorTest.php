<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Facades\InputColor;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomColor;
use Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts\InputTestAbstract;

class InputColorTest extends InputTestAbstract
{
    protected function getComponent(): ComponentAbstract
    {
        return app(config('bootstrap-components.components.color'));
    }

    protected function getHelper(): ComponentAbstract
    {
        return inputColor();
    }

    protected function getFacade(): ComponentAbstract
    {
        return InputColor::getFacadeRoot();
    }

    protected function getCustomComponent(): ComponentAbstract
    {
        return (new CustomColor);
    }

    protected function getComponentType(): string
    {
        return 'color';
    }
}
