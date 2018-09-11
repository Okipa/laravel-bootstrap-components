<?php

namespace Okipa\LaravelBootstrapComponents\Test\Unit\Media;

use Okipa\LaravelBootstrapComponents\Media\Media;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;

class VideoTest extends BootstrapComponentsTestCase
{
    public function testConfigStructure()
    {
        // components
        $this->assertTrue(array_key_exists('video', config('bootstrap-components.media')));
        // components.media.video
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.media.video')));
        $this->assertTrue(array_key_exists('poster', config('bootstrap-components.media.video')));
        $this->assertTrue(array_key_exists('class', config('bootstrap-components.media.video')));
        $this->assertTrue(array_key_exists('html_attributes', config('bootstrap-components.media.video')));
        // components.video.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.media.video.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.media.video.class')));
        // components.video.html_attributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.media.video.html_attributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.media.video.html_attributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Media::class, get_parent_class(video()));
    }

    public function testSetSrc()
    {
        $customSrc = 'test-custom-src';
        $html = video()->src($customSrc)->toHtml();
        $this->assertContains('src="' . $customSrc . '"', $html);
    }

    public function testNoSrc()
    {
        $html = video()->toHtml();
        $this->assertNotContains('src="', $html);
    }

    public function testConfigPoster()
    {
        $configPoster = 'test-config-poster';
        config()->set('bootstrap-components.media.video.poster', $configPoster);
        $html = video()->toHtml();
        $this->assertContains('poster="' . $configPoster . '"', $html);
    }
    
    public function testSetPoster()
    {
        $configPoster = 'test-config-poster';
        $customPoster = 'test-custom-poster';
        config()->set('bootstrap-components.media.video.poster', $configPoster);
        $html = video()->poster($customPoster)->toHtml();
        $this->assertContains('poster="' . $customPoster . '"', $html);
        $this->assertNotContains('poster="' . $configPoster . '"', $html);
    }

    public function testNoPoster()
    {
        $html = video()->toHtml();
        $this->assertNotContains('poster="', $html);
    }

    public function testSetNoContainerId()
    {
        $html = video()->toHtml();
        $this->assertNotContains('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = video()->containerId($customContainerId)->toHtml();
        $this->assertContains('<div id="' . $customContainerId, $html);
    }

    public function testSetNoComponentId()
    {
        $html = video()->toHtml();
        $this->assertNotContains('<video id="', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = video()->componentId($customComponentId)->toHtml();
        $this->assertContains('<video id="' . $customComponentId . '"', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.media.video.class.container', [$configContainerCLass]);
        $html = video()->toHtml();
        $this->assertContains('class="video-container ' . $configContainerCLass . '"', $html);
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.input.class.container', [$configContainerCLass]);
        $html = video()->containerClass([$customContainerCLass])->toHtml();
        $this->assertContains('class="video-container ' . $customContainerCLass . '"', $html);
        $this->assertNotContains('class="video-container ' . $configContainerCLass . '"', $html);
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.media.video.class.component', [$configComponentCLass]);
        $html = video()->toHtml();
        $this->assertContains('class="video-component ' . $configComponentCLass . '"', $html);
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.media.video.class.component', [$customComponentCLass]);
        $html = video()->componentClass([$customComponentCLass])->toHtml();
        $this->assertContains('class="video-component ' . $customComponentCLass . '"', $html);
        $this->assertNotContains('class="video-component ' . $configComponentCLass . '"', $html);
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.media.video.html_attributes.container', [$configContainerAttributes]);
        $html = video()->toHtml();
        $this->assertContains($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.media.video.html_attributes.container', [$configContainerAttributes]);
        $html = video()->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertContains($customContainerAttributes, $html);
        $this->assertNotContains($configContainerAttributes, $html);
    }
    
    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.media.video.html_attributes.component', [$configComponentAttributes]);
        $html = video()->toHtml();
        $this->assertContains($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.media.video.html_attributes.component', [$configComponentAttributes]);
        $html = video()->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertContains($customComponentAttributes, $html);
        $this->assertNotContains($configComponentAttributes, $html);
    }
}
