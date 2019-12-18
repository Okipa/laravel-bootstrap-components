<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\Component;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomText;

class InputTextTest extends InputMultilingualTestAbstract
{
    protected function getComponent(): Component
    {
        return input()->text();
    }

    protected function getCustomComponent(): Component
    {
        return (new CustomText);
    }

    protected function getComponentType(): string
    {
        return 'text';
    }
}
