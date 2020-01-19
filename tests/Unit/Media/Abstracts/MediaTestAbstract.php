<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Media\Abstracts;

use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Components\Media\Abstracts\MediaAbstract;
use Okipa\LaravelBootstrapComponents\Tests\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Tests\Fakers\UsersFaker;

abstract class MediaTestAbstract extends BootstrapComponentsTestCase
{
    use UsersFaker;

    abstract protected function getComponent(): ComponentAbstract;

    abstract protected function getHelper(): ComponentAbstract;

    abstract protected function getFacade(): ComponentAbstract;

    abstract protected function getComponentType(): string;

    abstract protected function getCustomComponent(): ComponentAbstract;

    public function testHelper()
    {
        $this->assertInstanceOf(get_class($this->getComponent()), $this->getHelper());
    }

    public function testFacade()
    {
        $this->assertInstanceOf(get_class($this->getComponent()), $this->getFacade());
    }

    public function testInstance()
    {
        $this->assertInstanceOf(MediaAbstract::class, $this->getComponent());
    }

    public function testSetSrc()
    {
        $html = $this->getComponent()->src('custom-src')->toHtml();
        $this->assertStringContainsString('src="custom-src">', $html);
    }

    public function testNoSrc()
    {
        $html = $this->getComponent()->toHtml();
        $this->assertStringNotContainsString('<source src="', $html);
    }

    public function testSetCustomLegend()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        $this->assertStringContainsString('class="legend form-text text-muted">default-legend', $html);
    }

    protected function getComponentKey(): string
    {
        return $this->getComponentType();
    }

    public function testSetLegendOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->legend('custom-legend')->toHtml();
        $this->assertStringContainsString('class="legend form-text text-muted">custom-legend', $html);
        $this->assertStringNotContainsString('class="legend form-text text-muted">default-legend', $html);
    }

    public function testHideLegend()
    {
        $html = $this->getComponent()->legend(null)->toHtml();
        $this->assertStringNotContainsString('class="legend form-text text-muted"', $html);
    }

    public function testSetLabel()
    {
        $html = $this->getComponent()->label('custom-label')->toHtml();
        $this->assertStringContainsString('<label class="d-block">custom-label</label>', $html);
    }

    public function testNoLabel()
    {
        $html = $this->getComponent()->toHtml();
        $this->assertStringNotContainsString('<label', $html);
    }

    public function testHideLabel()
    {
        $html = $this->getComponent()->label(false)->toHtml();
        $this->assertStringNotContainsString(
            '<label class="d-block" for="' . $this->getComponentType() . '-name">validation.attributes.name</label>',
            $html
        );
    }

    public function testSetNoContainerId()
    {
        $html = $this->getComponent()->toHtml();
        $this->assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $html = $this->getComponent()->containerId('custom-container-id')->toHtml();
        $this->assertStringContainsString('<div id="custom-container-id"', $html);
    }

    public function testSetNoComponentId()
    {
        $html = $this->getComponent()->toHtml();
        $this->assertStringNotContainsString('<audio id="', $html);
    }

    public function testSetComponentId()
    {
        $html = $this->getComponent()->componentId('custom-component-id')->toHtml();
        $this->assertStringContainsString('<audio id="custom-component-id"', $html);
    }

    public function testSetCustomContainerClasses()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        $this->assertStringContainsString('class="component-container default container classes"', $html);
    }

    public function testSetContainerClassesOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->containerClasses(['custom', 'container', 'classes'])->toHtml();
        $this->assertStringContainsString('class="component-container custom container classes"', $html);
        $this->assertStringNotContainsString('class="component-container default container classes"', $html);
    }

    public function testSetCustomComponentClasses()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        $this->assertStringContainsString('class="component default component classes"', $html);
    }

    public function testSetComponentClassesOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->componentClasses(['custom', 'component', 'classes'])->toHtml();
        $this->assertStringContainsString('class="component custom component classes"', $html);
        $this->assertStringNotContainsString('class="component default component classes"', $html);
    }

    public function testSetCustomContainerHtmlAttributes()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        $this->assertStringContainsString(
            'default="container" html="attributes">',
            $html
        );
    }

    public function testSetContainerHtmlAttributesOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()
            ->containerHtmlAttributes(['custom' => 'container', 'html' => 'attributes'])
            ->toHtml();
        $this->assertStringContainsString('custom="container" html="attributes">', $html);
        $this->assertStringNotContainsString('default="container" html="attributes">', $html);
    }

    public function testSetCustomComponentHtmlAttributes()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        $this->assertStringContainsString('default="component" html="attributes">', $html);
    }

    public function testSetComponentHtmlAttributesOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()
            ->componentHtmlAttributes(['custom' => 'component', 'html' => 'attributes'])
            ->toHtml();
        $this->assertStringContainsString('custom="component" html="attributes">', $html);
        $this->assertStringNotContainsString('default="component" html="attributes">', $html);
    }
}
