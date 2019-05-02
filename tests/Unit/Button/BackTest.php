<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Button;

use Okipa\LaravelBootstrapComponents\Button\Button;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\RoutesFaker;

class BackTest extends BootstrapComponentsTestCase
{
    use RoutesFaker;

    public function testConfigStructure()
    {
        // components.button
        $this->assertTrue(array_key_exists('back', config('bootstrap-components.button')));
        // components.button.back
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.button.back')));
        $this->assertTrue(array_key_exists('prepend', config('bootstrap-components.button.back')));
        $this->assertTrue(array_key_exists('append', config('bootstrap-components.button.back')));
        $this->assertTrue(array_key_exists('label', config('bootstrap-components.button.back')));
        $this->assertTrue(array_key_exists('class', config('bootstrap-components.button.back')));
        $this->assertTrue(array_key_exists('html_attributes', config('bootstrap-components.button.back')));
        // components.back.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.button.back.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.button.back.class')));
        // components.back.html_attributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.button.back.html_attributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.button.back.html_attributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Button::class, get_parent_class(bsBack()));
    }

    public function testType()
    {
        $html = bsBack()->toHtml();
        $this->assertStringContainsString('class="button-container', $html);
        $this->assertStringContainsString('href="http://localhost"', $html);
        $this->assertStringContainsString('class="button-component', $html);
    }

    public function testSetUrl()
    {
        $customUrl = 'test-custom-url';
        $html = bsBack()->url($customUrl)->toHtml();
        $this->assertStringContainsString('href="' . $customUrl . '"', $html);
    }

    public function testSetRoute()
    {
        $this->setRoutes();
        $customRoute = 'users.index';
        $html = bsBack()->route($customRoute, ['id' => 1])->toHtml();
        $this->assertStringContainsString('href="' . route($customRoute) . '?id=1"', $html);
    }

