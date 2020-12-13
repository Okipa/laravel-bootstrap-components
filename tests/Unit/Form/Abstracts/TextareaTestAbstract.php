<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts;

use Okipa\LaravelBootstrapComponents\Tests\Dummy\Resolver;
use Okipa\LaravelBootstrapComponents\Tests\Models\User;

abstract class TextareaTestAbstract extends InputMultilingualTestAbstract
{
    public function testType(): void
    {
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString('<textarea', $html);
    }

    public function testModelValue(): void
    {
        $user = $this->createUniqueUser();
        $html = $this->getComponent()->model($user)->name('name')->toHtml();
        self::assertStringContainsString($user->name . '</textarea>', $html);
    }

    public function testSetValue(): void
    {
        $html = $this->getComponent()->name('name')->value('custom-value')->toHtml();
        self::assertStringContainsString('>custom-value</textarea>', $html);
    }

    public function testSetZeroValue(): void
    {
        $html = $this->getComponent()->name('name')->value(0)->toHtml();
        self::assertStringContainsString('>0</textarea>', $html);
    }

    public function testSetEmptyStringValue(): void
    {
        $html = $this->getComponent()->name('name')->value('')->toHtml();
        self::assertStringContainsString('></textarea>', $html);
    }

    public function testSetNullValue(): void
    {
        $html = $this->getComponent()->name('name')->value(null)->toHtml();
        self::assertStringContainsString('></textarea>', $html);
    }

    public function testSetValueFromClosureWithDisabledMultilingual(): void
    {
        $html = $this->getComponent()->name('name')->value(function ($locale) {
            return 'closure-value-' . $locale;
        })->toHtml();
        self::assertStringContainsString('closure-value-' . app()->getLocale() . '</textarea>', $html);
    }

    public function testOldValue(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['name' => 'old-value'])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name')->value('custom-value')->toHtml();
        self::assertStringContainsString('old-value</textarea>', $html);
        self::assertStringNotContainsString('custom-value</textarea>', $html);
    }

    public function testOldArrayValue(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['name' => ['old-value']])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name[0]')->value('custom-value')->toHtml();
        self::assertStringContainsString('old-value</textarea>', $html);
        self::assertStringNotContainsString('custom-value</textarea>', $html);
    }

    public function testDefaultLabelPositionedAbove(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<textarea');
        self::assertLessThan($labelPosition, $inputPosition);
    }

    public function testSetLabelPositionedAboveReplacesDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->labelPositionedAbove()->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<textarea');
        self::assertLessThan($inputPosition, $labelPosition);
    }

    public function testDefaultComponentId(): void
    {
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString(' for="' . $this->getComponentType() . '-name"', $html);
        self::assertStringContainsString('<textarea id="' . $this->getComponentType() . '-name"', $html);
    }

    public function testDefaultComponentIdWithArrayName(): void
    {
        $html = $this->getComponent()->name('name[0]')->toHtml();
        self::assertStringContainsString(' for="' . $this->getComponentType() . '-name-0"', $html);
        self::assertStringContainsString('<textarea id="' . $this->getComponentType() . '-name-0"', $html);
    }

    public function testDefaultComponentIdFormatting(): void
    {
        $html = $this->getComponent()->name('camelCaseName')->toHtml();
        self::assertStringContainsString(' for="' . $this->getComponentType() . '-camel-case-name"', $html);
        self::assertStringContainsString('<textarea id="' . $this->getComponentType() . '-camel-case-name"', $html);
    }

    public function testSetComponentId(): void
    {
        $customComponentId = 'custom-component-id';
        $html = $this->getComponent()->name('name')->componentId($customComponentId)->toHtml();
        self::assertStringContainsString(' for="' . $customComponentId . '"', $html);
        self::assertStringContainsString('<textarea id="' . $customComponentId . '"', $html);
    }

    public function testLocalizedModelValue(): void
    {
        $locales = ['fr', 'en'];
        $name = [];
        foreach ($locales as $locale) {
            $name[$locale] = $this->faker->word;
        }
        $user = new User(['name' => $name]);
        $html = $this->getComponent()->model($user)->name('name')->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            self::assertStringContainsString($user->name[$locale] . '</textarea>', $html);
        }
    }

    public function testLocalizedModelValueFromCustomMultilingualResolver(): void
    {
        $user = new User(['name_fr' => $this->faker->word, 'name_en' => $this->faker->word]);
        config()->set('bootstrap-components.form.multilingualResolver', Resolver::class);
        $resolverLocales = (new Resolver())->getDefaultLocales();
        $html = $this->getComponent()->model($user)->name('name')->toHtml();
        foreach ($resolverLocales as $resolverLocale) {
            self::assertStringContainsString($user->{'name_' . $resolverLocale} . '</textarea>', $html);
        }
    }

    public function testSetLocalizedValue(): void
    {
        $locales = ['fr', 'en'];
        $values = [];
        foreach ($locales as $locale) {
            $values[$locale] = 'custom-value-' . $locale;
        }
        $html = $this->getComponent()
            ->name('name')
            ->locales($locales)
            ->value(function ($locale) use ($values) {
                return $values[$locale];
            })
            ->toHtml();
        foreach ($locales as $locale) {
            self::assertStringContainsString($values[$locale] . '</textarea>', $html);
        }
    }

    public function testLocalizedOldValue(): void
    {
        $locales = ['fr', 'en'];
        $oldValues = [];
        $values = [];
        foreach ($locales as $locale) {
            $oldValues[$locale] = 'old-value-' . $locale;
            $values[$locale] = 'custom-value-' . $locale;
        }
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['name' => $oldValues])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()
            ->name('name')
            ->locales($locales)
            ->value(fn($locale) => $values . '-' . $locale)
            ->toHtml();
        foreach ($locales as $locale) {
            self::assertStringContainsString($oldValues[$locale] . '</textarea>', $html);
            self::assertStringNotContainsString($values[$locale] . '</textarea>', $html);
        }
    }

    public function testLocalizedOldValueFromCustomMultilingualResolver(): void
    {
        config()->set('bootstrap-components.form.multilingualResolver', Resolver::class);
        $resolverLocales = (new Resolver())->getDefaultLocales();
        $oldValues = [];
        foreach ($resolverLocales as $resolverLocale) {
            $oldValues['name_' . $resolverLocale] = 'old-value-' . $resolverLocale;
        }
        $locales = ['fr', 'en'];
        $values = [];
        foreach ($locales as $locale) {
            $values[$locale] = 'test-custom-value-' . $locale;
        }
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge($oldValues)->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name')->value(fn($locale) => $values[$locale])->toHtml();
        foreach ($resolverLocales as $resolverLocale) {
            self::assertStringContainsString($oldValues['name_' . $resolverLocale] . '</textarea>', $html);
        }
        foreach ($locales as $locale) {
            self::assertStringNotContainsString($values[$locale] . '</textarea>', $html);
        }
    }

    public function testSetLocalizedComponentId(): void
    {
        $locales = ['fr', 'en'];
        $customComponentId = 'test-custom-component-id';
        $html = $this->getComponent()->name('name')->componentId($customComponentId)->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            self::assertStringContainsString(' for="' . $customComponentId . '-' . $locale . '"', $html);
            self::assertStringContainsString('<textarea id="' . $customComponentId . '-' . $locale . '"', $html);
        }
    }
}
