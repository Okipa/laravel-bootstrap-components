<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Media\Abstracts;

abstract class ImageTestAbstract extends MediaTestAbstract
{
    public function testSetLinkUrl()
    {
        $html = image()->linkUrl('custom-url')->toHtml();
        self::assertStringContainsString('href="custom-url"', $html);
    }

    public function testSetNoLinkUrl()
    {
        $html = image()->toHtml();
        self::assertStringNotContainsString('href="', $html);
    }

    public function testSetNotLinkTitle()
    {
        $html = image()->toHtml();
        self::assertStringNotContainsString('title="', $html);
    }

    public function testSetNoLinkTitleWithLabel()
    {
        $html = image()->label('custom-label')->toHtml();
        self::assertStringContainsString('title="custom-label"', $html);
    }

    public function testSetNoLinkTitleWithAlt()
    {
        $html = image()->alt('custom-alt')->toHtml();
        self::assertStringContainsString('title="custom-alt"', $html);
    }

    public function testSetNoLinkTitleWithLabelAndAlt()
    {
        $html = image()->label('custom-label')->alt('custom-alt')->toHtml();
        self::assertStringContainsString('title="custom-label"', $html);
    }

    public function testSetLinkTitleOverridesDefault()
    {
        $html = image()->label('custom-label')
            ->linkTitle('custom-title')
            ->alt('custom-alt')
            ->toHtml();
        self::assertStringContainsString('title="custom-title"', $html);
    }

    public function testSetNoAlt()
    {
        $html = image()->toHtml();
        self::assertStringNotContainsString('alt="', $html);
    }

    public function testNoAltWithLabel()
    {
        $html = image()->label('custom-label')->toHtml();
        self::assertStringContainsString('alt="custom-label"', $html);
    }

    public function testNoAltWithLinkTitle()
    {
        $html = image()->linkTitle('custom-title')->toHtml();
        self::assertStringContainsString('alt="custom-title"', $html);
    }

    public function testNoAltWithLabelAndLinkTitle()
    {
        $html = image()->label('custom-label')->linkTitle('custom-title')->toHtml();
        self::assertStringContainsString('alt="custom-label"', $html);
    }

    public function testSetAltOverridesDefault()
    {
        $html = image()->label('custom-label')->linkTitle('custom-title')->alt('custom-alt')->toHtml();
        self::assertStringContainsString('alt="custom-alt"', $html);
    }

    public function testSetNoWidth()
    {
        $html = image()->toHtml();
        self::assertStringNotContainsString('width="', $html);
    }

    public function testSetWidth()
    {
        $html = image()->width(100)->toHtml();
        self::assertStringContainsString('width="100"', $html);
    }

    public function testSetNoHeight()
    {
        $html = image()->toHtml();
        self::assertStringNotContainsString('height="', $html);
    }

    public function testSetHeight()
    {
        $html = image()->height(150)->toHtml();
        self::assertStringContainsString('height="150"', $html);
    }

    public function testDefaultComponentId()
    {
        $html = $this->getComponent()->toHtml();
        self::assertStringNotContainsString('<img id="', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'custom-component-id';
        $html = $this->getComponent()->componentId($customComponentId)->toHtml();
        self::assertStringContainsString('<img id="' . $customComponentId . '"', $html);
    }

    public function testSetCustomLinkClasses()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('class="component-link default link classes"', $html);
    }

    public function testSetLinkClassesOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->linkClasses(['custom', 'link', 'classes'])->toHtml();
        self::assertStringContainsString('class="component-link custom link classes"', $html);
        self::assertStringNotContainsString('class="component-link default link classes"', $html);
    }

    public function testSetCustomLinkHtmlAttributes()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('default="link" html="attributes">', $html);
    }

    public function testSetLinkHtmlAttributesOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()
            ->linkHtmlAttributes(['custom' => 'link', 'html' => 'attributes'])
            ->toHtml();
        self::assertStringContainsString('custom="link" html="attributes">', $html);
        self::assertStringNotContainsString('default="link" html="attributes">', $html);
    }
}
