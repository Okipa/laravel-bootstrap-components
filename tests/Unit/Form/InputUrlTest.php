<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\Component;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomEmail;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomUrl;

class InputUrlTest extends InputTestAbstract
{
    protected function getComponent(): Component
    {
        return input()->url();
    }

    protected function getCustomComponent(): Component
    {
        return (new CustomUrl);
    }

    protected function getComponentType(): string
    {
        return 'url';
    }
}
