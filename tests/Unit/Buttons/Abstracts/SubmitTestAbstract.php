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

    public function testHelper(): void
    {
        self::assertInstanceOf(get_class($this->getComponent()), $this->getHelper());
    }

    public function testFacade(): void
    {
        self::assertInstanceOf(get_class($this->getComponent()), $this->getFacade());
    }

    public function testInstance(): void
    {
        self::assertInstanceOf(SubmitAbstract::class, $this->getComponent());
    }

    public function testType(): void
    {
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString(' <button type="' . $this->getComponentType() . '"', $html);
    }

    public function testDefaultPrepend(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('<span class="label-prepend">default-prepend</span>', $html);
    }

    protected function getComponentKey(): string
    {
        return $this->getComponentType();
    }

    public function testSetPrependReplacesDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->prepend('custom-prepend')->toHtml();
        self::assertStringContainsString('<span class="label-prepend">custom-prepend</span>', $html);
        self::assertStringNotContainsString('<span class="label-prepend">default-prepend</span>', $html);
    }

    public function testHidePrepend(): void
    {
        $html = $this->getComponent()->prepend(null)->toHtml();
        self::assertStringNotContainsString('<span class="label-prepend">', $html);
    }

    public function testDefaultAppend(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('<span class="label-append">default-append</span>', $html);
    }

    public function testSetAppendReplacesDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->append('custom-append')->toHtml();
        self::assertStringContainsString('<span class="label-append">custom-append</span>', $html);
        self::assertStringNotContainsString('<span class="label-append">default-append</span>', $html);
    }

    public function testHideAppend(): void
    {
        $html = $this->getComponent()->append(null)->toHtml();
        self::assertStringNotContainsString('<span class="label-append">', $html);
    }

    public function testHidePrependHideAppend(): void
    {
        $html = $this->getComponent()->prepend(null)->append(null)->toHtml();
        self::assertStringNotContainsString('<span class="label-prepend">', $html);
        self::assertStringNotContainsString('<span class="label-append">', $html);
    }

    public function testDefaultLabel(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('<span class="label">default-label</span>', $html);
    }

    public function testSetLabelReplacesDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $label = 'custom-label';
        $html = $this->getComponent()->label($label)->toHtml();
        self::assertStringContainsString('<span class="label">custom-label</span>', $html);
        self::assertStringNotContainsString('<span class="label">default-label</span>', $html);
    }

    public function testNoLabel(): void
    {
        $html = $this->getComponent()->label(null)->toHtml();
        self::assertStringNotContainsString('<span class="label">', $html);
    }

    public function testHideLabel(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->label(null)->toHtml();
        self::assertStringNotContainsString('<span class="label">default-label</span>', $html);
    }

    public function testSetNoContainerId(): void
    {
        $html = $this->getComponent()->toHtml();
        self::assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId(): void
    {
        $customContainerId = 'custom-container-id';
        $html = $this->getComponent()->containerId($customContainerId)->toHtml();
        self::assertStringContainsString('<div id="' . $customContainerId . '"', $html);
    }

    public function testDefaultComponentId(): void
    {
        $html = $this->getComponent()->toHtml();
        self::assertStringNotContainsString('<button id="', $html);
    }

    public function testSetComponentId(): void
    {
        $customComponentId = 'custom-component-id';
        $html = $this->getComponent()->componentId($customComponentId)->toHtml();
        self::assertStringContainsString('<button id="' . $customComponentId . '"', $html);
    }

    public function testItCanSetDefaultContainerClassesFromComponentConfig(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('class="component-container default container classes"', $html);
    }

    public function testItCanMergeContainerClassesToDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->containerClasses(['with', 'merged'], true)->toHtml();
        self::assertStringContainsString('class="component-container default container classes with merged"', $html);
    }

    public function testItCanReplaceDefaultContainerClasses(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->containerClasses(['replaces', 'default'])->toHtml();
        self::assertStringContainsString('class="component-container replaces default"', $html);
    }

    public function testItCanSetDefaultComponentClassesFromComponentConfig(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('class="component btn default component classes"', $html);
    }

    public function testItCanMergeComponentClassesToDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->componentClasses(['with', 'merged'], true)->toHtml();
        self::assertStringContainsString('class="component btn default component classes with merged"', $html);
    }

    public function testItCanReplaceDefaultComponentClasses(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->componentClasses(['replaces', 'default'])->toHtml();
        self::assertStringContainsString('class="component btn replaces default"', $html);
    }

    public function testItCanSetDefaultContainerHtmlAttributesFromComponentConfig(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('default="container" html="attributes">', $html);
    }

    public function testItCanMergeContainerHtmlAttributesToDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->containerHtmlAttributes(['with' => 'merged'], true)->toHtml();
        self::assertStringContainsString('default="container" html="attributes" with="merged">', $html);
    }

    public function testItCanReplaceDefaultContainerHtmlAttributes(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->containerHtmlAttributes(['replaces' => 'default'])->toHtml();
        self::assertStringContainsString('replaces="default">', $html);
    }

    public function testItCanSetDefaultComponentHtmlAttributesFromComponentConfig(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('default="component" html="attributes">', $html);
    }

    public function testItCanMergeComponentHtmlAttributesToDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->componentHtmlAttributes(['with' => 'merged'], true)->toHtml();
        self::assertStringContainsString('default="component" html="attributes" with="merged">', $html);
    }

    public function testItCanReplaceDefaultComponentHtmlAttributes(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->componentHtmlAttributes(['replaced' => 'default'])->toHtml();
        self::assertStringContainsString('replaced="default">', $html);
    }
}
