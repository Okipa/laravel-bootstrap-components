<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Exception;
use Illuminate\Support\MessageBag;
use Okipa\LaravelBootstrapComponents\Form\Input;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\UsersFaker;

class EmailTest extends BootstrapComponentsTestCase
{
    use UsersFaker;

    public function testConfigStructure()
    {
        // components.form
        $this->assertTrue(array_key_exists('email', config('bootstrap-components.form')));
        // components.form.email
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.form.email')));
        $this->assertTrue(array_key_exists('prepend', config('bootstrap-components.form.email')));
        $this->assertTrue(array_key_exists('append', config('bootstrap-components.form.email')));
        $this->assertTrue(array_key_exists('labelPositionedAbove', config('bootstrap-components.form.email')));
        $this->assertTrue(array_key_exists('legend', config('bootstrap-components.form.email')));
        $this->assertTrue(array_key_exists('classes', config('bootstrap-components.form.email')));
        $this->assertTrue(array_key_exists('htmlAttributes', config('bootstrap-components.form.email')));
        // components.form.email.classes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.email.classes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.email.classes')));
        // components.form.email.htmlAttributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.email.htmlAttributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.email.htmlAttributes')));
        // components.form.email.formValidation
        $this->assertTrue(array_key_exists('displaySuccess', config('bootstrap-components.form.email.formValidation')));
        $this->assertTrue(array_key_exists('displayFailure', config('bootstrap-components.form.email.formValidation')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Input::class, get_parent_class(bsEmail()));
    }

    public function testSetName()
    {
        $html = bsEmail()->name('name')->toHtml();
        $this->assertStringContainsString(' name="name"', $html);
    }

    public function testType()
    {
        $html = bsEmail()->name('name')->toHtml();
        $this->assertStringContainsString(' type="email"', $html);
    }

    public function testInputWithoutName()
    {
        $this->expectException(Exception::class);
        bsEmail()->toHtml();
    }

    public function testModelValue()
    {
        $user = $this->createUniqueUser();
        $html = bsEmail()->model($user)->name('name')->toHtml();
        $this->assertStringContainsString(' value="' . $user->name . '"', $html);
    }

    public function testConfigPrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.form.email.prepend', $configPrepend);
        $html = bsEmail()->name('name')->toHtml();
        $this->assertStringContainsString('input-group-prepend', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $configPrepend . '</span>', $html);
    }

    public function testSetPrepend()
    {
        $configPrepend = 'test-config-prepend';
        $customPrepend = 'test-custom-prepend';
        config()->set('bootstrap-components.form.email.prepend', $configPrepend);
        $html = bsEmail()->name('name')->prepend($customPrepend)->toHtml();
        $this->assertStringContainsString('input-group-prepend', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $customPrepend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="input-group-text">' . $configPrepend . '</span>', $html);
    }

    public function testNoPrepend()
    {
        config()->set('bootstrap-components.form.email.prepend', null);
        $html = bsEmail()->name('name')->toHtml();
        $this->assertStringNotContainsString('input-group-prepend', $html);
    }

    public function testHidePrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.form.email.prepend', $configPrepend);
        $html = bsEmail()->name('name')->prepend(false)->toHtml();
        $this->assertStringNotContainsString('input-group-prepend', $html);
    }

