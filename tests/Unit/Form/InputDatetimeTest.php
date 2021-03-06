<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Facades\InputDatetime;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomInputDatetime;
use Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts\TemporalTestAbstract;

class InputDatetimeTest extends TemporalTestAbstract
{
    protected function getComponent(): ComponentAbstract
    {
        return app(config('bootstrap-components.components.datetime'));
    }

    protected function getHelper(): ComponentAbstract
    {
        return inputDatetime();
    }

    protected function getFacade(): ComponentAbstract
    {
        return InputDatetime::getFacadeRoot();
    }

    protected function getCustomComponent(): ComponentAbstract
    {
        return (new CustomInputDatetime());
    }

    protected function getComponentType(): string
    {
        return 'datetime-local';
    }

    protected function getComponentKey(): string
    {
        return 'datetime';
    }

    protected function getFormat(): string
    {
        return 'Y-m-d\TH:i';
    }
}
