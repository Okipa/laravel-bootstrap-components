<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Button;

use Okipa\LaravelBootstrapComponents\Button\Button;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\RoutesFaker;

class CancelTest extends BootstrapComponentsTestCase
{
    use RoutesFaker;

    public function testConfigStructure()
    {
        // components.button
        $this->assertTrue(array_key_exists('cancel', config('bootstrap-components.button')));
        // components.button.cancel
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.button.cancel')));
        $this->assertTrue(array_key_exists('prepend', config('bootstrap-components.button.cancel')));
        $this->assertTrue(array_key_exists('append', config('bootstrap-components.button.cancel')));
        $this->assertTrue(array_key_exists('label', config('bootstrap-components.button.cancel')));
        $this->assertTrue(array_key_exists('classes', config('bootstrap-components.button.cancel')));
        $this->assertTrue(array_key_exists('htmlAttributes', config('bootstrap-components.button.cancel')));
        // components.cancel.classes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.button.cancel.classes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.button.cancel.classes')));
        // components.cancel.htmlAttributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.button.cancel.htmlAttributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.button.cancel.htmlAttributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Button::class, get_parent_class(bsCancel()));
    }

    public function testType()
    {
        $html = bsCancel()->toHtml();
        $this->assertStringContainsString('class="button-container', $html);
        $this->assertStringContainsString('href="http://localhost"', $html);
        $this->assertStringContainsString('class="button-component', $html);
    }

    public function testSetUrl()
    {
        $customUrl = 'test-custom-url';
        $html = bsCancel()->url($customUrl)->toHtml();
        $this->assertStringContainsString('href="' . $customUrl . '"', $html);
    }

    public function testSetRoute()
    {
        $this->setRoutes();
        $customRoute = 'users.index';
        $html = bsCancel()->route($customRoute)->toHtml();
        $this->assertStringContainsString('href="' . route($customRoute) . '"', $html);
    }