    public function testConfigAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.email.append', $configAppend);
        $html = bsEmail()->name('name')->toHtml();
        $this->assertStringContainsString('input-group-append', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $configAppend . '</span>', $html);
    }

    public function testSetAppend()
    {
        $configAppend = 'test-config-append';
        $customAppend = 'test-custom-append';
        config()->set('bootstrap-components.form.email.append', $configAppend);
        $html = bsEmail()->name('name')->append($customAppend)->toHtml();
        $this->assertStringContainsString('input-group-append', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $customAppend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="input-group-text">' . $configAppend . '</span>', $html);
    }

    public function testNoAppend()
    {
        config()->set('bootstrap-components.form.email.append', null);
        $html = bsEmail()->name('name')->toHtml();
        $this->assertStringNotContainsString('input-group-append', $html);
    }

    public function testHideAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.email.append', $configAppend);
        $html = bsEmail()->name('name')->append(false)->toHtml();
        $this->assertStringNotContainsString('input-group-append', $html);
    }

    public function testNoPrependNoAppend()
    {
        config()->set('bootstrap-components.form.email.prepend', null);
        config()->set('bootstrap-components.form.email.append', null);
        $html = bsEmail()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div class="input-group">', $html);
    }

    public function testHidePrependHideAppend()
    {
        $configPrepend = 'test-config-prepend';
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.email.prepend', $configPrepend);
        config()->set('bootstrap-components.form.email.append', $configAppend);
        $html = bsEmail()->name('name')->prepend(false)->append(false)->toHtml();
        $this->assertStringNotContainsString('<div class="input-group">', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.email.legend', $configLegend);
        $html = bsEmail()->name('name')->toHtml();
        $this->assertStringContainsString('email-name-legend', $html);
        $this->assertStringContainsString('bootstrap-components::' . $configLegend, $html);
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.form.email.legend', $configLegend);
        $html = bsEmail()->name('name')->legend($customLegend)->toHtml();
        $this->assertStringContainsString('email-name-legend', $html);
        $this->assertStringContainsString($customLegend, $html);
        $this->assertStringNotContainsString($configLegend, $html);
    }

    public function testSetTranslatedLegend()
    {
        $legend = 'bootstrap-components::bootstrap-components.label.validate';
        $html = bsEmail()->name('name')->legend($legend)->toHtml();
        $this->assertStringContainsString(__($legend), $html);
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.form.email.legend', null);
        $html = bsEmail()->name('name')->toHtml();
        $this->assertStringNotContainsString('email-name-legend', $html);
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.email.legend', $configLegend);
        $html = bsEmail()->name('name')->legend(false)->toHtml();
        $this->assertStringNotContainsString('email-name-legend', $html);
    }

    public function testSetValue()
    {
        $customValue = 'test-custom-value';
        $html = bsEmail()->name('name')->value($customValue)->toHtml();
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
        $html = bsEmail()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString(' value="' . $oldValue . '"', $html);
        $this->assertStringNotContainsString(' value="' . $customValue . '"', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsEmail()->name('name')->label($label)->toHtml();
        $this->assertStringContainsString('<label for="email-name">' . $label . '</label>', $html);
        $this->assertStringContainsString(' placeholder="' . $label . '"', $html);
        $this->assertStringContainsString(' aria-labelledby="' . $label . '"', $html);
    }

    public function testSetTranslatedLabel()
    {
        $label = 'bootstrap-components::bootstrap-components.label.validate';
        $html = bsEmail()->name('name')->label($label)->toHtml();
        $this->assertStringContainsString('<label for="email-name">' . __($label) . '</label>', $html);
        $this->assertStringContainsString(' placeholder="' . __($label) . '"', $html);
        $this->assertStringContainsString(' aria-labelledby="' . __($label) . '"', $html);
    }

    public function testNoLabel()
    {
        $html = bsEmail()->name('name')->toHtml();
        $this->assertStringContainsString(
            '<label for="email-name">validation.attributes.name</label>',
            $html
        );
        $this->assertStringContainsString(' aria-labelledby="validation.attributes.name"', $html);
    }

    public function testHideLabel()
    {
        $html = bsEmail()->name('name')->label(false)->toHtml();
        $this->assertStringNotContainsString(
            '<label for="email-name">validation.attributes.name</label>',
            $html
        );
        $this->assertStringNotContainsString(
            ' aria-labelledby="validation.attributes.name"',
            $html
        );
    }

    public function testConfigLabelPositionedAbove()
    {
        config()->set('bootstrap-components.form.email.labelPositionedAbove', true);
        $html = bsEmail()->name('name')->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        $this->assertLessThan($inputPosition, $labelPosition);
    }

    public function testConfigLabelPositionedUnder()
    {
        config()->set('bootstrap-components.form.email.labelPositionedAbove', false);
        $html = bsEmail()->name('name')->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        $this->assertLessThan($labelPosition, $inputPosition);
    }

    public function testLabelPositionedAbove()
    {
        config()->set('bootstrap-components.form.email.labelPositionedAbove', false);
        $html = bsEmail()->name('name')->labelPositionedAbove()->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        $this->assertLessThan($inputPosition, $labelPosition);
    }

    public function testLabelPositionedUnder()
    {
        config()->set('bootstrap-components.form.email.labelPositionedAbove', true);
        $html = bsEmail()->name('name')->labelPositionedAbove(false)->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        $this->assertLessThan($labelPosition, $inputPosition);
    }

    public function testSetPlaceholder()
    {
        $placeholder = 'test-custom-placeholder';
        $html = bsEmail()->name('name')->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString(' placeholder="' . $placeholder . '"', $html);
    }

    public function testSetTranslatedPlaceholder()
    {
        $placeholder = 'bootstrap-components::bootstrap-components.label.validate';
        $html = bsEmail()->name('name')->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString(' placeholder="' . __($placeholder) . '"', $html);
    }

    public function testSetPlaceholderWithLabel()
    {
        $label = 'test-custom-label';
        $placeholder = 'test-custom-placeholder';
        $html = bsEmail()->name('name')->label($label)->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString(' placeholder="' . $placeholder . '"', $html);
    }

    public function testNoPlaceholder()
    {
        $html = bsEmail()->name('name')->toHtml();
        $this->assertStringContainsString(' placeholder="validation.attributes.name"', $html);
    }

    public function testNoPlaceholderWithNoLabel()
    {
        $html = bsEmail()->name('name')->label(false)->toHtml();
        $this->assertStringContainsString(' placeholder="validation.attributes.name"', $html);
    }

    public function testHidePlaceholder()
    {
        $html = bsEmail()->name('name')->placeholder(false)->toHtml();
        $this->assertStringNotContainsString(' placeholder="', $html);
    }

    public function testConfigDisplaySuccess()
    {
        config()->set('bootstrap-components.form.email.formValidation.displaySuccess', true);
        $errors = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsEmail()->name('name')->render(compact('errors'));
        $this->assertStringContainsString('is-valid', $html);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testConfigDoNotDisplaySuccess()
    {
        config()->set('bootstrap-components.form.email.formValidation.displaySuccess', false);
        $errors = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsEmail()->name('name')->render(compact('errors'));
        $this->assertStringNotContainsString('is-valid', $html);
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringNotContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testDisplaySuccess()
    {
        config()->set('bootstrap-components.form.email.formValidation.displaySuccess', false);
        $errors = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsEmail()->name('name')->displaySuccess()->render(compact('errors'));
        $this->assertStringContainsString('is-valid', $html);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testDoNotDisplaySuccess()
    {
        config()->set('bootstrap-components.form.email.formValidation.displaySuccess', true);
        $errors = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsEmail()->name('name')->displaySuccess(false)->render(compact('errors'));
        $this->assertStringNotContainsString('is-valid', $html);
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringNotContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testConfigDisplayFailure()
    {
        config()->set('bootstrap-components.form.email.formValidation.displayFailure', true);
        $errors = app(MessageBag::class)->add('name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsEmail()->name('name')->render(compact('errors'));
        $this->assertStringContainsString('is-invalid', $html);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errors->first('name'), $html);
    }

    public function testConfigDoNotDisplayFailure()
    {
        config()->set('bootstrap-components.form.email.formValidation.displayFailure', false);
        $errors = app(MessageBag::class)->add('name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsEmail()->name('name')->render(compact('errors'));
        $this->assertStringNotContainsString('is-invalid', $html);
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringNotContainsString($errors->first('name'), $html);
    }

    public function testDisplayFailure()
    {
        config()->set('bootstrap-components.form.email.formValidation.displayFailure', false);
        $errors = app(MessageBag::class)->add('name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsEmail()->name('name')->displayFailure()->render(compact('errors'));
        $this->assertStringContainsString('is-invalid', $html);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errors->first('name'), $html);
    }

    public function testDoNotDisplayFailure()
    {
        config()->set('bootstrap-components.form.email.formValidation.displayFailure', true);
        $errors = app(MessageBag::class)->add('name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsEmail()->name('name')->displayFailure(false)->render(compact('errors'));
        $this->assertStringNotContainsString('is-invalid', $html);
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringNotContainsString($errors->first('name'), $html);
    }

    public function testSetNoContainerId()
    {
        $html = bsEmail()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = bsEmail()->name('name')->containerId($customContainerId)->toHtml();
        $this->assertStringContainsString('<div id="' . $customContainerId . '"', $html);
    }

    public function testSetNoComponentId()
    {
        $html = bsEmail()->name('name')->toHtml();
        $this->assertStringContainsString(' for="email-name"', $html);
        $this->assertStringContainsString('<input id="email-name', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = bsEmail()->name('name')->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString(' for="' . $customComponentId . '"', $html);
        $this->assertStringContainsString('<input id="' . $customComponentId . '"', $html);
    }

    public function testConfigContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        config()->set('bootstrap-components.form.email.classes.container', [$configContainerClasses]);
        $html = bsEmail()->name('name')->toHtml();
        $this->assertStringContainsString(' class="email-name-container ' . $configContainerClasses . '"', $html);
    }

    public function testSetContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        $customContainerClasses = 'test-custom-class-container';
        config()->set('bootstrap-components.form.email.classes.container', [$configContainerClasses]);
        $html = bsEmail()->name('name')->containerClasses([$customContainerClasses])->toHtml();
        $this->assertStringContainsString(
            ' class="email-name-container ' . $customContainerClasses . '"',
            $html
        );
        $this->assertStringNotContainsString(
            ' class="email-name-container ' . $configContainerClasses . '"',
            $html
        );
    }

    public function testConfigComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        config()->set('bootstrap-components.form.email.classes.component', [$configComponentClasses]);
        $html = bsEmail()->name('name')->toHtml();
        $this->assertStringContainsString(
            ' class="form-control email-name-component ' . $configComponentClasses . '"',
            $html
        );
    }

    public function testSetComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        $customComponentClasses = 'test-custom-class-component';
        config()->set('bootstrap-components.form.email.classes.component', [$customComponentClasses]);
        $html = bsEmail()->name('name')->componentClasses([$customComponentClasses])->toHtml();
        $this->assertStringContainsString(
            ' class="form-control email-name-component ' . $customComponentClasses . '"',
            $html
        );
        $this->assertStringNotContainsString(
            ' class="form-control email-name-component ' . $configComponentClasses . '"',
            $html
        );
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.email.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsEmail()->name('name')->toHtml();
        $this->assertStringContainsString($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.email.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsEmail()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertStringContainsString($customContainerAttributes, $html);
        $this->assertStringNotContainsString($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.email.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsEmail()->name('name')->toHtml();
        $this->assertStringContainsString($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.email.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsEmail()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertStringContainsString($customComponentAttributes, $html);
        $this->assertStringNotContainsString($configComponentAttributes, $html);
    }
}
