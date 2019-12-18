<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Clickable;

use Okipa\LaravelBootstrapComponents\Button\Button;
use Okipa\LaravelBootstrapComponents\Tests\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Tests\Fakers\RoutesFaker;

class UpdateTest extends BootstrapComponentsTestCase
{
    use RoutesFaker;

    public function testConfigStructure()
    {
        // components.button
        $this->assertTrue(array_key_exists('update', config('bootstrap-components.button')));
        // components.button.update
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.button.update')));
        $this->assertTrue(array_key_exists('prepend', config('bootstrap-components.button.cancel')));
        $this->assertTrue(array_key_exists('append', config('bootstrap-components.button.cancel')));
        $this->assertTrue(array_key_exists('label', config('bootstrap-components.button.update')));
        $this->assertTrue(array_key_exists('classes', config('bootstrap-components.button.update')));
        $this->assertTrue(array_key_exists('htmlAttributes', config('bootstrap-components.button.update')));
        // components.update.classes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.button.update.classes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.button.update.classes')));
        // components.update.htmlAttributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.button.update.htmlAttributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.button.update.htmlAttributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Button::class, get_parent_class(bsUpdate()));
    }

    public function testType()
    {
        $html = bsUpdate()->toHtml();
        $this->assertStringContainsString('class="submit-container', $html);
        $this->assertStringNotContainsString('href="http://localhost"', $html);
        $this->assertStringContainsString('class="submit-component', $html);
    }

    public function testSetUrl()
    {
        $customUrl = 'test-custom-url';
        $html = bsUpdate()->url($customUrl)->toHtml();
        $this->assertStringNotContainsString('href="' . $customUrl . '"', $html);
    }

    public function testSetRoute()
    {
        $this->setRoutes();
        $customRoute = 'users.index';
        $html = bsUpdate()->route($customRoute)->toHtml();
        $this->assertStringNotContainsString('href="' . route($customRoute) . '"', $html);
    }

