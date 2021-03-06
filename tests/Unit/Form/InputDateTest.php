<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Facades\InputDate;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomInputDate;
use Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts\TemporalTestAbstract;

class InputDateTest extends TemporalTestAbstract
{
    protected function getComponent(): ComponentAbstract
    {
        return app(config('bootstrap-components.components.date'));
    }

    protected function getHelper(): ComponentAbstract
    {
        return inputDate();
    }

    protected function getFacade(): ComponentAbstract
    {
        return InputDate::getFacadeRoot();
    }

    protected function getCustomComponent(): ComponentAbstract
    {
        return (new CustomInputDate());
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
