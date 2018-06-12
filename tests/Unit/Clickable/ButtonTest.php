<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Clickable;

use Okipa\LaravelBootstrapComponents\Component;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\RoutesFaker;

class ButtonTest extends BootstrapComponentsTestCase
{
    use RoutesFaker;

    public function testConfigStructure()
    {
        // components
        $this->assertTrue(array_key_exists('button', config('bootstrap-components')));
        // components.button
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.button')));
        $this->assertTrue(array_key_exists('icon', config('bootstrap-components.button')));
        $this->assertTrue(array_key_exists('label', config('bootstrap-components.button')));
        $this->assertTrue(array_key_exists('class', config('bootstrap-components.button')));
        $this->assertTrue(array_key_exists('html_attributes', config('bootstrap-components.button')));
        // components.button.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.button.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.button.class')));
        // components.button.html_attributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.button.html_attributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.button.html_attributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Component::class, get_parent_class(button()));
    }

    public function testSetButtonType()
    {
        $html = button()->type('button')->toHtml();
        $this->assertContains('<div class="button-container', $html);
        $this->assertContains('<a href="http://localhost"', $html);
        $this->assertContains('class="button-component', $html);
    }

    public function testSetSubmitType()
    {
        $html = button()->type('submit')->toHtml();
        $this->assertContains('<div class="submit-container', $html);
        $this->assertContains('<button type="submit"', $html);
        $this->assertContains('class="submit-component', $html);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Type must be declared for the Okipa\LaravelBootstrapComponents\Clickable\Button
     *                           component generation.
     */
    public function testNoType()
    {
        button()->toHtml();
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Okipa\LaravelBootstrapComponents\Clickable\Button : the given « wrong » type is invalid
     *                           and should be one of the following : submit, button.
     */
    public function testSetWrongType()
    {
        button()->type('wrong')->toHtml();
    }

    public function testSetUrl()
    {
        $customUrl = 'test-custom-url';
        $html = button()->type('button')->url($customUrl)->toHtml();
        $this->assertContains('<a href="' . $customUrl . '"', $html);
    }

    public function testSetRoute()
    {
        $this->setRoutes();
        $customRoute = 'users.index';
        $html = button()->type('button')->route($customRoute)->toHtml();
        $this->assertContains('<a href="' . route($customRoute) . '"', $html);
    }

    public function testConfigIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.button.icon', $configIcon);
        $html = button()->type('submit')->toHtml();
        $this->assertContains($configIcon, $html);
    }

    public function testSetIcon()
    {
        $configIcon = 'test-config-icon';
        $customIcon = 'test-custom-icon';
        config()->set('bootstrap-components.button.icon', $configIcon);
        $html = button()->type('submit')->icon($customIcon)->toHtml();
        $this->assertContains('<span class="icon">' . $customIcon . '</span>', $html);
        $this->assertNotContains('<span class="icon">' . $configIcon . '</span>', $html);
    }

    public function testNoIcon()
    {
        config()->set('bootstrap-components.button.icon', null);
        $html = button()->type('submit')->toHtml();
        $this->assertNotContains('<span class="icon">', $html);
    }

    public function testHideIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.button.icon', $configIcon);
        $html = button()->type('submit')->hideIcon()->toHtml();
        $this->assertNotContains('<span class="icon">' . $configIcon . '</span>', $html);
    }

    public function testConfigLabel()
    {
        $configLabel = 'test-config-label';
        config()->set('bootstrap-components.button.label', $configLabel);
        $html = button()->type('submit')->toHtml();
        $this->assertContains('title="bootstrap-components::' . $configLabel . '">', $html);
        $this->assertContains('<span class="label">bootstrap-components::' . $configLabel . '</span>', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = button()->type('submit')->label($label)->toHtml();
        $this->assertContains('<span class="label">' . $label . '</span>', $html);
    }

    public function testNoLabel()
    {
        config()->set('bootstrap-components.button.label', null);
        $html = button()->type('submit')->toHtml();
        $this->assertNotContains('<span class="label">', $html);
        $this->assertNotContains('title="', $html);
        $this->assertNotContains('<span class="label">', $html);
    }

    public function testHideLabel()
    {
        $configLabel = 'test-config-label';
        config()->set('bootstrap-components.button.label', $configLabel);
        $html = button()->type('submit')->hideLabel()->toHtml();
        $this->assertNotContains('title="bootstrap-components::' . $configLabel . '">', $html);
        $this->assertNotContains('<span class="label">bootstrap-components::' . $configLabel . '</span>', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.button.class.container', [$configContainerCLass]);
        $html = button()->type('submit')->toHtml();
        $this->assertContains('<div class="submit-container ' . $configContainerCLass . '">', $html);
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.input.class.container', [$configContainerCLass]);
        $html = button()->type('submit')->containerClass([$customContainerCLass])->toHtml();
        $this->assertContains('<div class="submit-container ' . $customContainerCLass . '">', $html);
        $this->assertNotContains('<div class="submit-container ' . $configContainerCLass . '">', $html);
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.button.class.component', [$configComponentCLass]);
        $html = button()->type('submit')->toHtml();
        $this->assertContains('class="submit-component ' . $configComponentCLass . '"', $html);
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.button.class.component', [$customComponentCLass]);
        $html = button()->type('submit')->componentClass([$customComponentCLass])->toHtml();
        $this->assertContains('class="submit-component ' . $customComponentCLass . '"', $html);
        $this->assertNotContains('class="submit-component ' . $configComponentCLass . '"', $html);
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.button.html_attributes.container', [$configContainerAttributes]);
        $html = button()->type('submit')->toHtml();
        $this->assertContains($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.button.html_attributes.container', [$configContainerAttributes]);
        $html = button()->type('submit')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertContains($customContainerAttributes, $html);
        $this->assertNotContains($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.button.html_attributes.component', [$configComponentAttributes]);
        $html = button()->type('submit')->toHtml();
        $this->assertContains($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.button.html_attributes.component', [$configComponentAttributes]);
        $html = button()->type('submit')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertContains($customComponentAttributes, $html);
        $this->assertNotContains($configComponentAttributes, $html);
    }
}
