<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Buttons;

use Okipa\LaravelBootstrapComponents\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Facades\Button;
use Okipa\LaravelBootstrapComponents\Facades\Submit;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomButton;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomSubmit;
use Okipa\LaravelBootstrapComponents\Tests\Unit\Buttons\Abstracts\ButtonTestAbstract;
use Okipa\LaravelBootstrapComponents\Tests\Unit\Buttons\Abstracts\SubmitTestAbstract;

class ButtonTest extends ButtonTestAbstract
{
    protected function getComponent(): ComponentAbstract
    {
        return app(config('bootstrap-components.components.button'));
    }

    protected function getHelper(): ComponentAbstract
    {
        return button();
    }

    protected function getFacade(): ComponentAbstract
    {
        return Button::getFacadeRoot();
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
