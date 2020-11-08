<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Facades\InputPassword;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomPassword;
use Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts\InputTestAbstract;

class InputPasswordTest extends InputTestAbstract
{
    protected function getComponent(): ComponentAbstract
    {
        return app(config('bootstrap-components.components.password'));
    }

    protected function getHelper(): ComponentAbstract
    {
        return inputPassword();
    }

    protected function getFacade(): ComponentAbstract
    {
        return InputPassword::getFacadeRoot();
    }

    protected function getCustomComponent(): ComponentAbstract
    {
        return (new CustomPassword());
    }

    protected function getComponentType(): string
    {
        return 'password';
    }
}
