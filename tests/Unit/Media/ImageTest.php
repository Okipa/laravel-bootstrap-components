<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Media;

use Okipa\LaravelBootstrapComponents\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Facades\Image;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\CustomComponents\CustomImage;
use Okipa\LaravelBootstrapComponents\Tests\Unit\Media\Abstracts\MediaTestAbstract;

class ImageTest extends MediaTestAbstract
{
    protected function getComponent(): ComponentAbstract
    {
        return app(config('bootstrap-components.components.image'));
    }

    protected function getHelper(): ComponentAbstract
    {
        return image();
    }

    protected function getFacade(): ComponentAbstract
    {
        return Image::getFacadeRoot();
    }

    protected function getComponentType(): string
    {
        return 'image';
    }

    protected function getCustomComponent(): ComponentAbstract
    {
        return (new CustomImage);
    }
}
