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

class TextareaTest extends BootstrapComponentsTestCase
{
    use UsersFaker;

    public function testConfigStructure()
    {
        // components.form
        $this->assertTrue(array_key_exists('textarea', config('bootstrap-components.form')));
        // components.form.textarea
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.form.textarea')));
        $this->assertTrue(array_key_exists('prepend', config('bootstrap-components.form.textarea')));
        $this->assertTrue(array_key_exists('append', config('bootstrap-components.form.textarea')));
        $this->assertTrue(array_key_exists('labelPositionedAbove', config('bootstrap-components.form.textarea')));
        $this->assertTrue(array_key_exists('legend', config('bootstrap-components.form.textarea')));
        $this->assertTrue(array_key_exists('classes', config('bootstrap-components.form.textarea')));
        $this->assertTrue(array_key_exists('htmlAttributes', config('bootstrap-components.form.textarea')));
        // components.form.textarea.classes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.textarea.classes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.textarea.classes')));
        // components.form.textarea.htmlAttributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.textarea.htmlAttributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.textarea.htmlAttributes')));
        // components.form.textarea.formValidation
        $this->assertTrue(array_key_exists(
            'displaySuccess',
            config('bootstrap-components.form.textarea.formValidation')
        ));
        $this->assertTrue(array_key_exists(
            'displayFailure',
            config('bootstrap-components.form.textarea.formValidation')
        ));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(InputMultilingual::class, get_parent_class(bsTextarea()));
    }

    public function testSetName()
    {
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringContainsString(' name="name"', $html);
    }

    public function testType()
    {
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringContainsString('<textarea', $html);
    }

    public function testInputWithoutName()
    {
        $this->expectException(Exception::class);
        bsTextarea()->toHtml();
    }

    public function testModelValue()
    {
        $user = $this->createUniqueUser();
        $html = bsTextarea()->model($user)->name('name')->toHtml();
        $this->assertStringContainsString(
            ' aria-describedby="textarea-name">' . $user->name . '</textarea>',
            $html
        );
    }

