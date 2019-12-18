<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\Component;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomDatetime;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomTime;

class InputDatetimeTest extends TemporalTestAbstract
{
    protected function getComponent(): Component
    {
        return input()->datetime();
    }

    protected function getCustomComponent(): Component
    {
        return (new CustomDatetime);
    }

    protected function getComponentType(): string
    {
        return 'datetime-local';
    }

    protected function getFormat(): string
    {
        return 'Y-m-d H:i:s';
    }

    protected function getComponentKey(): string
    {
        return 'datetime';
    }
}
