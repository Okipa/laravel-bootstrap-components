<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Facades\Form;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomForm;
use Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts\FormTestAbstract;

class FormTest extends FormTestAbstract
{
    protected function getComponent(): ComponentAbstract
    {
        return app(config('bootstrap-components.components.form'));
    }

    protected function getHelper(): ComponentAbstract
    {
        return form();
    }

    protected function getFacade(): ComponentAbstract
    {
        return Form::getFacadeRoot();
    }

    protected function getCustomComponent(): ComponentAbstract
    {
        return (new CustomForm());
    }

    protected function getComponentType(): string
    {
        return '';
    }
}
