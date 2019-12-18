<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\Component;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomPassword;

class InputPasswordTest extends InputTestAbstract
{
    protected function getComponent(): Component
    {
        return input()->password();
    }

    protected function getCustomComponent(): Component
    {
        return (new CustomPassword);
    }

    protected function getComponentType(): string
    {
        return 'password';
    }
}
