<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts;

use Okipa\LaravelBootstrapComponents\Tests\Dummy\Resolver;
use Okipa\LaravelBootstrapComponents\Tests\Models\User;

abstract class TextareaTestAbstract extends InputMultilingualTestAbstract
{
    public function testType()
    {
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringContainsString('<textarea', $html);
    }

    public function testModelValue()
    {
        $user = $this->createUniqueUser();
        $html = $this->getComponent()->model($user)->name('name')->toHtml();
        $this->assertStringContainsString($user->name . '</textarea>', $html);
    }

    public function testSetValue()
    {
        $customValue = 'custom-value';
        $html = $this->getComponent()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString($customValue . '</textarea>', $html);
    }

    public function testOldValue()
    {
        $oldValue = 'old-value';
        $customValue = 'custom-value';
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValue) {
                $request = request()->merge(['name' => $oldValue]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString($oldValue . '</textarea>', $html);
        $this->assertStringNotContainsString($customValue . '</textarea>', $html);
    }

    public function testSetCustomLabelPositionedAbove()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<textarea');
        $this->assertLessThan($labelPosition, $inputPosition);
    }

    public function testSetLabelPositionedAboveOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->labelPositionedAbove()->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<textarea');
        $this->assertLessThan($inputPosition, $labelPosition);
    }

    public function testSetNoComponentId()
    {
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringContainsString(' for="' . $this->getComponentType() . '-name"', $html);
        $this->assertStringContainsString('<textarea id="' . $this->getComponentType() . '-name"', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'custom-component-id';
        $html = $this->getComponent()->name('name')->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString(' for="' . $customComponentId . '"', $html);
        $this->assertStringContainsString('<textarea id="' . $customComponentId . '"', $html);
    }

    public function testLocalizedModelValue()
    {
        $locales = ['fr', 'en'];
        $name = [];
        foreach ($locales as $locale) {
            $name[$locale] = $this->faker->word;
        }
        $user = new User(['name' => $name]);
        $html = $this->getComponent()->model($user)->name('name')->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringContainsString($user->name[$locale] . '</textarea>', $html);
        }
    }

    public function testLocalizedModelValueFromCustomMultilingualResolver()
    {
        $user = new User(['name_fr' => $this->faker->word, 'name_en' => $this->faker->word]);
        config()->set('bootstrap-components.form.multilingualResolver', Resolver::class);
        $resolverLocales = (new Resolver)->getDefaultLocales();
        $html = $this->getComponent()->model($user)->name('name')->toHtml();
        foreach ($resolverLocales as $resolverLocale) {
            $this->assertStringContainsString($user->{'name_' . $resolverLocale} . '</textarea>', $html);
        }
    }

    public function testSetLocalizedValue()
    {
        $locales = ['fr', 'en'];
        $customValues = [];
        foreach ($locales as $locale) {
            $customValues[$locale] = 'custom-value-' . $locale;
        }
        $html = $this->getComponent()->name('name')->locales($locales)->value(function ($locale) use ($customValues) {
            return $customValues[$locale];
        })->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringContainsString($customValues[$locale] . '</textarea>', $html);
        }
    }

    public function testLocalizedOldValue()
    {
        $locales = ['fr', 'en'];
        $oldValues = [];
        $customValues = [];
        foreach ($locales as $locale) {
            $oldValues[$locale] = 'old-value-' . $locale;
            $customValues[$locale] = 'custom-value-' . $locale;
        }
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValues) {
                $request = request()->merge(['name' => $oldValues]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name')->locales($locales)->value(function ($locale) use ($customValues) {
            return $customValues . '-' . $locale;
        })->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringContainsString($oldValues[$locale] . '</textarea>', $html);
            $this->assertStringNotContainsString($customValues[$locale] . '</textarea>', $html);
        }
    }

    public function testLocalizedOldValueFromCustomMultilingualResolver()
    {
        config()->set('bootstrap-components.form.multilingualResolver', Resolver::class);
        $resolverLocales = (new Resolver)->getDefaultLocales();
        $oldValues = [];
        foreach ($resolverLocales as $resolverLocale) {
            $oldValues['name_' . $resolverLocale] = 'old-value-' . $resolverLocale;
        }
        $locales = ['fr', 'en'];
        $customValues = [];
        foreach ($locales as $locale) {
            $customValues[$locale] = 'test-custom-value-' . $locale;
        }
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValues) {
                $request = request()->merge($oldValues);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name')->value(function ($locale) use ($customValues) {
            return $customValues[$locale];
        })->toHtml();
        foreach ($resolverLocales as $resolverLocale) {
            $this->assertStringContainsString($oldValues['name_' . $resolverLocale] . '</textarea>', $html);
        }
        foreach ($locales as $locale) {
            $this->assertStringNotContainsString($customValues[$locale] . '</textarea>', $html);
        }
    }

    public function testSetLocalizedComponentId()
    {
        $locales = ['fr', 'en'];
        $customComponentId = 'test-custom-component-id';
        $html = $this->getComponent()->name('name')->componentId($customComponentId)->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringContainsString(' for="' . $customComponentId . '-' . $locale . '"', $html);
            $this->assertStringContainsString('<textarea id="' . $customComponentId . '-' . $locale . '"', $html);
        }
    }
}
