<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts;

use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\UploadableAbstract;

abstract class InputFileTestAbstract extends InputTestAbstract
{
    public function testInstance()
    {
        $this->assertInstanceOf(UploadableAbstract::class, $this->getComponent());
    }

    public function testModelValue()
    {
        $user = $this->createUniqueUser();
        $html = $this->getComponent()->model($user)->name('name')->toHtml();
        $this->assertStringContainsString(
            '<label class="custom-file-label" for="' . $this->getComponentType() . '-name">' . $user->name . '</label>',
            $html
        );
    }

    public function testSetValue()
    {
        $html = $this->getComponent()->name('name')->value('custom-value')->toHtml();
        $this->assertStringContainsString(
            '<label class="custom-file-label" for="' . $this->getComponentType() . '-name">custom-value</label>',
            $html
        );
    }

    public function testSetZeroValue()
    {
        $html = $this->getComponent()->name('name')->value(0)->toHtml();
        $this->assertStringContainsString(
            '<label class="custom-file-label" for="' . $this->getComponentType() . '-name">0</label>',
            $html
        );
    }

    public function testSetEmptyStringValue()
    {
        $html = $this->getComponent()->name('name')->value('')->toHtml();
        $this->assertStringContainsString(
            '<label class="custom-file-label" for="' . $this->getComponentType() . '-name">'
            . __('No file selected.') . '</label>',
            $html
        );
    }

    public function testSetNullValue()
    {
        $html = $this->getComponent()->name('name')->value(null)->toHtml();
        $this->assertStringContainsString(
            '<label class="custom-file-label" for="' . $this->getComponentType() . '-name">'
            . __('No file selected.') . '</label>',
            $html
        );
    }

    public function testSetValueFromClosureWithDisabledMultilingual()
    {
        $html = $this->getComponent()->name('name')->value(function ($locale) {
            return 'closure-value-' . $locale;
        })->toHtml();
        $this->assertStringContainsString(
            '<label class="custom-file-label" for="' . $this->getComponentType() . '-name">closure-value-'
            . app()->getLocale() . '</label>',
            $html
        );
    }

    public function testOldValue()
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
        $this->assertStringContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name">' . $oldValue . '</label>', $html);
        $this->assertStringNotContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name">' . $value . '</label>', $html);
    }

    public function testOldArrayValue()
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
        $this->assertStringContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name-0">' . $oldValue . '</label>', $html);
        $this->assertStringNotContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name-0">' . $value . '</label>', $html);
    }

    public function testDefaultPlaceholder()
    {
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringContainsString('custom-file-label', $html);
        $this->assertStringContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name">' . __('No file selected.') . '</label>', $html);
    }

    public function testDefaultPlaceholderWithArrayName()
    {
        $html = $this->getComponent()->name('name[0]')->toHtml();
        $this->assertStringContainsString('custom-file-label', $html);
        $this->assertStringContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name-0">' . __('No file selected.') . '</label>', $html);
    }

    public function testSetPlaceholder()
    {
        $placeholder = 'custom-placeholder';
        $html = $this->getComponent()->name('name')->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString('custom-file-label', $html);
        $this->assertStringContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name">' . $placeholder . '</label>', $html);
    }

    public function testSetPlaceholderWithLabel()
    {
        $label = 'custom-label';
        $placeholder = 'custom-placeholder';
        $html = $this->getComponent()->name('name')->label($label)->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name">' . $placeholder . '</label>', $html);
    }

    public function testNoPlaceholderWithLabel()
    {
        $label = 'custom-label';
        $html = $this->getComponent()->name('name')->label($label)->toHtml();
        $this->assertStringContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name">' . __('No file selected.') . '</label>', $html);
        $this->assertStringNotContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name">' . $label . '</label>', $html);
    }

    public function testNoPlaceholderWithNoLabel()
    {
        $html = $this->getComponent()->name('name')->label(false)->toHtml();
        $this->assertStringContainsString('custom-file-label', $html);
        $this->assertStringContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name">' . __('No file selected.') . '</label>', $html);
    }


    public function testHidePlaceholder()
    {
        $html = $this->getComponent()->name('name')->placeholder(false)->toHtml();
        $this->assertStringNotContainsString('ustom-file-label', $html);
        $this->assertStringNotContainsString('<label class="custom-file-label" for="' . $this->getComponentType()
            . '-name">' . __('No file selected.') . '</label>', $html);
    }

    public function testSetCustomComponentClasses()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringContainsString(
            'class="component form-control custom-file-input default component classes"',
            $html
        );
    }

    public function testSetComponentClassesOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->componentClasses(['custom', 'component', 'classes'])->toHtml();
        $this->assertStringContainsString(
            'class="component form-control custom-file-input custom component classes"',
            $html
        );
        $this->assertStringNotContainsString(
            'class="component form-control custom-file-input default component classes"',
            $html
        );
    }

    public function testSetUploadedFile()
    {
        $html = $this->getComponent()->name('name')->uploadedFile(function () {
            return 'Uploaded file !';
        })->toHtml();
        $this->assertStringContainsString('id="uploaded-file-name"', $html);
        $this->assertStringContainsString('Uploaded file !', $html);
    }

    public function testSetNoUploadedFile()
    {
        $html = $this->getComponent()->name('name')->uploadedFile(function () {
            return null;
        })->toHtml();
        $this->assertStringNotContainsString('id="uploaded-file-name"', $html);
    }

    public function testCustomShowRemoveCheckbox()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->uploadedFile(function () {
            return 'html';
        })->toHtml();
        $this->assertStringContainsString('<input id="checkbox-remove-name"', $html);
        $this->assertStringContainsString(' name="remove_name"', $html);
    }

    public function testSetShowRemoveCheckboxOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->uploadedFile(function () {
            return 'html';
        })->showRemoveCheckbox(false)->toHtml();
        $this->assertStringNotContainsString('<input id="checkbox-remove-name"', $html);
        $this->assertStringNotContainsString(' name="remove_name"', $html);
    }

    public function testSetShowRemoveCheckboxWithoutUploadedFile()
    {
        $html = $this->getComponent()->name('name')->uploadedFile(function () {
            return null;
        })->showRemoveCheckbox()->toHtml();
        $this->assertStringNotContainsString('<input id="checkbox-remove-name"', $html);
        $this->assertStringNotContainsString(' name="remove_name"', $html);
    }

    public function testDefaultRemoveCheckboxLabel()
    {
        $html = $this->getComponent()->name('name')->uploadedFile(function () {
            return 'html';
        })->showRemoveCheckbox()->toHtml();
        $this->assertStringContainsString(
            ' for="checkbox-remove-name">' . __('Remove') . ' validation.attributes.name',
            $html
        );
    }

    public function testSetCustomRemoveCheckboxLabel()
    {
        $html = $this->getComponent()->name('name')->uploadedFile(function () {
            return 'html';
        })->showRemoveCheckbox(true, 'Test')->toHtml();
        $this->assertStringContainsString(' for="checkbox-remove-name">Test', $html);
    }
}
