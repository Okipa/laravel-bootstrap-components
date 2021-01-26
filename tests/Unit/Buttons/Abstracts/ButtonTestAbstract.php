<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Buttons\Abstracts;

use Okipa\LaravelBootstrapComponents\Components\Buttons\Abstracts\ButtonAbstract;
use Okipa\LaravelBootstrapComponents\Tests\Fakers\RoutesFaker;

abstract class ButtonTestAbstract extends SubmitTestAbstract
{
    use RoutesFaker;

    /** @test */
    public function it_can_return_instance_from_helper(): void
    {
        self::assertInstanceOf(ButtonAbstract::class, $this->getHelper());
    }

    /** @test */
    public function it_can_return_instance_from_facade(): void
    {
        self::assertInstanceOf(ButtonAbstract::class, $this->getFacade());
    }

    /** @test */
    public function it_can_return_instance_from_extended_testing_class(): void
    {
        self::assertInstanceOf(ButtonAbstract::class, $this->getComponent());
    }

    /** @test */
    public function it_has_correct_type(): void
    {
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('<a', $html);
    }

    /** @test */
    public function it_can_set_default_url_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('href="default-url"', $html);
    }

    /** @test */
    public function it_can_replace_default_url(): void
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

    /** @test */
    public function it_can_replace_default_url_from_route(): void
    {
        $this->setRoutes();
        $customRoute = 'users.index';
        $html = $this->getComponent()->route($customRoute)->toHtml();
        self::assertStringContainsString('href="' . route($customRoute) . '"', $html);
    }

    /** @test */
    public function it_can_set_default_label_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('title="default-label"', $html);
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
        self::assertStringContainsString('title="custom-label"', $html);
        self::assertStringNotContainsString('title="default-label"', $html);
        self::assertStringContainsString('<span class="label">custom-label</span>', $html);
        self::assertStringNotContainsString('<span class="label">default-label</span>', $html);
    }

    /** @test */
    public function it_can_generate_default_label(): void
    {
        $html = $this->getComponent()->label(null)->toHtml();
        self::assertStringNotContainsString('title="', $html);
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
        self::assertStringNotContainsString('title="default-label">', $html);
        self::assertStringNotContainsString('<span class="label">default-label</span>', $html);
    }

    /** @test */
    public function it_has_no_component_id_by_default(): void
    {
        $html = $this->getComponent()->toHtml();
        self::assertStringNotContainsString('<a id="', $html);
    }

    /** @test */
    public function it_can_set_component_id(): void
    {
        $customComponentId = 'custom-component-id';
        $html = $this->getComponent()->componentId($customComponentId)->toHtml();
        self::assertStringContainsString('<a id="' . $customComponentId . '"', $html);
    }
}
