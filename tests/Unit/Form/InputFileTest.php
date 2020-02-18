<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Facades\InputFile;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomFile;
use Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts\InputFileTestAbstract;

class InputFileTest extends InputFileTestAbstract
{
    protected function getComponent(): ComponentAbstract
    {
        return app(config('bootstrap-components.components.file'));
    }

    protected function getHelper(): ComponentAbstract
    {
        return inputFile();
    }

    protected function getFacade(): ComponentAbstract
    {
        return InputFile::getFacadeRoot();
    }

    protected function getCustomComponent(): ComponentAbstract
    {
        return (new CustomFile);
    }

    protected function getComponentType(): string
    {
        return 'file';
    }
}
