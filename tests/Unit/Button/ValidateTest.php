<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Button;

use Okipa\LaravelBootstrapComponents\Button\Button;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\RoutesFaker;

class bsValidateTest extends BootstrapComponentsTestCase
{
    use RoutesFaker;

    public function testConfigStructure()
    {
        // components.button
        $this->assertTrue(array_key_exists('validate', config('bootstrap-components.button')));
        // components.button.validate
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.button.validate')));
        $this->assertTrue(array_key_exists('icon', config('bootstrap-components.button.validate')));
        $this->assertTrue(array_key_exists('label', config('bootstrap-components.button.validate')));
        $this->assertTrue(array_key_exists('class', config('bootstrap-components.button.validate')));
        $this->assertTrue(array_key_exists('html_attributes', config('bootstrap-components.button.validate')));
        // components.validate.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.button.validate.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.button.validate.class')));
        // components.validate.html_attributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.button.validate.html_attributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.button.validate.html_attributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Button::class, get_parent_class(bsValidate()));
    }

    public function testType()
    {
        $html = bsValidate()->toHtml();
        $this->assertContains('<div class="submit-container', $html);
        $this->assertNotContains('<a href="http://localhost"', $html);
        $this->assertContains('class="submit-component', $html);
    }

    public function testSetUrl()
    {
        $customUrl = 'test-custom-url';
        $html = bsValidate()->url($customUrl)->toHtml();
        $this->assertNotContains('<a href="' . $customUrl . '"', $html);
    }

    public function testSetRoute()
    {
        $this->setRoutes();
        $customRoute = 'users.index';
        $html = bsValidate()->route($customRoute)->toHtml();
        $this->assertNotContains('<a href="' . route($customRoute) . '"', $html);
    }

    public function testConfigIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.button.validate.icon', $configIcon);
        $html = bsValidate()->toHtml();
        $this->assertContains($configIcon, $html);
    }

    public function testSetIcon()
    {
        $configIcon = 'test-config-icon';
        $customIcon = 'test-custom-icon';
        config()->set('bootstrap-components.button.validate.icon', $configIcon);
        $html = bsValidate()->icon($customIcon)->toHtml();
        $this->assertContains('<span class="icon">' . $customIcon . '</span>', $html);
        $this->assertNotContains('<span class="icon">' . $configIcon . '</span>', $html);
    }

    public function testNoIcon()
    {
        config()->set('bootstrap-components.button.validate.icon', null);
        $html = bsValidate()->toHtml();
        $this->assertNotContains('<span class="icon">', $html);
    }

    public function testHideIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.button.validate.icon', $configIcon);
        $html = bsValidate()->hideIcon()->toHtml();
        $this->assertNotContains('<span class="icon">' . $configIcon . '</span>', $html);
    }

    public function testConfigLabel()
    {
        $configLabel = 'test-config-label';
        config()->set('bootstrap-components.button.validate.label', $configLabel);
        $html = bsValidate()->toHtml();
        $this->assertContains('title="bootstrap-components::' . $configLabel . '">', $html);
        $this->assertContains('<span class="label">bootstrap-components::' . $configLabel . '</span>', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsValidate()->label($label)->toHtml();
        $this->assertContains('<span class="label">' . $label . '</span>', $html);
    }

    public function testNoLabel()
    {
        config()->set('bootstrap-components.button.validate.label', null);
        $html = bsValidate()->toHtml();
        $this->assertNotContains('<span class="label">', $html);
        $this->assertNotContains('title="', $html);
        $this->assertNotContains('<span class="label">', $html);
    }

    public function testHideLabel()
    {
        $configLabel = 'test-config-label';
        config()->set('bootstrap-components.button.validate.label', $configLabel);
        $html = bsValidate()->hideLabel()->toHtml();
        $this->assertNotContains('title="bootstrap-components::' . $configLabel . '">', $html);
        $this->assertNotContains('<span class="label">bootstrap-components::' . $configLabel . '</span>', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.button.validate.class.container', [$configContainerCLass]);
        $html = bsValidate()->toHtml();
        $this->assertContains('<div class="submit-container ' . $configContainerCLass . '">', $html);
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.input.class.container', [$configContainerCLass]);
        $html = bsValidate()->containerClass([$customContainerCLass])->toHtml();
        $this->assertContains('<div class="submit-container ' . $customContainerCLass . '">', $html);
        $this->assertNotContains('<div class="submit-container ' . $configContainerCLass . '">', $html);
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.button.validate.class.component', [$configComponentCLass]);
        $html = bsValidate()->toHtml();
        $this->assertContains('class="submit-component ' . $configComponentCLass . '"', $html);
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.button.validate.class.component', [$customComponentCLass]);
        $html = bsValidate()->componentClass([$customComponentCLass])->toHtml();
        $this->assertContains('class="submit-component ' . $customComponentCLass . '"', $html);
        $this->assertNotContains('class="submit-component ' . $configComponentCLass . '"', $html);
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.button.validate.html_attributes.container', [$configContainerAttributes]);
        $html = bsValidate()->toHtml();
        $this->assertContains($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.button.validate.html_attributes.container', [$configContainerAttributes]);
        $html = bsValidate()->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertContains($customContainerAttributes, $html);
        $this->assertNotContains($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.button.validate.html_attributes.component', [$configComponentAttributes]);
        $html = bsValidate()->toHtml();
        $this->assertContains($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.button.validate.html_attributes.component', [$configComponentAttributes]);
        $html = bsValidate()->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertContains($customComponentAttributes, $html);
        $this->assertNotContains($configComponentAttributes, $html);
    }
}