    public function testConfigPrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.button.back.prepend', $configPrepend);
        $html = bsBack()->toHtml();
        $this->assertStringContainsString('<span class="label-prepend">' . $configPrepend . '</span>', $html);
    }

    public function testSetPrepend()
    {
        $configPrepend = 'test-config-prepend';
        $customPrepend = 'test-custom-prepend';
        config()->set('bootstrap-components.button.back.prepend', $configPrepend);
        $html = bsBack()->prepend($customPrepend)->toHtml();
        $this->assertStringContainsString('<span class="label-prepend">' . $customPrepend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="label-prepend">' . $configPrepend . '</span>', $html);
    }

    public function testNoPrepend()
    {
        config()->set('bootstrap-components.button.back.prepend', null);
        $html = bsBack()->toHtml();
        $this->assertStringNotContainsString('label-prepend', $html);
    }

    public function testHidePrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.button.back.prepend', $configPrepend);
        $html = bsBack()->prepend(false)->toHtml();
        $this->assertStringNotContainsString('label-prepend', $html);
    }

    public function testConfigAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.button.back.append', $configAppend);
        $html = bsBack()->toHtml();
        $this->assertStringContainsString('<span class="label-append">' . $configAppend . '</span>', $html);
    }

    public function testSetAppend()
    {
        $configAppend = 'test-config-append';
        $customAppend = 'test-custom-append';
        config()->set('bootstrap-components.button.back.append', $configAppend);
        $html = bsBack()->append($customAppend)->toHtml();
        $this->assertStringContainsString('<span class="label-append">' . $customAppend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="label-append">' . $configAppend . '</span>', $html);
    }

    public function testNoAppend()
    {
        config()->set('bootstrap-components.button.back.append', null);
        $html = bsBack()->toHtml();
        $this->assertStringNotContainsString('label-append', $html);
    }

    public function testHideAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.button.back.append', $configAppend);
        $html = bsBack()->append(false)->toHtml();
        $this->assertStringNotContainsString('label-append', $html);
    }

    public function testNoPrependNoAppend()
    {
        config()->set('bootstrap-components.button.back.prepend', null);
        config()->set('bootstrap-components.button.back.append', null);
        $html = bsBack()->toHtml();
        $this->assertStringNotContainsString('label-prepend', $html);
        $this->assertStringNotContainsString('label-append', $html);
    }

    public function testHidePrependHideAppend()
    {
        $configPrepend = 'test-config-prepend';
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.button.back.prepend', $configPrepend);
        config()->set('bootstrap-components.button.back.append', $configAppend);
        $html = bsBack()->prepend(false)->append(false)->toHtml();
        $this->assertStringNotContainsString('label-prepend', $html);
        $this->assertStringNotContainsString('label-append', $html);
    }

    public function testConfigLabel()
    {
        $configLabel = 'test-config-label';
        config()->set('bootstrap-components.button.back.label', $configLabel);
        $html = bsBack()->toHtml();
        $this->assertStringContainsString('title="bootstrap-components::' . $configLabel . '">', $html);
        $this->assertStringContainsString(
            '<span class="label">bootstrap-components::' . $configLabel . '</span>',
            $html
        );
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsBack()->label($label)->toHtml();
        $this->assertStringContainsString('<span class="label">' . $label . '</span>', $html);
    }

    public function testNoLabel()
    {
        config()->set('bootstrap-components.button.back.label', null);
        $html = bsBack()->toHtml();
        $this->assertStringNotContainsString('<span class="label">', $html);
        $this->assertStringNotContainsString('title="', $html);
        $this->assertStringNotContainsString('<span class="label">', $html);
    }

    public function testHideLabel()
    {
        $configLabel = 'test-config-label';
        config()->set('bootstrap-components.button.back.label', $configLabel);
        $html = bsBack()->label(false)->toHtml();
        $this->assertStringNotContainsString(
            'title="bootstrap-components::' . $configLabel . '">',
            $html
        );
        $this->assertStringNotContainsString(
            '<span class="label">bootstrap-components::' . $configLabel . '</span>',
            $html
        );
    }

    public function testSetNoContainerId()
    {
        $html = bsBack()->toHtml();
        $this->assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = bsBack()->containerId($customContainerId)->toHtml();
        $this->assertStringContainsString('<div id="' . $customContainerId . '"', $html);
    }

    public function testSetNoComponentId()
    {
        $html = bsBack()->toHtml();
        $this->assertStringNotContainsString('<a id="', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = bsBack()->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString('<a id="' . $customComponentId . '"', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.button.back.class.container', [$configContainerCLass]);
        $html = bsBack()->toHtml();
        $this->assertStringContainsString('class="button-container ' . $configContainerCLass . '">', $html);
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.input.class.container', [$configContainerCLass]);
        $html = bsBack()->containerClass([$customContainerCLass])->toHtml();
        $this->assertStringContainsString('class="button-container ' . $customContainerCLass . '">', $html);
        $this->assertStringNotContainsString('class="button-container ' . $configContainerCLass . '">', $html);
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.button.back.class.component', [$configComponentCLass]);
        $html = bsBack()->toHtml();
        $this->assertStringContainsString('class="button-component ' . $configComponentCLass . '"', $html);
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.button.back.class.component', [$customComponentCLass]);
        $html = bsBack()->componentClass([$customComponentCLass])->toHtml();
        $this->assertStringContainsString('class="button-component ' . $customComponentCLass . '"', $html);
        $this->assertStringNotContainsString('class="button-component ' . $configComponentCLass . '"', $html);
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.button.back.html_attributes.container', [$configContainerAttributes]);
        $html = bsBack()->toHtml();
        $this->assertStringContainsString($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.button.back.html_attributes.container', [$configContainerAttributes]);
        $html = bsBack()->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertStringContainsString($customContainerAttributes, $html);
        $this->assertStringNotContainsString($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.button.back.html_attributes.component', [$configComponentAttributes]);
        $html = bsBack()->toHtml();
        $this->assertStringContainsString($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.button.back.html_attributes.component', [$configComponentAttributes]);
        $html = bsBack()->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertStringContainsString($customComponentAttributes, $html);
        $this->assertStringNotContainsString($configComponentAttributes, $html);
    }
}
