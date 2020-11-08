<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Facades\Textarea;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomTextarea;
use Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts\TextareaTestAbstract;

class TextareaTest extends TextareaTestAbstract
{
    protected function getComponent(): ComponentAbstract
    {
        return app(config('bootstrap-components.components.textarea'));
    }

    protected function getHelper(): ComponentAbstract
    {
        return textarea();
    }

    protected function getFacade(): ComponentAbstract
    {
        return Textarea::getFacadeRoot();
    }

    protected function getCustomComponent(): ComponentAbstract
    {
        return (new CustomTextarea());
    }

    protected function getComponentType(): string
    {
        return 'textarea';
    }
}
