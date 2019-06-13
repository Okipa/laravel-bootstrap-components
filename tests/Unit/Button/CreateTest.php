<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Button;

use Okipa\LaravelBootstrapComponents\Button\Button;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\RoutesFaker;

class CreateTest extends BootstrapComponentsTestCase
{
    use RoutesFaker;

    public function testConfigStructure()
    {
        // components.button
        $this->assertTrue(array_key_exists('create', config('bootstrap-components.button')));
        // components.button.create
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.button.create')));
        $this->assertTrue(array_key_exists('prepend', config('bootstrap-components.button.cancel')));
        $this->assertTrue(array_key_exists('append', config('bootstrap-components.button.cancel')));
        $this->assertTrue(array_key_exists('label', config('bootstrap-components.button.create')));
        $this->assertTrue(array_key_exists('classes', config('bootstrap-components.button.create')));
        $this->assertTrue(array_key_exists('htmlAttributes', config('bootstrap-components.button.create')));
        // components.create.classes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.button.create.classes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.button.create.classes')));
        // components.create.htmlAttributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.button.create.htmlAttributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.button.create.htmlAttributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Button::class, get_parent_class(bsCreate()));
    }

    public function testType()
    {
        $html = bsCreate()->toHtml();
        $this->assertStringContainsString('class="submit-container', $html);
        $this->assertStringNotContainsString('href="http://localhost"', $html);
        $this->assertStringContainsString('class="submit-component', $html);
    }

    public function testSetUrl()
    {
        $customUrl = 'test-custom-url';
        $html = bsCreate()->url($customUrl)->toHtml();
        $this->assertStringNotContainsString('href="' . $customUrl . '"', $html);
    }

    public function testSetRoute()
    {
        $this->setRoutes();
        $customRoute = 'users.index';
        $html = bsCreate()->route($customRoute)->toHtml();
        $this->assertStringNotContainsString('href="' . route($customRoute) . '"', $html);
    }

