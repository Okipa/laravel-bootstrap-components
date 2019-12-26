<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Media\Abstracts;

abstract class ImageTestAbstract extends MediaTestAbstract
{
    public function testSetLinkUrl()
    {
        $customLinkUrl = 'custom-link-url';
        $html = image()->linkUrl($customLinkUrl)->toHtml();
        $this->assertStringContainsString('href="' . $customLinkUrl . '"', $html);
    }

    public function testSetNoLinkUrl()
    {
        $html = image()->toHtml();
        $this->assertStringNotContainsString('href="', $html);
    }

    public function testSetLinkTitle()
    {
        //
    }

    public function testSetNoLinkTitleWithLabel()
    {
        //
    }

    public function testSetNoLinkTitleWithAlt()
    {
        //
    }

    public function testSetNoLinkTitleWithLabelAndAlt()
    {
        //
    }

    public function testSetNotLinkTitle()
    {
        //
    }

    public function testSetAlt()
    {
        $customAlt = 'custom-alt';
        $html = image()->alt($customAlt)->toHtml();
        $this->assertStringContainsString('alt="' . $customAlt . '"', $html);
    }

    public function testNoAltWithLabel()
    {
        //
    }

    public function testNoAltWithTitle()
    {
        //
    }

    public function testNoAltWithLabelAndTitle()
    {
        //
    }

    public function testSetNoAlt()
    {
        $html = image()->toHtml();
        $this->assertStringNotContainsString('alt="', $html);
    }

    public function testSetWidth()
    {
        $customWidth = 100;
        $html = image()->width($customWidth)->toHtml();
        $this->assertStringContainsString('width="' . $customWidth . '"', $html);
    }

    public function testSetNoWidth()
    {
        $html = image()->toHtml();
        $this->assertStringNotContainsString('width="', $html);
    }

    public function testSetHeight()
    {
        $customHeight = 100;
        $html = image()->height($customHeight)->toHtml();
        $this->assertStringContainsString('height="' . $customHeight . '"', $html);
    }

    public function testSetNoHeight()
    {
        $html = image()->toHtml();
        $this->assertStringNotContainsString('height="', $html);
    }

    public function testSetNoComponentId()
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
        $html = $this->getComponent()->componentClasses(['custom', 'link', 'classes'])->toHtml();
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
            ->componentHtmlAttributes(['custom' => 'link', 'html' => 'attributes'])
            ->toHtml();
        $this->assertStringContainsString('custom="link" html="attributes">', $html);
        $this->assertStringNotContainsString('default="link" html="attributes">', $html);
    }
}
