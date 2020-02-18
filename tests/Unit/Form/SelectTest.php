<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Facades\Select;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomSelect;
use Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts\SelectTestAbstract;

class SelectTest extends SelectTestAbstract
{

    protected function getComponent(): ComponentAbstract
    {
        return app(config('bootstrap-components.components.select'));
    }

    protected function getHelper(): ComponentAbstract
    {
        return select();
    }

    protected function getFacade(): ComponentAbstract
    {
        return Select::getFacadeRoot();
    }

    protected function getComponentType(): string
    {
        return 'select';
    }

    protected function getCustomComponent(): ComponentAbstract
    {
        return (new CustomSelect);
    }
}
