<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Buttons\Abstracts;

use Okipa\LaravelBootstrapComponents\Tests\Fakers\RoutesFaker;

abstract class ButtonTestAbstract extends SubmitTestAbstract
{
    use RoutesFaker;

    public function testType(): void
    {
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('<a', $html);
    }

    public function setCustomUrl(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('href="default-url"', $html);
    }

    public function testSetUrlReplacesDefault(): void
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

    public function testSetRoute(): void
    {
        $this->setRoutes();
        $customRoute = 'users.index';
        $html = $this->getComponent()->route($customRoute)->toHtml();
        self::assertStringContainsString('href="' . route($customRoute) . '"', $html);
    }

    public function testDefaultLabel(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('title="default-label"', $html);
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
        self::assertStringContainsString('title="custom-label"', $html);
        self::assertStringNotContainsString('title="default-label"', $html);
        self::assertStringContainsString('<span class="label">custom-label</span>', $html);
        self::assertStringNotContainsString('<span class="label">default-label</span>', $html);
    }

    public function testNoLabel(): void
    {
        $html = $this->getComponent()->label(null)->toHtml();
        self::assertStringNotContainsString('title="', $html);
        self::assertStringNotContainsString('<span class="label">', $html);
    }

    public function testHideLabel(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->label(null)->toHtml();
        self::assertStringNotContainsString('title="default-label">', $html);
        self::assertStringNotContainsString('<span class="label">default-label</span>', $html);
    }

    public function testDefaultComponentId(): void
    {
        $html = $this->getComponent()->toHtml();
        self::assertStringNotContainsString('<a id="', $html);
    }

    public function testSetComponentId(): void
    {
        $customComponentId = 'custom-component-id';
        $html = $this->getComponent()->componentId($customComponentId)->toHtml();
        self::assertStringContainsString('<a id="' . $customComponentId . '"', $html);
    }
}
