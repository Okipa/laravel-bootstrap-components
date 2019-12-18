<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\Component;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomToggle;

class InputToggleTest extends InputCheckableTestAbstract
{
    protected function getComponent(): Component
    {
        return input()->toggle();
    }

    protected function getComponentType(): string
    {
        return 'toggle';
    }

    protected function getCustomComponent(): Component
    {
        return (new CustomToggle);
    }
}