    public function testConfigPrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.button.cancel.prepend', $configPrepend);
        $html = bsCancel()->toHtml();
        $this->assertStringContainsString('<span class="label-prepend">' . $configPrepend . '</span>', $html);
    }

    public function testSetPrepend()
    {
        $configPrepend = 'test-config-prepend';
        $customPrepend = 'test-custom-prepend';
        config()->set('bootstrap-components.button.cancel.prepend', $configPrepend);
        $html = bsCancel()->prepend($customPrepend)->toHtml();
        $this->assertStringContainsString('<span class="label-prepend">' . $customPrepend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="label-prepend">' . $configPrepend . '</span>', $html);
    }

    public function testNoPrepend()
    {
        config()->set('bootstrap-components.button.cancel.prepend', null);
        $html = bsCancel()->toHtml();
        $this->assertStringNotContainsString('label-prepend', $html);
    }

    public function testHidePrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.button.cancel.prepend', $configPrepend);
        $html = bsCancel()->prepend(false)->toHtml();
        $this->assertStringNotContainsString('label-prepend', $html);
    }

    public function testConfigAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.button.cancel.append', $configAppend);
        $html = bsCancel()->toHtml();
        $this->assertStringContainsString('<span class="label-append">' . $configAppend . '</span>', $html);
    }

    public function testSetAppend()
    {
        $configAppend = 'test-config-append';
        $customAppend = 'test-custom-append';
        config()->set('bootstrap-components.button.cancel.append', $configAppend);
        $html = bsCancel()->append($customAppend)->toHtml();
        $this->assertStringContainsString('<span class="label-append">' . $customAppend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="label-append">' . $configAppend . '</span>', $html);
    }

    public function testNoAppend()
    {
        config()->set('bootstrap-components.button.cancel.append', null);
        $html = bsCancel()->toHtml();
        $this->assertStringNotContainsString('label-append', $html);
    }

    public function testHideAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.button.cancel.append', $configAppend);
        $html = bsCancel()->append(false)->toHtml();
        $this->assertStringNotContainsString('label-append', $html);
    }

    public function testNoPrependNoAppend()
    {
        config()->set('bootstrap-components.button.cancel.prepend', null);
        config()->set('bootstrap-components.button.cancel.append', null);
        $html = bsCancel()->toHtml();
        $this->assertStringNotContainsString('label-prepend', $html);
        $this->assertStringNotContainsString('label-append', $html);
    }

    public function testHidePrependHideAppend()
    {
        $configPrepend = 'test-config-prepend';
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.button.cancel.prepend', $configPrepend);
        config()->set('bootstrap-components.button.cancel.append', $configAppend);
        $html = bsCancel()->prepend(false)->append(false)->toHtml();
        $this->assertStringNotContainsString('label-prepend', $html);
        $this->assertStringNotContainsString('label-append', $html);
    }

    public function testConfigLabel()
    {
        $configLabel = 'test-config-label';
        config()->set('bootstrap-components.button.cancel.label', $configLabel);
        $html = bsCancel()->toHtml();
        $this->assertStringContainsString('title="bootstrap-components::' . $configLabel . '">', $html);
        $this->assertStringContainsString(
            '<span class="label">bootstrap-components::' . $configLabel . '</span>',
            $html
        );
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsCancel()->label($label)->toHtml();
        $this->assertStringContainsString('<span class="label">' . $label . '</span>', $html);
    }

    public function testNoLabel()
    {
        config()->set('bootstrap-components.button.cancel.label', null);
        $html = bsCancel()->toHtml();
        $this->assertStringNotContainsString('<span class="label">', $html);
        $this->assertStringNotContainsString('title="', $html);
        $this->assertStringNotContainsString('<span class="label">', $html);
    }

    public function testHideLabel()
    {
        $configLabel = 'test-config-label';
        config()->set('bootstrap-components.button.cancel.label', $configLabel);
        $html = bsCancel()->label(false)->toHtml();
        $this->assertStringNotContainsString('title="bootstrap-components::' . $configLabel . '">', $html);
        $this->assertStringNotContainsString(
            '<span class="label">bootstrap-components::' . $configLabel . '</span>',
            $html
        );
    }

    public function testSetNoContainerId()
    {
        $html = bsCancel()->toHtml();
        $this->assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = bsCancel()->containerId($customContainerId)->toHtml();
        $this->assertStringContainsString('<div id="' . $customContainerId . '"', $html);
    }

    public function testSetNoComponentId()
    {
        $html = bsCancel()->toHtml();
        $this->assertStringNotContainsString('<a id="', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = bsCancel()->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString('<a id="' . $customComponentId . '"', $html);
    }

    public function testConfigContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        config()->set('bootstrap-components.button.cancel.classes.container', [$configContainerClasses]);
        $html = bsCancel()->toHtml();
        $this->assertStringContainsString('class="button-container ' . $configContainerClasses . '">', $html);
    }

    public function testSetContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        $customContainerClasses = 'test-custom-class-container';
        config()->set('bootstrap-components.input.classes.container', [$configContainerClasses]);
        $html = bsCancel()->containerClasses([$customContainerClasses])->toHtml();
        $this->assertStringContainsString('class="button-container ' . $customContainerClasses . '">', $html);
        $this->assertStringNotContainsString('class="button-container ' . $configContainerClasses . '">', $html);
    }

    public function testConfigComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        config()->set('bootstrap-components.button.cancel.classes.component', [$configComponentClasses]);
        $html = bsCancel()->toHtml();
        $this->assertStringContainsString('class="button-component ' . $configComponentClasses . '"', $html);
    }

    public function testSetComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        $customComponentClasses = 'test-custom-class-component';
        config()->set('bootstrap-components.button.cancel.classes.component', [$customComponentClasses]);
        $html = bsCancel()->componentClasses([$customComponentClasses])->toHtml();
        $this->assertStringContainsString('class="button-component ' . $customComponentClasses . '"', $html);
        $this->assertStringNotContainsString('class="button-component ' . $configComponentClasses . '"', $html);
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.button.cancel.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsCancel()->toHtml();
        $this->assertStringContainsString($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.button.cancel.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsCancel()->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertStringContainsString($customContainerAttributes, $html);
        $this->assertStringNotContainsString($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.button.cancel.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsCancel()->toHtml();
        $this->assertStringContainsString($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.button.cancel.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsCancel()->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertStringContainsString($customComponentAttributes, $html);
        $this->assertStringNotContainsString($configComponentAttributes, $html);
    }
}
