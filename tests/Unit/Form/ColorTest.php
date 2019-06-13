<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Exception;
use Illuminate\Support\MessageBag;
use Okipa\LaravelBootstrapComponents\Form\Input;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\UsersFaker;

class ColorTest extends BootstrapComponentsTestCase
{
    use UsersFaker;

    public function testConfigStructure()
    {
        // components.form
        $this->assertTrue(array_key_exists('color', config('bootstrap-components.form')));
        // components.form.color
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.form.color')));
        $this->assertTrue(array_key_exists('prepend', config('bootstrap-components.form.color')));
        $this->assertTrue(array_key_exists('append', config('bootstrap-components.form.color')));
        $this->assertTrue(array_key_exists('labelPositionedAbove', config('bootstrap-components.form.color')));
        $this->assertTrue(array_key_exists('legend', config('bootstrap-components.form.color')));
        $this->assertTrue(array_key_exists('classes', config('bootstrap-components.form.color')));
        $this->assertTrue(array_key_exists('htmlAttributes', config('bootstrap-components.form.color')));
        // components.form.color.classes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.color.classes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.color.classes')));
        // components.form.color.htmlAttributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.color.htmlAttributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.color.htmlAttributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Input::class, get_parent_class(bsColor()));
    }

    public function testName()
    {
        $html = bsColor()->name('name')->toHtml();
        $this->assertStringContainsString('name="name"', $html);
    }

    public function testType()
    {
        $html = bsColor()->name('name')->toHtml();
        $this->assertStringContainsString('type="color"', $html);
    }

    public function testInputWithoutName()
    {
        $this->expectException(Exception::class);
        bsColor()->toHtml();
    }

    public function testModelValue()
    {
        $user = $this->createUniqueUser();
        $html = bsColor()->model($user)->name('name')->toHtml();
        $this->assertStringContainsString('value="' . $user->name . '"', $html);
    }

