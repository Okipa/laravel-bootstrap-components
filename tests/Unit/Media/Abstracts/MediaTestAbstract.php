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
        self::assertInstanceOf(MediaAbstract::class, $this->getComponent());
    }

    public function testSetSrc(): void
    {
        $html = $this->getComponent()->src('custom-src')->toHtml();
        self::assertStringContainsString('src="custom-src">', $html);
    }

    public function testNoSrc(): void
    {
        $html = $this->getComponent()->toHtml();
        self::assertStringNotContainsString('<source src="', $html);
    }

    public function testDefaultCaption(): void
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

    public function testSetCaptionReplacesDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->caption('custom-caption')->toHtml();
        self::assertStringContainsString('class="caption form-text text-muted">custom-caption', $html);
        self::assertStringNotContainsString('class="caption form-text text-muted">default-caption', $html);
    }

    public function testHideCaption(): void
    {
        $html = $this->getComponent()->caption(null)->toHtml();
        self::assertStringNotContainsString('class="caption form-text text-muted"', $html);
    }

    public function testSetLabel(): void
    {
        $html = $this->getComponent()->label('custom-label')->toHtml();
        self::assertStringContainsString('<label class="d-block">custom-label</label>', $html);
    }

    public function testNoLabel(): void
    {
        $html = $this->getComponent()->toHtml();
        self::assertStringNotContainsString('<label', $html);
    }

    public function testHideLabel(): void
    {
        $html = $this->getComponent()->label(null)->toHtml();
        self::assertStringNotContainsString(
            '<label class="d-block" for="' . $this->getComponentType() . '-name">validation.attributes.name</label>',
            $html
        );
    }

    public function testSetNoContainerId(): void
    {
        $html = $this->getComponent()->toHtml();
        self::assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId(): void
    {
        $html = $this->getComponent()->containerId('custom-container-id')->toHtml();
        self::assertStringContainsString('<div id="custom-container-id"', $html);
    }

    public function testDefaultComponentId(): void
    {
        $html = $this->getComponent()->toHtml();
        self::assertStringNotContainsString('<audio id="', $html);
    }

    public function testSetComponentId(): void
    {
        $html = $this->getComponent()->componentId('custom-component-id')->toHtml();
        self::assertStringContainsString('<audio id="custom-component-id"', $html);
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
        self::assertStringContainsString('class="component default component classes"', $html);
    }

    public function testItCanMergeComponentClassesToDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->componentClasses(['with', 'merged'], true)->toHtml();
        self::assertStringContainsString('class="component default component classes with merged"', $html);
    }

    public function testItCanReplaceDefaultComponentClasses(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->componentClasses(['replaces', 'default'])->toHtml();
        self::assertStringContainsString('class="component replaces default"', $html);
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
        $html = $this->getComponent()
            ->containerHtmlAttributes(['with' => 'merged'], true)
            ->toHtml();
        self::assertStringContainsString('default="container" html="attributes" with="merged">', $html);
    }

    public function testItCanReplaceDefaultContainerHtmlAttributes(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()
            ->containerHtmlAttributes(['replaces' => 'default'])
            ->toHtml();
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
        $html = $this->getComponent()
            ->componentHtmlAttributes(['with' => 'merged'], true)
            ->toHtml();
        self::assertStringContainsString('default="component" html="attributes" with="merged">', $html);
    }

    public function testItCanReplaceDefaultComponentHtmlAttributes(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()
            ->componentHtmlAttributes(['replaces' => 'defaults'])
            ->toHtml();
        self::assertStringContainsString('replaces="defaults">', $html);
    }
}
