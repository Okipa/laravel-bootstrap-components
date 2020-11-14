<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Buttons;

use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Facades\SubmitValidate;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomSubmit;
use Okipa\LaravelBootstrapComponents\Tests\Unit\Buttons\Abstracts\SubmitTestAbstract;

class ValidateTest extends SubmitTestAbstract
{
    protected function getComponent(): ComponentAbstract
    {
        return app(config('bootstrap-components.components.validate'));
    }

    protected function getHelper(): ComponentAbstract
    {
        return submitValidate();
    }

    protected function getFacade(): ComponentAbstract
    {
        return SubmitValidate::getFacadeRoot();
    }

    protected function getComponentType(): string
    {
        return 'submit';
    }

    public function getComponentKey(): string
    {
        return 'validate';
    }

    protected function getCustomComponent(): ComponentAbstract
    {
        return (new CustomSubmit());
    }
}
