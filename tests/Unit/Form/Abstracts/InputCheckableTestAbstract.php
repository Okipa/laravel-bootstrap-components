<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
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

    public function testItCanSetPrependFromComponentConfig(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString('<span class="label-prepend">default-prepend</span>', $html);
    }

    public function testSetPrependReplacesDefault(): void
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

    public function testItCanSetAppendFromComponentConfig(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString('<span class="label-append">default-append</span>', $html);
    }

    public function testSetAppendReplacesDefault(): void
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

    public function testComponentIsNotCheckedByDefault(): void
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
        $html = $this->getComponent()->name('name')->value(fn() => true)->toHtml();
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
        self::assertStringNotContainsString('checked="checked', $html);
    }

    public function testOldValue(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['active' => '1'])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('active')->checked(false)->toHtml();
        self::assertStringContainsString('checked="checked', $html);
    }

    public function testOldNullValue(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['active' => null])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('active')->checked(false)->toHtml();
        self::assertStringNotContainsString('checked="checked', $html);
    }

    public function testOldArrayValue(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['active' => ['1']])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('active[0]')->checked(false)->toHtml();
        self::assertStringContainsString('checked="checked', $html);
    }

    public function testOldValueNotChecked(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['active' => '0'])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('active')->checked(true)->toHtml();
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

    public function testItCanSetLabelPositionedAboveFromComponentConfig(): void
    {
        self::markTestSkipped();
    }

    public function testSetLabelPositionedAboveReplacesDefault(): void
    {
        self::markTestSkipped();
    }

    public function itCanSetDefaultPlaceholder(): void
    {
        self::markTestSkipped();
    }

    public function testItCanSetDefaultPlaceholderWithArrayName(): void
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

    public function testItCanSetDefaultContainerClassesFromComponentConfig(): void
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

    public function testItCanMergeContainerClassesToDefault(): void
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

    public function testItCanReplaceDefaultContainerClasses(): void
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

    public function testItCanSetDefaultComponentClassesFromComponentConfig(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString('class="component custom-control-input default component classes"', $html);
    }

    public function testItCanMergeComponentClassesToDefault(): void
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

    public function testItCanReplaceDefaultComponentClasses(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->componentClasses(['replaced'])->toHtml();
        self::assertStringContainsString('class="component custom-control-input replaced"', $html);
    }
}
