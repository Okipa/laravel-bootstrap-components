<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Buttons;

use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Facades\ButtonBack;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomButton;
use Okipa\LaravelBootstrapComponents\Tests\Unit\Buttons\Abstracts\ButtonTestAbstract;

class BackTest extends ButtonTestAbstract
{
    protected function getComponent(): ComponentAbstract
    {
        return app(config('bootstrap-components.components.back'));
    }

    protected function getHelper(): ComponentAbstract
    {
        return buttonBack();
    }

    protected function getFacade(): ComponentAbstract
    {
        return ButtonBack::getFacadeRoot();
    }

    protected function getComponentType(): string
    {
        return 'button';
    }

    public function getComponentKey(): string
    {
        return 'back';
    }

    protected function getCustomComponent(): ComponentAbstract
    {
        return (new CustomButton());
    }
}
