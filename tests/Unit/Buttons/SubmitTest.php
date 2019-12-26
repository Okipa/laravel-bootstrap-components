<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Buttons;

use Okipa\LaravelBootstrapComponents\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Facades\Submit;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomSubmit;
use Okipa\LaravelBootstrapComponents\Tests\Unit\Buttons\Abstracts\SubmitTestAbstract;

class SubmitTest extends SubmitTestAbstract
{
    protected function getComponent(): ComponentAbstract
    {
        return app(config('bootstrap-components.components.submit'));
    }

    protected function getHelper(): ComponentAbstract
    {
        return submit();
    }

    protected function getFacade(): ComponentAbstract
    {
        return Submit::getFacadeRoot();
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
