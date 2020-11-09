<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Buttons\Abstracts;

use Okipa\LaravelBootstrapComponents\Tests\Fakers\RoutesFaker;

abstract class ButtonTestAbstract extends SubmitTestAbstract
{
    use RoutesFaker;

    public function testType()
    {
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('<a', $html);
    }

    public function setCustomUrl()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('href="default-url"', $html);
    }

    public function testSetUrlOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $customUrl = 'custom-url';
        $html = $this->getComponent()->url($customUrl)->toHtml();
        self::assertStringContainsString('href="' . $customUrl . '"', $html);
        self::assertStringNotContainsString('href="default-url"', $html);
    }

    public function testSetRoute()
    {
        $this->setRoutes();
        $customRoute = 'users.index';
        $html = $this->getComponent()->route($customRoute)->toHtml();
        self::assertStringContainsString('href="' . route($customRoute) . '"', $html);
    }

    public function testSetCustomLabel()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('title="default-label"', $html);
        self::assertStringContainsString('<span class="label">default-label</span>', $html);
    }

    public function testSetLabelOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $label = 'custom-label';
        $html = $this->getComponent()->label($label)->toHtml();
        self::assertStringContainsString('title="custom-label"', $html);
        self::assertStringNotContainsString('title="default-label"', $html);
        self::assertStringContainsString('<span class="label">custom-label</span>', $html);
        self::assertStringNotContainsString('<span class="label">default-label</span>', $html);
    }

    public function testNoLabel()
    {
        $html = $this->getComponent()->label(null)->toHtml();
        self::assertStringNotContainsString('title="', $html);
        self::assertStringNotContainsString('<span class="label">', $html);
    }

    public function testHideLabel()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->label(null)->toHtml();
        self::assertStringNotContainsString('title="default-label">', $html);
        self::assertStringNotContainsString('<span class="label">default-label</span>', $html);
    }

    public function testDefaultComponentId()
    {
        $html = $this->getComponent()->toHtml();
        self::assertStringNotContainsString('<a id="', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'custom-component-id';
        $html = $this->getComponent()->componentId($customComponentId)->toHtml();
        self::assertStringContainsString('<a id="' . $customComponentId . '"', $html);
    }

    public function testSetCustomContainerClasses()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('class="component-container default container classes"', $html);
    }

    public function testSetContainerClassesOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->containerClasses(['custom', 'container', 'classes'])->toHtml();
        self::assertStringContainsString('class="component-container custom container classes"', $html);
        self::assertStringNotContainsString('class="component-container default container classes"', $html);
    }

    public function testSetCustomComponentClasses()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('class="component btn default component classes"', $html);
    }

    public function testSetComponentClassesOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->componentClasses(['custom', 'component', 'classes'])->toHtml();
        self::assertStringContainsString('class="component btn custom component classes"', $html);
        self::assertStringNotContainsString('class="component btn default component classes"', $html);
    }
}
