<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\MultilingualAbstract;
use Okipa\LaravelBootstrapComponents\Tests\Dummy\Resolver;
use Okipa\LaravelBootstrapComponents\Tests\Models\User;

abstract class InputMultilingualTestAbstract extends InputTestAbstract
{
    /** @test */
    public function it_can_return_instance_from_helper(): void
    {
        self::assertInstanceOf(MultilingualAbstract::class, $this->getHelper());
    }

    /** @test */
    public function it_can_return_instance_from_facade(): void
    {
        self::assertInstanceOf(MultilingualAbstract::class, $this->getFacade());
    }

    /** @test */
    public function it_can_return_multilingual_instance_from_extended_testing_class(): void
    {
        self::assertInstanceOf(MultilingualAbstract::class, $this->getComponent());
    }

    /** @test */
    public function it_can_set_default_locales_from_custom_multilingual_resolver(): void
    {
        config()->set('bootstrap-components.form.multilingualResolver', Resolver::class);
        $resolverLocales = (new Resolver())->getDefaultLocales();
        $html = $this->getComponent()->name('name')->toHtml();
        foreach ($resolverLocales as $resolverLocale) {
            self::assertStringContainsString('data-locale="' . $resolverLocale . '"', $html);
        }
    }

    /** @test */
    public function it_can_replace_default_locales(): void
    {
        config()->set('bootstrap-components.form.multilingualResolver', Resolver::class);
        $resolverLocales = (new Resolver())->getDefaultLocales();
        $locales = ['fr', 'it', 'be'];
        config()->set('bootstrap-components.form.text.locales', []);
        $html = $this->getComponent()->name('name')->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            self::assertStringContainsString('data-locale="' . $locale . '"', $html);
        }
        foreach ($resolverLocales as $resolverLocale) {
            self::assertStringNotContainsString('data-locale="' . $resolverLocale . '"', $html);
        }
    }

    /** @test */
    public function it_can_set_single_locale(): void
    {
        $locales = ['fr'];
        config()->set('bootstrap-components.form.text.locales', ['fr']);
        $html = $this->getComponent()->name('name')->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            self::assertStringNotContainsString('data-locale="' . $locale . '"', $html);
        }
    }

    /** @test */
    public function it_can_set_localized_name(): void
    {
        $locales = ['fr', 'en'];
        $html = $this->getComponent()->name('name')->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            self::assertStringContainsString('name="name[' . $locale . ']"', $html);
        }
    }

    /** @test */
    public function it_can_set_localized_name_from_custom_multilingual_resolver(): void
    {
        config()->set('bootstrap-components.form.multilingualResolver', Resolver::class);
        $resolverLocales = (new Resolver())->getDefaultLocales();
        $html = $this->getComponent()->name('name')->toHtml();
        foreach ($resolverLocales as $resolverLocale) {
            self::assertStringContainsString('name="name_' . $resolverLocale . '"', $html);
        }
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
            self::assertStringContainsString('value="' . $user->name[$locale] . '"', $html);
        }
    }

    /** @test */
    public function it_can_take_localized_model_value_from_custom_multilingual_resolver(): void
    {
        $user = new User(['name_fr' => $this->faker->word, 'name_en' => $this->faker->word]);
        config()->set('bootstrap-components.form.multilingualResolver', Resolver::class);
        $resolverLocales = (new Resolver())->getDefaultLocales();
        $html = $this->getComponent()->model($user)->name('name')->toHtml();
        foreach ($resolverLocales as $resolverLocale) {
            self::assertStringContainsString('value="' . $user->{'name_' . $resolverLocale} . '"', $html);
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
            ->value(fn($locale) => $values[$locale])
            ->toHtml();
        foreach ($locales as $locale) {
            self::assertStringContainsString(' value="' . $values[$locale] . '"', $html);
        }
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
        $html = $this->getComponent()->name('name')->locales($locales)->value(function ($locale) use ($values) {
            return $values . '-' . $locale;
        })->toHtml();
        foreach ($locales as $locale) {
            self::assertStringContainsString(' value="' . $oldValues[$locale] . '"', $html);
            self::assertStringNotContainsString(' value="' . $values[$locale] . '"', $html);
        }
    }

    /** @test */
    public function it_can_take_old_value_from_null(): void
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
        $html = $this->getComponent()
            ->name('name')
            ->locales($locales)
            ->value(fn($locale) => $values[$locale])
            ->toHtml();
        foreach ($locales as $locale) {
            self::assertStringContainsString(' value="' . $oldValues[$locale] . '"', $html);
            self::assertStringNotContainsString(' value="' . $values[$locale] . '"', $html);
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
            $values[$locale] = 'custom-value-' . $locale;
        }
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge($oldValues)->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name')->value(fn($locale) => $values[$locale])->toHtml();
        foreach ($resolverLocales as $resolverLocale) {
            self::assertStringContainsString('value="' . $oldValues['name_' . $resolverLocale] . '"', $html);
        }
        foreach ($locales as $locale) {
            self::assertStringNotContainsString('value="' . $values[$locale] . '"', $html);
        }
    }

    /** @test */
    public function it_can_set_localized_prepend(): void
    {
        $locales = ['fr', 'en'];
        $html = $this->getComponent()
            ->name('name')
            ->locales($locales)
            ->prepend(fn($locale) => 'prepend-' . $locale)
            ->toHtml();
        foreach ($locales as $locale) {
            self::assertStringContainsString('<span class="input-group-text">prepend-' . $locale . '</span>', $html);
        }
    }

    /** @test */
    public function it_can_set_localized_append(): void
    {
        $locales = ['fr', 'en'];
        $html = $this->getComponent()
            ->name('name')
            ->locales($locales)
            ->append(function ($locale) {
                return 'append-' . $locale;
            })
            ->toHtml();
        foreach ($locales as $locale) {
            self::assertStringContainsString('<span class="input-group-text">append-' . $locale . '</span>', $html);
        }
    }

    /** @test */
    public function it_can_set_localized_label(): void
    {
        $locales = ['fr', 'en'];
        $label = 'custom-label';
        $html = $this->getComponent()->name('name')->label($label)->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            self::assertStringContainsString(
                '<label for="' . $this->getComponentType() . '-name-' . $locale . '">' . $label . ' ('
                . mb_strtoupper($locale) . ')</label>',
                $html
            );
            self::assertStringContainsString(' placeholder="' . $label . ' (' . mb_strtoupper($locale) . ')"', $html);
        }
    }

    /** @test */
    public function it_can_set_localized_placeholder(): void
    {
        $locales = ['fr', 'en'];
        $placeholder = 'custom-placeholder';
        $html = $this->getComponent()->name('name')->placeholder($placeholder)->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            self::assertStringContainsString(
                ' placeholder="' . $placeholder . ' (' . mb_strtoupper($locale) . ')"',
                $html
            );
        }
    }

    /** @test */
    public function it_can_set_localized_component_id(): void
    {
        $locales = ['fr', 'en'];
        $customComponentId = 'custom-component-id';
        $html = $this->getComponent()->name('name')->componentId($customComponentId)->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            self::assertStringContainsString(' for="' . $customComponentId . '-' . $locale . '"', $html);
            self::assertStringContainsString('<input id="' . $customComponentId . '-' . $locale . '"', $html);
        }
    }

    /** @test */
    public function it_can_set_localized_container_id(): void
    {
        $locales = ['fr', 'en'];
        $customContainerId = 'custom-container-id';
        $html = $this->getComponent()->name('name')->containerId($customContainerId)->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            self::assertStringContainsString('<div id="' . $customContainerId . '-' . $locale . '"', $html);
        }
    }

    /** @test */
    public function it_can_set_localized_error_message(): void
    {
        $locales = ['fr', 'en'];
        $messageBag = app(MessageBag::class)->add('name.fr', 'Dummy name.fr error message.');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        $html = $this->getComponent()->name('name')->locales($locales)->displayFailure()->render(compact('errors'));
        self::assertStringContainsString(
            'id="' . $this->getComponentType() . '-name-fr" class="component form-control is-invalid"',
            $html
        );
        self::assertStringContainsString('Dummy ' . _('validation.attributes.name') . ' (FR) error message.', $html);
        self::assertStringNotContainsString(
            'id="' . $this->getComponentType() . '-name-en" class="component form-control is-invalid"',
            $html
        );
        self::assertStringNotContainsString(
            'Dummy ' . _('validation.attributes.name') . ' (EN) error message.',
            $html
        );
    }

    /** @test */
    public function it_can_set_localized_error_message_with_several_words(): void
    {
        $locales = ['fr', 'en'];
        $messageBag = app(MessageBag::class)->add('last_name.fr', 'Dummy last name.fr error message.');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        $html = $this->getComponent()
            ->name('last_name')
            ->locales($locales)
            ->displayFailure()
            ->render(compact('errors'));
        self::assertStringContainsString(
            'id="' . $this->getComponentType() . '-last-name-fr" class="component form-control is-invalid"',
            $html
        );
        self::assertStringContainsString(
            'Dummy ' . _('validation.attributes.last_name') . ' (FR) error message.',
            $html
        );
        self::assertStringNotContainsString(
            'id="' . $this->getComponentType() . '-last-name-en" class="component form-control is-invalid"',
            $html
        );
        self::assertStringNotContainsString(
            'Dummy ' . _('validation.attributes.last_name') . ' (EN) error message.',
            $html
        );
    }

    /** @test */
    public function it_can_set_localized_error_message_with_several_words_and_custom_multilingual_resolver(): void
    {
        config()->set('bootstrap-components.form.multilingualResolver', Resolver::class);
        $locales = ['fr', 'en'];
        $messageBag = app(MessageBag::class)->add('last_name_fr', 'Dummy last name fr error message.');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        $html = $this->getComponent()
            ->name('last_name')
            ->locales($locales)
            ->displayFailure()
            ->render(compact('errors'));
        self::assertStringContainsString(
            'id="' . $this->getComponentType() . '-last-name-fr" class="component form-control is-invalid"',
            $html
        );
        self::assertStringContainsString(
            'Dummy ' . _('validation.attributes.last_name') . ' (FR) error message.',
            $html
        );
        self::assertStringNotContainsString(
            'id="' . $this->getComponentType() . '-last-name-en" class="component form-control is-invalid"',
            $html
        );
        self::assertStringNotContainsString(
            'Dummy ' . _('validation.attributes.last_name') . ' (EN) error message.',
            $html
        );
    }

    /** @test */
    public function it_can_set_localized_error_message_from_custom_multilingual_resolver(): void
    {
        config()->set('bootstrap-components.form.multilingualResolver', Resolver::class);
        $messageBag = app(MessageBag::class)->add('name_en', 'Dummy name_en error message.');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        $html = $this->getComponent()->name('name')->displayFailure()->render(compact('errors'));
        self::assertStringContainsString(
            'id="' . $this->getComponentType() . '-name-en" class="component form-control is-invalid"',
            $html
        );
        self::assertStringContainsString('Dummy ' . _('validation.attributes.name') . ' (EN) error message.', $html);
        self::assertStringNotContainsString(
            'id="' . $this->getComponentType() . '-name-de" class="component form-control is-invalid"',
            $html
        );
        self::assertStringNotContainsString(
            'Dummy ' . _('validation.attributes.name') . ' (DE) error message.',
            $html
        );
    }
}
