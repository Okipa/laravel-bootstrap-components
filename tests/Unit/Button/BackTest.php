<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Button;

use Okipa\LaravelBootstrapComponents\Button\Button;
use Okipa\LaravelBootstrapComponents\Tests\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Tests\Fakers\RoutesFaker;

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
        $this->assertTrue(array_key_exists('classes', config('bootstrap-components.button.back')));
        $this->assertTrue(array_key_exists('htmlAttributes', config('bootstrap-components.button.back')));
        // components.back.classes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.button.back.classes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.button.back.classes')));
        // components.back.htmlAttributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.button.back.htmlAttributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.button.back.htmlAttributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Button::class, get_parent_class(bsBack()));
    }

    public function testType()
    {
        $html = bsBack()->toHtml();
        $this->assertStringContainsString(' class="button-container', $html);
        $this->assertStringContainsString('href="http://localhost"', $html);
        $this->assertStringContainsString(' class="button-component', $html);
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

    public function testSetTranslatedLabel()
    {
        $label = 'bootstrap-components.label.validate';
        $html = bsBack()->label($label)->toHtml();
        $this->assertStringContainsString('<span class="label">' . __($label) . '</span>', $html);
        $this->assertStringContainsString('title="' . __($label) . '"', $html);
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
            'title="' . $configLabel . '">',
            $html
        );
        $this->assertStringNotContainsString(
            '<span class="label">' . $configLabel . '</span>',
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

    public function testConfigContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        config()->set('bootstrap-components.button.back.classes.container', [$configContainerClasses]);
        $html = bsBack()->toHtml();
        $this->assertStringContainsString(' class="button-container ' . $configContainerClasses . '">', $html);
    }

    public function testSetContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        $customContainerClasses = 'test-custom-class-container';
        config()->set('bootstrap-components.input.classes.container', [$configContainerClasses]);
        $html = bsBack()->containerClasses([$customContainerClasses])->toHtml();
        $this->assertStringContainsString(' class="button-container ' . $customContainerClasses . '">', $html);
        $this->assertStringNotContainsString(' class="button-container ' . $configContainerClasses . '">', $html);
    }

    public function testConfigComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        config()->set('bootstrap-components.button.back.classes.component', [$configComponentClasses]);
        $html = bsBack()->toHtml();
        $this->assertStringContainsString(' class="button-component ' . $configComponentClasses . '"', $html);
    }

    public function testSetComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        $customComponentClasses = 'test-custom-class-component';
        config()->set('bootstrap-components.button.back.classes.component', [$customComponentClasses]);
        $html = bsBack()->componentClasses([$customComponentClasses])->toHtml();
        $this->assertStringContainsString('class="button-component ' . $customComponentClasses . '"', $html);
        $this->assertStringNotContainsString('class="button-component ' . $configComponentClasses . '"', $html);
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.button.back.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsBack()->toHtml();
        $this->assertStringContainsString($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.button.back.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsBack()->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertStringContainsString($customContainerAttributes, $html);
        $this->assertStringNotContainsString($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.button.back.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsBack()->toHtml();
        $this->assertStringContainsString($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.button.back.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsBack()->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertStringContainsString($customComponentAttributes, $html);
        $this->assertStringNotContainsString($configComponentAttributes, $html);
    }
}
