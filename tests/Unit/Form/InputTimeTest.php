<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\Component;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomTime;

class InputTimeTest extends TemporalTestAbstract
{
    protected function getComponent(): Component
    {
        return input()->time();
    }

    protected function getCustomComponent(): Component
    {
        return (new CustomTime);
    }

    protected function getComponentType(): string
    {
        return 'time';
    }

    protected function getFormat(): string
    {
        return 'H:i:s';
    }
}
