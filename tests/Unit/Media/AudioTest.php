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
        $this->assertTrue(array_key_exists('html_attributes', config('bootstrap-components.media.audio')));
        // components.media.audio.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.media.audio.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.media.audio.class')));
        // components.media.audio.html_attributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.media.audio.html_attributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.media.audio.html_attributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Media::class, get_parent_class(audio()));
    }

    public function testSetSrc()
    {
        $customSrc = 'test-custom-src';
        $html = audio()->src($customSrc)->toHtml();
        $this->assertContains('<source src="' . $customSrc . '">', $html);
    }

    public function testNoSrc()
    {
        $html = audio()->toHtml();
        $this->assertNotContains('<source src="', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.media.audio.class.container', [$configContainerCLass]);
        $html = audio()->toHtml();
        $this->assertContains('<div class="audio-container ' . $configContainerCLass . '"', $html);
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.media.audio.class.container', [$configContainerCLass]);
        $html = audio()->containerClass([$customContainerCLass])->toHtml();
        $this->assertContains('<div class="audio-container ' . $customContainerCLass . '"', $html);
        $this->assertNotContains('<div class="audio-container ' . $configContainerCLass . '"', $html);
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.media.audio.class.component', [$configComponentCLass]);
        $html = audio()->toHtml();
        $this->assertContains('class="audio-component ' . $configComponentCLass . '"', $html);
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.media.audio.class.component', [$customComponentCLass]);
        $html = audio()->componentClass([$customComponentCLass])->toHtml();
        $this->assertContains('class="audio-component ' . $customComponentCLass . '"', $html);
        $this->assertNotContains('class="audio-component ' . $configComponentCLass . '"', $html);
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.media.audio.html_attributes.container', [$configContainerAttributes]);
        $html = audio()->toHtml();
        $this->assertContains($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.media.audio.html_attributes.container', [$configContainerAttributes]);
        $html = audio()->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertContains($customContainerAttributes, $html);
        $this->assertNotContains($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.media.audio.html_attributes.component', [$configComponentAttributes]);
        $html = audio()->toHtml();
        $this->assertContains($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.media.audio.html_attributes.component', [$configComponentAttributes]);
        $html = audio()->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertContains($customComponentAttributes, $html);
        $this->assertNotContains($configComponentAttributes, $html);
    }
}
