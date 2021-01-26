<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts;

use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\UploadableAbstract;

abstract class InputFileTestAbstract extends InputTestAbstract
{
    /** @test */
    public function it_can_return_instance_from_helper(): void
    {
        self::assertInstanceOf(UploadableAbstract::class, $this->getHelper());
    }

    /** @test */
    public function it_can_return_instance_from_facade(): void
    {
        self::assertInstanceOf(UploadableAbstract::class, $this->getFacade());
    }

    /** @test */
    public function it_can_return_instance_from_extended_testing_class(): void
    {
        self::assertInstanceOf(UploadableAbstract::class, $this->getComponent());
    }

    /** @test */
    public function it_can_get_value_from_model(): void
    {
        $user = $this->createUniqueUser();
        $html = $this->getComponent()->model($user)->name('name')->toHtml();
        self::assertStringContainsString(
            '<label class="custom-file-label" for="' . $this->getComponentType() . '-name">' . $user->name . '</label>',
            $html
        );
    }

    /** @test */
    public function it_can_set_value(): void
    {
        $html = $this->getComponent()->name('name')->value('custom-value')->toHtml();
        self::assertStringContainsString(
            '<label class="custom-file-label" for="' . $this->getComponentType() . '-name">custom-value</label>',
            $html
        );
    }

    /** @test */
    public function it_can_set_zero_value(): void
    {
        $html = $this->getComponent()->name('name')->value(0)->toHtml();
        self::assertStringContainsString(
            '<label class="custom-file-label" for="' . $this->getComponentType() . '-name">0</label>',
            $html
        );
    }

    /** @test */
    public function it_can_set_empty_string_value(): void
    {
        $html = $this->getComponent()->name('name')->value('')->toHtml();
        self::assertStringContainsString(
            '<label class="custom-file-label" for="' . $this->getComponentType() . '-name">'
            . __('No file selected.') . '</label>',
            $html
        );
    }

    /** @test */
    public function it_can_set_null_value(): void
    {
        $html = $this->getComponent()->name('name')->value(null)->toHtml();
        self::assertStringContainsString(
            '<label class="custom-file-label" for="' . $this->getComponentType() . '-name">'
            . __('No file selected.') . '</label>',
            $html
        );
    }

    /** @test */
    public function it_can_set_value_from_closure_with_disabled_multilingual(): void
    {
        $html = $this->getComponent()->name('name')->value(function ($locale) {
            return 'closure-value-' . $locale;
        })->toHtml();
        self::assertStringContainsString(
            '<label class="custom-file-label" for="' . $this->getComponentType() . '-name">closure-value-'
            . app()->getLocale() . '</label>',
            $html
        );
    }

