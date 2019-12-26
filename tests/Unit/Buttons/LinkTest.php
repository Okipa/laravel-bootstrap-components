<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Buttons;

use Okipa\LaravelBootstrapComponents\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Facades\ButtonLink;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomButton;
use Okipa\LaravelBootstrapComponents\Tests\Unit\Buttons\Abstracts\ButtonTestAbstract;

class LinkTest extends ButtonTestAbstract
{
    public function getComponentKey(): string
    {
        return 'link';
    }

    protected function getComponent(): ComponentAbstract
    {
        return app(config('bootstrap-components.components.link'));
    }

    protected function getHelper(): ComponentAbstract
    {
        return buttonLink();
    }

    protected function getFacade(): ComponentAbstract
    {
        return ButtonLink::getFacadeRoot();
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
