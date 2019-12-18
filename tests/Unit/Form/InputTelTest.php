<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\Component;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomTel;

class InputTelTest extends InputTestAbstract
{
    protected function getComponent(): Component
    {
        return input()->tel();
    }

    protected function getCustomComponent(): Component
    {
        return (new CustomTel);
    }

    protected function getComponentType(): string
    {
        return 'tel';
    }
}