    /** @test */
    public function it_can_take_old_value_from_string(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['name' => 'old-value'])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name')->value('custom-value')->toHtml();
        self::assertStringContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name">old-value</label>', $html);
    }

    /** @test */
    public function it_can_take_old_value_from_null(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['name' => null])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name')->value('custom-value')->toHtml();
        self::assertStringContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name">' . __('No file selected.') . '</label>', $html);
    }

    /** @test */
    public function it_can_take_old_value_from_array(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['name' => [0 => 'old-value']])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name[0]')->value('custom-value')->toHtml();
        self::assertStringContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name-0">old-value</label>', $html);
    }

    /** @test */
    public function it_can_generate_default_placeholder_from_string_name(): void
    {
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString('custom-file-label', $html);
        self::assertStringContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name">' . __('No file selected.') . '</label>', $html);
    }

    /** @test */
    public function it_can_generate_default_placeholder_from_array_name(): void
    {
        $html = $this->getComponent()->name('name[0]')->toHtml();
        self::assertStringContainsString('custom-file-label', $html);
        self::assertStringContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name-0">' . __('No file selected.') . '</label>', $html);
    }

    /** @test */
    public function it_can_replace_default_placeholder(): void
    {
        $placeholder = 'custom-placeholder';
        $html = $this->getComponent()->name('name')->placeholder($placeholder)->toHtml();
        self::assertStringContainsString('custom-file-label', $html);
        self::assertStringContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name">' . $placeholder . '</label>', $html);
    }

    /** @test */
    public function it_can_replace_default_placeholder_with_specific_label(): void
    {
        $label = 'custom-label';
        $placeholder = 'custom-placeholder';
        $html = $this->getComponent()->name('name')->label($label)->placeholder($placeholder)->toHtml();
        self::assertStringContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name">' . $placeholder . '</label>', $html);
    }

    /** @test */
    public function it_can_generate_default_placeholder_with_specific_label(): void
    {
        $label = 'custom-label';
        $html = $this->getComponent()->name('name')->label($label)->toHtml();
        self::assertStringContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name">' . __('No file selected.') . '</label>', $html);
        self::assertStringNotContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name">' . $label . '</label>', $html);
    }

    /** @test */
    public function it_can_generate_default_placeholder_with_hidden_label(): void
    {
        $html = $this->getComponent()->name('name')->label(null)->toHtml();
        self::assertStringContainsString('custom-file-label', $html);
        self::assertStringContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name">' . __('No file selected.') . '</label>', $html);
    }

    /** @test */
    public function it_can_hide_placeholder(): void
    {
        $html = $this->getComponent()->name('name')->placeholder(false)->toHtml();
        self::assertStringNotContainsString('ustom-file-label', $html);
        self::assertStringNotContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name">' . __('No file selected.') . '</label>', $html);
    }

    /** @test */
    public function it_can_set_default_component_classes_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString(
            'class="component form-control custom-file-input default component classes"',
            $html
        );
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
            'class="component form-control custom-file-input default component classes merged"',
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
        self::assertStringContainsString('class="component form-control custom-file-input replaced"', $html);
    }

    /** @test */
    public function it_can_set_uploaded_file(): void
    {
        $html = $this->getComponent()->name('name')->uploadedFile(function () {
            return 'Uploaded file !';
        })->toHtml();
        self::assertStringContainsString('id="uploaded-file-name"', $html);
        self::assertStringContainsString('Uploaded file !', $html);
    }

    /** @test */
    public function it_can_set_no_uploaded_file(): void
    {
        $html = $this->getComponent()->name('name')->uploadedFile(function () {
            return null;
        })->toHtml();
        self::assertStringNotContainsString('id="uploaded-file-name"', $html);
    }

    /** @test */
    public function it_can_set_default_show_remove_checkbox_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->uploadedFile(function () {
            return 'html';
        })->toHtml();
        self::assertStringContainsString('<input id="checkbox-remove-name"', $html);
        self::assertStringContainsString(' name="remove_name"', $html);
    }

    /** @test */
    public function it_can_replace_default_show_remove_checkbox(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->uploadedFile(function () {
            return 'html';
        })->showRemoveCheckbox(false)->toHtml();
        self::assertStringNotContainsString('<input id="checkbox-remove-name"', $html);
        self::assertStringNotContainsString(' name="remove_name"', $html);
    }

    /** @test */
    public function it_cant_display_show_remove_checkbox_without_uploaded_file(): void
    {
        $html = $this->getComponent()->name('name')->uploadedFile(function () {
            return null;
        })->showRemoveCheckbox()->toHtml();
        self::assertStringNotContainsString('<input id="checkbox-remove-name"', $html);
        self::assertStringNotContainsString(' name="remove_name"', $html);
    }

    /** @test */
    public function it_can_set_default_remove_checkbox_label_from_component_config(): void
    {
        $html = $this->getComponent()->name('name')->uploadedFile(function () {
            return 'html';
        })->showRemoveCheckbox()->toHtml();
        self::assertStringContainsString(
            ' for="checkbox-remove-name">' . __('Remove') . ' validation.attributes.name',
            $html
        );
    }

    /** @test */
    public function it_can_replace_default_show_remove_checkbox_label(): void
    {
        $html = $this->getComponent()->name('name')->uploadedFile(function () {
            return 'html';
        })->showRemoveCheckbox(true, 'Test')->toHtml();
        self::assertStringContainsString(' for="checkbox-remove-name">Test', $html);
    }

    /** @test */
    public function it_cant_display_uploaded_file_element_with_empty_view(): void
    {
        view()->addNamespace('laravel-bootstrap-components', 'tests/views');
        $html = $this->getComponent()->name('name')->uploadedFile(function () {
            return view('laravel-bootstrap-components::empty');
        })->toHtml();
        self::assertStringNotContainsString(' id="uploaded-file-name"', $html);
    }
}
