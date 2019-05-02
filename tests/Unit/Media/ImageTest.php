<?php

namespace Okipa\LaravelBootstrapComponents\Test\Unit\Media;

use Okipa\LaravelBootstrapComponents\Media\Media;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;

class ImageTest extends BootstrapComponentsTestCase
{
    public function testConfigStructure()
    {
        // components.media
        $this->assertTrue(array_key_exists('image', config('bootstrap-components.media')));
        // components.media.image
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.media.image')));
        $this->assertTrue(array_key_exists('class', config('bootstrap-components.media.image')));
        $this->assertTrue(array_key_exists('html_attributes', config('bootstrap-components.media.image')));
        // components.image.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.media.image.class')));
        $this->assertTrue(array_key_exists('link', config('bootstrap-components.media.image.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.media.image.class')));
        // components.image.html_attributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.media.image.html_attributes')));
        $this->assertTrue(array_key_exists('link', config('bootstrap-components.media.image.html_attributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.media.image.html_attributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Media::class, get_parent_class(image()));
    }

    public function testSetLinkUrl()
    {
        $customLinkUrl = 'test-custom-link-url';
        $html = image()->linkUrl($customLinkUrl)->toHtml();
        $this->assertStringContainsString('href="' . $customLinkUrl . '"', $html);
    }

    public function testNoLinkUrl()
    {
        $html = image()->toHtml();
        $this->assertStringNotContainsString('href="', $html);
    }

    public function testSetSrc()
    {
        $customSrc = 'test-custom-src';
        $html = image()->src($customSrc)->toHtml();
        $this->assertStringContainsString('src="' . $customSrc . '"', $html);
    }

    public function testNoSrc()
    {
        $html = image()->toHtml();
        $this->assertStringNotContainsString('src="', $html);
    }

    public function testSetAlt()
    {
        $customAlt = 'test-custom-alt';
        $html = image()->alt($customAlt)->toHtml();
        $this->assertStringContainsString('alt="' . $customAlt . '"', $html);
    }

    public function testNoAlt()
    {
        $html = image()->toHtml();
        $this->assertStringNotContainsString('alt="', $html);
    }

    public function testSetWidth()
    {
        $customWidth = 100;
        $html = image()->width($customWidth)->toHtml();
        $this->assertStringContainsString('width="' . $customWidth . '"', $html);
    }

    public function testNoWidth()
    {
        $html = image()->toHtml();
        $this->assertStringNotContainsString('width="', $html);
    }

    public function testSetHeight()
    {
        $customHeight = 100;
        $html = image()->height($customHeight)->toHtml();
        $this->assertStringContainsString('height="' . $customHeight . '"', $html);
    }

    public function testNoHeight()
    {
        $html = image()->toHtml();
        $this->assertStringNotContainsString('height="', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.media.image.class.container', [$configContainerCLass]);
        $html = image()->toHtml();
        $this->assertStringContainsString('class="image-container ' . $configContainerCLass . '"', $html);
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.input.class.container', [$configContainerCLass]);
        $html = image()->containerClass([$customContainerCLass])->toHtml();
        $this->assertStringContainsString('class="image-container ' . $customContainerCLass . '"', $html);
        $this->assertStringNotContainsString('class="image-container ' . $configContainerCLass . '"', $html);
    }

    public function testConfigLinkClass()
    {
        $configLinkCLass = 'test-config-class-link';
        config()->set('bootstrap-components.media.image.class.link', [$configLinkCLass]);
        $html = image()->toHtml();
        $this->assertStringContainsString('class="image-link ' . $configLinkCLass . '"', $html);
    }

    public function testSetLinkClass()
    {
        $configLinkCLass = 'test-config-class-link';
        $customLinkCLass = 'test-custom-class-link';
        config()->set('bootstrap-components.media.image.class.link', [$configLinkCLass]);
        $html = image()->linkClass([$customLinkCLass])->toHtml();
        $this->assertStringContainsString('class="image-link ' . $customLinkCLass . '"', $html);
        $this->assertStringNotContainsString('class="image-link ' . $configLinkCLass . '"', $html);
    }

    public function testSetNoContainerId()
    {
        $html = image()->toHtml();
        $this->assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = image()->containerId($customContainerId)->toHtml();
        $this->assertStringContainsString('<div id="' . $customContainerId, $html);
    }

    public function testSetNoLinkId()
    {
        $html = image()->toHtml();
        $this->assertStringNotContainsString('<a id="', $html);
    }

    public function testSetLinkId()
    {
        $customContainerId = 'test-custom-link-id';
        $html = image()->linkId($customContainerId)->toHtml();
        $this->assertStringContainsString('<a id="' . $customContainerId, $html);
    }

    public function testSetNoComponentId()
    {
        $html = image()->toHtml();
        $this->assertStringNotContainsString('<img id="', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = image()->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString('<img id="' . $customComponentId . '"', $html);
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.media.image.class.component', [$configComponentCLass]);
        $html = image()->toHtml();
        $this->assertStringContainsString('class="image-component ' . $configComponentCLass . '"', $html);
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.media.image.class.component', [$customComponentCLass]);
        $html = image()->componentClass([$customComponentCLass])->toHtml();
        $this->assertStringContainsString('class="image-component ' . $customComponentCLass . '"', $html);
        $this->assertStringNotContainsString('class="image-component ' . $configComponentCLass . '"', $html);
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.media.image.html_attributes.container', [$configContainerAttributes]);
        $html = image()->toHtml();
        $this->assertStringContainsString($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.media.image.html_attributes.container', [$configContainerAttributes]);
        $html = image()->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertStringContainsString($customContainerAttributes, $html);
        $this->assertStringNotContainsString($configContainerAttributes, $html);
    }

    public function testConfigLinkHtmlAttributes()
    {
        $configLinkAttributes = 'test-config-attributes-link';
        config()->set('bootstrap-components.media.image.html_attributes.link', [$configLinkAttributes]);
        $html = image()->toHtml();
        $this->assertStringContainsString($configLinkAttributes, $html);
    }

    public function testSetLinkHtmlAttributes()
    {
        $configLinkAttributes = 'test-config-attributes-link';
        $customLinkAttributes = 'test-custom-attributes-link';
        config()->set('bootstrap-components.media.image.html_attributes.link', [$configLinkAttributes]);
        $html = image()->linkHtmlAttributes([$customLinkAttributes])->toHtml();
        $this->assertStringContainsString($customLinkAttributes, $html);
        $this->assertStringNotContainsString($configLinkAttributes, $html);
    }
    
    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.media.image.html_attributes.component', [$configComponentAttributes]);
        $html = image()->toHtml();
        $this->assertStringContainsString($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.media.image.html_attributes.component', [$configComponentAttributes]);
        $html = image()->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertStringContainsString($customComponentAttributes, $html);
        $this->assertStringNotContainsString($configComponentAttributes, $html);
    }
}
