<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Exception;
use Illuminate\Support\MessageBag;
use Okipa\LaravelBootstrapComponents\Component;
use Okipa\LaravelBootstrapComponents\Tests\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomEmail;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomFile;
use Okipa\LaravelBootstrapComponents\Tests\Fakers\UsersFaker;

class InputFileTest extends FileTestAbstract
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