    public function testConfigPrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.form.textarea.prepend', $configPrepend);
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringContainsString('input-group-prepend', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $configPrepend . '</span>', $html);
    }

    public function testSetPrepend()
    {
        $configPrepend = 'test-config-prepend';
        $customPrepend = 'test-custom-prepend';
        config()->set('bootstrap-components.form.textarea.prepend', $configPrepend);
        $html = bsTextarea()->name('name')->prepend($customPrepend)->toHtml();
        $this->assertStringContainsString('input-group-prepend', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $customPrepend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="input-group-text">' . $configPrepend . '</span>', $html);
    }

    public function testNoPrepend()
    {
        config()->set('bootstrap-components.form.textarea.prepend', null);
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringNotContainsString('input-group-prepend', $html);
    }

    public function testHidePrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.form.textarea.prepend', $configPrepend);
        $html = bsTextarea()->name('name')->prepend(false)->toHtml();
        $this->assertStringNotContainsString('input-group-prepend', $html);
    }

    public function testConfigAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.textarea.append', $configAppend);
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringContainsString('input-group-append', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $configAppend . '</span>', $html);
    }

    public function testSetAppend()
    {
        $configAppend = 'test-config-append';
        $customAppend = 'test-custom-append';
        config()->set('bootstrap-components.form.textarea.append', $configAppend);
        $html = bsTextarea()->name('name')->append($customAppend)->toHtml();
        $this->assertStringContainsString('input-group-append', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $customAppend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="input-group-text">' . $configAppend . '</span>', $html);
    }

    public function testNoAppend()
    {
        config()->set('bootstrap-components.form.textarea.append', null);
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringNotContainsString('input-group-append', $html);
    }

    public function testHideAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.textarea.append', $configAppend);
        $html = bsTextarea()->name('name')->append(false)->toHtml();
        $this->assertStringNotContainsString('input-group-append', $html);
    }

    public function testNoPrependNoAppend()
    {
        config()->set('bootstrap-components.form.textarea.prepend', null);
        config()->set('bootstrap-components.form.textarea.append', null);
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div class="input-group">', $html);
    }

    public function testHidePrependHideAppend()
    {
        $configPrepend = 'test-config-prepend';
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.textarea.prepend', $configPrepend);
        config()->set('bootstrap-components.form.textarea.append', $configAppend);
        $html = bsTextarea()->name('name')->prepend(false)->append(false)->toHtml();
        $this->assertStringNotContainsString('<div class="input-group">', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.textarea.legend', $configLegend);
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringContainsString('textarea-name-legend', $html);
        $this->assertStringContainsString('bootstrap-components::' . $configLegend, $html);
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.form.textarea.legend', $configLegend);
        $html = bsTextarea()->name('name')->legend($customLegend)->toHtml();
        $this->assertStringContainsString('textarea-name-legend', $html);
        $this->assertStringContainsString($customLegend, $html);
        $this->assertStringNotContainsString($configLegend, $html);
    }

    public function testSetTranslatedLegend()
    {
        $legend = 'bootstrap-components::bootstrap-components.label.validate';
        $html = bsTextarea()->name('name')->legend($legend)->toHtml();
        $this->assertStringContainsString(__($legend), $html);
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.form.textarea.legend', null);
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringNotContainsString('textarea-name-legend', $html);
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.textarea.legend', $configLegend);
        $html = bsTextarea()->name('name')->legend(false)->toHtml();
        $this->assertStringNotContainsString('textarea-name-legend', $html);
    }

    public function testSetValue()
    {
        $customValue = 'test-custom-value';
        $html = bsTextarea()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString(
            ' aria-describedby="textarea-name">' . $customValue . '</textarea>',
            $html
        );
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
        $html = bsTextarea()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString(
            ' aria-describedby="textarea-name">' . $oldValue . '</textarea>',
            $html
        );
        $this->assertStringNotContainsString(
            ' aria-describedby="textarea-name">' . $customValue . '</textarea>',
            $html
        );
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsTextarea()->name('name')->label($label)->toHtml();
        $this->assertStringContainsString('<label for="textarea-name">' . $label . '</label>', $html);
        $this->assertStringContainsString(' placeholder="' . $label . '"', $html);
        $this->assertStringContainsString(' aria-label="' . $label . '"', $html);
    }

    public function testSetTranslatedLabel()
    {
        $label = 'bootstrap-components::bootstrap-components.label.validate';
        $html = bsTextarea()->name('name')->label($label)->toHtml();
        $this->assertStringContainsString('<label for="textarea-name">' . __($label) . '</label>', $html);
        $this->assertStringContainsString(' placeholder="' . __($label) . '"', $html);
        $this->assertStringContainsString(' aria-label="' . __($label) . '"', $html);
    }

    public function testNoLabel()
    {
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringContainsString(
            '<label for="textarea-name">validation.attributes.name</label>',
            $html
        );
        $this->assertStringContainsString(
            ' aria-label="validation.attributes.name"',
            $html
        );
    }

    public function testHideLabel()
    {
        $html = bsTextarea()->name('name')->label(false)->toHtml();
        $this->assertStringNotContainsString(
            '<label for="textarea-name">validation.attributes.name</label>',
            $html
        );
        $this->assertStringNotContainsString(
            ' aria-label="validation.attributes.name"',
            $html
        );
    }

    public function testConfigLabelPositionedAbove()
    {
        config()->set('bootstrap-components.form.textarea.labelPositionedAbove', true);
        $html = bsTextarea()->name('name')->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<textarea');
        $this->assertLessThan($inputPosition, $labelPosition);
    }

    public function testConfigLabelPositionedUnder()
    {
        config()->set('bootstrap-components.form.textarea.labelPositionedAbove', false);
        $html = bsTextarea()->name('name')->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<textarea');
        $this->assertLessThan($labelPosition, $inputPosition);
    }

    public function testLabelPositionedAbove()
    {
        config()->set('bootstrap-components.form.textarea.labelPositionedAbove', false);
        $html = bsTextarea()->name('name')->labelPositionedAbove()->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<textarea');
        $this->assertLessThan($inputPosition, $labelPosition);
    }

    public function testLabelPositionedUnder()
    {
        config()->set('bootstrap-components.form.textarea.labelPositionedAbove', true);
        $html = bsTextarea()->name('name')->labelPositionedAbove(false)->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<textarea');
        $this->assertLessThan($labelPosition, $inputPosition);
    }

    public function testSetPlaceholder()
    {
        $placeholder = 'test-custom-placeholder';
        $html = bsTextarea()->name('name')->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString(' placeholder="' . $placeholder . '"', $html);
    }

    public function testSetTranslatedPlaceholder()
    {
        $placeholder = 'bootstrap-components::bootstrap-components.label.validate';
        $html = bsTextarea()->name('name')->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString(' placeholder="' . __($placeholder) . '"', $html);
    }

    public function testSetPlaceholderWithLabel()
    {
        $label = 'test-custom-label';
        $placeholder = 'test-custom-placeholder';
        $html = bsTextarea()->name('name')->label($label)->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString(' placeholder="' . $placeholder . '"', $html);
    }

    public function testNoPlaceholder()
    {
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringContainsString(' placeholder="validation.attributes.name"', $html);
    }

    public function testNoPlaceholderWithNoLabel()
    {
        $html = bsTextarea()->name('name')->label(false)->toHtml();
        $this->assertStringContainsString(' placeholder="validation.attributes.name"', $html);
    }

    public function testHidePlaceholder()
    {
        $html = bsTextarea()->name('name')->placeholder(false)->toHtml();
        $this->assertStringNotContainsString(' placeholder="', $html);
    }

    public function testConfigDisplaySuccess()
    {
        config()->set('bootstrap-components.form.textarea.formValidation.displaySuccess', true);
        $errors = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsTextarea()->name('name')->render(compact('errors'));
        $this->assertStringContainsString('is-valid', $html);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testConfigDoNotDisplaySuccess()
    {
        config()->set('bootstrap-components.form.textarea.formValidation.displaySuccess', false);
        $errors = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsTextarea()->name('name')->render(compact('errors'));
        $this->assertStringNotContainsString('is-valid', $html);
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringNotContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testDisplaySuccess()
    {
        config()->set('bootstrap-components.form.textarea.formValidation.displaySuccess', false);
        $errors = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsTextarea()->name('name')->displaySuccess()->render(compact('errors'));
        $this->assertStringContainsString('is-valid', $html);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testDoNotDisplaySuccess()
    {
        config()->set('bootstrap-components.form.textarea.formValidation.displaySuccess', true);
        $errors = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsTextarea()->name('name')->displaySuccess(false)->render(compact('errors'));
        $this->assertStringNotContainsString('is-valid', $html);
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringNotContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testConfigDisplayFailure()
    {
        config()->set('bootstrap-components.form.textarea.formValidation.displayFailure', true);
        $errors = app(MessageBag::class)->add('name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsTextarea()->name('name')->render(compact('errors'));
        $this->assertStringContainsString('is-invalid', $html);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errors->first('name'), $html);
    }

    public function testConfigDoNotDisplayFailure()
    {
        config()->set('bootstrap-components.form.textarea.formValidation.displayFailure', false);
        $errors = app(MessageBag::class)->add('name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsTextarea()->name('name')->render(compact('errors'));
        $this->assertStringNotContainsString('is-invalid', $html);
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringNotContainsString($errors->first('name'), $html);
    }

    public function testDisplayFailure()
    {
        config()->set('bootstrap-components.form.textarea.formValidation.displayFailure', false);
        $errors = app(MessageBag::class)->add('name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsTextarea()->name('name')->displayFailure()->render(compact('errors'));
        $this->assertStringContainsString('is-invalid', $html);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errors->first('name'), $html);
    }

    public function testDoNotDisplayFailure()
    {
        config()->set('bootstrap-components.form.textarea.formValidation.displayFailure', true);
        $errors = app(MessageBag::class)->add('name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsTextarea()->name('name')->displayFailure(false)->render(compact('errors'));
        $this->assertStringNotContainsString('is-invalid', $html);
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringNotContainsString($errors->first('name'), $html);
    }

    public function testSetNoContainerId()
    {
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = bsTextarea()->name('name')->containerId($customContainerId)->toHtml();
        $this->assertStringContainsString('<div id="' . $customContainerId, $html);
    }

    public function testSetNoComponentId()
    {
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringContainsString(' for="textarea-name"', $html);
        $this->assertStringContainsString('<textarea id="textarea-name"', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = bsTextarea()->name('name')->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString(' for="' . $customComponentId . '"', $html);
        $this->assertStringContainsString('<textarea id="' . $customComponentId . '"', $html);
    }

    public function testConfigContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        config()->set('bootstrap-components.form.textarea.classes.container', [$configContainerClasses]);
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringContainsString(
            ' class="textarea-name-container ' . $configContainerClasses . '"',
            $html
        );
    }

    public function testSetContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        $customContainerClasses = 'test-custom-class-container';
        config()->set('bootstrap-components.form.textarea.classes.container', [$configContainerClasses]);
        $html = bsTextarea()->name('name')->containerClasses([$customContainerClasses])->toHtml();
        $this->assertStringContainsString(
            ' class="textarea-name-container ' . $customContainerClasses . '"',
            $html
        );
        $this->assertStringNotContainsString(
            ' class="textarea-name-container ' . $configContainerClasses . '"',
            $html
        );
    }

    public function testConfigComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        config()->set('bootstrap-components.form.textarea.classes.component', [$configComponentClasses]);
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringContainsString(
            ' class="form-control textarea-name-component ' . $configComponentClasses . '"',
            $html
        );
    }

    public function testSetComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        $customComponentClasses = 'test-custom-class-component';
        config()->set('bootstrap-components.form.textarea.classes.component', [$customComponentClasses]);
        $html = bsTextarea()->name('name')->componentClasses([$customComponentClasses])->toHtml();
        $this->assertStringContainsString(
            ' class="form-control textarea-name-component ' . $customComponentClasses . '"',
            $html
        );
        $this->assertStringNotContainsString(
            ' class="form-control textarea-name-component ' . $configComponentClasses . '"',
            $html
        );
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.textarea.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringContainsString($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.textarea.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsTextarea()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertStringContainsString($customContainerAttributes, $html);
        $this->assertStringNotContainsString($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.textarea.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringContainsString($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.textarea.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsTextarea()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertStringContainsString($customComponentAttributes, $html);
        $this->assertStringNotContainsString($configComponentAttributes, $html);
    }

    public function testSetDefaultLocalesFromCustomMultilingualResolver()
    {
        config()->set('bootstrap-components.form.multilingual.resolver', MultilingualResolver::class);
        $resolverLocales = (new MultilingualResolver)->getDefaultLocales();
        $html = bsTextarea()->name('name')->toHtml();
        foreach ($resolverLocales as $locale) {
            $this->assertStringContainsString('class="textarea-name-' . $locale . '-container', $html);
        }
    }

    public function testSetLocales()
    {
        $locales = ['fr', 'en'];
        config()->set('bootstrap-components.form.textarea.locales', []);
        $html = bsTextarea()->name('name')->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringContainsString('class="textarea-name-' . $locale . '-container', $html);
        }
    }

    public function testSetSingleLocale()
    {
        $locales = ['fr'];
        config()->set('bootstrap-components.form.textarea.locales', ['fr']);
        $html = bsTextarea()->name('name')->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringContainsString('class="textarea-name-container', $html);
            $this->assertStringNotContainsString('class="textarea-name-' . $locale . '-container', $html);
        }
    }

    public function testLocalizedName()
    {
        $locales = ['fr', 'en'];
        $html = bsTextarea()->name('name')->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringContainsString('name="name[' . $locale . ']"', $html);
        }
    }

    public function testLocalizedNameFromCustomMultilingualResolver()
    {
        config()->set('bootstrap-components.form.multilingual.resolver', MultilingualResolver::class);
        $resolverLocales = (new MultilingualResolver)->getDefaultLocales();
        $html = bsTextarea()->name('name')->toHtml();
        foreach ($resolverLocales as $locale) {
            $this->assertStringContainsString('name="name_' . $locale . '"', $html);
        }
    }

    public function testLocalizedModelValue()
    {
        $locales = ['fr', 'en'];
        $user = $this->createUniqueUser();
        $html = bsTextarea()->model($user)->name('name')->locales($locales)->toHtml();
        $this->assertEquals(2, substr_count($html, '>' . $user->name . '</textarea>'));
    }

    public function testLocalizedModelValueFromCustomMultilingualResolver()
    {
        $user = new User(['name_fr' => $this->faker->word, 'name_en' => $this->faker->word]);
        config()->set('bootstrap-components.form.multilingual.resolver', MultilingualResolver::class);
        $resolverLocales = (new MultilingualResolver)->getDefaultLocales();
        $html = bsTextarea()->model($user)->name('name')->toHtml();
        foreach ($resolverLocales as $locale) {
            $this->assertStringContainsString('>' . $user->{'name_' . $locale} . '</textarea>', $html);
        }
    }

    public function testSetLocalizedWrongValue()
    {
        $locales = ['fr', 'en'];
        $customValues = [];
        foreach ($locales as $locale) {
            $customValues['name_' . $locale] = 'test-custom-value-' . $locale;
        }
        $this->expectException(InvalidArgumentException::class);
        bsTextarea()->name('name')->locales($locales)->value($customValues)->toHtml();
    }

    public function testSetLocalizedValue()
    {
        $locales = ['fr', 'en'];
        $customValues = [];
        foreach ($locales as $locale) {
            $customValues[$locale] = 'test-custom-value-' . $locale;
        }
        $html = bsTextarea()->name('name')->locales($locales)->value(function ($locale) use ($customValues) {
            return $customValues[$locale];
        })->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringContainsString('>' . $customValues[$locale] . '</textarea>', $html);
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
        $html = bsTextarea()->name('name')->locales($locales)->value(function ($locale) use ($customValues) {
            return $customValues[$locale];
        })->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringContainsString('>' . $oldValues[$locale] . '</textarea>', $html);
            $this->assertStringNotContainsString('>' . $customValues[$locale] . '</textarea>', $html);
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
        $html = bsTextarea()->name('name')->value(function ($locale) use ($customValues) {
            return $customValues[$locale];
        })->toHtml();
        foreach ($resolverLocales as $resolverLocale) {
            $this->assertStringContainsString('>' . $oldValues['name_' . $resolverLocale] . '</textarea>', $html);
        }
        foreach ($locales as $locale) {
            $this->assertStringNotContainsString('>' . $customValues[$locale] . '</textarea>', $html);
        }
    }

    public function testSetLocalizedLabel()
    {
        $locales = ['fr', 'en'];
        $label = 'test-custom-label';
        $html = bsTextarea()->name('name')->label($label)->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringContainsString(
                '<label for="textarea-name-' . $locale . '">' . $label . ' (' . strtoupper($locale) . ')</label>',
                $html
            );
            $this->assertStringContainsString(' placeholder="' . $label . ' (' . strtoupper($locale) . ')"', $html);
            $this->assertStringContainsString(' aria-label="' . $label . ' (' . strtoupper($locale) . ')"', $html);
        }
    }

    public function testSetLocalizedPlaceholder()
    {
        $locales = ['fr', 'en'];
        $placeholder = 'test-custom-placeholder';
        $html = bsTextarea()->name('name')->placeholder($placeholder)->locales($locales)->toHtml();
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
        $html = bsTextarea()->name('name')->componentId($customComponentId)->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringContainsString(' for="' . $customComponentId . '-' . $locale . '"', $html);
            $this->assertStringContainsString('<textarea id="' . $customComponentId . '-' . $locale . '"', $html);
        }
    }

    public function testSetLocalizedNoContainerId()
    {
        $locales = ['fr', 'en'];
        $html = bsTextarea()->name('name')->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringContainsString('<div id="textarea-name-' . $locale . '-container"', $html);
        }
    }

    public function testSetLocalizedContainerId()
    {
        $locales = ['fr', 'en'];
        $customContainerId = 'test-custom-container-id';
        $html = bsTextarea()->name('name')->containerId($customContainerId)->locales($locales)->toHtml();
        foreach ($locales as $locale) {
            $this->assertStringContainsString('<div id="' . $customContainerId . '-' . $locale . '"', $html);
        }
    }

    public function testLocalizedErrorMessage()
    {
        $locales = ['fr', 'en'];
        $errors = app(MessageBag::class);
        foreach ($locales as $locale) {
            $errors->add('name.' . $locale, 'Dummy name.' . $locale . ' error message.');
        }
        session()->put('errors', $errors);
        $html = bsTextarea()->name('name')->locales($locales)->displayFailure()->render(compact('errors'));
        foreach ($locales as $locale) {
            $errorMessage = 'Dummy ' . _('validation.attributes.name') . ' (' . strtoupper($locale)
                . ') error message.';
            $this->assertStringContainsString($errorMessage, $html);
        }
    }

    public function testLocalizedErrorMessageFromCustomMultilingualResolver()
    {
        config()->set('bootstrap-components.form.multilingual.resolver', MultilingualResolver::class);
        $resolverLocales = (new MultilingualResolver)->getDefaultLocales();
        $errors = app(MessageBag::class);
        foreach ($resolverLocales as $locale) {
            $errors->add('name_' . $locale, 'Dummy name_' . $locale . ' error message.');
        }
        session()->put('errors', $errors);
        $html = bsTextarea()->name('name')->displayFailure()->render(compact('errors'));
        foreach ($resolverLocales as $locale) {
            $errorMessage = 'Dummy ' . _('validation.attributes.name') . ' (' . strtoupper($locale)
                . ') error message.';
            $this->assertStringContainsString($errorMessage, $html);
        }
    }
}
