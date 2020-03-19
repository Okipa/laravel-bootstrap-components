<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Buttons\Abstracts;

use Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts\SubmitAbstract;
use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Tests\BootstrapComponentsTestCase;

abstract class SubmitTestAbstract extends BootstrapComponentsTestCase
{
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
        $this->assertInstanceOf(SubmitAbstract::class, $this->getComponent());
    }

    public function testType()
    {
        $html = $this->getComponent()->toHtml();
        $this->assertStringContainsString(' <button type="' . $this->getComponentType() . '"', $html);
    }

    public function testSetCustomPrepend()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        $this->assertStringContainsString('<span class="label-prepend">default-prepend</span>', $html);
    }

    protected function getComponentKey(): string
    {
        return $this->getComponentType();
    }

    public function testSetPrependOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->prepend('custom-prepend')->toHtml();
        $this->assertStringContainsString('<span class="label-prepend">custom-prepend</span>', $html);
        $this->assertStringNotContainsString('<span class="label-prepend">default-prepend</span>', $html);
    }

    public function testHidePrepend()
    {
        $html = $this->getComponent()->prepend(null)->toHtml();
        $this->assertStringNotContainsString('<span class="label-prepend">', $html);
    }

    public function testSetCustomAppend()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        $this->assertStringContainsString('<span class="label-append">default-append</span>', $html);
    }

    public function testSetAppendOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->append('custom-append')->toHtml();
        $this->assertStringContainsString('<span class="label-append">custom-append</span>', $html);
        $this->assertStringNotContainsString('<span class="label-append">default-append</span>', $html);
    }

    public function testHideAppend()
    {
        $html = $this->getComponent()->append(null)->toHtml();
        $this->assertStringNotContainsString('<span class="label-append">', $html);
    }

    public function testHidePrependHideAppend()
    {
        $html = $this->getComponent()->prepend(null)->append(null)->toHtml();
        $this->assertStringNotContainsString('<span class="label-prepend">', $html);
        $this->assertStringNotContainsString('<span class="label-append">', $html);
    }

    public function testSetCustomLabel()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        $this->assertStringContainsString('<span class="label">default-label</span>', $html);
    }

    public function testSetLabelOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $label = 'custom-label';
        $html = $this->getComponent()->label($label)->toHtml();
        $this->assertStringContainsString('<span class="label">custom-label</span>', $html);
        $this->assertStringNotContainsString('<span class="label">default-label</span>', $html);
    }

    public function testNoLabel()
    {
        $html = $this->getComponent()->label(null)->toHtml();
        $this->assertStringNotContainsString('<span class="label">', $html);
    }

    public function testHideLabel()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->label(null)->toHtml();
        $this->assertStringNotContainsString('<span class="label">default-label</span>', $html);
    }

    public function testSetNoContainerId()
    {
        $html = $this->getComponent()->toHtml();
        $this->assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'custom-container-id';
        $html = $this->getComponent()->containerId($customContainerId)->toHtml();
        $this->assertStringContainsString('<div id="' . $customContainerId . '"', $html);
    }

    public function testDefaultComponentId()
    {
        $html = $this->getComponent()->toHtml();
        $this->assertStringNotContainsString('<button id="', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'custom-component-id';
        $html = $this->getComponent()->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString('<button id="' . $customComponentId . '"', $html);
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
        $this->assertStringContainsString('class="component btn default component classes"', $html);
    }

    public function testSetComponentClassesOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->componentClasses(['custom', 'component', 'classes'])->toHtml();
        $this->assertStringContainsString('class="component btn custom component classes"', $html);
        $this->assertStringNotContainsString('class="component btn default component classes"', $html);
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
