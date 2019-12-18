<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\Component;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomCheckbox;

class InputCheckboxTest extends InputCheckableTestAbstract
{
    protected function getComponent(): Component
    {
        return input()->checkbox();
    }

    protected function getComponentType(): string
    {
        return 'checkbox';
    }

    protected function getCustomComponent(): Component
    {
        return (new CustomCheckbox);
    }
}
