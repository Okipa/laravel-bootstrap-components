<?php

namespace Okipa\LaravelBootstrapComponents\Test\Unit\Media;

use Okipa\LaravelBootstrapComponents\Media\Media;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;

class AudioTest extends BootstrapComponentsTestCase
{
    public function testConfigStructure()
    {
        // components.media
        $this->assertTrue(array_key_exists('audio', config('bootstrap-components.media')));
        // components.media.audio
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.media.audio')));
        $this->assertTrue(array_key_exists('class', config('bootstrap-components.media.audio')));
        $this->assertTrue(array_key_exists('htmlAttributes', config('bootstrap-components.media.audio')));
        // components.media.audio.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.media.audio.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.media.audio.class')));
        // components.media.audio.htmlAttributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.media.audio.htmlAttributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.media.audio.htmlAttributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Media::class, get_parent_class(audio()));
    }

    public function testSetSrc()
    {
        $customSrc = 'test-custom-src';
        $html = audio()->src($customSrc)->toHtml();
        $this->assertStringContainsString('<source src="' . $customSrc . '">', $html);
    }

    public function testNoSrc()
    {
        $html = audio()->toHtml();
        $this->assertStringNotContainsString('<source src="', $html);
    }

    public function testSetNoContainerId()
    {
        $html = audio()->toHtml();
        $this->assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = audio()->containerId($customContainerId)->toHtml();
        $this->assertStringContainsString('<div id="' . $customContainerId, $html);
    }

    public function testSetNoComponentId()
    {
        $html = audio()->toHtml();
        $this->assertStringNotContainsString('<audio id="', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = audio()->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString('<audio id="' . $customComponentId . '"', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.media.audio.class.container', [$configContainerCLass]);
        $html = audio()->toHtml();
        $this->assertStringContainsString('class="audio-container ' . $configContainerCLass . '"', $html);
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.media.audio.class.container', [$configContainerCLass]);
        $html = audio()->containerClass([$customContainerCLass])->toHtml();
        $this->assertStringContainsString('class="audio-container ' . $customContainerCLass . '"', $html);
        $this->assertStringNotContainsString('class="audio-container ' . $configContainerCLass . '"', $html);
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.media.audio.class.component', [$configComponentCLass]);
        $html = audio()->toHtml();
        $this->assertStringContainsString('class="audio-component ' . $configComponentCLass . '"', $html);
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.media.audio.class.component', [$customComponentCLass]);
        $html = audio()->componentClass([$customComponentCLass])->toHtml();
        $this->assertStringContainsString('class="audio-component ' . $customComponentCLass . '"', $html);
        $this->assertStringNotContainsString('class="audio-component ' . $configComponentCLass . '"', $html);
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.media.audio.htmlAttributes.container', [$configContainerAttributes]);
        $html = audio()->toHtml();
        $this->assertStringContainsString($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.media.audio.htmlAttributes.container', [$configContainerAttributes]);
        $html = audio()->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertStringContainsString($customContainerAttributes, $html);
        $this->assertStringNotContainsString($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.media.audio.htmlAttributes.component', [$configComponentAttributes]);
        $html = audio()->toHtml();
        $this->assertStringContainsString($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.media.audio.htmlAttributes.component', [$configComponentAttributes]);
        $html = audio()->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertStringContainsString($customComponentAttributes, $html);
        $this->assertStringNotContainsString($configComponentAttributes, $html);
    }
}
