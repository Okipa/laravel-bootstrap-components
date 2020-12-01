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
        self::assertInstanceOf(get_class($this->getComponent()), $this->getHelper());
    }

    public function testFacade()
    {
        self::assertInstanceOf(get_class($this->getComponent()), $this->getFacade());
    }

    public function testInstance()
    {
        self::assertInstanceOf(MediaAbstract::class, $this->getComponent());
    }

    public function testSetSrc()
    {
        $html = $this->getComponent()->src('custom-src')->toHtml();
        self::assertStringContainsString('src="custom-src">', $html);
    }

    public function testNoSrc()
    {
        $html = $this->getComponent()->toHtml();
        self::assertStringNotContainsString('<source src="', $html);
    }

    public function testSetCustomCaption()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('class="caption form-text text-muted">default-caption', $html);
    }

    protected function getComponentKey(): string
    {
        return $this->getComponentType();
    }

    public function testSetCaptionReplacesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->caption('custom-caption')->toHtml();
        self::assertStringContainsString('class="caption form-text text-muted">custom-caption', $html);
        self::assertStringNotContainsString('class="caption form-text text-muted">default-caption', $html);
    }

    public function testHideCaption()
    {
        $html = $this->getComponent()->caption(null)->toHtml();
        self::assertStringNotContainsString('class="caption form-text text-muted"', $html);
    }

    public function testSetLabel()
    {
        $html = $this->getComponent()->label('custom-label')->toHtml();
        self::assertStringContainsString('<label class="d-block">custom-label</label>', $html);
    }

    public function testNoLabel()
    {
        $html = $this->getComponent()->toHtml();
        self::assertStringNotContainsString('<label', $html);
    }

    public function testHideLabel()
    {
        $html = $this->getComponent()->label(null)->toHtml();
        self::assertStringNotContainsString(
            '<label class="d-block" for="' . $this->getComponentType() . '-name">validation.attributes.name</label>',
            $html
        );
    }

    public function testSetNoContainerId()
    {
        $html = $this->getComponent()->toHtml();
        self::assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $html = $this->getComponent()->containerId('custom-container-id')->toHtml();
        self::assertStringContainsString('<div id="custom-container-id"', $html);
    }

    public function testDefaultComponentId()
    {
        $html = $this->getComponent()->toHtml();
        self::assertStringNotContainsString('<audio id="', $html);
    }

    public function testSetComponentId()
    {
        $html = $this->getComponent()->componentId('custom-component-id')->toHtml();
        self::assertStringContainsString('<audio id="custom-component-id"', $html);
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

    public function testSetContainerClassesReplacesDefault()
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
        self::assertStringContainsString('class="component default component classes"', $html);
    }

    public function testSetComponentClassesReplacesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->componentClasses(['custom', 'component', 'classes'])->toHtml();
        self::assertStringContainsString('class="component custom component classes"', $html);
        self::assertStringNotContainsString('class="component default component classes"', $html);
    }

    public function testSetCustomContainerHtmlAttributes()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString(
            'default="container" html="attributes">',
            $html
        );
    }

    public function testSetContainerHtmlAttributesReplacesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()
            ->containerHtmlAttributes(['custom' => 'container', 'html' => 'attributes'])
            ->toHtml();
        self::assertStringContainsString('custom="container" html="attributes">', $html);
        self::assertStringNotContainsString('default="container" html="attributes">', $html);
    }

    public function testSetCustomComponentHtmlAttributes()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('default="component" html="attributes">', $html);
    }

    public function testSetComponentHtmlAttributesReplacesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()
            ->componentHtmlAttributes(['custom' => 'component', 'html' => 'attributes'])
            ->toHtml();
        self::assertStringContainsString('custom="component" html="attributes">', $html);
        self::assertStringNotContainsString('default="component" html="attributes">', $html);
    }
}
