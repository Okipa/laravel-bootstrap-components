<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\FormAbstract;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\InputAbstract;
use Okipa\LaravelBootstrapComponents\Tests\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Tests\Fakers\UsersFaker;
use RuntimeException;

abstract class FormTestAbstract extends BootstrapComponentsTestCase
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
        self::assertInstanceOf(FormAbstract::class, $this->getHelper());
    }

    /** @test */
    public function it_can_return_instance_from_facade(): void
    {
        self::assertInstanceOf(FormAbstract::class, $this->getFacade());
    }

    /** @test */
    public function it_can_return_instance_from_extended_testing_class(): void
    {
        self::assertInstanceOf(FormAbstract::class, $this->getComponent());
    }

//    /** @test */
//    public function it_can_set_form_inputs_label_positioned_above(): void
//    {
//    }

//    /** @test */
//    public function it_cant_set_form_inputs_label_positioned_above_when_overridden_by_input(): void
//    {
//    }

//    /** @test */
//    public function it_can_set_form_inputs_display_success(): void
//    {
//    }

//    /** @test */
//    public function it_cant_set_form_inputs_display_success_when_overridden_by_input(): void
//    {
//    }

//    /** @test */
//    public function it_can_set_form_inputs_display_failure(): void
//    {
//    }

//    /** @test */
//    public function it_cant_set_form_inputs_display_failure_when_overridden_by_input(): void
//    {
//    }

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
        self::assertStringContainsString('<form id="' . $customComponentId . '"', $html);
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
        self::assertStringContainsString('class="component form default component classes"', $html);
    }

    /** @test */
    public function it_can_merge_component_classes_to_default(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->componentClasses(['with', 'merged'], true)->toHtml();
        self::assertStringContainsString('class="component form default component classes with merged"', $html);
    }

    /** @test */
    public function it_can_replace_default_component_classes(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->componentClasses(['replaces', 'default'])->toHtml();
        self::assertStringContainsString('class="component form replaces default"', $html);
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
