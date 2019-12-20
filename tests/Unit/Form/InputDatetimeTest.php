<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Facades\InputDatetime;
use Okipa\LaravelBootstrapComponents\Facades\InputTime;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomDatetime;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomTime;
use Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts\TemporalTestAbstract;

class InputDatetimeTest extends TemporalTestAbstract
{
    protected function getComponent(): ComponentAbstract
    {
        return app(config('bootstrap-components.form.components.datetime'));
    }

    protected function getHelper(): ComponentAbstract
    {
        return inputDatetime();
    }

    protected function getFacade()
    {
        return InputDatetime::getFacadeRoot();
    }

    protected function getCustomComponent(): ComponentAbstract
    {
        return (new CustomDatetime);
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
        return 'Y-m-d H:i:s';
    }
}
