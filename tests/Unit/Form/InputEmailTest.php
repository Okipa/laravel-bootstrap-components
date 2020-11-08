<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Facades\InputEmail;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomInputEmail;
use Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts\InputTestAbstract;

class InputEmailTest extends InputTestAbstract
{
    protected function getComponent(): ComponentAbstract
    {
        return app(config('bootstrap-components.components.email'));
    }

    protected function getHelper(): ComponentAbstract
    {
        return inputEmail();
    }

    protected function getFacade(): ComponentAbstract
    {
        return InputEmail::getFacadeRoot();
    }

    protected function getCustomComponent(): ComponentAbstract
    {
        return (new CustomInputEmail());
    }

    protected function getComponentType(): string
    {
        return 'email';
    }
}
