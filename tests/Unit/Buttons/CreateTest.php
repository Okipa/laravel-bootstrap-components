<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Buttons;

use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Facades\SubmitCreate;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomSubmit;
use Okipa\LaravelBootstrapComponents\Tests\Unit\Buttons\Abstracts\SubmitTestAbstract;

class CreateTest extends SubmitTestAbstract
{
    public function getComponentKey(): string
    {
        return 'create';
    }

    protected function getComponent(): ComponentAbstract
    {
        return app(config('bootstrap-components.components.create'));
    }

    protected function getHelper(): ComponentAbstract
    {
        return submitCreate();
    }

    protected function getFacade(): ComponentAbstract
    {
        return SubmitCreate::getFacadeRoot();
    }

    protected function getComponentType(): string
    {
        return 'submit';
    }

    protected function getCustomComponent(): ComponentAbstract
    {
        return (new CustomSubmit);
    }
}
