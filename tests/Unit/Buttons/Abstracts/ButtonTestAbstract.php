<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Buttons\Abstracts;

use Okipa\LaravelBootstrapComponents\Tests\Fakers\RoutesFaker;

abstract class ButtonTestAbstract extends SubmitTestAbstract
{
    use RoutesFaker;

    public function testType()
    {
        $html = $this->getComponent()->toHtml();
        $this->assertStringContainsString('<a', $html);
    }

    public function setCustomUrl()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        $this->assertStringContainsString('href="default-url"', $html);
    }

    public function testSetUrlOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $customUrl = 'custom-url';
        $html = $this->getComponent()->url($customUrl)->toHtml();
        $this->assertStringContainsString('href="' . $customUrl . '"', $html);
        $this->assertStringNotContainsString('href="default-url"', $html);
    }

    public function testSetRoute()
    {
        $this->setRoutes();
        $customRoute = 'users.index';
        $html = $this->getComponent()->route($customRoute)->toHtml();
        $this->assertStringContainsString('href="' . route($customRoute) . '"', $html);
    }

    public function testSetCustomLabel()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        $this->assertStringContainsString('title="default-label"', $html);
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
        $this->assertStringContainsString('title="custom-label"', $html);
        $this->assertStringNotContainsString('title="default-label"', $html);
        $this->assertStringContainsString('<span class="label">custom-label</span>', $html);
        $this->assertStringNotContainsString('<span class="label">default-label</span>', $html);
    }

    public function testNoLabel()
    {
        $html = $this->getComponent()->label(null)->toHtml();
        $this->assertStringNotContainsString('title="', $html);
        $this->assertStringNotContainsString('<span class="label">', $html);
    }

    public function testHideLabel()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->label(null)->toHtml();
        $this->assertStringNotContainsString('title="default-label">', $html);
        $this->assertStringNotContainsString('<span class="label">default-label</span>', $html);
    }

    public function testSetNoComponentId()
    {
        $html = $this->getComponent()->toHtml();
        $this->assertStringNotContainsString('<a id="', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'custom-component-id';
        $html = $this->getComponent()->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString('<a id="' . $customComponentId . '"', $html);
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
}