    public function testConfigPrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.button.create.prepend', $configPrepend);
        $html = bsCreate()->toHtml();
        $this->assertStringContainsString('<span class="label-prepend">' . $configPrepend . '</span>', $html);
    }

    public function testSetPrepend()
    {
        $configPrepend = 'test-config-prepend';
        $customPrepend = 'test-custom-prepend';
        config()->set('bootstrap-components.button.create.prepend', $configPrepend);
        $html = bsCreate()->prepend($customPrepend)->toHtml();
        $this->assertStringContainsString('<span class="label-prepend">' . $customPrepend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="label-prepend">' . $configPrepend . '</span>', $html);
    }

    public function testNoPrepend()
    {
        config()->set('bootstrap-components.button.create.prepend', null);
        $html = bsCreate()->toHtml();
        $this->assertStringNotContainsString('label-prepend', $html);
    }

    public function testHidePrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.button.create.prepend', $configPrepend);
        $html = bsCreate()->prepend(false)->toHtml();
        $this->assertStringNotContainsString('label-prepend', $html);
    }

    public function testConfigAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.button.create.append', $configAppend);
        $html = bsCreate()->toHtml();
        $this->assertStringContainsString('<span class="label-append">' . $configAppend . '</span>', $html);
    }

    public function testSetAppend()
    {
        $configAppend = 'test-config-append';
        $customAppend = 'test-custom-append';
        config()->set('bootstrap-components.button.create.append', $configAppend);
        $html = bsCreate()->append($customAppend)->toHtml();
        $this->assertStringContainsString('<span class="label-append">' . $customAppend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="label-append">' . $configAppend . '</span>', $html);
    }

    public function testNoAppend()
    {
        config()->set('bootstrap-components.button.create.append', null);
        $html = bsCreate()->toHtml();
        $this->assertStringNotContainsString('label-append', $html);
    }

    public function testHideAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.button.create.append', $configAppend);
        $html = bsCreate()->append(false)->toHtml();
        $this->assertStringNotContainsString('label-append', $html);
    }

    public function testNoPrependNoAppend()
    {
        config()->set('bootstrap-components.button.create.prepend', null);
        config()->set('bootstrap-components.button.create.append', null);
        $html = bsCreate()->toHtml();
        $this->assertStringNotContainsString('label-prepend', $html);
        $this->assertStringNotContainsString('label-append', $html);
    }

    public function testHidePrependHideAppend()
    {
        $configPrepend = 'test-config-prepend';
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.button.create.prepend', $configPrepend);
        config()->set('bootstrap-components.button.create.append', $configAppend);
        $html = bsCreate()->prepend(false)->append(false)->toHtml();
        $this->assertStringNotContainsString('label-prepend', $html);
        $this->assertStringNotContainsString('label-append', $html);
    }

    public function testConfigLabel()
    {
        $configLabel = 'test-config-label';
        config()->set('bootstrap-components.button.create.label', $configLabel);
        $html = bsCreate()->toHtml();
        $this->assertStringContainsString('title="bootstrap-components::' . $configLabel . '">', $html);
        $this->assertStringContainsString(
            '<span class="label">bootstrap-components::' . $configLabel . '</span>',
            $html
        );
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsCreate()->label($label)->toHtml();
        $this->assertStringContainsString('<span class="label">' . $label . '</span>', $html);
    }

    public function testNoLabel()
    {
        config()->set('bootstrap-components.button.create.label', null);
        $html = bsCreate()->toHtml();
        $this->assertStringNotContainsString('<span class="label">', $html);
        $this->assertStringNotContainsString('title="', $html);
        $this->assertStringNotContainsString('<span class="label">', $html);
    }

    public function testHideLabel()
    {
        $configLabel = 'test-config-label';
        config()->set('bootstrap-components.button.create.label', $configLabel);
        $html = bsCreate()->label(false)->toHtml();
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
        $html = bsCreate()->toHtml();
        $this->assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = bsCreate()->containerId($customContainerId)->toHtml();
        $this->assertStringContainsString('<div id="' . $customContainerId . '"', $html);
    }

    public function testSetNoComponentId()
    {
        $html = bsCreate()->toHtml();
        $this->assertStringNotContainsString('<button id="', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = bsCreate()->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString('<button id="' . $customComponentId . '"', $html);
    }

    public function testConfigContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        config()->set('bootstrap-components.button.create.classes.container', [$configContainerClasses]);
        $html = bsCreate()->toHtml();
        $this->assertStringContainsString('class="submit-container ' . $configContainerClasses . '">', $html);
    }

    public function testSetContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        $customContainerClasses = 'test-custom-class-container';
        config()->set('bootstrap-components.input.classes.container', [$configContainerClasses]);
        $html = bsCreate()->containerClasses([$customContainerClasses])->toHtml();
        $this->assertStringContainsString('class="submit-container ' . $customContainerClasses . '">', $html);
        $this->assertStringNotContainsString('class="submit-container ' . $configContainerClasses . '">', $html);
    }

    public function testConfigComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        config()->set('bootstrap-components.button.create.classes.component', [$configComponentClasses]);
        $html = bsCreate()->toHtml();
        $this->assertStringContainsString('class="submit-component ' . $configComponentClasses . '"', $html);
    }

    public function testSetComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        $customComponentClasses = 'test-custom-class-component';
        config()->set('bootstrap-components.button.create.classes.component', [$customComponentClasses]);
        $html = bsCreate()->componentClasses([$customComponentClasses])->toHtml();
        $this->assertStringContainsString('class="submit-component ' . $customComponentClasses . '"', $html);
        $this->assertStringNotContainsString('class="submit-component ' . $configComponentClasses . '"', $html);
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.button.create.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsCreate()->toHtml();
        $this->assertStringContainsString($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.button.create.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsCreate()->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertStringContainsString($customContainerAttributes, $html);
        $this->assertStringNotContainsString($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.button.create.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsCreate()->toHtml();
        $this->assertStringContainsString($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.button.create.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsCreate()->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertStringContainsString($customComponentAttributes, $html);
        $this->assertStringNotContainsString($configComponentAttributes, $html);
    }
}
