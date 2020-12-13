<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Media\Abstracts;

abstract class ImageTestAbstract extends MediaTestAbstract
{
    public function testSetLinkUrl(): void
    {
        $html = image()->linkUrl('custom-url')->toHtml();
        self::assertStringContainsString('href="custom-url"', $html);
    }

    public function testSetNoLinkUrl(): void
    {
        $html = image()->toHtml();
        self::assertStringNotContainsString('href="', $html);
    }

    public function testSetNotLinkTitle(): void
    {
        $html = image()->toHtml();
        self::assertStringNotContainsString('title="', $html);
    }

    public function testSetNoLinkTitleWithLabel(): void
    {
        $html = image()->label('custom-label')->toHtml();
        self::assertStringContainsString('title="custom-label"', $html);
    }

    public function testSetNoLinkTitleWithAlt(): void
    {
        $html = image()->alt('custom-alt')->toHtml();
        self::assertStringContainsString('title="custom-alt"', $html);
    }

    public function testSetNoLinkTitleWithLabelAndAlt(): void
    {
        $html = image()->label('custom-label')->alt('custom-alt')->toHtml();
        self::assertStringContainsString('title="custom-label"', $html);
    }

    public function testSetLinkTitleReplacesDefault(): void
    {
        $html = image()->label('custom-label')
            ->linkTitle('custom-title')
            ->alt('custom-alt')
            ->toHtml();
        self::assertStringContainsString('title="custom-title"', $html);
    }

    public function testSetNoAlt(): void
    {
        $html = image()->toHtml();
        self::assertStringNotContainsString('alt="', $html);
    }

    public function testNoAltWithLabel(): void
    {
        $html = image()->label('custom-label')->toHtml();
        self::assertStringContainsString('alt="custom-label"', $html);
    }

    public function testNoAltWithLinkTitle(): void
    {
        $html = image()->linkTitle('custom-title')->toHtml();
        self::assertStringContainsString('alt="custom-title"', $html);
    }

    public function testNoAltWithLabelAndLinkTitle(): void
    {
        $html = image()->label('custom-label')->linkTitle('custom-title')->toHtml();
        self::assertStringContainsString('alt="custom-label"', $html);
    }

    public function testSetAltReplacesDefault(): void
    {
        $html = image()->label('custom-label')->linkTitle('custom-title')->alt('custom-alt')->toHtml();
        self::assertStringContainsString('alt="custom-alt"', $html);
    }

    public function testSetNoWidth(): void
    {
        $html = image()->toHtml();
        self::assertStringNotContainsString('width="', $html);
    }

    public function testSetWidth(): void
    {
        $html = image()->width(100)->toHtml();
        self::assertStringContainsString('width="100"', $html);
    }

    public function testSetNoHeight(): void
    {
        $html = image()->toHtml();
        self::assertStringNotContainsString('height="', $html);
    }

    public function testSetHeight(): void
    {
        $html = image()->height(150)->toHtml();
        self::assertStringContainsString('height="150"', $html);
    }

    public function testDefaultComponentId(): void
    {
        $html = $this->getComponent()->toHtml();
        self::assertStringNotContainsString('<img id="', $html);
    }

    public function testSetComponentId(): void
    {
        $customComponentId = 'custom-component-id';
        $html = $this->getComponent()->componentId($customComponentId)->toHtml();
        self::assertStringContainsString('<img id="' . $customComponentId . '"', $html);
    }

    public function testDefaultLinkClasses(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('class="component-link default link classes"', $html);
    }

    public function testSetLinkClassesMergedToDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->linkClasses(['with', 'merged'], true)->toHtml();
        self::assertStringContainsString('class="component-link default link classes with merged"', $html);
    }

    public function testSetLinkClassesReplacesDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->linkClasses(['replaces', 'default'])->toHtml();
        self::assertStringContainsString('class="component-link replaces default"', $html);
    }

    public function testDefaultLinkHtmlAttributes(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('default="link" html="attributes">', $html);
    }

    public function testSetLinkHtmlAttributesMergedToDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()
            ->linkHtmlAttributes(['with' => 'merged'], true)
            ->toHtml();
        self::assertStringContainsString('default="link" html="attributes" with="merged">', $html);
    }

    public function testSetLinkHtmlAttributesReplacesDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()
            ->linkHtmlAttributes(['replaces' => 'default'])
            ->toHtml();
        self::assertStringContainsString('replaces="default">', $html);
    }
}
