<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\Component;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomFile;

class InputFileTest extends InputFileTestAbstract
{
    protected function getComponent(): Component
    {
        return input()->file();
    }

    protected function getCustomComponent(): Component
    {
        return (new CustomFile);
    }

    protected function getComponentType(): string
    {
        return 'file';
    }
}
