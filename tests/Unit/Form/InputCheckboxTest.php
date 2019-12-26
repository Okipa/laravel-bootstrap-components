<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Facades\InputCheckbox;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomCheckbox;
use Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts\InputCheckableTestAbstract;

class InputCheckboxTest extends InputCheckableTestAbstract
{
    protected function getComponent(): ComponentAbstract
    {
        return app(config('bootstrap-components.components.checkbox'));
    }

    protected function getHelper(): ComponentAbstract
    {
        return inputCheckbox();
    }

    protected function getFacade(): ComponentAbstract
    {
        return InputCheckbox::getFacadeRoot();
    }

    protected function getComponentType(): string
    {
        return 'checkbox';
    }

    protected function getCustomComponent(): ComponentAbstract
    {
        return (new CustomCheckbox);
    }
}
