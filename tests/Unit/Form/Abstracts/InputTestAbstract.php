<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\FormAbstract;
use Okipa\LaravelBootstrapComponents\Tests\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Tests\Fakers\UsersFaker;
use RuntimeException;

abstract class InputTestAbstract extends BootstrapComponentsTestCase
{
    use UsersFaker;

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

    /** @test */
    public function it_can_set_name(): void
    {
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString(' name="name"', $html);
    }

    /** @test */
    public function it_can_set_name_with_specific_format(): void
    {
        $html = $this->getComponent()->name('camelCaseName')->toHtml();
        self::assertStringContainsString(' name="camelCaseName"', $html);
    }

    /** @test */
    public function it_has_correct_type(): void
    {
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString(' type="' . $this->getComponentType() . '"', $html);
    }

    /** @test */
    public function it_cant_set_component_without_name(): void
    {
        $this->expectException(RuntimeException::class);
        $this->getComponent()->toHtml();
    }

    /** @test */
    public function it_can_get_value_from_model(): void
    {
        $user = $this->createUniqueUser();
        $html = $this->getComponent()->name('name')->model($user)->toHtml();
        self::assertStringContainsString(' value="' . $user->name . '"', $html);
    }

    /** @test */
    public function it_can_set_default_prepend_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString('<span class="input-group-text">default-prepend</span>', $html);
    }

    /** @test */
    public function it_can_replace_default_prepend(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->prepend('custom-prepend')->toHtml();
        self::assertStringContainsString('<span class="input-group-text">custom-prepend</span>', $html);
        self::assertStringNotContainsString('<span class="input-group-text">default-prepend</span>', $html);
    }

    /** @test */
    public function it_can_replace_default_prepend_from_closure_with_disabled_multilingual(): void
    {
        $html = $this->getComponent()->name('name')->prepend(function ($locale) {
            return 'prepend-' . $locale;
        })->toHtml();
        self::assertStringContainsString('<span class="input-group-text">prepend-en</span>', $html);
    }

    /** @test */
    public function it_can_hide_prepend(): void
    {
        $html = $this->getComponent()->name('name')->prepend(null)->toHtml();
        self::assertStringNotContainsString('<div class="input-group-prepend">', $html);
    }

    /** @test */
    public function it_can_hide_prepend_with_false(): void
    {
        $html = $this->getComponent()->name('name')->prepend(false)->toHtml();
        self::assertStringNotContainsString('<div class="input-group-prepend">', $html);
    }

    /** @test */
    public function it_can_set_default_append_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString('<span class="input-group-text">default-append</span>', $html);
    }

    /** @test */
    public function it_can_replace_default_append(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->append('custom-append')->toHtml();
        self::assertStringContainsString('<span class="input-group-text">custom-append</span>', $html);
        self::assertStringNotContainsString('<span class="input-group-text">default-append</span>', $html);
    }

    /** @test */
    public function it_can_replace_default_append_from_closure_with_disabled_multilingual(): void
    {
        $html = $this->getComponent()->name('name')->append(function ($locale) {
            return 'append-' . $locale;
        })->toHtml();
        self::assertStringContainsString('<span class="input-group-text">append-en</span>', $html);
    }

    /** @test */
    public function it_can_hide_append(): void
    {
        $html = $this->getComponent()->name('name')->append(null)->toHtml();
        self::assertStringNotContainsString('<div class="input-group-append">', $html);
    }

    /** @test */
    public function it_can_hide_append_with_false(): void
    {
        $html = $this->getComponent()->name('name')->append(false)->toHtml();
        self::assertStringNotContainsString('<div class="input-group-append">', $html);
    }

    /** @test */
    public function it_can_hide_prepend_and_append(): void
    {
        $html = $this->getComponent()->name('name')->prepend(null)->append(null)->toHtml();
        self::assertStringNotContainsString('<div class="input-group">', $html);
    }

    /** @test */
    public function it_can_set_default_caption_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString('class="caption form-text text-muted">default-caption', $html);
    }

    /** @test */
    public function it_can_replace_default_caption(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->caption('custom-caption')->toHtml();
        self::assertStringContainsString('class="caption form-text text-muted">custom-caption', $html);
        self::assertStringNotContainsString('class="caption form-text text-muted">default-caption', $html);
    }

    /** @test */
    public function it_can_hide_caption(): void
    {
        $html = $this->getComponent()->name('name')->caption(null)->toHtml();
        self::assertStringNotContainsString('class="caption form-text text-muted"', $html);
    }

    /** @test */
    public function it_can_set_value(): void
    {
        $html = $this->getComponent()->name('name')->value('custom-value')->toHtml();
        self::assertStringContainsString(' value="custom-value"', $html);
    }

    /** @test */
    public function it_can_set_zero_value(): void
    {
        $html = $this->getComponent()->name('name')->value(0)->toHtml();
        self::assertStringContainsString(' value="0"', $html);
    }

    /** @test */
    public function it_can_set_empty_string_value(): void
    {
        $html = $this->getComponent()->name('name')->value('')->toHtml();
        self::assertStringContainsString(' value=""', $html);
    }

    /** @test */
    public function it_can_set_null_value(): void
    {
        $html = $this->getComponent()->name('name')->value(null)->toHtml();
        self::assertStringContainsString(' value=""', $html);
    }

    /** @test */
    public function it_can_set_value_from_closure_with_disabled_multilingual(): void
    {
        $html = $this->getComponent()->name('name')->value(function ($locale) {
            return 'closure-value-' . $locale;
        })->toHtml();
        self::assertStringContainsString(' value="closure-value-' . app()->getLocale() . '"', $html);
    }

    /** @test */
    public function it_can_take_old_value_from_string(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['name' => 'old-value'])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name')->value('custom-value')->toHtml();
        self::assertStringContainsString(' value="old-value"', $html);
        self::assertStringNotContainsString(' value="custom-value"', $html);
    }

    /** @test */
    public function it_can_take_old_value_from_null(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['name' => null])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name')->value('custom-value')->toHtml();
        self::assertStringContainsString(' value=""', $html);
        self::assertStringNotContainsString(' value="custom-value"', $html);
    }

    /** @test */
    public function it_can_take_old_value_from_array(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['name' => ['old-value']])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name[0]')->value('custom-value')->toHtml();
        self::assertStringContainsString(' value="old-value"', $html);
        self::assertStringNotContainsString(' value="custom-value"', $html);
    }

    /** @test */
    public function it_can_generate_default_label(): void
    {
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString(
            '<label for="' . $this->getComponentType() . '-name">validation.attributes.name</label>',
            $html
        );
    }

    /** @test */
    public function it_can_replace_default_label(): void
    {
        $label = 'custom-label';
        $html = $this->getComponent()->name('name')->label($label)->toHtml();
        self::assertStringContainsString(
            '<label for="' . $this->getComponentType() . '-name">' . $label . '</label>',
            $html
        );
    }

    /** @test */
    public function it_can_hide_label(): void
    {
        $html = $this->getComponent()->name('name')->label(null)->toHtml();
        self::assertStringNotContainsString(
            '<label for="' . $this->getComponentType() . '-name">validation.attributes.name</label>',
            $html
        );
    }

    /** @test */
    public function it_can_hide_label_with_false(): void
    {
        $html = $this->getComponent()->name('name')->label(false)->toHtml();
        self::assertStringNotContainsString(
            '<label for="' . $this->getComponentType() . '-name">validation.attributes.name</label>',
            $html
        );
    }

    /** @test */
    public function it_can_set_default_label_positioned_above_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        self::assertLessThan($labelPosition, $inputPosition);
    }

    /** @test */
    public function it_can_replace_default_label_positioned_above(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->labelPositionedAbove()->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        self::assertLessThan($inputPosition, $labelPosition);
    }

    /** @test */
    public function it_can_generate_default_placeholder_from_string_name(): void
    {
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString(' placeholder="validation.attributes.name"', $html);
    }

    /** @test */
    public function it_can_generate_default_placeholder_from_array_name(): void
    {
        $html = $this->getComponent()->name('name[0]')->toHtml();
        self::assertStringContainsString(' placeholder="validation.attributes.name"', $html);
    }

    /** @test */
    public function it_can_generate_default_placeholder_with_specific_label(): void
    {
        $label = 'custom-label';
        $html = $this->getComponent()->name('name')->label($label)->toHtml();
        self::assertStringContainsString(' placeholder="' . $label . '"', $html);
    }

    /** @test */
    public function it_can_generate_default_placeholder_with_hidden_label(): void
    {
        $html = $this->getComponent()->name('name')->label(null)->toHtml();
        self::assertStringContainsString(' placeholder="validation.attributes.name"', $html);
    }

    /** @test */
    public function it_can_replace_default_placeholder(): void
    {
        $placeholder = 'custom-placeholder';
        $html = $this->getComponent()->name('name')->placeholder($placeholder)->toHtml();
        self::assertStringContainsString(' placeholder="' . $placeholder . '"', $html);
    }

    /** @test */
    public function it_can_replace_default_placeholder_with_specific_label(): void
    {
        $label = 'custom-label';
        $placeholder = 'custom-placeholder';
        $html = $this->getComponent()->name('name')->label($label)->placeholder($placeholder)->toHtml();
        self::assertStringContainsString(' placeholder="' . $placeholder . '"', $html);
        self::assertStringNotContainsString(' placeholder="' . $label . '"', $html);
    }

    /** @test */
    public function it_can_hide_placeholder(): void
    {
        $html = $this->getComponent()->name('name')->placeholder(false)->toHtml();
        self::assertStringNotContainsString(' placeholder="', $html);
    }

    /** @test */
    public function it_can_set_default_display_success_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $messageBag = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        $html = $this->getComponent()->name('name')->render(compact('errors'));
        self::assertStringContainsString('is-valid', $html);
    }

    /** @test */
    public function it_can_replace_default_display_success(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $messageBag = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        $html = $this->getComponent()->name('name')->displaySuccess(false)->render(compact('errors'));
        self::assertStringNotContainsString('is-valid', $html);
    }

    /** @test */
    public function it_cant_display_success_without_other_errors(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringNotContainsString('is-valid', $html);
    }

    /** @test */
    public function it_can_set_default_display_failure_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $messageBag = app(MessageBag::class)->add('name', 'Dummy error message.');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        $html = $this->getComponent()->name('name')->render(compact('errors'));
        self::assertStringContainsString('is-invalid', $html);
        self::assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        self::assertStringContainsString($errors->first('name'), $html);
    }

    /** @test */
    public function it_can_replace_default_display_failure(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $messageBag = app(MessageBag::class)->add('name', 'Dummy error message.');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        $html = $this->getComponent()->name('name')->displayFailure(false)->render(compact('errors'));
        self::assertStringNotContainsString('is-invalid', $html);
        self::assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
        self::assertStringNotContainsString($errors->first('name'), $html);
    }

    /** @test */
    public function it_can_display_failure_with_specific_error_bag(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $messageBag = app(MessageBag::class)->add('name', 'Dummy error message.');
        $errors = app(ViewErrorBag::class)->put('test', $messageBag);
        $html = $this->getComponent()->name('name')->displayFailure(true)->errorBag('test')->render(compact('errors'));
        self::assertStringContainsString('is-invalid', $html);
        self::assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        self::assertStringContainsString($errors->test->first('name'), $html);
    }

    /** @test */
    public function it_can_display_failure_from_array_name(): void
    {
        $messageBag = app(MessageBag::class)->add('name.0', 'Dummy error message.');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        $html = $this->getComponent()->name('name[0]')->render(compact('errors'));
        self::assertStringContainsString('is-invalid', $html);
        self::assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        self::assertStringContainsString($errors->first('name'), $html);
    }

    /** @test */
    public function it_has_no_container_id_by_default(): void
    {
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringNotContainsString('<div id="', $html);
    }

    /** @test */
    public function it_can_set_container_id(): void
    {
        $customContainerId = 'custom-container-id';
        $html = $this->getComponent()->name('name')->containerId($customContainerId)->toHtml();
        self::assertStringContainsString('<div id="' . $customContainerId . '"', $html);
    }

    /** @test */
    public function it_can_generate_default_component_id(): void
    {
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString(' for="' . $this->getComponentType() . '-name"', $html);
        self::assertStringContainsString('<input id="' . $this->getComponentType() . '-name"', $html);
    }

    /** @test */
    public function it_can_generate_default_component_id_from_array_name(): void
    {
        $html = $this->getComponent()->name('name[0]')->toHtml();
        self::assertStringContainsString(' for="' . $this->getComponentType() . '-name-0"', $html);
        self::assertStringContainsString('<input id="' . $this->getComponentType() . '-name-0"', $html);
    }

    /** @test */
    public function it_can_generate_default_component_id_from_string_name_with_specific_format(): void
    {
        $html = $this->getComponent()->name('camelCaseName')->toHtml();
        self::assertStringContainsString(' for="' . $this->getComponentType() . '-camel-case-name"', $html);
        self::assertStringContainsString('<input id="' . $this->getComponentType() . '-camel-case-name"', $html);
    }

    /** @test */
    public function it_can_set_component_id(): void
    {
        $customComponentId = 'custom-component-id';
        $html = $this->getComponent()->name('name')->componentId($customComponentId)->toHtml();
        self::assertStringContainsString(' for="' . $customComponentId . '"', $html);
        self::assertStringContainsString('<input id="' . $customComponentId . '"', $html);
    }

    /** @test */
    public function it_can_set_default_container_classes_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString('class="component-container default container classes"', $html);
    }

    /** @test */
    public function it_can_merge_container_classes_to_default(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->containerClasses(['merged'], true)->toHtml();
        self::assertStringContainsString('class="component-container default container classes merged"', $html);
    }

    /** @test */
    public function it_can_replace_default_container_classes(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->containerClasses(['replaced'])->toHtml();
        self::assertStringContainsString('class="component-container replaced"', $html);
    }

    /** @test */
    public function it_can_set_default_component_classes_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString('class="component form-control default component classes"', $html);
    }

    /** @test */
    public function it_can_merge_component_classes_to_default(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->componentClasses(['merged'], true)->toHtml();
        self::assertStringContainsString('class="component form-control default component classes merged"', $html);
    }

    /** @test */
    public function it_can_replace_default_component_classes(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->componentClasses(['replaced'])->toHtml();
        self::assertStringContainsString('class="component form-control replaced"', $html);
    }

    /** @test */
    public function it_can_set_default_container_html_attributes_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString('default="container" html="attributes">', $html);
    }

    /** @test */
    public function it_can_merge_container_html_attributes_to_default(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->containerHtmlAttributes(['with' => 'merged'], true)->toHtml();
        self::assertStringContainsString('default="container" html="attributes" with="merged">', $html);
    }

    /** @test */
    public function it_can_replace_default_container_html_attributes(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->containerHtmlAttributes(['replaces' => 'default'])->toHtml();
        self::assertStringContainsString('replaces="default">', $html);
    }

    /** @test */
    public function it_can_set_default_component_html_attributes_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->value(null)->toHtml();
        self::assertStringContainsString('default="component" html="attributes">', $html);
    }

    /** @test */
    public function it_can_merge_component_html_attributes_to_default(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()
            ->name('name')
            ->value(null)
            ->componentHtmlAttributes(['with' => 'merged'], true)
            ->toHtml();
        self::assertStringContainsString('default="component" html="attributes" with="merged">', $html);
    }

    /** @test */
    public function it_can_replace_default_component_html_attributes(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()
            ->name('name')
            ->value(null)
            ->componentHtmlAttributes(['replaces' => 'default'])
            ->toHtml();
        self::assertStringContainsString('replaces="default">', $html);
    }
}
