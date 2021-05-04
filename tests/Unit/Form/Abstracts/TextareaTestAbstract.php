<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\Resolver;
use Okipa\LaravelBootstrapComponents\Tests\Models\User;

abstract class TextareaTestAbstract extends InputMultilingualTestAbstract
{
    /** @test */
    public function it_has_correct_type(): void
    {
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString('<textarea', $html);
    }

    /** @test */
    public function it_can_get_value_from_model(): void
    {
        $user = $this->createUniqueUser();
        $html = $this->getComponent()->model($user)->name('name')->toHtml();
        self::assertStringContainsString($user->name . '</textarea>', $html);
    }

    /** @test */
    public function it_can_set_value(): void
    {
        $html = $this->getComponent()->name('name')->value('custom-value')->toHtml();
        self::assertStringContainsString('>custom-value</textarea>', $html);
    }

    /** @test */
    public function it_can_set_zero_value(): void
    {
        $html = $this->getComponent()->name('name')->value(0)->toHtml();
        self::assertStringContainsString('>0</textarea>', $html);
    }

    /** @test */
    public function it_can_set_empty_string_value(): void
    {
        $html = $this->getComponent()->name('name')->value('')->toHtml();
        self::assertStringContainsString('></textarea>', $html);
    }

    /** @test */
    public function it_can_set_null_value(): void
    {
        $html = $this->getComponent()->name('name')->value(null)->toHtml();
        self::assertStringContainsString('></textarea>', $html);
    }

    /** @test */
    public function it_can_set_value_from_closure_with_disabled_multilingual(): void
    {
        $html = $this->getComponent()->name('name')->value(function ($locale) {
            return 'closure-value-' . $locale;
        })->toHtml();
        self::assertStringContainsString('>closure-value-' . app()->getLocale() . '</textarea>', $html);
    }

    /** @test */
    public function it_can_take_old_value_from_string(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['name' => 'old-value'])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name')->value('custom-value')->toHtml();
        self::assertStringContainsString('old-value</textarea>', $html);
        self::assertStringNotContainsString('custom-value</textarea>', $html);
    }

    /** @test */
    public function it_can_take_old_value_from_null(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['name' => null])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name')->value('custom-value')->toHtml();
        self::assertStringContainsString('></textarea>', $html);
        self::assertStringNotContainsString('custom-value</textarea>', $html);
    }

    /** @test */
    public function it_can_take_old_value_from_array(): void
    {
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['name' => ['old-value']])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name[0]')->value('custom-value')->toHtml();
        self::assertStringContainsString('old-value</textarea>', $html);
        self::assertStringNotContainsString('custom-value</textarea>', $html);
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
        $inputPosition = strrpos($html, '<textarea');
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
        $inputPosition = strrpos($html, '<textarea');
        self::assertLessThan($inputPosition, $labelPosition);
    }

    /** @test */
    public function it_can_generate_default_component_id(): void
    {
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString(' for="' . $this->getComponentType() . '-name"', $html);
        self::assertStringContainsString('<textarea id="' . $this->getComponentType() . '-name"', $html);
    }

    /** @test */
    public function it_can_generate_default_component_id_from_array_name(): void
    {
        $html = $this->getComponent()->name('name[0]')->toHtml();
        self::assertStringContainsString(' for="' . $this->getComponentType() . '-name-0"', $html);
        self::assertStringContainsString('<textarea id="' . $this->getComponentType() . '-name-0"', $html);
    }

    /** @test */
    public function it_can_generate_default_component_id_from_string_name_with_specific_format(): void
    {
        $html = $this->getComponent()->name('camelCaseName')->toHtml();
        self::assertStringContainsString(' for="' . $this->getComponentType() . '-camel-case-name"', $html);
        self::assertStringContainsString('<textarea id="' . $this->getComponentType() . '-camel-case-name"', $html);
    }

    /** @test */
    public function it_can_set_component_id(): void
    {
        $customComponentId = 'custom-component-id';
        $html = $this->getComponent()->name('name')->componentId($customComponentId)->toHtml();
        self::assertStringContainsString(' for="' . $customComponentId . '"', $html);
        self::assertStringContainsString('<textarea id="' . $customComponentId . '"', $html);
    }

    /** @test */
    public function it_can_take_localized_model_value(): void
    {
        $locales = ['fr', 'en'];
        $name = [];
        foreach ($locales as $locale) {
            $name[$locale] = $this->faker->word;
        }
        $user = new User(['name' => $name]);
        $html = $this->getComponent()->model($user)->name('name')->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            self::assertStringContainsString('>' . $user->name[$locale] . '</textarea>', $html);
        }
    }

    /** @test */
    public function it_can_keep_null_localized_value(): void
    {
        $name = ['fr' => 'Test FR'];
        $user = new User(compact('name'));
        $html = $this->getComponent()->model($user)->name('name')->locales(['fr', 'en'])->toHtml();
        self::assertStringContainsString('data-locale="fr">Test FR</textarea>', $html);
        self::assertStringContainsString('data-locale="en"></textarea>', $html);
    }

    /** @test */
    public function it_can_take_localized_old_value(): void
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
            self::assertStringContainsString('>' . $oldValues[$locale] . '</textarea>', $html);
            self::assertStringNotContainsString('>' . $values[$locale] . '</textarea>', $html);
        }
    }

    /** @test */
    public function it_can_take_localized_old_null_value(): void
    {
        $locales = ['fr', 'en'];
        $oldValues = [];
        $values = [];
        foreach ($locales as $locale) {
            $oldValues[$locale] = null;
            $values[$locale] = 'custom-value-' . $locale;
        }
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['name' => $oldValues])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name')->locales($locales)->value(function ($locale) use ($values) {
            return $values . '-' . $locale;
        })->toHtml();
        self::assertEquals(2, Str::substrCount($html, '></textarea>'));
    }

    /** @test */
    public function it_can_take_localized_model_value_from_custom_multilingual_resolver(): void
    {
        $user = new User(['name_fr' => $this->faker->word, 'name_en' => $this->faker->word]);
        config()->set('bootstrap-components.form.multilingualResolver', Resolver::class);
        $resolverLocales = (new Resolver())->getDefaultLocales();
        $html = $this->getComponent()->model($user)->name('name')->toHtml();
        foreach ($resolverLocales as $resolverLocale) {
            self::assertStringContainsString($user->{'name_' . $resolverLocale} . '</textarea>', $html);
        }
    }

    /** @test */
    public function it_can_set_localized_value(): void
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
            self::assertStringContainsString('>' . $values[$locale] . '</textarea>', $html);
        }
    }

    /** @test */
    public function it_can_take_localized_old_value_from_custom_multilingual_resolver(): void
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
            self::assertStringContainsString('>' . $oldValues['name_' . $resolverLocale] . '</textarea>', $html);
        }
        foreach ($locales as $locale) {
            self::assertStringNotContainsString('>' . $values[$locale] . '</textarea>', $html);
        }
    }

    /** @test */
    public function it_can_set_localized_component_id(): void
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
