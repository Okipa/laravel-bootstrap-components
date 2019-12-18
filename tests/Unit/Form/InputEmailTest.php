<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\Component;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomEmail;

class InputEmailTest extends InputTestAbstract
{
    protected function getComponent(): Component
    {
        return input()->email();
    }

    protected function getCustomComponent(): Component
    {
        return (new CustomEmail);
    }

    protected function getComponentType(): string
    {
        return 'email';
    }
}