    public function testConfigPrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.button.update.prepend', $configPrepend);
        $html = bsUpdate()->toHtml();
        $this->assertStringContainsString('<span class="label-prepend">' . $configPrepend . '</span>', $html);
    }

    public function testSetPrepend()
    {
        $configPrepend = 'test-config-prepend';
        $customPrepend = 'test-custom-prepend';
        config()->set('bootstrap-components.button.update.prepend', $configPrepend);
        $html = bsUpdate()->prepend($customPrepend)->toHtml();
        $this->assertStringContainsString('<span class="label-prepend">' . $customPrepend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="label-prepend">' . $configPrepend . '</span>', $html);
    }

    public function testNoPrepend()
    {
        config()->set('bootstrap-components.button.update.prepend', null);
        $html = bsUpdate()->toHtml();
        $this->assertStringNotContainsString('label-prepend', $html);
    }

    public function testHidePrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.button.update.prepend', $configPrepend);
        $html = bsUpdate()->prepend(false)->toHtml();
        $this->assertStringNotContainsString('label-prepend', $html);
    }

    public function testConfigAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.button.update.append', $configAppend);
        $html = bsUpdate()->toHtml();
        $this->assertStringContainsString('<span class="label-append">' . $configAppend . '</span>', $html);
    }

    public function testSetAppend()
    {
        $configAppend = 'test-config-append';
        $customAppend = 'test-custom-append';
        config()->set('bootstrap-components.button.update.append', $configAppend);
        $html = bsUpdate()->append($customAppend)->toHtml();
        $this->assertStringContainsString('<span class="label-append">' . $customAppend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="label-append">' . $configAppend . '</span>', $html);
    }

    public function testNoAppend()
    {
        config()->set('bootstrap-components.button.update.append', null);
        $html = bsUpdate()->toHtml();
        $this->assertStringNotContainsString('label-append', $html);
    }

    public function testHideAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.button.update.append', $configAppend);
        $html = bsUpdate()->append(false)->toHtml();
        $this->assertStringNotContainsString('label-append', $html);
    }

    public function testNoPrependNoAppend()
    {
        config()->set('bootstrap-components.button.update.prepend', null);
        config()->set('bootstrap-components.button.update.append', null);
        $html = bsUpdate()->toHtml();
        $this->assertStringNotContainsString('label-prepend', $html);
        $this->assertStringNotContainsString('label-append', $html);
    }

    public function testHidePrependHideAppend()
    {
        $configPrepend = 'test-config-prepend';
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.button.update.prepend', $configPrepend);
        config()->set('bootstrap-components.button.update.append', $configAppend);
        $html = bsUpdate()->prepend(false)->append(false)->toHtml();
        $this->assertStringNotContainsString('label-prepend', $html);
        $this->assertStringNotContainsString('label-append', $html);
    }

    public function testConfigLabel()
    {
        $configLabel = 'test-config-label';
        config()->set('bootstrap-components.button.update.label', $configLabel);
        $html = bsUpdate()->toHtml();
        $this->assertStringContainsString('title="bootstrap-components::' . $configLabel . '">', $html);
        $this->assertStringContainsString(
            '<span class="label">bootstrap-components::' . $configLabel . '</span>',
            $html
        );
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsUpdate()->label($label)->toHtml();
        $this->assertStringContainsString('<span class="label">' . $label . '</span>', $html);
    }

    public function testSetTranslatedLabel()
    {
        $label = 'bootstrap-components::bootstrap-components.label.validate';
        $html = bsUpdate()->label($label)->toHtml();
        $this->assertStringContainsString('<span class="label">' . __($label) . '</span>', $html);
        $this->assertStringContainsString('title="' . __($label) . '"', $html);
    }

    public function testNoLabel()
    {
        config()->set('bootstrap-components.button.update.label', null);
        $html = bsUpdate()->toHtml();
        $this->assertStringNotContainsString('<span class="label">', $html);
        $this->assertStringNotContainsString('title="', $html);
        $this->assertStringNotContainsString('<span class="label">', $html);
    }

    public function testHideLabel()
    {
        $configLabel = 'test-config-label';
        config()->set('bootstrap-components.button.update.label', $configLabel);
        $html = bsUpdate()->label(false)->toHtml();
        $this->assertStringNotContainsString('title="' . $configLabel . '">', $html);
        $this->assertStringNotContainsString(
            '<span class="label">' . $configLabel . '</span>',
            $html
        );
    }

    public function testSetNoContainerId()
    {
        $html = bsUpdate()->toHtml();
        $this->assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = bsUpdate()->containerId($customContainerId)->toHtml();
        $this->assertStringContainsString('<div id="' . $customContainerId . '"', $html);
    }

    public function testSetNoComponentId()
    {
        $html = bsUpdate()->toHtml();
        $this->assertStringNotContainsString('<button id="', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = bsUpdate()->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString('<button id="' . $customComponentId . '"', $html);
    }

    public function testConfigContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        config()->set('bootstrap-components.button.update.classes.container', [$configContainerClasses]);
        $html = bsUpdate()->toHtml();
        $this->assertStringContainsString('class="submit-container ' . $configContainerClasses . '">', $html);
    }

    public function testSetContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        $customContainerClasses = 'test-custom-class-container';
        config()->set('bootstrap-components.input.classes.container', [$configContainerClasses]);
        $html = bsUpdate()->containerClasses([$customContainerClasses])->toHtml();
        $this->assertStringContainsString('class="submit-container ' . $customContainerClasses . '">', $html);
        $this->assertStringNotContainsString('class="submit-container ' . $configContainerClasses . '">', $html);
    }

    public function testConfigComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        config()->set('bootstrap-components.button.update.classes.component', [$configComponentClasses]);
        $html = bsUpdate()->toHtml();
        $this->assertStringContainsString('class="submit-component ' . $configComponentClasses . '"', $html);
    }

    public function testSetComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        $customComponentClasses = 'test-custom-class-component';
        config()->set('bootstrap-components.button.update.classes.component', [$customComponentClasses]);
        $html = bsUpdate()->componentClasses([$customComponentClasses])->toHtml();
        $this->assertStringContainsString('class="submit-component ' . $customComponentClasses . '"', $html);
        $this->assertStringNotContainsString('class="submit-component ' . $configComponentClasses . '"', $html);
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.button.update.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsUpdate()->toHtml();
        $this->assertStringContainsString($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.button.update.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsUpdate()->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertStringContainsString($customContainerAttributes, $html);
        $this->assertStringNotContainsString($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.button.update.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsUpdate()->toHtml();
        $this->assertStringContainsString($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.button.update.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsUpdate()->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertStringContainsString($customComponentAttributes, $html);
        $this->assertStringNotContainsString($configComponentAttributes, $html);
    }
}
