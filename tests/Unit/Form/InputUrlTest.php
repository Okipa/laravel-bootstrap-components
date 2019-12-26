<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Facades\InputUrl;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomUrl;
use Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts\InputTestAbstract;

class InputUrlTest extends InputTestAbstract
{
    protected function getComponent(): ComponentAbstract
    {
        return app(config('bootstrap-components.components.url'));
    }

    protected function getHelper(): ComponentAbstract
    {
        return inputUrl();
    }

    protected function getFacade(): ComponentAbstract
    {
        return InputUrl::getFacadeRoot();
    }

    protected function getCustomComponent(): ComponentAbstract
    {
        return (new CustomUrl);
    }

    protected function getComponentType(): string
    {
        return 'url';
    }
}
