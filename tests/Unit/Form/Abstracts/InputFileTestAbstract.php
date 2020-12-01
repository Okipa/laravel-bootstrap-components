<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts;

use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\UploadableAbstract;

abstract class InputFileTestAbstract extends InputTestAbstract
{
    public function testInstance(): void
    {
        self::assertInstanceOf(UploadableAbstract::class, $this->getComponent());
    }

    public function testModelValue(): void
    {
        $user = $this->createUniqueUser();
        $html = $this->getComponent()->model($user)->name('name')->toHtml();
        self::assertStringContainsString(
            '<label class="custom-file-label" for="' . $this->getComponentType() . '-name">' . $user->name . '</label>',
            $html
        );
    }

    public function testSetValue(): void
    {
        $html = $this->getComponent()->name('name')->value('custom-value')->toHtml();
        self::assertStringContainsString(
            '<label class="custom-file-label" for="' . $this->getComponentType() . '-name">custom-value</label>',
            $html
        );
    }

    public function testSetZeroValue(): void
    {
        $html = $this->getComponent()->name('name')->value(0)->toHtml();
        self::assertStringContainsString(
            '<label class="custom-file-label" for="' . $this->getComponentType() . '-name">0</label>',
            $html
        );
    }

    public function testSetEmptyStringValue(): void
    {
        $html = $this->getComponent()->name('name')->value('')->toHtml();
        self::assertStringContainsString(
            '<label class="custom-file-label" for="' . $this->getComponentType() . '-name">'
            . __('No file selected.') . '</label>',
            $html
        );
    }

    public function testSetNullValue(): void
    {
        $html = $this->getComponent()->name('name')->value(null)->toHtml();
        self::assertStringContainsString(
            '<label class="custom-file-label" for="' . $this->getComponentType() . '-name">'
            . __('No file selected.') . '</label>',
            $html
        );
    }

    public function testSetValueFromClosureWithDisabledMultilingual(): void
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

    public function testOldValue(): void
    {
        $oldValue = 'old-value';
        $value = 'custom-value';
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValue) {
                $request = request()->merge(['name' => $oldValue]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name')->value($value)->toHtml();
        self::assertStringContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name">' . $oldValue . '</label>', $html);
        self::assertStringNotContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name">' . $value . '</label>', $html);
    }

    public function testOldArrayValue(): void
    {
        $oldValue = 'old-value';
        $value = 'custom-value';
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValue) {
                $request = request()->merge(['name' => [0 => $oldValue]]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name[0]')->value($value)->toHtml();
        self::assertStringContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name-0">' . $oldValue . '</label>', $html);
        self::assertStringNotContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name-0">' . $value . '</label>', $html);
    }

    public function testDefaultPlaceholder(): void
    {
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString('custom-file-label', $html);
        self::assertStringContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name">' . __('No file selected.') . '</label>', $html);
    }

    public function testDefaultPlaceholderWithArrayName(): void
    {
        $html = $this->getComponent()->name('name[0]')->toHtml();
        self::assertStringContainsString('custom-file-label', $html);
        self::assertStringContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name-0">' . __('No file selected.') . '</label>', $html);
    }

    public function testSetPlaceholder(): void
    {
        $placeholder = 'custom-placeholder';
        $html = $this->getComponent()->name('name')->placeholder($placeholder)->toHtml();
        self::assertStringContainsString('custom-file-label', $html);
        self::assertStringContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name">' . $placeholder . '</label>', $html);
    }

    public function testSetPlaceholderWithLabel(): void
    {
        $label = 'custom-label';
        $placeholder = 'custom-placeholder';
        $html = $this->getComponent()->name('name')->label($label)->placeholder($placeholder)->toHtml();
        self::assertStringContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name">' . $placeholder . '</label>', $html);
    }

    public function testNoPlaceholderWithLabel(): void
    {
        $label = 'custom-label';
        $html = $this->getComponent()->name('name')->label($label)->toHtml();
        self::assertStringContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name">' . __('No file selected.') . '</label>', $html);
        self::assertStringNotContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name">' . $label . '</label>', $html);
    }

    public function testNoPlaceholderWithNoLabel(): void
    {
        $html = $this->getComponent()->name('name')->label(null)->toHtml();
        self::assertStringContainsString('custom-file-label', $html);
        self::assertStringContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name">' . __('No file selected.') . '</label>', $html);
    }


    public function testHidePlaceholder(): void
    {
        $html = $this->getComponent()->name('name')->placeholder(false)->toHtml();
        self::assertStringNotContainsString('ustom-file-label', $html);
        self::assertStringNotContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name">' . __('No file selected.') . '</label>', $html);
    }

    public function testSetCustomComponentClasses(): void
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

    public function testSetComponentClassesMergedToDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->componentClasses(['with', 'merged'])->toHtml();
        self::assertStringContainsString(
            'class="component form-control custom-file-input default component classes with merged"',
            $html
        );
    }

    public function testSetComponentClassesReplacesDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()
            ->name('name')
            ->componentClasses(['custom', 'component', 'classes'], true)
            ->toHtml();
        self::assertStringContainsString(
            'class="component form-control custom-file-input custom component classes"',
            $html
        );
    }

    public function testSetUploadedFile(): void
    {
        $html = $this->getComponent()->name('name')->uploadedFile(function () {
            return 'Uploaded file !';
        })->toHtml();
        self::assertStringContainsString('id="uploaded-file-name"', $html);
        self::assertStringContainsString('Uploaded file !', $html);
    }

    public function testSetNoUploadedFile(): void
    {
        $html = $this->getComponent()->name('name')->uploadedFile(function () {
            return null;
        })->toHtml();
        self::assertStringNotContainsString('id="uploaded-file-name"', $html);
    }

    public function testCustomShowRemoveCheckbox(): void
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

    public function testSetShowRemoveCheckboxReplacesDefault(): void
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

    public function testSetShowRemoveCheckboxWithoutUploadedFile(): void
    {
        $html = $this->getComponent()->name('name')->uploadedFile(function () {
            return null;
        })->showRemoveCheckbox()->toHtml();
        self::assertStringNotContainsString('<input id="checkbox-remove-name"', $html);
        self::assertStringNotContainsString(' name="remove_name"', $html);
    }

    public function testDefaultRemoveCheckboxLabel(): void
    {
        $html = $this->getComponent()->name('name')->uploadedFile(function () {
            return 'html';
        })->showRemoveCheckbox()->toHtml();
        self::assertStringContainsString(
            ' for="checkbox-remove-name">' . __('Remove') . ' validation.attributes.name',
            $html
        );
    }

    public function testSetCustomRemoveCheckboxLabel(): void
    {
        $html = $this->getComponent()->name('name')->uploadedFile(function () {
            return 'html';
        })->showRemoveCheckbox(true, 'Test')->toHtml();
        self::assertStringContainsString(' for="checkbox-remove-name">Test', $html);
    }

    public function testUploadedZoneNotDisplayedWithEmptyView(): void
    {
        view()->addNamespace('laravel-bootstrap-components', 'tests/views');
        $html = $this->getComponent()->name('name')->uploadedFile(function () {
            return view('laravel-bootstrap-components::empty');
        })->toHtml();
        self::assertStringNotContainsString(' id="uploaded-file-name"', $html);
    }
}
