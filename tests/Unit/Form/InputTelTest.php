<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Facades\InputTel;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomTel;
use Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts\InputTestAbstract;

class InputTelTest extends InputTestAbstract
{
    protected function getComponent(): ComponentAbstract
    {
        return app(config('bootstrap-components.form.components.tel'));
    }

    protected function getHelper(): ComponentAbstract
    {
        return inputTel();
    }

    protected function getFacade()
    {
        return InputTel::getFacadeRoot();
    }

    protected function getCustomComponent(): ComponentAbstract
    {
        return (new CustomTel);
    }

    protected function getComponentType(): string
    {
        return 'tel';
    }
}
