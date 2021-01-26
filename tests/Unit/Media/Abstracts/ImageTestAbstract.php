<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Media\Abstracts;

use Okipa\LaravelBootstrapComponents\Components\Media\Abstracts\ImageAbstract;

abstract class ImageTestAbstract extends MediaTestAbstract
{
    public function it_can_return_instance_from_helper(): void
    {
        self::assertInstanceOf(ImageAbstract::class, $this->getHelper());
    }

    public function it_can_return_instance_from_facade(): void
    {
        self::assertInstanceOf(ImageAbstract::class, $this->getFacade());
    }

    public function it_can_return_instance_from_extended_testing_class(): void
    {
        self::assertInstanceOf(ImageAbstract::class, $this->getComponent());
    }

    /** @test */
    public function it_can_set_link_url(): void
    {
        $html = image()->linkUrl('custom-url')->toHtml();
        self::assertStringContainsString('href="custom-url"', $html);
    }

    /** @test */
    public function it_can_set_no_link_url(): void
    {
        $html = image()->toHtml();
        self::assertStringNotContainsString('href="', $html);
    }

    /** @test */
    public function it_can_set_no_link_title(): void
    {
        $html = image()->toHtml();
        self::assertStringNotContainsString('title="', $html);
    }

    /** @test */
    public function it_can_generate_missing_link_title_from_label(): void
    {
        $html = image()->label('custom-label')->toHtml();
        self::assertStringContainsString('title="custom-label"', $html);
    }

    /** @test */
    public function it_can_generate_missing_link_title_from_alt(): void
    {
        $html = image()->alt('custom-alt')->toHtml();
        self::assertStringContainsString('title="custom-alt"', $html);
    }

    /** @test */
    public function it_can_generate_missing_link_title_from_label_rather_than_alt(): void
    {
        $html = image()->label('custom-label')->alt('custom-alt')->toHtml();
        self::assertStringContainsString('title="custom-label"', $html);
    }

    /** @test */
    public function it_can_set_link_title(): void
    {
        $html = image()->label('custom-label')
            ->linkTitle('custom-title')
            ->alt('custom-alt')
            ->toHtml();
        self::assertStringContainsString('title="custom-title"', $html);
    }

    /** @test */
    public function it_can_set_no_alt(): void
    {
        $html = image()->toHtml();
        self::assertStringNotContainsString('alt="', $html);
    }

    /** @test */
    public function it_can_generate_missing_alt_from_label(): void
    {
        $html = image()->label('custom-label')->toHtml();
        self::assertStringContainsString('alt="custom-label"', $html);
    }

    /** @test */
    public function it_can_generate_missing_alt_from_title(): void
    {
        $html = image()->linkTitle('custom-title')->toHtml();
        self::assertStringContainsString('alt="custom-title"', $html);
    }

    /** @test */
    public function it_can_generate_missing_alt_from_label_rather_than_title(): void
    {
        $html = image()->label('custom-label')->linkTitle('custom-title')->toHtml();
        self::assertStringContainsString('alt="custom-label"', $html);
    }

    /** @test */
    public function it_can_set_alt(): void
    {
        $html = image()->label('custom-label')->linkTitle('custom-title')->alt('custom-alt')->toHtml();
        self::assertStringContainsString('alt="custom-alt"', $html);
    }

    /** @test */
    public function it_can_set_no_width(): void
    {
        $html = image()->toHtml();
        self::assertStringNotContainsString('width="', $html);
    }

    /** @test */
    public function it_can_set_width(): void
    {
        $html = image()->width(100)->toHtml();
        self::assertStringContainsString('width="100"', $html);
    }

    /** @test */
    public function it_can_set_no_height(): void
    {
        $html = image()->toHtml();
        self::assertStringNotContainsString('height="', $html);
    }

    /** @test */
    public function it_can_set_height(): void
    {
        $html = image()->height(150)->toHtml();
        self::assertStringContainsString('height="150"', $html);
    }

    /** @test */
    public function it_has_no_component_id_by_default(): void
    {
        $html = $this->getComponent()->toHtml();
        self::assertStringNotContainsString('<img id="', $html);
    }

    /** @test */
    public function it_can_set_component_id(): void
    {
        $customComponentId = 'custom-component-id';
        $html = $this->getComponent()->componentId($customComponentId)->toHtml();
        self::assertStringContainsString('<img id="' . $customComponentId . '"', $html);
    }

    /** @test */
    public function it_can_set_default_link_classes_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('class="component-link default link classes"', $html);
    }

    /** @test */
    public function it_can_merge_link_classes_to_default(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->linkClasses(['with', 'merged'], true)->toHtml();
        self::assertStringContainsString('class="component-link default link classes with merged"', $html);
    }

    /** @test */
    public function it_can_replace_default_link_classes(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->linkClasses(['replaces', 'default'])->toHtml();
        self::assertStringContainsString('class="component-link replaces default"', $html);
    }

    /** @test */
    public function it_can_set_default_link_html_attributes_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->toHtml();
        self::assertStringContainsString('default="link" html="attributes">', $html);
    }

    /** @test */
    public function it_can_merge_link_html_attributes_to_default(): void
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

    /** @test */
    public function it_can_replace_default_link_html_attributes(): void
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
