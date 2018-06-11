<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit;

use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\UsersFaker;

class ComponentTest extends BootstrapComponentsTestCase
{
    use UsersFaker;

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.input.class.component', [$customContainerCLass]);
        $html = input()->type('text')->name('name')->containerClass([$customContainerCLass])->toHtml();
        $this->assertContains('class="input-name-container ' . $customContainerCLass . '"', $html);
        $this->assertNotContains('class="input-name-container ' . $configContainerCLass . '"', $html);
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.input.class.component', [$customComponentCLass]);
        $html = input()->type('text')->name('name')->componentClass([$customComponentCLass])->toHtml();
        $this->assertContains('class="form-control input-name-component ' . $customComponentCLass . '"', $html);
        $this->assertNotContains('class="form-control input-name-component ' . $configComponentCLass . '"', $html);
    }

    public function testSetContainerAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.input.html_attributes.container', [$configContainerAttributes]);
        $html = input()->type('text')->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertContains($customContainerAttributes, $html);
        $this->assertNotContains($configContainerAttributes, $html);
    }
    
    public function testSetComponentAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.input.html_attributes.component', [$configComponentAttributes]);
        $html = input()->type('text')->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertContains($customComponentAttributes, $html);
        $this->assertNotContains($configComponentAttributes, $html);
    }
}
