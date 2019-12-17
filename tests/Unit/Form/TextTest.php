<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Exception;
use Illuminate\Support\MessageBag;
use InvalidArgumentException;
use Okipa\LaravelBootstrapComponents\Form\InputMultilingual;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\MultilingualResolver;
use Okipa\LaravelBootstrapComponents\Test\Fakers\UsersFaker;
use Okipa\LaravelBootstrapComponents\Test\Models\User;

class TextTest extends BootstrapComponentsTestCase
{
    use UsersFaker;

    public function testConfigStructure()
    {
        // components.form
        $this->assertTrue(array_key_exists('text', config('bootstrap-components.form')));
        // components.form.text
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.form.text')));
        $this->assertTrue(array_key_exists('prepend', config('bootstrap-components.form.text')));
        $this->assertTrue(array_key_exists('append', config('bootstrap-components.form.text')));
        $this->assertTrue(array_key_exists('labelPositionedAbove', config('bootstrap-components.form.text')));
        $this->assertTrue(array_key_exists('legend', config('bootstrap-components.form.text')));
        $this->assertTrue(array_key_exists('classes', config('bootstrap-components.form.text')));
        $this->assertTrue(array_key_exists('htmlAttributes', config('bootstrap-components.form.text')));
        // components.form.text.classes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.text.classes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.text.classes')));
        // components.form.text.htmlAttributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.text.htmlAttributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.text.htmlAttributes')));
        // components.form.text.formValidation
        $this->assertTrue(array_key_exists('displaySuccess', config('bootstrap-components.form.text.formValidation')));
        $this->assertTrue(array_key_exists('displayFailure', config('bootstrap-components.form.text.formValidation')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(InputMultilingual::class, get_parent_class(bsText()));
    }

    public function testName()
    {
        $html = bsText()->name('name')->toHtml();
        $this->assertStringContainsString(' name="name"', $html);
    }

    public function testType()
    {
        $html = bsText()->name('name')->toHtml();
        $this->assertStringContainsString(' type="text"', $html);
    }

    public function testInputWithoutName()
    {
        $this->expectException(Exception::class);
        bsText()->toHtml();
    }

    public function testModelValue()
    {
        $user = $this->createUniqueUser();
        $html = bsText()->model($user)->name('name')->toHtml();
        $this->assertStringContainsString(' value="' . $user->name . '"', $html);
    }

    public function testConfigPrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.form.text.prepend', $configPrepend);
        $html = bsText()->name('name')->toHtml();
        $this->assertStringContainsString('input-group-prepend', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $configPrepend . '</span>', $html);
    }

    public function testSetPrepend()
    {
        $configPrepend = 'test-config-prepend';
        $customPrepend = 'test-custom-prepend';
        config()->set('bootstrap-components.form.text.prepend', $configPrepend);
        $html = bsText()->name('name')->prepend($customPrepend)->toHtml();
        $this->assertStringContainsString('input-group-prepend', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $customPrepend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="input-group-text">' . $configPrepend . '</span>', $html);
    }

    public function testNoPrepend()
    {
        config()->set('bootstrap-components.form.text.prepend', null);
        $html = bsText()->name('name')->toHtml();
        $this->assertStringNotContainsString('input-group-prepend', $html);
    }

    public function testHidePrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.form.text.prepend', $configPrepend);
        $html = bsText()->name('name')->prepend(false)->toHtml();
        $this->assertStringNotContainsString('input-group-prepend', $html);
    }

    public function testConfigAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.text.append', $configAppend);
        $html = bsText()->name('name')->toHtml();
        $this->assertStringContainsString('input-group-append', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $configAppend . '</span>', $html);
    }

    public function testSetAppend()
    {
        $configAppend = 'test-config-append';
        $customAppend = 'test-custom-append';
        config()->set('bootstrap-components.form.text.append', $configAppend);
        $html = bsText()->name('name')->append($customAppend)->toHtml();
        $this->assertStringContainsString('input-group-append', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $customAppend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="input-group-text">' . $configAppend . '</span>', $html);
    }

    public function testNoAppend()
    {
        config()->set('bootstrap-components.form.text.append', null);
        $html = bsText()->name('name')->toHtml();
        $this->assertStringNotContainsString('input-group-append', $html);
    }

    public function testHideAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.text.append', $configAppend);
        $html = bsText()->name('name')->append(false)->toHtml();
        $this->assertStringNotContainsString('input-group-append', $html);
    }

