<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Media\Abstracts;

abstract class VideoTestAbstract extends MediaTestAbstract
{
    public function testSetCustomPoster()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = video()->toHtml();
        $this->assertStringContainsString('poster="default-poster"', $html);
    }

    public function testSetPosterOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = video()->poster('custom-poster')->toHtml();
        $this->assertStringContainsString('poster="custom-poster"', $html);
        $this->assertStringNotContainsString('poster="default-poster"', $html);
    }

    public function testNoPoster()
    {
        $html = video()->toHtml();
        $this->assertStringNotContainsString('poster="', $html);
    }

    public function testDefaultComponentId()
    {
        $html = $this->getComponent()->toHtml();
        $this->assertStringNotContainsString('<video id="', $html);
    }

    public function testSetComponentId()
    {
        $html = $this->getComponent()->componentId('custom-component-id')->toHtml();
        $this->assertStringContainsString('<video id="custom-component-id"', $html);
    }
}