    public function testConfigPrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.form.color.prepend', $configPrepend);
        $html = bsColor()->name('name')->toHtml();
        $this->assertStringContainsString('input-group-prepend', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $configPrepend . '</span>', $html);
    }

    public function testSetPrepend()
    {
        $configPrepend = 'test-config-prepend';
        $customPrepend = 'test-custom-prepend';
        config()->set('bootstrap-components.form.color.prepend', $configPrepend);
        $html = bsColor()->name('name')->prepend($customPrepend)->toHtml();
        $this->assertStringContainsString('input-group-prepend', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $customPrepend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="input-group-text">' . $configPrepend . '</span>', $html);
    }

    public function testNoPrepend()
    {
        config()->set('bootstrap-components.form.color.prepend', null);
        $html = bsColor()->name('name')->toHtml();
        $this->assertStringNotContainsString('input-group-prepend', $html);
    }

    public function testHidePrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.form.color.prepend', $configPrepend);
        $html = bsColor()->name('name')->prepend(false)->toHtml();
        $this->assertStringNotContainsString('input-group-prepend', $html);
    }

    public function testConfigAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.color.append', $configAppend);
        $html = bsColor()->name('name')->toHtml();
        $this->assertStringContainsString('input-group-append', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $configAppend . '</span>', $html);
    }

    public function testSetAppend()
    {
        $configAppend = 'test-config-append';
        $customAppend = 'test-custom-append';
        config()->set('bootstrap-components.form.color.append', $configAppend);
        $html = bsColor()->name('name')->append($customAppend)->toHtml();
        $this->assertStringContainsString('input-group-append', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $customAppend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="input-group-text">' . $configAppend . '</span>', $html);
    }

    public function testNoAppend()
    {
        config()->set('bootstrap-components.form.color.append', null);
        $html = bsColor()->name('name')->toHtml();
        $this->assertStringNotContainsString('input-group-append', $html);
    }

    public function testHideAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.color.append', $configAppend);
        $html = bsColor()->name('name')->append(false)->toHtml();
        $this->assertStringNotContainsString('input-group-append', $html);
    }

    public function testNoPrependNoAppend()
    {
        config()->set('bootstrap-components.form.color.prepend', null);
        config()->set('bootstrap-components.form.color.append', null);
        $html = bsColor()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div class="input-group">', $html);
    }

    public function testHidePrependHideAppend()
    {
        $configPrepend = 'test-config-prepend';
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.color.prepend', $configPrepend);
        config()->set('bootstrap-components.form.color.append', $configAppend);
        $html = bsColor()->name('name')->prepend(false)->append(false)->toHtml();
        $this->assertStringNotContainsString('<div class="input-group">', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.color.legend', $configLegend);
        $html = bsColor()->name('name')->toHtml();
        $this->assertStringContainsString('color-name-legend', $html);
        $this->assertStringContainsString($configLegend, $html);
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.form.color.legend', $configLegend);
        $html = bsColor()->name('name')->legend($customLegend)->toHtml();
        $this->assertStringContainsString('color-name-legend', $html);
        $this->assertStringContainsString($customLegend, $html);
        $this->assertStringNotContainsString($configLegend, $html);
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.form.color.legend', null);
        $html = bsColor()->name('name')->toHtml();
        $this->assertStringNotContainsString('color-name-legend', $html);
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.color.legend', $configLegend);
        $html = bsColor()->name('name')->legend(false)->toHtml();
        $this->assertStringNotContainsString('color-name-legend', $html);
    }

    public function testSetValue()
    {
        $customValue = 'test-custom-value';
        $html = bsColor()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString('value="' . $customValue . '"', $html);
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
        $html = bsColor()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString('value="' . $oldValue . '"', $html);
        $this->assertStringNotContainsString('value="' . $customValue . '"', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsColor()->name('name')->label($label)->toHtml();
        $this->assertStringContainsString('<label for="color-name">' . $label . '</label>', $html);
        $this->assertStringContainsString('placeholder="' . $label . '"', $html);
        $this->assertStringContainsString('aria-label="' . $label . '"', $html);
    }

    public function testNoLabel()
    {
        $html = bsColor()->name('name')->toHtml();
        $this->assertStringContainsString(
            '<label for="color-name">validation.attributes.name</label>',
            $html
        );
        $this->assertStringContainsString(
            'aria-label="validation.attributes.name"',
            $html
        );
    }

    public function testHideLabel()
    {
        $html = bsColor()->name('name')->label(false)->toHtml();
        $this->assertStringNotContainsString(
            '<label for="color-name">validation.attributes.name</label>',
            $html
        );
        $this->assertStringNotContainsString(
            'aria-label="validation.attributes.name"',
            $html
        );
    }

    public function testConfigLabelPositionedAbove()
    {
        config()->set('bootstrap-components.form.color.labelPositionedAbove', true);
        $html = bsColor()->name('name')->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        $this->assertLessThan($inputPosition, $labelPosition);
    }

    public function testConfigLabelPositionedUnder()
    {
        config()->set('bootstrap-components.form.color.labelPositionedAbove', false);
        $html = bsColor()->name('name')->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        $this->assertLessThan($labelPosition, $inputPosition);
    }

    public function testLabelPositionedAbove()
    {
        config()->set('bootstrap-components.form.color.labelPositionedAbove', false);
        $html = bsColor()->name('name')->labelPositionedAbove()->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        $this->assertLessThan($inputPosition, $labelPosition);
    }

    public function testLabelPositionedUnder()
    {
        config()->set('bootstrap-components.form.color.labelPositionedAbove', true);
        $html = bsColor()->name('name')->labelPositionedAbove(false)->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        $this->assertLessThan($labelPosition, $inputPosition);
    }

    public function testSetPlaceholder()
    {
        $placeholder = 'test-custom-placeholder';
        $html = bsColor()->name('name')->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString('placeholder="' . $placeholder . '"', $html);
    }

    public function testSetPlaceholderWithLabel()
    {
        $label = 'test-custom-label';
        $placeholder = 'test-custom-placeholder';
        $html = bsColor()->name('name')->label($label)->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString('placeholder="' . $placeholder . '"', $html);
    }

    public function testNoPlaceholder()
    {
        $html = bsColor()->name('name')->toHtml();
        $this->assertStringContainsString('placeholder="validation.attributes.name"', $html);
    }

    public function testNoPlaceholderWithNoLabel()
    {
        $html = bsColor()->name('name')->label(false)->toHtml();
        $this->assertStringContainsString('placeholder="validation.attributes.name"', $html);
    }

    public function testHidePlaceholder()
    {
        $html = bsColor()->name('name')->placeholder(false)->toHtml();
        $this->assertStringNotContainsString('placeholder="', $html);
    }

    public function testConfigDisplaySuccess()
    {
        config()->set('bootstrap-components.form.color.formValidation.displaySuccess', true);
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsColor()->name('name')->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testConfigDoNotDisplaySuccess()
    {
        config()->set('bootstrap-components.form.color.formValidation.displaySuccess', false);
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsColor()->name('name')->render(['errors' => $messageBag]);
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringNotContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testDisplaySuccess()
    {
        config()->set('bootstrap-components.form.color.formValidation.displaySuccess', false);
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsColor()->name('name')->displaySuccess(true)->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testDoNotDisplaySuccess()
    {
        config()->set('bootstrap-components.form.color.formValidation.displaySuccess', true);
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsColor()->name('name')->displaySuccess(false)->render(['errors' => $messageBag]);
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringNotContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testConfigDisplayFailure()
    {
        config()->set('bootstrap-components.form.color.formValidation.displayFailure', true);
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsColor()->name('name')->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errorMessage, $html);
    }

    public function testConfigDoNotDisplayFailure()
    {
        config()->set('bootstrap-components.form.color.formValidation.displayFailure', false);
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsColor()->name('name')->render(['errors' => $messageBag]);
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringNotContainsString($errorMessage, $html);
    }

    public function testDisplayFailure()
    {
        config()->set('bootstrap-components.form.color.formValidation.displayFailure', false);
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsColor()->name('name')->displayFailure(true)->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errorMessage, $html);
    }

    public function testDoNotDisplayFailure()
    {
        config()->set('bootstrap-components.form.color.formValidation.displayFailure', true);
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsColor()->name('name')->displayFailure(false)->render(['errors' => $messageBag]);
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringNotContainsString($errorMessage, $html);
    }

    public function testSetNoContainerId()
    {
        $html = bsColor()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = bsColor()->name('name')->containerId($customContainerId)->toHtml();
        $this->assertStringContainsString('<div id="' . $customContainerId . '"', $html);
    }

    public function testSetNoComponentId()
    {
        $html = bsColor()->name('name')->toHtml();
        $this->assertStringContainsString('for="color-name"', $html);
        $this->assertStringContainsString('<input id="color-name"', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = bsColor()->name('name')->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString('for="' . $customComponentId . '"', $html);
        $this->assertStringContainsString('<input id="' . $customComponentId . '"', $html);
    }

    public function testConfigContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        config()->set('bootstrap-components.form.color.classes.container', [$configContainerClasses]);
        $html = bsColor()->name('name')->toHtml();
        $this->assertStringContainsString(
            'class="color-name-container ' . $configContainerClasses . '"',
            $html
        );
    }

    public function testSetContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        $customContainerClasses = 'test-custom-class-container';
        config()->set('bootstrap-components.form.color.classes.container', [$configContainerClasses]);
        $html = bsColor()->name('name')->containerClasses([$customContainerClasses])->toHtml();
        $this->assertStringContainsString(
            'class="color-name-container ' . $customContainerClasses . '"',
            $html
        );
        $this->assertStringNotContainsString(
            'class="color-name-container ' . $configContainerClasses . '"',
            $html
        );
    }

    public function testConfigComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        config()->set('bootstrap-components.form.color.classes.component', [$configComponentClasses]);
        $html = bsColor()->name('name')->toHtml();
        $this->assertStringContainsString(
            'class="form-control color-name-component ' . $configComponentClasses . '"',
            $html
        );
    }

    public function testSetComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        $customComponentClasses = 'test-custom-class-component';
        config()->set('bootstrap-components.form.color.classes.component', [$customComponentClasses]);
        $html = bsColor()->name('name')->componentClasses([$customComponentClasses])->toHtml();
        $this->assertStringContainsString(
            'class="form-control color-name-component ' . $customComponentClasses . '"',
            $html
        );
        $this->assertStringNotContainsString(
            'class="form-control color-name-component ' . $configComponentClasses . '"',
            $html
        );
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.color.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsColor()->name('name')->toHtml();
        $this->assertStringContainsString($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.color.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsColor()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertStringContainsString($customContainerAttributes, $html);
        $this->assertStringNotContainsString($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.color.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsColor()->name('name')->toHtml();
        $this->assertStringContainsString($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.color.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsColor()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertStringContainsString($customComponentAttributes, $html);
        $this->assertStringNotContainsString($configComponentAttributes, $html);
    }
}