    public function testNoPrependNoAppend()
    {
        config()->set('bootstrap-components.form.text.prepend', null);
        config()->set('bootstrap-components.form.text.append', null);
        $html = bsText()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div class="input-group">', $html);
    }

    public function testHidePrependHideAppend()
    {
        $configPrepend = 'test-config-prepend';
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.text.prepend', $configPrepend);
        config()->set('bootstrap-components.form.text.append', $configAppend);
        $html = bsText()->name('name')->prepend(false)->append(false)->toHtml();
        $this->assertStringNotContainsString('<div class="input-group">', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.text.legend', $configLegend);
        $html = bsText()->name('name')->toHtml();
        $this->assertStringContainsString('text-name-legend', $html);
        $this->assertStringContainsString('bootstrap-components::' . $configLegend, $html);
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.form.text.legend', $configLegend);
        $html = bsText()->name('name')->legend($customLegend)->toHtml();
        $this->assertStringContainsString('text-name-legend', $html);
        $this->assertStringContainsString($customLegend, $html);
        $this->assertStringNotContainsString($configLegend, $html);
    }

    public function testSetTranslatedLegend()
    {
        $legend = 'bootstrap-components::bootstrap-components.label.validate';
        $html = bsText()->name('name')->legend($legend)->toHtml();
        $this->assertStringContainsString(__($legend), $html);
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.form.text.legend', null);
        $html = bsText()->name('name')->toHtml();
        $this->assertStringNotContainsString('text-name-legend', $html);
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.text.legend', $configLegend);
        $html = bsText()->name('name')->legend(false)->toHtml();
        $this->assertStringNotContainsString('text-name-legend', $html);
    }

    public function testSetValue()
    {
        $customValue = 'test-custom-value';
        $html = bsText()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString(' value="' . $customValue . '"', $html);
    }

    public function testOldValue()
    {
        $oldValue = 'test-old-value';
        $customValue = 'test-custom-value';
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValue) {
                $request = request()->merge(['name' => $oldValue]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = bsText()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString(' value="' . $oldValue . '"', $html);
        $this->assertStringNotContainsString(' value="' . $customValue . '"', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsText()->name('name')->label($label)->toHtml();
        $this->assertStringContainsString('<label for="text-name">' . $label . '</label>', $html);
        $this->assertStringContainsString(' placeholder="' . $label . '"', $html);
        $this->assertStringContainsString(' aria-labelledby="' . $label . '"', $html);
    }

    public function testSetTranslatedLabel()
    {
        $label = 'bootstrap-components::bootstrap-components.label.validate';
        $html = bsText()->name('name')->label($label)->toHtml();
        $this->assertStringContainsString('<label for="text-name">' . __($label) . '</label>', $html);
        $this->assertStringContainsString(' placeholder="' . __($label) . '"', $html);
        $this->assertStringContainsString(' aria-labelledby="' . __($label) . '"', $html);
    }

    public function testNoLabel()
    {
        $html = bsText()->name('name')->toHtml();
        $this->assertStringContainsString(
            '<label for="text-name">validation.attributes.name</label>',
            $html
        );
        $this->assertStringContainsString(
            ' aria-labelledby="validation.attributes.name"',
            $html
        );
    }

    public function testHideLabel()
    {
        $html = bsText()->name('name')->label(false)->toHtml();
        $this->assertStringNotContainsString(
            '<label for="text-name">validation.attributes.name</label>',
            $html
        );
        $this->assertStringNotContainsString(
            ' aria-labelledby="validation.attributes.name"',
            $html
        );
    }

    public function testConfigLabelPositionedAbove()
    {
        config()->set('bootstrap-components.form.text.labelPositionedAbove', true);
        $html = bsText()->name('name')->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        $this->assertLessThan($inputPosition, $labelPosition);
    }

    public function testConfigLabelPositionedUnder()
    {
        config()->set('bootstrap-components.form.text.labelPositionedAbove', false);
        $html = bsText()->name('name')->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        $this->assertLessThan($labelPosition, $inputPosition);
    }

    public function testLabelPositionedAbove()
    {
        config()->set('bootstrap-components.form.text.labelPositionedAbove', false);
        $html = bsText()->name('name')->labelPositionedAbove()->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        $this->assertLessThan($inputPosition, $labelPosition);
    }

    public function testLabelPositionedUnder()
    {
        config()->set('bootstrap-components.form.text.labelPositionedAbove', true);
        $html = bsText()->name('name')->labelPositionedAbove(false)->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        $this->assertLessThan($labelPosition, $inputPosition);
    }

    public function testSetPlaceholder()
    {
        $placeholder = 'test-custom-placeholder';
        $html = bsText()->name('name')->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString(' placeholder="' . $placeholder . '"', $html);
    }

    public function testSetTranslatedPlaceholder()
    {
        $placeholder = 'bootstrap-components::bootstrap-components.label.validate';
        $html = bsText()->name('name')->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString(' placeholder="' . __($placeholder) . '"', $html);
    }

    public function testSetPlaceholderWithLabel()
    {
        $label = 'test-custom-label';
        $placeholder = 'test-custom-placeholder';
        $html = bsText()->name('name')->label($label)->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString(' placeholder="' . $placeholder . '"', $html);
    }

    public function testNoPlaceholder()
    {
        $html = bsText()->name('name')->toHtml();
        $this->assertStringContainsString(' placeholder="validation.attributes.name"', $html);
    }

    public function testNoPlaceholderWithNoLabel()
    {
        $html = bsText()->name('name')->label(false)->toHtml();
        $this->assertStringContainsString(' placeholder="validation.attributes.name"', $html);
    }

    public function testHidePlaceholder()
    {
        $html = bsText()->name('name')->placeholder(false)->toHtml();
        $this->assertStringNotContainsString(' placeholder="', $html);
    }

    public function testConfigDisplaySuccess()
    {
        config()->set('bootstrap-components.form.text.formValidation.displaySuccess', true);
        $errors = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsText()->name('name')->render(compact('errors'));
        $this->assertStringContainsString('is-valid', $html);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testConfigDoNotDisplaySuccess()
    {
        config()->set('bootstrap-components.form.text.formValidation.displaySuccess', false);
        $errors = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsText()->name('name')->render(compact('errors'));
        $this->assertStringNotContainsString('is-valid', $html);
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringNotContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testDisplaySuccess()
    {
        config()->set('bootstrap-components.form.text.formValidation.displaySuccess', false);
        $errors = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsText()->name('name')->displaySuccess()->render(compact('errors'));
        $this->assertStringContainsString('is-valid', $html);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testDoNotDisplaySuccess()
    {
        config()->set('bootstrap-components.form.text.formValidation.displaySuccess', true);
        $errors = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsText()->name('name')->displaySuccess(false)->render(compact('errors'));
        $this->assertStringNotContainsString('is-valid', $html);
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringNotContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testConfigDisplayFailure()
    {
        config()->set('bootstrap-components.form.text.formValidation.displayFailure', true);
        $errors = app(MessageBag::class)->add('name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsText()->name('name')->render(compact('errors'));
        $this->assertStringContainsString('is-invalid', $html);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errors->first('name'), $html);
    }

    public function testConfigDoNotDisplayFailure()
    {
        config()->set('bootstrap-components.form.text.formValidation.displayFailure', false);
        $errors = app(MessageBag::class)->add('name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsText()->name('name')->render(compact('errors'));
        $this->assertStringNotContainsString('is-invalid', $html);
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringNotContainsString($errors->first('name'), $html);
    }

    public function testDisplayFailure()
    {
        config()->set('bootstrap-components.form.text.formValidation.displayFailure', false);
        $errors = app(MessageBag::class)->add('name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsText()->name('name')->displayFailure()->render(compact('errors'));
        $this->assertStringContainsString('is-invalid', $html);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errors->first('name'), $html);
    }

    public function testDoNotDisplayFailure()
    {
        config()->set('bootstrap-components.form.text.formValidation.displayFailure', true);
        $errors = app(MessageBag::class)->add('name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsText()->name('name')->displayFailure(false)->render(compact('errors'));
        $this->assertStringNotContainsString('is-invalid', $html);
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringNotContainsString($errors->first('name'), $html);
    }

    public function testSetNoContainerId()
    {
        $html = bsText()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = bsText()->name('name')->containerId($customContainerId)->toHtml();
        $this->assertStringContainsString('<div id="' . $customContainerId . '"', $html);
    }

    public function testSetNoComponentId()
    {
        $html = bsText()->name('name')->toHtml();
        $this->assertStringContainsString(' for="text-name"', $html);
        $this->assertStringContainsString('<input id="text-name"', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = bsText()->name('name')->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString(' for="' . $customComponentId . '"', $html);
        $this->assertStringContainsString('<input id="' . $customComponentId . '"', $html);
    }

    public function testConfigContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        config()->set('bootstrap-components.form.text.classes.container', [$configContainerClasses]);
        $html = bsText()->name('name')->toHtml();
        $this->assertStringContainsString(
            ' class="text-name-container ' . $configContainerClasses . '"',
            $html
        );
    }

    public function testSetContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        $customContainerClasses = 'test-custom-class-container';
        config()->set('bootstrap-components.form.text.classes.container', [$configContainerClasses]);
        $html = bsText()->name('name')->containerClasses([$customContainerClasses])->toHtml();
        $this->assertStringContainsString(
            ' class="text-name-container ' . $customContainerClasses . '"',
            $html
        );
        $this->assertStringNotContainsString(
            ' class="text-name-container ' . $configContainerClasses . '"',
            $html
        );
    }

    public function testConfigComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        config()->set('bootstrap-components.form.text.classes.component', [$configComponentClasses]);
        $html = bsText()->name('name')->toHtml();
        $this->assertStringContainsString(
            ' class="form-control text-name-component ' . $configComponentClasses . '"',
            $html
        );
    }

    public function testSetComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        $customComponentClasses = 'test-custom-class-component';
        config()->set('bootstrap-components.form.text.classes.component', [$customComponentClasses]);
        $html = bsText()->name('name')->componentClasses([$customComponentClasses])->toHtml();
        $this->assertStringContainsString(
            ' class="form-control text-name-component ' . $customComponentClasses . '"',
            $html
        );
        $this->assertStringNotContainsString(
            ' class="form-control text-name-component ' . $configComponentClasses . '"',
            $html
        );
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.text.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsText()->name('name')->toHtml();
        $this->assertStringContainsString($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.text.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsText()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertStringContainsString($customContainerAttributes, $html);
        $this->assertStringNotContainsString($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.text.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsText()->name('name')->toHtml();
        $this->assertStringContainsString($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.text.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsText()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertStringContainsString($customComponentAttributes, $html);
        $this->assertStringNotContainsString($configComponentAttributes, $html);
    }

    public function testSetDefaultLocalesFromCustomMultilingualResolver()
    {
        config()->set('bootstrap-components.form.multilingual.resolver', MultilingualResolver::class);
        $resolverLocales = (new MultilingualResolver)->getDefaultLocales();
        $html = bsText()->name('name')->toHtml();
        foreach ($resolverLocales as $locale) {
            $this->assertStringContainsString('class="text-name-' . $locale . '-container', $html);
        }
    }

    public function testSetLocales()
    {
        config()->set('bootstrap-components.form.multilingual.resolver', MultilingualResolver::class);
        $resolverLocales = (new MultilingualResolver)->getDefaultLocales();
        $locales = ['fr', 'it', 'be'];
        config()->set('bootstrap-components.form.text.locales', []);
        $html = bsText()->name('name')->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringContainsString('class="text-name-' . $locale . '-container', $html);
        }
        foreach ($resolverLocales as $locale) {
            $this->assertStringNotContainsString('class="text-name-' . $locale . '-container', $html);
        }
    }

    public function testSetSingleLocale()
    {
        $locales = ['fr'];
        config()->set('bootstrap-components.form.text.locales', ['fr']);
        $html = bsText()->name('name')->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringContainsString('class="text-name-container', $html);
            $this->assertStringNotContainsString('class="text-name-' . $locale . '-container', $html);
        }
    }

    public function testLocalizedName()
    {
        $locales = ['fr', 'en'];
        $html = bsText()->name('name')->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringContainsString('name="name[' . $locale . ']"', $html);
        }
    }

    public function testLocalizedNameFromCustomMultilingualResolver()
    {
        config()->set('bootstrap-components.form.multilingual.resolver', MultilingualResolver::class);
        $resolverLocales = (new MultilingualResolver)->getDefaultLocales();
        $html = bsText()->name('name')->toHtml();
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
        $html = bsText()->model($user)->name('name')->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringContainsString('value="' . $user->name[$locale] . '"', $html);
        }
    }

    public function testLocalizedModelValueFromCustomMultilingualResolver()
    {
        $user = new User(['name_fr' => $this->faker->word, 'name_en' => $this->faker->word]);
        config()->set('bootstrap-components.form.multilingual.resolver', MultilingualResolver::class);
        $resolverLocales = (new MultilingualResolver)->getDefaultLocales();
        $html = bsText()->model($user)->name('name')->toHtml();
        foreach ($resolverLocales as $resolverLocale) {
            $this->assertStringContainsString('value="' . $user->{'name_' . $resolverLocale} . '"', $html);
        }
    }

    public function testSetLocalizedWrongValue()
    {
        $locales = ['fr', 'en'];
        $customValue = 'test-custom-value';
        $this->expectException(InvalidArgumentException::class);
        bsText()->name('name')->locales($locales)->value($customValue)->toHtml();
    }

    public function testSetLocalizedValue()
    {
        $locales = ['fr', 'en'];
        $customValues = [];
        foreach ($locales as $locale) {
            $customValues[$locale] = 'test-custom-value-' . $locale;
        }
        $html = bsText()->name('name')->locales($locales)->value(function ($locale) use ($customValues) {
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
        $html = bsText()->name('name')->locales($locales)->value(function ($locale) use ($customValues) {
            return $customValues . '-' . $locale;
        })->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringContainsString(' value="' . $oldValues[$locale] . '"', $html);
            $this->assertStringNotContainsString(' value="' . $customValues[$locale] . '"', $html);
        }
    }

    public function testLocalizedOldValueFromCustomMultilingualResolver()
    {
        config()->set('bootstrap-components.form.multilingual.resolver', MultilingualResolver::class);
        $resolverLocales = (new MultilingualResolver)->getDefaultLocales();
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
        $html = bsText()->name('name')->value(function ($locale) use ($customValues) {
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
        $html = bsText()->name('name')->label($label)->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringContainsString(
                '<label for="text-name-' . $locale . '">' . $label . ' (' . strtoupper($locale) . ')</label>',
                $html
            );
            $this->assertStringContainsString(' placeholder="' . $label . ' (' . strtoupper($locale) . ')"', $html);
            $this->assertStringContainsString(' aria-labelledby="' . $label . ' (' . strtoupper($locale) . ')"', $html);
        }
    }

    public function testSetLocalizedPlaceholder()
    {
        $locales = ['fr', 'en'];
        $placeholder = 'test-custom-placeholder';
        $html = bsText()->name('name')->placeholder($placeholder)->locales($locales)->toHtml();
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
        $html = bsText()->name('name')->componentId($customComponentId)->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringContainsString(' for="' . $customComponentId . '-' . $locale . '"', $html);
            $this->assertStringContainsString('<input id="' . $customComponentId . '-' . $locale . '"', $html);
        }
    }

    public function testSetLocalizedNoContainerId()
    {
        $locales = ['fr', 'en'];
        $html = bsText()->name('name')->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringContainsString('<div id="text-name-' . $locale . '-container"', $html);
        }
    }

    public function testSetLocalizedContainerId()
    {
        $locales = ['fr', 'en'];
        $customContainerId = 'test-custom-container-id';
        $html = bsText()->name('name')->containerId($customContainerId)->locales($locales)->toHtml();
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
        $html = bsText()->name('name')->locales($locales)->displayFailure()->render(compact('errors'));
        $this->assertStringContainsString('text-name-fr-component is-invalid', $html);
        $this->assertStringContainsString('Dummy ' . _('validation.attributes.name') . ' (FR) error message.', $html);
        $this->assertStringNotContainsString('text-name-en-component is-invalid', $html);
        $this->assertStringNotContainsString(
            'Dummy ' . _('validation.attributes.name') . ' (EN) error message.',
            $html
        );
    }

    public function testLocalizedErrorMessageFromCustomMultilingualResolver()
    {
        config()->set('bootstrap-components.form.multilingual.resolver', MultilingualResolver::class);
        $errors = app(MessageBag::class);
        $errors->add('name_en', 'Dummy name_en error message.');
        session()->put('errors', $errors);
        $html = bsText()->name('name')->displayFailure()->render(compact('errors'));
        $this->assertStringContainsString('text-name-en-component is-invalid', $html);
        $this->assertStringContainsString('Dummy ' . _('validation.attributes.name') . ' (EN) error message.', $html);
        $this->assertStringNotContainsString('text-name-de-component is-invalid', $html);
        $this->assertStringNotContainsString(
            'Dummy ' . _('validation.attributes.name') . ' (DE) error message.',
            $html
        );
    }
}
