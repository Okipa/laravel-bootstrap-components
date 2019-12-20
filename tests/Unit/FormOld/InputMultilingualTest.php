<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Illuminate\Support\MessageBag;
use InvalidArgumentException;
use Okipa\LaravelBootstrapComponents\Form\Abstracts\MultilingualAbstract;
use Okipa\LaravelBootstrapComponents\Tests\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Tests\Fakers\Resolver;
use Okipa\LaravelBootstrapComponents\Tests\Models\User;

class InputMultilingualTest extends BootstrapComponentsTestCase
{
    public function testMultilingualType()
    {
        $this->assertInstanceOf(MultilingualAbstract::class, input()->text());
    }

    public function testSetDefaultLocalesFromCustomMultilingualResolver()
    {
        config()->set('bootstrap-components.form.multilingualResolver', Resolver::class);
        $resolverLocales = (new Resolver)->getDefaultLocales();
        $html = input()->text()->name('name')->toHtml();
        foreach ($resolverLocales as $resolverLocale) {
            $this->assertStringContainsString('data-locale="' . $resolverLocale . '"', $html);
        }
    }

    public function testSetLocales()
    {
        config()->set('bootstrap-components.form.multilingualResolver', Resolver::class);
        $resolverLocales = (new Resolver)->getDefaultLocales();
        $locales = ['fr', 'it', 'be'];
        config()->set('bootstrap-components.form.text.locales', []);
        $html = input()->text()->name('name')->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringContainsString('data-locale="' . $locale . '"', $html);
        }
        foreach ($resolverLocales as $resolverLocale) {
            $this->assertStringNotContainsString('data-locale="' . $resolverLocale . '"', $html);
        }
    }

    public function testSetSingleLocale()
    {
        $locales = ['fr'];
        config()->set('bootstrap-components.form.text.locales', ['fr']);
        $html = input()->text()->name('name')->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringNotContainsString('data-locale="' . $locale . '"', $html);
        }
    }

    public function testLocalizedName()
    {
        $locales = ['fr', 'en'];
        $html = input()->text()->name('name')->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringContainsString('name="name[' . $locale . ']"', $html);
        }
    }

    public function testLocalizedNameFromCustomMultilingualResolver()
    {
        config()->set('bootstrap-components.form.multilingualResolver', Resolver::class);
        $resolverLocales = (new Resolver)->getDefaultLocales();
        $html = input()->text()->name('name')->toHtml();
        foreach ($resolverLocales as $resolverLocale) {
            $this->assertStringContainsString('name="name_' . $resolverLocale . '"', $html);
        }
    }

    public function testLocalizedModelValue()
    {
        $locales = ['fr', 'en'];
        $name = [];
        foreach ($locales as $locale) {
            $name[$locale] = $this->faker->word;
        }
        $user = new User(['name' => $name]);
        $html = input()->text()->model($user)->name('name')->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringContainsString('value="' . $user->name[$locale] . '"', $html);
        }
    }

    public function testLocalizedModelValueFromCustomMultilingualResolver()
    {
        $user = new User(['name_fr' => $this->faker->word, 'name_en' => $this->faker->word]);
        config()->set('bootstrap-components.form.multilingualResolver', Resolver::class);
        $resolverLocales = (new Resolver)->getDefaultLocales();
        $html = input()->text()->model($user)->name('name')->toHtml();
        foreach ($resolverLocales as $resolverLocale) {
            $this->assertStringContainsString('value="' . $user->{'name_' . $resolverLocale} . '"', $html);
        }
    }

    public function testSetLocalizedWrongValue()
    {
        $locales = ['fr', 'en'];
        $customValue = 'test-custom-value';
        $this->expectException(InvalidArgumentException::class);
        input()->text()->name('name')->locales($locales)->value($customValue)->toHtml();
    }

    public function testSetLocalizedValue()
    {
        $locales = ['fr', 'en'];
        $customValues = [];
        foreach ($locales as $locale) {
            $customValues[$locale] = 'test-custom-value-' . $locale;
        }
        $html = input()->text()->name('name')->locales($locales)->value(function ($locale) use ($customValues) {
            return $customValues[$locale];
        })->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringContainsString(' value="' . $customValues[$locale] . '"', $html);
        }
    }

    public function testLocalizedOldValue()
    {
        $locales = ['fr', 'en'];
        $oldValues = [];
        $customValues = [];
        foreach ($locales as $locale) {
            $oldValues[$locale] = 'test-old-value-' . $locale;
            $customValues[$locale] = 'test-custom-value-' . $locale;
        }
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValues) {
                $request = request()->merge(['name' => $oldValues]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = input()->text()->name('name')->locales($locales)->value(function ($locale) use ($customValues) {
            return $customValues . '-' . $locale;
        })->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringContainsString(' value="' . $oldValues[$locale] . '"', $html);
            $this->assertStringNotContainsString(' value="' . $customValues[$locale] . '"', $html);
        }
    }

    public function testLocalizedOldValueFromCustomMultilingualResolver()
    {
        config()->set('bootstrap-components.form.multilingualResolver', Resolver::class);
        $resolverLocales = (new Resolver)->getDefaultLocales();
        $oldValues = [];
        foreach ($resolverLocales as $resolverLocale) {
            $oldValues['name_' . $resolverLocale] = 'test-old-value-' . $resolverLocale;
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
        $html = input()->text()->name('name')->value(function ($locale) use ($customValues) {
            return $customValues[$locale];
        })->toHtml();
        foreach ($resolverLocales as $resolverLocale) {
            $this->assertStringContainsString('value="' . $oldValues['name_' . $resolverLocale] . '"', $html);
        }
        foreach ($locales as $locale) {
            $this->assertStringNotContainsString('value="' . $customValues[$locale] . '"', $html);
        }
    }

    public function testSetLocalizedLabel()
    {
        $locales = ['fr', 'en'];
        $label = 'test-custom-label';
        $html = input()->text()->name('name')->label($label)->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringContainsString(
                '<label for="text-name-' . $locale . '">' . $label . ' (' . strtoupper($locale) . ')</label>',
                $html
            );
            $this->assertStringContainsString(' placeholder="' . $label . ' (' . strtoupper($locale) . ')"', $html);
        }
    }

    public function testSetLocalizedPlaceholder()
    {
        $locales = ['fr', 'en'];
        $placeholder = 'test-custom-placeholder';
        $html = input()->text()->name('name')->placeholder($placeholder)->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringContainsString(
                ' placeholder="' . $placeholder . ' (' . strtoupper($locale) . ')"',
                $html
            );
        }
    }

    public function testSetLocalizedComponentId()
    {
        $locales = ['fr', 'en'];
        $customComponentId = 'test-custom-component-id';
        $html = input()->text()->name('name')->componentId($customComponentId)->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringContainsString(' for="' . $customComponentId . '-' . $locale . '"', $html);
            $this->assertStringContainsString('<input id="' . $customComponentId . '-' . $locale . '"', $html);
        }
    }

    public function testSetLocalizedContainerId()
    {
        $locales = ['fr', 'en'];
        $customContainerId = 'test-custom-container-id';
        $html = input()->text()->name('name')->containerId($customContainerId)->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringContainsString('<div id="' . $customContainerId . '-' . $locale . '"', $html);
        }
    }

    public function testLocalizedErrorMessage()
    {
        $locales = ['fr', 'en'];
        $errors = app(MessageBag::class);
        $errors->add('name.fr', 'Dummy name.fr error message.');
        session()->put('errors', $errors);
        $html = input()->text()->name('name')->locales($locales)->displayFailure()->render(compact('errors'));
        $this->assertStringContainsString('id="text-name-fr" class="component form-control is-invalid"', $html);
        $this->assertStringContainsString('Dummy ' . _('validation.attributes.name') . ' (FR) error message.', $html);
        $this->assertStringNotContainsString('id="text-name-en" class="component form-control is-invalid"', $html);
        $this->assertStringNotContainsString(
            'Dummy ' . _('validation.attributes.name') . ' (EN) error message.',
            $html
        );
    }

    public function testLocalizedErrorMessageFromCustomMultilingualResolver()
    {
        config()->set('bootstrap-components.form.multilingualResolver', Resolver::class);
        $errors = app(MessageBag::class);
        $errors->add('name_en', 'Dummy name_en error message.');
        session()->put('errors', $errors);
        $html = input()->text()->name('name')->displayFailure()->render(compact('errors'));
        $this->assertStringContainsString('id="text-name-en" class="component form-control is-invalid"', $html);
        $this->assertStringContainsString('Dummy ' . _('validation.attributes.name') . ' (EN) error message.', $html);
        $this->assertStringNotContainsString('id="text-name-de" class="component form-control is-invalid"', $html);
        $this->assertStringNotContainsString(
            'Dummy ' . _('validation.attributes.name') . ' (DE) error message.',
            $html
        );
    }
}
