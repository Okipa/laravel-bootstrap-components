<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts;

use InvalidArgumentException;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\RadioAbstract;

abstract class InputRadioTestAbstract extends InputTestAbstract
{
    /** @test */
    public function it_can_return_instance_from_helper(): void
    {
        self::assertInstanceOf(RadioAbstract::class, $this->getHelper());
    }

    /** @test */
    public function it_can_return_instance_from_facade(): void
    {
        self::assertInstanceOf(RadioAbstract::class, $this->getFacade());
    }

    /** @test */
    public function it_can_return_instance_from_extended_testing_class(): void
    {
        self::assertInstanceOf(RadioAbstract::class, $this->getComponent());
    }

    /** @test */
    public function it_cant_set_no_value(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->getComponent()->name('name')->value(null)->toHtml();
    }

    /** @test */
    public function it_can_get_value_from_model(): void
    {
        $user = $this->createUniqueUser();
        $html = $this->getComponent()->name('name')->model($user)->value($user->name)->toHtml();
        self::assertStringContainsString('checked="checked"', $html);
    }

    /** @test */
    public function it_can_set_default_prepend_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString('<span class="label-prepend">default-prepend</span>', $html);
    }

    /** @test */
    public function it_can_replace_default_prepend(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->prepend('custom-prepend')->toHtml();
        self::assertStringContainsString('<span class="label-prepend">custom-prepend</span>', $html);
        self::assertStringNotContainsString('<span class="label-prepend">default-prepend</span>', $html);
    }

    /** @test */
    public function it_can_replace_default_prepend_from_closure_with_disabled_multilingual(): void
    {
        $html = $this->getComponent()->name('name')->prepend(function ($locale) {
            return 'prepend-' . $locale;
        })->toHtml();
        self::assertStringContainsString('<span class="label-prepend">prepend-en</span>', $html);
    }

    /** @test */
    public function it_can_hide_prepend(): void
    {
        $html = $this->getComponent()->name('name')->prepend(null)->toHtml();
        self::assertStringNotContainsString('<div class="label-prepend">', $html);
    }

    /** @test */
    public function it_can_set_default_append_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString('<span class="label-append">default-append</span>', $html);
    }

    /** @test */
    public function it_can_replace_default_append(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->append('custom-append')->toHtml();
        self::assertStringContainsString('<span class="label-append">custom-append</span>', $html);
        self::assertStringNotContainsString('<span class="label-append">default-append</span>', $html);
    }

    /** @test */
    public function it_can_replace_default_append_from_closure_with_disabled_multilingual(): void
    {
        $html = $this->getComponent()->name('name')->append(function ($locale) {
            return 'append-' . $locale;
        })->toHtml();
        self::assertStringContainsString('<span class="label-append">append-en</span>', $html);
    }

    /** @test */
    public function it_can_hide_append(): void
    {
        $html = $this->getComponent()->name('name')->append(null)->toHtml();
        self::assertStringNotContainsString('<div class="label-append">', $html);
    }

    /** @test */
    public function it_can_hide_prepend_and_append(): void
    {
        $html = $this->getComponent()->name('name')->prepend(null)->append(null)->toHtml();
        self::assertStringNotContainsString('<div class="label-prepend">', $html);
        self::assertStringNotContainsString('<div class="label-append">', $html);
    }

    /** @test */
    public function it_can_set_null_value(): void
    {
        self::markTestSkipped();
    }

    /** @test */
    public function it_cant_set_null_value(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->it_can_set_null_value();
    }

    /** @test */
    public function it_can_set_empty_string_value(): void
    {
        self::markTestSkipped();
    }

    /** @test */
    public function it_cant_set_empty_string_value(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->getComponent()->name('name')->value('')->toHtml();
    }

    /** @test */
    public function it_is_not_checked_by_default(): void
    {
        $html = $this->getComponent()->name('active')->toHtml();
        self::assertStringNotContainsString('checked="checked', $html);
    }

    /** @test */
    public function it_can_set_checked(): void
    {
        $html = $this->getComponent()->name('name')->checked()->toHtml();
        self::assertStringContainsString('checked="checked"', $html);
    }

    /** @test */
    public function it_can_set_not_checked(): void
    {
        $html = $this->getComponent()->name('name')->checked(false)->toHtml();
        self::assertStringNotContainsString('checked="checked"', $html);
    }

    /** @test */
    public function it_can_take_old_value_from_string(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['name' => 'old-value'])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name')->value('old-value')->checked(false)->toHtml();
        self::assertStringContainsString('checked="checked', $html);
    }

    /** @test */
    public function it_can_take_old_value_from_null(): void
    {
        self::markTestSkipped();
    }

    /** @test */
    public function it_can_take_old_zero_value(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['name' => '0'])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name')->value(0)->checked(false)->toHtml();
        self::assertStringContainsString('checked="checked', $html);
    }

    /** @test */
    public function it_can_set_not_checked_from_old_value(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['name' => 'old-value'])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name')->value('custom-value')->checked()->toHtml();
        self::assertStringNotContainsString('checked="checked', $html);
    }

    /** @test */
    public function it_can_replace_default_label(): void
    {
        $html = $this->getComponent()->name('name')->label('custom-label')->toHtml();
        self::assertStringContainsString(
            '<label class="custom-control-label" for="' . $this->getComponentType()
            . '-name-value">custom-label</label>',
            $html
        );
    }

    /** @test */
    public function it_can_generate_default_label(): void
    {
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString(
            '<label class="custom-control-label" for="' . $this->getComponentType()
            . '-name-value">validation.attributes.name</label>',
            $html
        );
    }

    /** @test */
    public function it_can_hide_label(): void
    {
        $html = $this->getComponent()->name('name')->label(null)->toHtml();
        self::assertStringNotContainsString(
            '<label class="custom-control-label" for="' . $this->getComponentType()
            . '-name-value">validation.attributes.name</label>',
            $html
        );
    }

    /** @test */
    public function it_can_set_default_label_positioned_above_from_component_config(): void
    {
        self::markTestSkipped();
    }

    /** @test */
    public function it_can_replace_default_label_positioned_above(): void
    {
        self::markTestSkipped();
    }

    /** @test */
    public function it_can_generate_default_placeholder_from_string_name(): void
    {
        self::markTestSkipped();
    }

    /** @test */
    public function it_can_generate_default_placeholder_from_array_name(): void
    {
        self::markTestSkipped();
    }

    /** @test */
    public function it_can_replace_default_placeholder(): void
    {
        self::markTestSkipped();
    }

    /** @test */
    public function it_can_replace_default_placeholder_with_specific_label(): void
    {
        self::markTestSkipped();
    }

    /** @test */
    public function it_can_generate_default_placeholder_with_specific_label(): void
    {
        self::markTestSkipped();
    }

    /** @test */
    public function it_can_generate_default_placeholder_with_hidden_label(): void
    {
        self::markTestSkipped();
    }

    /** @test */
    public function it_can_hide_placeholder(): void
    {
        self::markTestSkipped();
    }

    /** @test */
    public function it_can_generate_default_component_id(): void
    {
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString(' for="' . $this->getComponentType() . '-name-value"', $html);
        self::assertStringContainsString('<input id="' . $this->getComponentType() . '-name-value"', $html);
    }

    /** @test */
    public function it_can_generate_default_component_id_from_array_name(): void
    {
        $html = $this->getComponent()->name('name[0]')->toHtml();
        self::assertStringContainsString(' for="' . $this->getComponentType() . '-name-0-value"', $html);
        self::assertStringContainsString('<input id="' . $this->getComponentType() . '-name-0-value"', $html);
    }

    /** @test */
    public function it_can_generate_default_component_id_from_string_name_with_specific_format(): void
    {
        $html = $this->getComponent()->name('camelCaseName')->toHtml();
        self::assertStringContainsString(' for="' . $this->getComponentType() . '-camel-case-name-value"', $html);
        self::assertStringContainsString('<input id="' . $this->getComponentType() . '-camel-case-name-value"', $html);
    }

    /** @test */
    public function it_can_set_default_container_classes_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString(
            'class="component-container custom-control custom-checkbox default container classes"',
            $html
        );
    }

    /** @test */
    public function it_can_merge_container_classes_to_default(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->containerClasses(['merged'], true)->toHtml();
        self::assertStringContainsString(
            'class="component-container custom-control custom-checkbox default container classes merged"',
            $html
        );
    }

    /** @test */
    public function it_can_replace_default_container_classes(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->containerClasses(['replaced'])->toHtml();
        self::assertStringContainsString('class="component-container custom-control custom-checkbox replaced"', $html);
    }

    /** @test */
    public function it_can_set_default_component_classes_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString('class="component custom-control-input default component classes"', $html);
    }

    /** @test */
    public function it_can_merge_component_classes_to_default(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->componentClasses(['merged'], true)->toHtml();
        self::assertStringContainsString(
            'class="component custom-control-input default component classes merged"',
            $html
        );
    }

    /** @test */
    public function it_can_replace_default_component_classes(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->componentClasses(['replaced'])->toHtml();
        self::assertStringContainsString('class="component custom-control-input replaced"', $html);
    }
}
