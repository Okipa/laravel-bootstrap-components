<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Buttons;

use Okipa\LaravelBootstrapComponents\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Facades\ButtonCancel;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomButton;
use Okipa\LaravelBootstrapComponents\Tests\Unit\Buttons\Abstracts\ButtonTestAbstract;

class CancelTest extends ButtonTestAbstract
{
    public function getComponentKey(): string
    {
        return 'cancel';
    }

    protected function getComponent(): ComponentAbstract
    {
        return app(config('bootstrap-components.components.cancel'));
    }

    protected function getHelper(): ComponentAbstract
    {
        return buttonCancel();
    }

    protected function getFacade(): ComponentAbstract
    {
        return ButtonCancel::getFacadeRoot();
    }

    protected function getComponentType(): string
    {
        return 'button';
    }

    protected function getCustomComponent(): ComponentAbstract
    {
        return (new CustomButton);
    }
}
