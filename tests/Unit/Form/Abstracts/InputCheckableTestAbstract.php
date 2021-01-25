<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\CheckableAbstract;

abstract class InputCheckableTestAbstract extends InputTestAbstract
{
    /** @test */
    public function it_can_return_instance_from_extended_testing_class(): void
    {
        self::assertInstanceOf(CheckableAbstract::class, $this->getComponent());
    }

    /** @test */
    public function it_has_correct_type(): void
    {
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString(' type="checkbox"', $html);
    }

    /** @test */
    public function it_can_get_value_from_model(): void
    {
        $user = $this->createUniqueUser();
        $html = $this->getComponent()->model($user)->name('active')->toHtml();
        self::assertStringContainsString(' checked="checked"', $html);
    }

    /** @test */
    public function it_can_set_prepend_from_component_config(): void
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
    public function it_can_hide_preprend_and_append(): void
    {
        $html = $this->getComponent()->name('name')->prepend(null)->append(null)->toHtml();
        self::assertStringNotContainsString('<div class="label-prepend">', $html);
        self::assertStringNotContainsString('<div class="label-append">', $html);
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
        $user = null;
        $html = $this->getComponent()->model($user)->name('active')->checked()->toHtml();
        self::assertStringContainsString('checked="checked"', $html);
    }

    /** @test */
    public function it_can_set_checked_and_override_model_value(): void
    {
        $user = $this->createUniqueUser();
        $html = $this->getComponent()->model($user)->name('active')->checked(false)->toHtml();
        self::assertStringNotContainsString('checked="checked"', $html);
    }

    /** @test */
    public function it_can_set_value(): void
    {
        $html = $this->getComponent()->name('active')->value(true)->toHtml();
        self::assertStringContainsString('checked="checked', $html);
    }

    /** @test */
    public function it_can_set_zero_value(): void
    {
        $html = $this->getComponent()->name('name')->value(0)->toHtml();
        self::assertStringNotContainsString('checked="checked', $html);
    }

    /** @test */
    public function it_can_set_empty_string_value(): void
    {
        $html = $this->getComponent()->name('name')->value('')->toHtml();
        self::assertStringNotContainsString('checked="checked', $html);
    }

    /** @test */
    public function it_can_set_null_value(): void
    {
        $html = $this->getComponent()->name('name')->value(null)->toHtml();
        self::assertStringNotContainsString('checked="checked', $html);
    }

    /** @test */
    public function it_can_set_value_from_closure_with_disabled_multilingual(): void
    {
        $html = $this->getComponent()->name('name')->value(fn() => true)->toHtml();
        self::assertStringContainsString('checked="checked', $html);
    }

    /** @test */
    public function it_can_set_not_checked_from_value(): void
    {
        $html = $this->getComponent()->name('active')->value(false)->toHtml();
        self::assertStringNotContainsString('checked="checked', $html);
    }

    /** @test */
    public function it_can_set_not_checked_from_value_and_overide_model_value(): void
    {
        $user = $this->createUniqueUser();
        $html = $this->getComponent()->model($user)->name('active')->value(false)->toHtml();
        self::assertStringNotContainsString('checked="checked', $html);
    }

    /** @test */
    public function it_can_take_old_value_from_string(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['active' => '1'])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('active')->checked(false)->toHtml();
        self::assertStringContainsString('checked="checked', $html);
    }

    /** @test */
    public function it_can_take_old_value_from_null(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['active' => null])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('active')->checked(false)->toHtml();
        self::assertStringNotContainsString('checked="checked', $html);
    }

    /** @test */
    public function it_can_take_old_value_from_array(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['active' => ['1']])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('active[0]')->checked(false)->toHtml();
        self::assertStringContainsString('checked="checked', $html);
    }

    /** @test */
    public function it_can_set_not_checked_from_old_value(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['active' => '0'])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('active')->checked(true)->toHtml();
        self::assertStringNotContainsString('checked="checked', $html);
    }

    /** @test */
    public function it_can_replace_default_label(): void
    {
        $html = $this->getComponent()->name('active')->label('custom-label')->toHtml();
        self::assertStringContainsString(
            ' for="' . $this->getComponentType() . '-active">custom-label</label>',
            $html
        );
    }

    /** @test */
    public function it_can_generate_default_label(): void
    {
        $html = $this->getComponent()->name('active')->toHtml();
        self::assertStringContainsString(' for="' . $this->getComponentType() . '-active">'
            . 'validation.attributes.active</label>', $html);
    }

    /** @test */
    public function it_can_hide_label(): void
    {
        $html = $this->getComponent()->name('active')->label(null)->toHtml();
        self::assertStringNotContainsString(' for="' . $this->getComponentType() . '-active">'
            . 'validation.attributes.active</label>', $html);
    }

    /** @test */
    public function it_can_set_default_label_positioned_above_from_component_config(): void
    {
        self::markTestSkipped();
    }

    /** @test */
    public function it_can_replace_label_positioned_above(): void
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
    public function it_can_generate_default_placehoder_with_hidden_label(): void
    {
        self::markTestSkipped();
    }

    /** @test */
    public function it_can_hide_placeholder(): void
    {
        self::markTestSkipped();
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
            'class="component-container custom-control custom-' . $this->getComponentType()
            . ' default container classes"',
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
            'class="component-container custom-control custom-' . $this->getComponentType()
            . ' default container classes merged"',
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
        self::assertStringContainsString(
            'class="component-container custom-control custom-' . $this->getComponentType() . ' replaced"',
            $html
        );
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
