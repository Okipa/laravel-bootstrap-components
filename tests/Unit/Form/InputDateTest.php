<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\Component;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomDate;

class InputDateTest extends TemporalTestAbstract
{
    protected function getComponent(): Component
    {
        return input()->date();
    }

    protected function getCustomComponent(): Component
    {
        return (new CustomDate);
    }

    protected function getComponentType(): string
    {
        return 'date';
    }

    protected function getFormat(): string
    {
        return 'Y-m-d';
    }
}
