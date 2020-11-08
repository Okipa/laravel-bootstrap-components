<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Clickable;

use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Facades\SubmitUpdate;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomSubmit;
use Okipa\LaravelBootstrapComponents\Tests\Unit\Buttons\Abstracts\SubmitTestAbstract;

class UpdateTest extends SubmitTestAbstract
{
    public function getComponentKey(): string
    {
        return 'update';
    }

    protected function getComponent(): ComponentAbstract
    {
        return app(config('bootstrap-components.components.update'));
    }

    protected function getHelper(): ComponentAbstract
    {
        return submitUpdate();
    }

    protected function getFacade(): ComponentAbstract
    {
        return SubmitUpdate::getFacadeRoot();
    }

    protected function getComponentType(): string
    {
        return 'submit';
    }

    protected function getCustomComponent(): ComponentAbstract
    {
        return (new CustomSubmit());
    }
}
