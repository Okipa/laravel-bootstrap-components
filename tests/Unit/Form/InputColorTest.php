<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\Component;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomColor;

class InputColorTest extends InputTestAbstract
{
    protected function getComponent(): Component
    {
        return input()->color();
    }

    protected function getCustomComponent(): Component
    {
        return (new CustomColor);
    }

    protected function getComponentType(): string
    {
        return 'color';
    }
}
