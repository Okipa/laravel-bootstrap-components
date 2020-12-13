<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Media\Abstracts;

abstract class VideoTestAbstract extends MediaTestAbstract
{
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

    public function testDefaultComponentId(): void
    {
        $html = $this->getComponent()->toHtml();
        self::assertStringNotContainsString('<video id="', $html);
    }

    public function testSetComponentId(): void
    {
        $html = $this->getComponent()->componentId('custom-component-id')->toHtml();
        self::assertStringContainsString('<video id="custom-component-id"', $html);
    }
}
