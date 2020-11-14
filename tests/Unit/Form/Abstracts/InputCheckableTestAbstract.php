<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts;

use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\CheckableAbstract;

abstract class InputCheckableTestAbstract extends InputTestAbstract
{
    public function testInstance(): void
    {
        self::assertInstanceOf(CheckableAbstract::class, $this->getComponent());
    }

    public function testType(): void
    {
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString(' type="checkbox"', $html);
    }

    public function testModelValue(): void
    {
        $user = $this->createUniqueUser();
        $html = $this->getComponent()->model($user)->name('active')->toHtml();
        self::assertStringContainsString(' checked="checked"', $html);
    }

    public function testSetCustomPrepend(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString('<span class="label-prepend">default-prepend</span>', $html);
    }

    public function testSetPrependOverridesDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->prepend('custom-prepend')->toHtml();
        self::assertStringContainsString('<span class="label-prepend">custom-prepend</span>', $html);
        self::assertStringNotContainsString('<span class="label-prepend">default-prepend</span>', $html);
    }

    public function testSetPrependFromClosureWithDisabledMultilingual(): void
    {
        $html = $this->getComponent()->name('name')->prepend(function ($locale) {
            return 'prepend-' . $locale;
        })->toHtml();
        self::assertStringContainsString('<span class="label-prepend">prepend-en</span>', $html);
    }

    public function testHidePrepend(): void
    {
        $html = $this->getComponent()->name('name')->prepend(null)->toHtml();
        self::assertStringNotContainsString('<div class="label-prepend">', $html);
    }

    public function testSetCustomAppend(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString('<span class="label-append">default-append</span>', $html);
    }

    public function testSetAppendOverridesDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->append('custom-append')->toHtml();
        self::assertStringContainsString('<span class="label-append">custom-append</span>', $html);
        self::assertStringNotContainsString('<span class="label-append">default-append</span>', $html);
    }

    public function testSetAppendFromClosureWithDisabledMultilingual(): void
    {
        $html = $this->getComponent()->name('name')->append(function ($locale) {
            return 'append-' . $locale;
        })->toHtml();
        self::assertStringContainsString('<span class="label-append">append-en</span>', $html);
    }

    public function testHideAppend(): void
    {
        $html = $this->getComponent()->name('name')->append(null)->toHtml();
        self::assertStringNotContainsString('<div class="label-append">', $html);
    }

    public function testHidePrependHideAppend(): void
    {
        $html = $this->getComponent()->name('name')->prepend(null)->append(null)->toHtml();
        self::assertStringNotContainsString('<div class="label-prepend">', $html);
        self::assertStringNotContainsString('<div class="label-append">', $html);
    }

    public function testSetChecked(): void
    {
        $user = null;
        $html = $this->getComponent()->model($user)->name('active')->checked()->toHtml();
        self::assertStringContainsString('checked="checked"', $html);
    }

    public function testSetCheckedOverridesModelValue(): void
    {
        $user = $this->createUniqueUser();
        $html = $this->getComponent()->model($user)->name('active')->checked(false)->toHtml();
        self::assertStringNotContainsString('checked="checked"', $html);
    }

    public function testDefaultCheckStatus(): void
    {
        $html = $this->getComponent()->name('active')->toHtml();
        self::assertStringNotContainsString('checked="checked', $html);
    }

    public function testSetValue(): void
    {
        $html = $this->getComponent()->name('active')->value(true)->toHtml();
        self::assertStringContainsString('checked="checked', $html);
    }

    public function testSetZeroValue(): void
    {
        $html = $this->getComponent()->name('name')->value(0)->toHtml();
        self::assertStringNotContainsString('checked="checked', $html);
    }

    public function testSetEmptyStringValue(): void
    {
        $html = $this->getComponent()->name('name')->value('')->toHtml();
        self::assertStringNotContainsString('checked="checked', $html);
    }

    public function testSetNullValue(): void
    {
        $html = $this->getComponent()->name('name')->value(null)->toHtml();
        self::assertStringNotContainsString('checked="checked', $html);
    }

    public function testSetValueFromClosureWithDisabledMultilingual(): void
    {
        $html = $this->getComponent()->name('name')->value(function () {
            return true;
        })->toHtml();
        self::assertStringContainsString('checked="checked', $html);
    }

    public function testSetValueNotChecked(): void
    {
        $html = $this->getComponent()->name('active')->value(false)->toHtml();
        self::assertStringNotContainsString('checked="checked', $html);
    }

    public function testSetValueOverridesModelValue(): void
    {
        $user = $this->createUniqueUser();
        $html = $this->getComponent()->model($user)->name('active')->value(false)->toHtml();
        self::assertStringContainsString('checked="checked', $html);
    }

    public function testOldValue(): void
    {
        $oldValue = true;
        $value = false;
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValue) {
                $request = request()->merge(['active' => (string) $oldValue]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('active')->value($value)->toHtml();
        self::assertStringContainsString('checked="checked', $html);
    }

    public function testOldArrayValue(): void
    {
        $oldValue = true;
        $value = false;
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValue) {
                $request = request()->merge(['active' => [0 => (string) $oldValue]]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('active[0]')->value($value)->toHtml();
        self::assertStringContainsString('checked="checked', $html);
    }

    public function testOldValueNotChecked(): void
    {
        $oldValue = false;
        $value = true;
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValue) {
                $request = request()->merge(['active' => (string) $oldValue]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('active')->value($value)->toHtml();
        self::assertStringNotContainsString('checked="checked', $html);
    }

    public function testSetLabel(): void
    {
        $html = $this->getComponent()->name('active')->label('custom-label')->toHtml();
        self::assertStringContainsString(
            ' for="' . $this->getComponentType() . '-active">custom-label</label>',
            $html
        );
    }

    public function testNoLabel(): void
    {
        $html = $this->getComponent()->name('active')->toHtml();
        self::assertStringContainsString(' for="' . $this->getComponentType() . '-active">'
            . 'validation.attributes.active</label>', $html);
    }

    public function testHideLabel(): void
    {
        $html = $this->getComponent()->name('active')->label(null)->toHtml();
        self::assertStringNotContainsString(' for="' . $this->getComponentType() . '-active">'
            . 'validation.attributes.active</label>', $html);
    }

    public function testSetCustomLabelPositionedAbove(): void
    {
        self::markTestSkipped();
    }

    public function testSetLabelPositionedAboveOverridesDefault(): void
    {
        self::markTestSkipped();
    }

    public function testDefaultPlaceholder(): void
    {
        self::markTestSkipped();
    }

    public function testDefaultPlaceholderWithArrayName(): void
    {
        self::markTestSkipped();
    }

    public function testSetPlaceholder(): void
    {
        self::markTestSkipped();
    }

    public function testSetTranslatedPlaceholder(): void
    {
        self::markTestSkipped();
    }

    public function testSetPlaceholderWithLabel(): void
    {
        self::markTestSkipped();
    }

    public function testNoPlaceholderWithLabel(): void
    {
        self::markTestSkipped();
    }

    public function testNoPlaceholderWithNoLabel(): void
    {
        self::markTestSkipped();
    }

    public function testHidePlaceholder(): void
    {
        self::markTestSkipped();
    }

    public function testSetCustomContainerClasses(): void
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

    public function testSetContainerClassesOverridesDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->containerClasses(['custom', 'container', 'classes'])->toHtml();
        self::assertStringContainsString(
            'class="component-container custom-control custom-' . $this->getComponentType()
            . ' custom container classes"',
            $html
        );
        self::assertStringNotContainsString(
            'class="component-container custom-control custom-' . $this->getComponentType()
            . ' default container classes"',
            $html
        );
    }

    public function testSetCustomComponentClasses(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString('class="component custom-control-input default component classes"', $html);
    }

    public function testSetComponentClassesOverridesDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->componentClasses(['custom', 'component', 'classes'])->toHtml();
        self::assertStringContainsString('class="component custom-control-input custom component classes"', $html);
        self::assertStringNotContainsString('class="component custom-control-input default component classes"', $html);
    }
}
