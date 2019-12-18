<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Media;

use Okipa\LaravelBootstrapComponents\Media\Media;
use Okipa\LaravelBootstrapComponents\Tests\BootstrapComponentsTestCase;

class VideoTest extends BootstrapComponentsTestCase
{
    public function testConfigStructure()
    {
        // components
        $this->assertTrue(array_key_exists('video', config('bootstrap-components.media')));
        // components.media.video
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.media.video')));
        $this->assertTrue(array_key_exists('poster', config('bootstrap-components.media.video')));
        $this->assertTrue(array_key_exists('classes', config('bootstrap-components.media.video')));
        $this->assertTrue(array_key_exists('htmlAttributes', config('bootstrap-components.media.video')));
        // components.video.classes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.media.video.classes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.media.video.classes')));
        // components.video.htmlAttributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.media.video.htmlAttributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.media.video.htmlAttributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Media::class, get_parent_class(video()));
    }

    public function testSetSrc()
    {
        $customSrc = 'test-custom-src';
        $html = video()->src($customSrc)->toHtml();
        $this->assertStringContainsString('src="' . $customSrc . '"', $html);
    }

    public function testNoSrc()
    {
        $html = video()->toHtml();
        $this->assertStringNotContainsString('src="', $html);
    }

    public function testConfigPoster()
    {
        $configPoster = 'test-config-poster';
        config()->set('bootstrap-components.media.video.poster', $configPoster);
        $html = video()->toHtml();
        $this->assertStringContainsString('poster="' . $configPoster . '"', $html);
    }

    public function testSetPoster()
    {
        $configPoster = 'test-config-poster';
        $customPoster = 'test-custom-poster';
        config()->set('bootstrap-components.media.video.poster', $configPoster);
        $html = video()->poster($customPoster)->toHtml();
        $this->assertStringContainsString('poster="' . $customPoster . '"', $html);
        $this->assertStringNotContainsString('poster="' . $configPoster . '"', $html);
    }

    public function testNoPoster()
    {
        $html = video()->toHtml();
        $this->assertStringNotContainsString('poster="', $html);
    }

    public function testSetNoContainerId()
    {
        $html = video()->toHtml();
        $this->assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = video()->containerId($customContainerId)->toHtml();
        $this->assertStringContainsString('<div id="' . $customContainerId, $html);
    }

    public function testSetNoComponentId()
    {
        $html = video()->toHtml();
        $this->assertStringNotContainsString('<video id="', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = video()->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString('<video id="' . $customComponentId . '"', $html);
    }

    public function testConfigContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        config()->set('bootstrap-components.media.video.classes.container', [$configContainerClasses]);
        $html = video()->toHtml();
        $this->assertStringContainsString(' class="video-container ' . $configContainerClasses . '"', $html);
    }

    public function testSetContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        $customContainerClasses = 'test-custom-class-container';
        config()->set('bootstrap-components.input.classes.container', [$configContainerClasses]);
        $html = video()->containerClasses([$customContainerClasses])->toHtml();
        $this->assertStringContainsString(' class="video-container ' . $customContainerClasses . '"', $html);
        $this->assertStringNotContainsString(' class="video-container ' . $configContainerClasses . '"', $html);
    }

    public function testConfigComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        config()->set('bootstrap-components.media.video.classes.component', [$configComponentClasses]);
        $html = video()->toHtml();
        $this->assertStringContainsString(' class="video-component ' . $configComponentClasses . '"', $html);
    }

    public function testSetComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        $customComponentClasses = 'test-custom-class-component';
        config()->set('bootstrap-components.media.video.classes.component', [$customComponentClasses]);
        $html = video()->componentClasses([$customComponentClasses])->toHtml();
        $this->assertStringContainsString(' class="video-component ' . $customComponentClasses . '"', $html);
        $this->assertStringNotContainsString(' class="video-component ' . $configComponentClasses . '"', $html);
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.media.video.htmlAttributes.container', [$configContainerAttributes]);
        $html = video()->toHtml();
        $this->assertStringContainsString($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.media.video.htmlAttributes.container', [$configContainerAttributes]);
        $html = video()->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertStringContainsString($customContainerAttributes, $html);
        $this->assertStringNotContainsString($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.media.video.htmlAttributes.component', [$configComponentAttributes]);
        $html = video()->toHtml();
        $this->assertStringContainsString($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.media.video.htmlAttributes.component', [$configComponentAttributes]);
        $html = video()->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertStringContainsString($customComponentAttributes, $html);
        $this->assertStringNotContainsString($configComponentAttributes, $html);
    }
}
