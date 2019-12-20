<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Facades\InputDate;
use Okipa\LaravelBootstrapComponents\Facades\InputDatetime;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomDate;
use Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts\TemporalTestAbstract;

class InputDateTest extends TemporalTestAbstract
{
    protected function getComponent(): ComponentAbstract
    {
        return app(config('bootstrap-components.form.components.date'));
    }

    protected function getHelper(): ComponentAbstract
    {
        return inputDate();
    }

    protected function getFacade()
    {
        return InputDate::getFacadeRoot();
    }

    protected function getCustomComponent(): ComponentAbstract
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
