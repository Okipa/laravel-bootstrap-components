<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use InvalidArgumentException;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\RadioAbstract;

abstract class InputRadioTestAbstract extends InputTestAbstract
{
    public function testInstance(): void
    {
        self::assertInstanceOf(RadioAbstract::class, $this->getComponent());
    }

    public function testInputWithoutValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->getComponent()->name('name')->value(null)->toHtml();
    }

    public function testModelValue(): void
    {
        $user = $this->createUniqueUser();
        $html = $this->getComponent()->name('name')->model($user)->value($user->name)->toHtml();
        self::assertStringContainsString('checked="checked"', $html);
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

    public function testSetNullValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        parent::testSetNullValue();
    }

    public function testSetEmptyStringValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->getComponent()->name('name')->value('')->toHtml();
    }

    public function testSetChecked(): void
    {
        $html = $this->getComponent()->name('name')->checked()->toHtml();
        self::assertStringContainsString('checked="checked"', $html);
    }

    public function testNotChecked(): void
    {
        $html = $this->getComponent()->name('name')->checked(false)->toHtml();
        self::assertStringNotContainsString('checked="checked"', $html);
    }

    public function testOldValue(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['name' => 'old-value'])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name')->value('old-value')->checked(false)->toHtml();
        self::assertStringContainsString('checked="checked', $html);
    }

    public function testOldNullValue(): void
    {
        self::markTestSkipped();
    }

    public function testOldZeroValue(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['name' => '0'])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name')->value(0)->checked(false)->toHtml();
        self::assertStringContainsString('checked="checked', $html);
    }

    public function testOldValueNotChecked(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['name' => 'old-value'])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name')->value('custom-value')->checked()->toHtml();
        self::assertStringNotContainsString('checked="checked', $html);
    }

    public function testSetLabel(): void
    {
        $html = $this->getComponent()->name('name')->label('custom-label')->toHtml();
        self::assertStringContainsString(
            '<label class="custom-control-label" for="' . $this->getComponentType()
            . '-name-value">custom-label</label>',
            $html
        );
    }

    public function testNoLabel(): void
    {
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString(
            '<label class="custom-control-label" for="' . $this->getComponentType()
            . '-name-value">validation.attributes.name</label>',
            $html
        );
    }

    public function testHideLabel(): void
    {
        $html = $this->getComponent()->name('name')->label(null)->toHtml();
        self::assertStringNotContainsString(
            '<label class="custom-control-label" for="' . $this->getComponentType()
            . '-name-value">validation.attributes.name</label>',
            $html
        );
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

    public function testItCanSetDefaultComponentId(): void
    {
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString(' for="' . $this->getComponentType() . '-name-value"', $html);
        self::assertStringContainsString('<input id="' . $this->getComponentType() . '-name-value"', $html);
    }

    public function testItCanSetDefaultComponentIdWithArrayName(): void
    {
        $html = $this->getComponent()->name('name[0]')->toHtml();
        self::assertStringContainsString(' for="' . $this->getComponentType() . '-name-0-value"', $html);
        self::assertStringContainsString('<input id="' . $this->getComponentType() . '-name-0-value"', $html);
    }

    public function testItCanFixComponentIdWrongFormat(): void
    {
        $html = $this->getComponent()->name('camelCaseName')->toHtml();
        self::assertStringContainsString(' for="' . $this->getComponentType() . '-camel-case-name-value"', $html);
        self::assertStringContainsString('<input id="' . $this->getComponentType() . '-camel-case-name-value"', $html);
    }

    public function testItCanSetDefaultContainerClassesFromComponentConfig(): void
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

    public function testItCanMergeContainerClassesToDefault(): void
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

    public function testItCanReplaceDefaultContainerClasses(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->containerClasses(['replaced'])->toHtml();
        self::assertStringContainsString('class="component-container custom-control custom-checkbox replaced"', $html);
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
