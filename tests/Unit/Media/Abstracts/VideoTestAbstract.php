<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Media\Abstracts;

use Okipa\LaravelBootstrapComponents\Components\Media\Abstracts\VideoAbstract;

abstract class VideoTestAbstract extends MediaTestAbstract
{
    public function it_can_return_instance_from_helper(): void
    {
        self::assertInstanceOf(VideoAbstract::class, $this->getHelper());
    }

    public function it_can_return_instance_from_facade(): void
    {
        self::assertInstanceOf(VideoAbstract::class, $this->getFacade());
    }

    public function it_can_return_instance_from_extended_testing_class(): void
    {
        self::assertInstanceOf(VideoAbstract::class, $this->getComponent());
    }

    public function testDefaultPoster(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = video()->toHtml();
        self::assertStringContainsString('poster="default-poster"', $html);
    }

    public function testSetPosterReplacesDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = video()->poster('custom-poster')->toHtml();
        self::assertStringContainsString('poster="custom-poster"', $html);
        self::assertStringNotContainsString('poster="default-poster"', $html);
    }

    public function testNoPoster(): void
    {
        $html = video()->toHtml();
        self::assertStringNotContainsString('poster="', $html);
    }

    public function it_has_no_component_id_by_default(): void
    {
        $html = $this->getComponent()->toHtml();
        self::assertStringNotContainsString('<video id="', $html);
    }

    public function it_can_set_component_id(): void
    {
        $html = $this->getComponent()->componentId('custom-component-id')->toHtml();
        self::assertStringContainsString('<video id="custom-component-id"', $html);
    }
}
