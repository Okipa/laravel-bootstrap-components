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
        $this->assertTrue(array_key_exists('icon', config('bootstrap-components.button.cancel')));
        $this->assertTrue(array_key_exists('label', config('bootstrap-components.button.cancel')));
        $this->assertTrue(array_key_exists('class', config('bootstrap-components.button.cancel')));
        $this->assertTrue(array_key_exists('html_attributes', config('bootstrap-components.button.cancel')));
        // components.cancel.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.button.cancel.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.button.cancel.class')));
        // components.cancel.html_attributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.button.cancel.html_attributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.button.cancel.html_attributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Button::class, get_parent_class(bsCancel()));
    }

    public function testType()
    {
        $html = bsCancel()->toHtml();
        $this->assertContains('<div class="button-container', $html);
        $this->assertContains('<a href="http://localhost"', $html);
        $this->assertContains('class="button-component', $html);
    }

    public function testSetUrl()
    {
        $customUrl = 'test-custom-url';
        $html = bsCancel()->url($customUrl)->toHtml();
        $this->assertContains('<a href="' . $customUrl . '"', $html);
    }

    public function testSetRoute()
    {
        $this->setRoutes();
        $customRoute = 'users.index';
        $html = bsCancel()->route($customRoute)->toHtml();
        $this->assertContains('<a href="' . route($customRoute) . '"', $html);
    }

    public function testConfigIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.button.cancel.icon', $configIcon);
        $html = bsCancel()->toHtml();
        $this->assertContains($configIcon, $html);
    }

    public function testSetIcon()
    {
        $configIcon = 'test-config-icon';
        $customIcon = 'test-custom-icon';
        config()->set('bootstrap-components.button.cancel.icon', $configIcon);
        $html = bsCancel()->icon($customIcon)->toHtml();
        $this->assertContains('<span class="icon">' . $customIcon . '</span>', $html);
        $this->assertNotContains('<span class="icon">' . $configIcon . '</span>', $html);
    }

    public function testNoIcon()
    {
        config()->set('bootstrap-components.button.cancel.icon', null);
        $html = bsCancel()->toHtml();
        $this->assertNotContains('<span class="icon">', $html);
    }

    public function testHideIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.button.cancel.icon', $configIcon);
        $html = bsCancel()->hideIcon()->toHtml();
        $this->assertNotContains('<span class="icon">' . $configIcon . '</span>', $html);
    }

    public function testConfigLabel()
    {
        $configLabel = 'test-config-label';
        config()->set('bootstrap-components.button.cancel.label', $configLabel);
        $html = bsCancel()->toHtml();
        $this->assertContains('title="bootstrap-components::' . $configLabel . '">', $html);
        $this->assertContains('<span class="label">bootstrap-components::' . $configLabel . '</span>', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsCancel()->label($label)->toHtml();
        $this->assertContains('<span class="label">' . $label . '</span>', $html);
    }

    public function testNoLabel()
    {
        config()->set('bootstrap-components.button.cancel.label', null);
        $html = bsCancel()->toHtml();
        $this->assertNotContains('<span class="label">', $html);
        $this->assertNotContains('title="', $html);
        $this->assertNotContains('<span class="label">', $html);
    }

    public function testHideLabel()
    {
        $configLabel = 'test-config-label';
        config()->set('bootstrap-components.button.cancel.label', $configLabel);
        $html = bsCancel()->hideLabel()->toHtml();
        $this->assertNotContains('title="bootstrap-components::' . $configLabel . '">', $html);
        $this->assertNotContains('<span class="label">bootstrap-components::' . $configLabel . '</span>', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.button.cancel.class.container', [$configContainerCLass]);
        $html = bsCancel()->toHtml();
        $this->assertContains('<div class="button-container ' . $configContainerCLass . '">', $html);
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.input.class.container', [$configContainerCLass]);
        $html = bsCancel()->containerClass([$customContainerCLass])->toHtml();
        $this->assertContains('<div class="button-container ' . $customContainerCLass . '">', $html);
        $this->assertNotContains('<div class="button-container ' . $configContainerCLass . '">', $html);
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.button.cancel.class.component', [$configComponentCLass]);
        $html = bsCancel()->toHtml();
        $this->assertContains('class="button-component ' . $configComponentCLass . '"', $html);
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.button.cancel.class.component', [$customComponentCLass]);
        $html = bsCancel()->componentClass([$customComponentCLass])->toHtml();
        $this->assertContains('class="button-component ' . $customComponentCLass . '"', $html);
        $this->assertNotContains('class="button-component ' . $configComponentCLass . '"', $html);
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.button.cancel.html_attributes.container', [$configContainerAttributes]);
        $html = bsCancel()->toHtml();
        $this->assertContains($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.button.cancel.html_attributes.container', [$configContainerAttributes]);
        $html = bsCancel()->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertContains($customContainerAttributes, $html);
        $this->assertNotContains($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.button.cancel.html_attributes.component', [$configComponentAttributes]);
        $html = bsCancel()->toHtml();
        $this->assertContains($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.button.cancel.html_attributes.component', [$configComponentAttributes]);
        $html = bsCancel()->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertContains($customComponentAttributes, $html);
        $this->assertNotContains($configComponentAttributes, $html);
    }
}
