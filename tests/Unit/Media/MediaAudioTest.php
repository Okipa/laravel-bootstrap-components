<?php

namespace Okipa\LaravelBootstrapComponents\Test\Unit\Media;

use Okipa\LaravelBootstrapComponents\Media\Media;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;

class MediaAudioTest extends BootstrapComponentsTestCase
{
    public function testConfigStructure()
    {
        // components
        $this->assertTrue(array_key_exists('media_audio', config('bootstrap-components')));
        // components.media_audio
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.media_audio')));
        $this->assertTrue(array_key_exists('class', config('bootstrap-components.media_audio')));
        $this->assertTrue(array_key_exists('html_attributes', config('bootstrap-components.media_audio')));
        // components.media_audio.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.media_audio.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.media_audio.class')));
        // components.media_audio.html_attributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.media_audio.html_attributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.media_audio.html_attributes')));
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
        $this->assertNotContains('<source', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.media_audio.class.container', [$configContainerCLass]);
        $html = audio()->toHtml();
        $this->assertContains('<div class="audio-container ' . $configContainerCLass . '"', $html);
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.media_audio.class.container', [$configContainerCLass]);
        $html = audio()->containerClass([$customContainerCLass])->toHtml();
        $this->assertContains('<div class="audio-container ' . $customContainerCLass . '"', $html);
        $this->assertNotContains('<div class="audio-container ' . $configContainerCLass . '"', $html);
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.media_audio.class.component', [$configComponentCLass]);
        $html = audio()->toHtml();
        $this->assertContains('class="audio-component ' . $configComponentCLass . '"', $html);
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.media_audio.class.component', [$customComponentCLass]);
        $html = audio()->componentClass([$customComponentCLass])->toHtml();
        $this->assertContains('class="audio-component ' . $customComponentCLass . '"', $html);
        $this->assertNotContains('class="audio-component ' . $configComponentCLass . '"', $html);
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.media_audio.html_attributes.container', [$configContainerAttributes]);
        $html = audio()->toHtml();
        $this->assertContains($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.media_audio.html_attributes.container', [$configContainerAttributes]);
        $html = audio()->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertContains($customContainerAttributes, $html);
        $this->assertNotContains($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.media_audio.html_attributes.component', [$configComponentAttributes]);
        $html = audio()->toHtml();
        $this->assertContains($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.media_audio.html_attributes.component', [$configComponentAttributes]);
        $html = audio()->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertContains($customComponentAttributes, $html);
        $this->assertNotContains($configComponentAttributes, $html);
    }
}
