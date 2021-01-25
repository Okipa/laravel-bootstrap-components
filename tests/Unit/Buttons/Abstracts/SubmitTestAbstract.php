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

    protected function getComponentKey(): string
    {
        return $this->getComponentType();
    }

    /** @test */
    public function it_can_return_instance_from_helper(): void
    {
        self::assertInstanceOf(SubmitAbstract::class, $this->getHelper());
    }

    /** @test */
    public function it_can_return_instance_from_facade(): void
    {
        self::assertInstanceOf(SubmitAbstract::class, $this->getFacade());
    }

    /** @test */
    public function it_can_return_instance_from_extended_testing_class(): void
    {
        self::assertInstanceOf(SubmitAbstract::class, $this->getComponent());
    }

    /** @test */
    public function it_has_correct_type(): void
    {
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString(' <button type="' . $this->getComponentType() . '"', $html);
    }

    /** @test */
    public function it_can_set_default_prepend_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('<span class="label-prepend">default-prepend</span>', $html);
    }

    /** @test */
    public function it_can_replace_default_prepend(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->prepend('custom-prepend')->toHtml();
        self::assertStringContainsString('<span class="label-prepend">custom-prepend</span>', $html);
        self::assertStringNotContainsString('<span class="label-prepend">default-prepend</span>', $html);
    }

    /** @test */
    public function it_can_hide_prepend(): void
    {
        $html = $this->getComponent()->prepend(null)->toHtml();
        self::assertStringNotContainsString('<span class="label-prepend">', $html);
    }

    /** @test */
    public function it_can_set_default_append_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('<span class="label-append">default-append</span>', $html);
    }

    /** @test */
    public function it_can_replace_default_append(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->append('custom-append')->toHtml();
        self::assertStringContainsString('<span class="label-append">custom-append</span>', $html);
        self::assertStringNotContainsString('<span class="label-append">default-append</span>', $html);
    }

    /** @test */
    public function it_can_hide_append(): void
    {
        $html = $this->getComponent()->append(null)->toHtml();
        self::assertStringNotContainsString('<span class="label-append">', $html);
    }

    /** @test */
    public function it_can_hide_preprend_and_append(): void
    {
        $html = $this->getComponent()->prepend(null)->append(null)->toHtml();
        self::assertStringNotContainsString('<span class="label-prepend">', $html);
        self::assertStringNotContainsString('<span class="label-append">', $html);
    }

    /** @test */
    public function it_can_set_default_label_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('<span class="label">default-label</span>', $html);
    }

    /** @test */
    public function it_can_replace_default_label(): void
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

    /** @test */
    public function it_can_generate_default_label(): void
    {
        $html = $this->getComponent()->label(null)->toHtml();
        self::assertStringNotContainsString('<span class="label">', $html);
    }

    /** @test */
    public function it_can_hide_label(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->label(null)->toHtml();
        self::assertStringNotContainsString('<span class="label">default-label</span>', $html);
    }

    /** @test */
    public function it_has_no_container_id_by_default(): void
    {
        $html = $this->getComponent()->toHtml();
        self::assertStringNotContainsString('<div id="', $html);
    }

    /** @test */
    public function it_can_set_container_id(): void
    {
        $customContainerId = 'custom-container-id';
        $html = $this->getComponent()->containerId($customContainerId)->toHtml();
        self::assertStringContainsString('<div id="' . $customContainerId . '"', $html);
    }

    /** @test */
    public function it_has_no_component_id_by_default(): void
    {
        $html = $this->getComponent()->toHtml();
        self::assertStringNotContainsString('<button id="', $html);
    }

    /** @test */
    public function it_can_set_component_id(): void
    {
        $customComponentId = 'custom-component-id';
        $html = $this->getComponent()->componentId($customComponentId)->toHtml();
        self::assertStringContainsString('<button id="' . $customComponentId . '"', $html);
    }

    /** @test */
    public function it_can_set_default_container_classes_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('class="component-container default container classes"', $html);
    }

    /** @test */
    public function it_can_merge_container_classes_to_default(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->containerClasses(['with', 'merged'], true)->toHtml();
        self::assertStringContainsString('class="component-container default container classes with merged"', $html);
    }

    /** @test */
    public function it_can_replace_default_container_classes(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->containerClasses(['replaces', 'default'])->toHtml();
        self::assertStringContainsString('class="component-container replaces default"', $html);
    }

    /** @test */
    public function it_can_set_default_component_classes_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('class="component btn default component classes"', $html);
    }

    /** @test */
    public function it_can_merge_component_classes_to_default(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->componentClasses(['with', 'merged'], true)->toHtml();
        self::assertStringContainsString('class="component btn default component classes with merged"', $html);
    }

    /** @test */
    public function it_can_replace_default_component_classes(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->componentClasses(['replaces', 'default'])->toHtml();
        self::assertStringContainsString('class="component btn replaces default"', $html);
    }

    /** @test */
    public function it_can_set_default_container_html_attributes_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('default="container" html="attributes">', $html);
    }

    /** @test */
    public function it_can_merge_container_html_attributes_to_default(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->containerHtmlAttributes(['with' => 'merged'], true)->toHtml();
        self::assertStringContainsString('default="container" html="attributes" with="merged">', $html);
    }

    /** @test */
    public function it_can_replace_default_container_html_attributes(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->containerHtmlAttributes(['replaces' => 'default'])->toHtml();
        self::assertStringContainsString('replaces="default">', $html);
    }

    /** @test */
    public function it_can_set_default_component_html_attributes_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('default="component" html="attributes">', $html);
    }

    /** @test */
    public function it_can_merge_component_html_attributes_to_default(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->componentHtmlAttributes(['with' => 'merged'], true)->toHtml();
        self::assertStringContainsString('default="component" html="attributes" with="merged">', $html);
    }

    /** @test */
    public function it_can_replace_default_component_html_attributes(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->componentHtmlAttributes(['replaced' => 'default'])->toHtml();
        self::assertStringContainsString('replaced="default">', $html);
    }
}
