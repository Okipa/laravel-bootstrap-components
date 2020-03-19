<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Media\Abstracts;

abstract class ImageTestAbstract extends MediaTestAbstract
{
    public function testSetLinkUrl()
    {
        $html = image()->linkUrl('custom-url')->toHtml();
        $this->assertStringContainsString('href="custom-url"', $html);
    }

    public function testSetNoLinkUrl()
    {
        $html = image()->toHtml();
        $this->assertStringNotContainsString('href="', $html);
    }

    public function testSetNotLinkTitle()
    {
        $html = image()->toHtml();
        $this->assertStringNotContainsString('title="', $html);
    }

    public function testSetNoLinkTitleWithLabel()
    {
        $html = image()->label('custom-label')->toHtml();
        $this->assertStringContainsString('title="custom-label"', $html);
    }

    public function testSetNoLinkTitleWithAlt()
    {
        $html = image()->alt('custom-alt')->toHtml();
        $this->assertStringContainsString('title="custom-alt"', $html);
    }

    public function testSetNoLinkTitleWithLabelAndAlt()
    {
        $html = image()->label('custom-label')->alt('custom-alt')->toHtml();
        $this->assertStringContainsString('title="custom-label"', $html);
    }

    public function testSetLinkTitleOverridesDefault()
    {
        $html = image()->label('custom-label')
            ->linkTitle('custom-title')
            ->alt('custom-alt')
            ->toHtml();
        $this->assertStringContainsString('title="custom-title"', $html);
    }

    public function testSetNoAlt()
    {
        $html = image()->toHtml();
        $this->assertStringNotContainsString('alt="', $html);
    }

    public function testNoAltWithLabel()
    {
        $html = image()->label('custom-label')->toHtml();
        $this->assertStringContainsString('alt="custom-label"', $html);
    }

    public function testNoAltWithLinkTitle()
    {
        $html = image()->linkTitle('custom-title')->toHtml();
        $this->assertStringContainsString('alt="custom-title"', $html);
    }

    public function testNoAltWithLabelAndLinkTitle()
    {
        $html = image()->label('custom-label')->linkTitle('custom-title')->toHtml();
        $this->assertStringContainsString('alt="custom-label"', $html);
    }

    public function testSetAltOverridesDefault()
    {
        $html = image()->label('custom-label')->linkTitle('custom-title')->alt('custom-alt')->toHtml();
        $this->assertStringContainsString('alt="custom-alt"', $html);
    }

    public function testSetNoWidth()
    {
        $html = image()->toHtml();
        $this->assertStringNotContainsString('width="', $html);
    }

    public function testSetWidth()
    {
        $html = image()->width(100)->toHtml();
        $this->assertStringContainsString('width="100"', $html);
    }

    public function testSetNoHeight()
    {
        $html = image()->toHtml();
        $this->assertStringNotContainsString('height="', $html);
    }

    public function testSetHeight()
    {
        $html = image()->height(150)->toHtml();
        $this->assertStringContainsString('height="150"', $html);
    }

    public function testDefaultComponentId()
    {
        $html = $this->getComponent()->toHtml();
        $this->assertStringNotContainsString('<img id="', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'custom-component-id';
        $html = $this->getComponent()->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString('<img id="' . $customComponentId . '"', $html);
    }

    public function testSetCustomLinkClasses()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        $this->assertStringContainsString('class="component-link default link classes"', $html);
    }

    public function testSetLinkClassesOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->linkClasses(['custom', 'link', 'classes'])->toHtml();
        $this->assertStringContainsString('class="component-link custom link classes"', $html);
        $this->assertStringNotContainsString('class="component-link default link classes"', $html);
    }

    public function testSetCustomLinkHtmlAttributes()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        $this->assertStringContainsString('default="link" html="attributes">', $html);
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
        $this->assertStringContainsString('custom="link" html="attributes">', $html);
        $this->assertStringNotContainsString('default="link" html="attributes">', $html);
    }
}
