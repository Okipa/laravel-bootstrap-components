<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Button;

use Okipa\LaravelBootstrapComponents\Button\Button;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\RoutesFaker;

class ValidateTest extends BootstrapComponentsTestCase
{
    use RoutesFaker;

    public function testConfigStructure()
    {
        // components.button
        $this->assertTrue(array_key_exists('validate', config('bootstrap-components.button')));
        // components.button.validate
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.button.validate')));
        $this->assertTrue(array_key_exists('prepend', config('bootstrap-components.button.cancel')));
        $this->assertTrue(array_key_exists('append', config('bootstrap-components.button.cancel')));
        $this->assertTrue(array_key_exists('label', config('bootstrap-components.button.validate')));
        $this->assertTrue(array_key_exists('classes', config('bootstrap-components.button.validate')));
        $this->assertTrue(array_key_exists('htmlAttributes', config('bootstrap-components.button.validate')));
        // components.validate.classes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.button.validate.classes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.button.validate.classes')));
        // components.validate.htmlAttributes
        $this->assertTrue(array_key_exists(
            'container',
            config('bootstrap-components.button.validate.htmlAttributes')
        ));
        $this->assertTrue(array_key_exists(
            'component',
            config('bootstrap-components.button.validate.htmlAttributes')
        ));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Button::class, get_parent_class(bsValidate()));
    }

    public function testType()
    {
        $html = bsValidate()->toHtml();
        $this->assertStringContainsString('class="submit-container', $html);
        $this->assertStringNotContainsString('href="http://localhost"', $html);
        $this->assertStringContainsString('class="submit-component', $html);
    }

    public function testSetUrl()
    {
        $customUrl = 'test-custom-url';
        $html = bsValidate()->url($customUrl)->toHtml();
        $this->assertStringNotContainsString('href="' . $customUrl . '"', $html);
    }

    public function testSetRoute()
    {
        $this->setRoutes();
        $customRoute = 'users.index';
        $html = bsValidate()->route($customRoute)->toHtml();
        $this->assertStringNotContainsString('href="' . route($customRoute) . '"', $html);
    }

    public function testConfigPrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.button.validate.prepend', $configPrepend);
        $html = bsValidate()->toHtml();
        $this->assertStringContainsString('<span class="label-prepend">' . $configPrepend . '</span>', $html);
    }

    public function testSetPrepend()
    {
        $configPrepend = 'test-config-prepend';
        $customPrepend = 'test-custom-prepend';
        config()->set('bootstrap-components.button.validate.prepend', $configPrepend);
        $html = bsValidate()->prepend($customPrepend)->toHtml();
        $this->assertStringContainsString('<span class="label-prepend">' . $customPrepend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="label-prepend">' . $configPrepend . '</span>', $html);
    }

    public function testNoPrepend()
    {
        config()->set('bootstrap-components.button.validate.prepend', null);
        $html = bsValidate()->toHtml();
        $this->assertStringNotContainsString('label-prepend', $html);
    }

    public function testHidePrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.button.validate.prepend', $configPrepend);
        $html = bsValidate()->prepend(false)->toHtml();
        $this->assertStringNotContainsString('label-prepend', $html);
    }

    public function testConfigAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.button.validate.append', $configAppend);
        $html = bsValidate()->toHtml();
        $this->assertStringContainsString('<span class="label-append">' . $configAppend . '</span>', $html);
    }

    public function testSetAppend()
    {
        $configAppend = 'test-config-append';
        $customAppend = 'test-custom-append';
        config()->set('bootstrap-components.button.validate.append', $configAppend);
        $html = bsValidate()->append($customAppend)->toHtml();
        $this->assertStringContainsString('<span class="label-append">' . $customAppend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="label-append">' . $configAppend . '</span>', $html);
    }

    public function testNoAppend()
    {
        config()->set('bootstrap-components.button.validate.append', null);
        $html = bsValidate()->toHtml();
        $this->assertStringNotContainsString('label-append', $html);
    }

    public function testHideAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.button.validate.append', $configAppend);
        $html = bsValidate()->append(false)->toHtml();
        $this->assertStringNotContainsString('label-append', $html);
    }

    public function testNoPrependNoAppend()
    {
        config()->set('bootstrap-components.button.validate.prepend', null);
        config()->set('bootstrap-components.button.validate.append', null);
        $html = bsValidate()->toHtml();
        $this->assertStringNotContainsString('label-prepend', $html);
        $this->assertStringNotContainsString('label-append', $html);
    }

    public function testHidePrependHideAppend()
    {
        $configPrepend = 'test-config-prepend';
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.button.validate.prepend', $configPrepend);
        config()->set('bootstrap-components.button.validate.append', $configAppend);
        $html = bsValidate()->prepend(false)->append(false)->toHtml();
        $this->assertStringNotContainsString('label-prepend', $html);
        $this->assertStringNotContainsString('label-append', $html);
    }

    public function testConfigLabel()
    {
        $configLabel = 'test-config-label';
        config()->set('bootstrap-components.button.validate.label', $configLabel);
        $html = bsValidate()->toHtml();
        $this->assertStringContainsString('title="' . $configLabel . '">', $html);
        $this->assertStringContainsString(
            '<span class="label">' . $configLabel . '</span>',
            $html
        );
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsValidate()->label($label)->toHtml();
        $this->assertStringContainsString('<span class="label">' . $label . '</span>', $html);
    }

    public function testSetTranslatedLabel()
    {
        $label = 'bootstrap-components::bootstrap-components.label.validate';
        $html = bsValidate()->label($label)->toHtml();
        $this->assertStringContainsString('<span class="label">' . __($label) . '</span>', $html);
    }

    public function testNoLabel()
    {
        config()->set('bootstrap-components.button.validate.label', null);
        $html = bsValidate()->toHtml();
        $this->assertStringNotContainsString('<span class="label">', $html);
        $this->assertStringNotContainsString('title="', $html);
        $this->assertStringNotContainsString('<span class="label">', $html);
    }

    public function testHideLabel()
    {
        $configLabel = 'test-config-label';
        config()->set('bootstrap-components.button.validate.label', $configLabel);
        $html = bsValidate()->label(false)->toHtml();
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
        $html = bsValidate()->toHtml();
        $this->assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = bsValidate()->containerId($customContainerId)->toHtml();
        $this->assertStringContainsString('<div id="' . $customContainerId . '"', $html);
    }

    public function testSetNoComponentId()
    {
        $html = bsValidate()->toHtml();
        $this->assertStringNotContainsString('<button id="', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = bsValidate()->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString('<button id="' . $customComponentId . '"', $html);
    }

    public function testConfigContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        config()->set('bootstrap-components.button.validate.classes.container', [$configContainerClasses]);
        $html = bsValidate()->toHtml();
        $this->assertStringContainsString('class="submit-container ' . $configContainerClasses . '">', $html);
    }

    public function testSetContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        $customContainerClasses = 'test-custom-class-container';
        config()->set('bootstrap-components.input.classes.container', [$configContainerClasses]);
        $html = bsValidate()->containerClasses([$customContainerClasses])->toHtml();
        $this->assertStringContainsString('class="submit-container ' . $customContainerClasses . '">', $html);
        $this->assertStringNotContainsString('class="submit-container ' . $configContainerClasses . '">', $html);
    }

    public function testConfigComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        config()->set('bootstrap-components.button.validate.classes.component', [$configComponentClasses]);
        $html = bsValidate()->toHtml();
        $this->assertStringContainsString('class="submit-component ' . $configComponentClasses . '"', $html);
    }

    public function testSetComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        $customComponentClasses = 'test-custom-class-component';
        config()->set('bootstrap-components.button.validate.classes.component', [$customComponentClasses]);
        $html = bsValidate()->componentClasses([$customComponentClasses])->toHtml();
        $this->assertStringContainsString('class="submit-component ' . $customComponentClasses . '"', $html);
        $this->assertStringNotContainsString('class="submit-component ' . $configComponentClasses . '"', $html);
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.button.validate.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsValidate()->toHtml();
        $this->assertStringContainsString($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.button.validate.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsValidate()->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertStringContainsString($customContainerAttributes, $html);
        $this->assertStringNotContainsString($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.button.validate.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsValidate()->toHtml();
        $this->assertStringContainsString($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.button.validate.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsValidate()->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertStringContainsString($customComponentAttributes, $html);
        $this->assertStringNotContainsString($configComponentAttributes, $html);
    }
}
