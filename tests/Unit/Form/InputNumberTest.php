<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\Component;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomNumber;

class InputNumberTest extends InputTestAbstract
{
    protected function getComponent(): Component
    {
        return input()->number();
    }

    protected function getCustomComponent(): Component
    {
        return (new CustomNumber);
    }

    protected function getComponentType(): string
    {
        return 'number';
    }
}
