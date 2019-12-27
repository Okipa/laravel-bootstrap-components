<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Facades\InputTime;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomTime;
use Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts\TemporalTestAbstract;

class InputTimeTest extends TemporalTestAbstract
{
    protected function getComponent(): ComponentAbstract
    {
        return app(config('bootstrap-components.components.time'));
    }

    protected function getHelper(): ComponentAbstract
    {
        return inputTime();
    }

    protected function getFacade(): ComponentAbstract
    {
        return InputTime::getFacadeRoot();
    }

    protected function getCustomComponent(): ComponentAbstract
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
