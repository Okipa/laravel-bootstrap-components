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

    public function it_can_return_instance_from_helper(): void
    {
        self::assertInstanceOf(get_class($this->getComponent()), $this->getHelper());
    }

    public function it_can_return_instance_from_facade(): void
    {
        self::assertInstanceOf(get_class($this->getComponent()), $this->getFacade());
    }

    public function it_can_return_instance_from_extended_testing_class(): void
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

    public function it_can_replace_default_caption(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->caption('custom-caption')->toHtml();
        self::assertStringContainsString('class="caption form-text text-muted">custom-caption', $html);
        self::assertStringNotContainsString('class="caption form-text text-muted">default-caption', $html);
    }

    public function it_can_hide_caption(): void
    {
        $html = $this->getComponent()->caption(null)->toHtml();
        self::assertStringNotContainsString('class="caption form-text text-muted"', $html);
    }

    public function it_can_replace_default_label(): void
    {
        $html = $this->getComponent()->label('custom-label')->toHtml();
        self::assertStringContainsString('<label class="d-block">custom-label</label>', $html);
    }

    public function it_can_generate_default_label(): void
    {
        $html = $this->getComponent()->toHtml();
        self::assertStringNotContainsString('<label', $html);
    }

    public function it_can_hide_label(): void
    {
        $html = $this->getComponent()->label(null)->toHtml();
        self::assertStringNotContainsString(
            '<label class="d-block" for="' . $this->getComponentType() . '-name">validation.attributes.name</label>',
            $html
        );
    }

    public function it_has_no_container_id_by_default(): void
    {
        $html = $this->getComponent()->toHtml();
        self::assertStringNotContainsString('<div id="', $html);
    }

    public function it_can_set_container_id(): void
    {
        $html = $this->getComponent()->containerId('custom-container-id')->toHtml();
        self::assertStringContainsString('<div id="custom-container-id"', $html);
    }

    public function it_has_no_component_id_by_default(): void
    {
        $html = $this->getComponent()->toHtml();
        self::assertStringNotContainsString('<audio id="', $html);
    }

    public function it_can_set_component_id(): void
    {
        $html = $this->getComponent()->componentId('custom-component-id')->toHtml();
        self::assertStringContainsString('<audio id="custom-component-id"', $html);
    }

    public function it_can_set_default_container_classes_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('class="component-container default container classes"', $html);
    }

    public function it_can_merge_container_classes_to_default(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->containerClasses(['with', 'merged'], true)->toHtml();
        self::assertStringContainsString('class="component-container default container classes with merged"', $html);
    }

    public function it_can_replace_default_container_classes(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->containerClasses(['replaces', 'default'])->toHtml();
        self::assertStringContainsString('class="component-container replaces default"', $html);
    }

    public function it_can_set_default_component_classes_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('class="component default component classes"', $html);
    }

    public function it_can_merge_component_classes_to_default(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->componentClasses(['with', 'merged'], true)->toHtml();
        self::assertStringContainsString('class="component default component classes with merged"', $html);
    }

    public function it_can_replace_default_component_classes(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->componentClasses(['replaces', 'default'])->toHtml();
        self::assertStringContainsString('class="component replaces default"', $html);
    }

    public function it_can_set_default_container_html_attributes_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('default="container" html="attributes">', $html);
    }

    public function it_can_merge_container_html_attributes_to_default(): void
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

    public function it_can_replace_default_container_html_attributes(): void
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

    public function it_can_set_default_component_html_attributes_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('default="component" html="attributes">', $html);
    }

    public function it_can_merge_component_html_attributes_to_default(): void
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

    public function it_can_replace_default_component_html_attributes(): void
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
