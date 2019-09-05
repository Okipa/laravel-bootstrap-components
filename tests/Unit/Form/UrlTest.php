<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Exception;
use Illuminate\Support\MessageBag;
use Okipa\LaravelBootstrapComponents\Form\Input;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\UsersFaker;

class UrlTest extends BootstrapComponentsTestCase
{
    use UsersFaker;

    public function testConfigStructure()
    {
        // components.form
        $this->assertTrue(array_key_exists('url', config('bootstrap-components.form')));
        // components.form.url
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.form.url')));
        $this->assertTrue(array_key_exists('prepend', config('bootstrap-components.form.url')));
        $this->assertTrue(array_key_exists('append', config('bootstrap-components.form.url')));
        $this->assertTrue(array_key_exists('labelPositionedAbove', config('bootstrap-components.form.url')));
        $this->assertTrue(array_key_exists('legend', config('bootstrap-components.form.url')));
        $this->assertTrue(array_key_exists('classes', config('bootstrap-components.form.url')));
        $this->assertTrue(array_key_exists('htmlAttributes', config('bootstrap-components.form.url')));
        // components.form.url.classes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.url.classes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.url.classes')));
        // components.form.url.htmlAttributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.url.htmlAttributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.url.htmlAttributes')));
        // components.form.url.formValidation
        $this->assertTrue(array_key_exists('displaySuccess', config('bootstrap-components.form.url.formValidation')));
        $this->assertTrue(array_key_exists('displayFailure', config('bootstrap-components.form.url.formValidation')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Input::class, get_parent_class(bsUrl()));
    }

    public function testSetName()
    {
        $html = bsUrl()->name('name')->toHtml();
        $this->assertStringContainsString('name="name"', $html);
    }

    public function testType()
    {
        $html = bsUrl()->name('name')->toHtml();
        $this->assertStringContainsString('type="url"', $html);
    }

    public function testInputWithoutName()
    {
        $this->expectException(Exception::class);
        bsUrl()->toHtml();
    }

    public function testModelValue()
    {
        $user = $this->createUniqueUser();
        $html = bsUrl()->model($user)->name('name')->toHtml();
        $this->assertStringContainsString('value="' . $user->name . '"', $html);
    }

    public function testConfigPrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.form.url.prepend', $configPrepend);
        $html = bsUrl()->name('name')->toHtml();
        $this->assertStringContainsString('input-group-prepend', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $configPrepend . '</span>', $html);
    }

    public function testSetPrepend()
    {
        $configPrepend = 'test-config-prepend';
        $customPrepend = 'test-custom-prepend';
        config()->set('bootstrap-components.form.url.prepend', $configPrepend);
        $html = bsUrl()->name('name')->prepend($customPrepend)->toHtml();
        $this->assertStringContainsString('input-group-prepend', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $customPrepend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="input-group-text">' . $configPrepend . '</span>', $html);
    }

    public function testNoPrepend()
    {
        config()->set('bootstrap-components.form.url.prepend', null);
        $html = bsUrl()->name('name')->toHtml();
        $this->assertStringNotContainsString('input-group-prepend', $html);
    }

    public function testHidePrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.form.url.prepend', $configPrepend);
        $html = bsUrl()->name('name')->prepend(false)->toHtml();
        $this->assertStringNotContainsString('input-group-prepend', $html);
    }

    public function testConfigAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.url.append', $configAppend);
        $html = bsUrl()->name('name')->toHtml();
        $this->assertStringContainsString('input-group-append', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $configAppend . '</span>', $html);
    }

    public function testSetAppend()
    {
        $configAppend = 'test-config-append';
        $customAppend = 'test-custom-append';
        config()->set('bootstrap-components.form.url.append', $configAppend);
        $html = bsUrl()->name('name')->append($customAppend)->toHtml();
        $this->assertStringContainsString('input-group-append', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $customAppend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="input-group-text">' . $configAppend . '</span>', $html);
    }

    public function testNoAppend()
    {
        config()->set('bootstrap-components.form.url.append', null);
        $html = bsUrl()->name('name')->toHtml();
        $this->assertStringNotContainsString('input-group-append', $html);
    }

    public function testHideAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.url.append', $configAppend);
        $html = bsUrl()->name('name')->append(false)->toHtml();
        $this->assertStringNotContainsString('input-group-append', $html);
    }

    public function testNoPrependNoAppend()
    {
        config()->set('bootstrap-components.form.url.prepend', null);
        config()->set('bootstrap-components.form.url.append', null);
        $html = bsUrl()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div class="input-group">', $html);
    }

    public function testHidePrependHideAppend()
    {
        $configPrepend = 'test-config-prepend';
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.url.prepend', $configPrepend);
        config()->set('bootstrap-components.form.url.append', $configAppend);
        $html = bsUrl()->name('name')->prepend(false)->append(false)->toHtml();
        $this->assertStringNotContainsString('<div class="input-group">', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.url.legend', $configLegend);
        $html = bsUrl()->name('name')->toHtml();
        $this->assertStringContainsString('url-name-legend', $html);
        $this->assertStringContainsString('bootstrap-components::' . $configLegend, $html);
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.form.url.legend', $configLegend);
        $html = bsUrl()->name('name')->legend($customLegend)->toHtml();
        $this->assertStringContainsString('url-name-legend', $html);
        $this->assertStringContainsString($customLegend, $html);
        $this->assertStringNotContainsString($configLegend, $html);
    }

    public function testSetTranslatedLegend()
    {
        $legend = 'bootstrap-components::bootstrap-components.label.validate';
        $html = bsUrl()->name('name')->legend($legend)->toHtml();
        $this->assertStringContainsString(__($legend), $html);
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.form.url.legend', null);
        $html = bsUrl()->name('name')->toHtml();
        $this->assertStringNotContainsString('url-name-legend', $html);
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.url.legend', $configLegend);
        $html = bsUrl()->name('name')->legend(false)->toHtml();
        $this->assertStringNotContainsString('url-name-legend', $html);
    }

    public function testSetValue()
    {
        $customValue = 'test-custom-value';
        $html = bsUrl()->name('name')->value($customValue)->toHtml();
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
        $html = bsUrl()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString('value="' . $oldValue . '"', $html);
        $this->assertStringNotContainsString('value="' . $customValue . '"', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsUrl()->name('name')->label($label)->toHtml();
        $this->assertStringContainsString('<label for="url-name">' . $label . '</label>', $html);
        $this->assertStringContainsString('placeholder="' . $label . '"', $html);
        $this->assertStringContainsString('aria-label="' . $label . '"', $html);
    }

    public function testSetTranslatedLabel()
    {
        $label = 'bootstrap-components::bootstrap-components.label.validate';
        $html = bsUrl()->name('name')->label($label)->toHtml();
        $this->assertStringContainsString('<label for="url-name">' . __($label) . '</label>', $html);
        $this->assertStringContainsString('placeholder="' . __($label) . '"', $html);
        $this->assertStringContainsString('aria-label="' . __($label) . '"', $html);
    }

    public function testNoLabel()
    {
        $html = bsUrl()->name('name')->toHtml();
        $this->assertStringContainsString('<label for="url-name">validation.attributes.name</label>', $html);
        $this->assertStringContainsString('aria-label="validation.attributes.name"', $html);
    }

    public function testHideLabel()
    {
        $html = bsUrl()->name('name')->label(false)->toHtml();
        $this->assertStringNotContainsString('<label for="url-name">validation.attributes.name</label>', $html);
        $this->assertStringNotContainsString('aria-label="validation.attributes.name"', $html);
    }

    public function testConfigLabelPositionedAbove()
    {
        config()->set('bootstrap-components.form.url.labelPositionedAbove', true);
        $html = bsUrl()->name('name')->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        $this->assertLessThan($inputPosition, $labelPosition);
    }

    public function testConfigLabelPositionedUnder()
    {
        config()->set('bootstrap-components.form.url.labelPositionedAbove', false);
        $html = bsUrl()->name('name')->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        $this->assertLessThan($labelPosition, $inputPosition);
    }

    public function testLabelPositionedAbove()
    {
        config()->set('bootstrap-components.form.url.labelPositionedAbove', false);
        $html = bsUrl()->name('name')->labelPositionedAbove()->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        $this->assertLessThan($inputPosition, $labelPosition);
    }

    public function testLabelPositionedUnder()
    {
        config()->set('bootstrap-components.form.url.labelPositionedAbove', true);
        $html = bsUrl()->name('name')->labelPositionedAbove(false)->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        $this->assertLessThan($labelPosition, $inputPosition);
    }

    public function testSetPlaceholder()
    {
        $placeholder = 'test-custom-placeholder';
        $html = bsUrl()->name('name')->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString('placeholder="' . $placeholder . '"', $html);
    }

    public function testSetTranslatedPlaceholder()
    {
        $placeholder = 'bootstrap-components::bootstrap-components.label.validate';
        $html = bsUrl()->name('name')->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString('placeholder="' . __($placeholder) . '"', $html);
    }

    public function testSetPlaceholderWithLabel()
    {
        $label = 'test-custom-label';
        $placeholder = 'test-custom-placeholder';
        $html = bsUrl()->name('name')->label($label)->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString('placeholder="' . $placeholder . '"', $html);
    }

    public function testNoPlaceholder()
    {
        $html = bsUrl()->name('name')->toHtml();
        $this->assertStringContainsString('placeholder="validation.attributes.name"', $html);
    }

    public function testNoPlaceholderWithNoLabel()
    {
        $html = bsUrl()->name('name')->label(false)->toHtml();
        $this->assertStringContainsString('placeholder="validation.attributes.name"', $html);
    }

    public function testHidePlaceholder()
    {
        $html = bsUrl()->name('name')->placeholder(false)->toHtml();
        $this->assertStringNotContainsString('placeholder="', $html);
    }

    public function testConfigDisplaySuccess()
    {
        config()->set('bootstrap-components.form.url.formValidation.displaySuccess', true);
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsUrl()->name('name')->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testConfigDoNotDisplaySuccess()
    {
        config()->set('bootstrap-components.form.url.formValidation.displaySuccess', false);
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsUrl()->name('name')->render(['errors' => $messageBag]);
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringNotContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testDisplaySuccess()
    {
        config()->set('bootstrap-components.form.url.formValidation.displaySuccess', false);
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsUrl()->name('name')->displaySuccess(true)->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testDoNotDisplaySuccess()
    {
        config()->set('bootstrap-components.form.url.formValidation.displaySuccess', true);
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsUrl()->name('name')->displaySuccess(false)->render(['errors' => $messageBag]);
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringNotContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testConfigDisplayFailure()
    {
        config()->set('bootstrap-components.form.url.formValidation.displayFailure', true);
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsUrl()->name('name')->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errorMessage, $html);
    }

    public function testConfigDoNotDisplayFailure()
    {
        config()->set('bootstrap-components.form.url.formValidation.displayFailure', false);
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsUrl()->name('name')->render(['errors' => $messageBag]);
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringNotContainsString($errorMessage, $html);
    }

    public function testDisplayFailure()
    {
        config()->set('bootstrap-components.form.url.formValidation.displayFailure', false);
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsUrl()->name('name')->displayFailure(true)->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errorMessage, $html);
    }

    public function testDoNotDisplayFailure()
    {
        config()->set('bootstrap-components.form.url.formValidation.displayFailure', true);
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsUrl()->name('name')->displayFailure(false)->render(['errors' => $messageBag]);
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringNotContainsString($errorMessage, $html);
    }

    public function testSetNoContainerId()
    {
        $html = bsUrl()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = bsUrl()->name('name')->containerId($customContainerId)->toHtml();
        $this->assertStringContainsString('<div id="' . $customContainerId . '"', $html);
    }

    public function testSetNoComponentId()
    {
        $html = bsUrl()->name('name')->toHtml();
        $this->assertStringContainsString('for="url-name"', $html);
        $this->assertStringContainsString('<input id="url-name"', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = bsUrl()->name('name')->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString('for="' . $customComponentId . '"', $html);
        $this->assertStringContainsString('<input id="' . $customComponentId . '"', $html);
    }

    public function testConfigContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        config()->set('bootstrap-components.form.url.classes.container', [$configContainerClasses]);
        $html = bsUrl()->name('name')->toHtml();
        $this->assertStringContainsString('class="url-name-container ' . $configContainerClasses . '"', $html);
    }

    public function testSetContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        $customContainerClasses = 'test-custom-class-container';
        config()->set('bootstrap-components.form.url.classes.container', [$configContainerClasses]);
        $html = bsUrl()->name('name')->containerClasses([$customContainerClasses])->toHtml();
        $this->assertStringContainsString(
            'class="url-name-container ' . $customContainerClasses . '"',
            $html
        );
        $this->assertStringNotContainsString(
            'class="url-name-container ' . $configContainerClasses . '"',
            $html
        );
    }

    public function testConfigComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        config()->set('bootstrap-components.form.url.classes.component', [$configComponentClasses]);
        $html = bsUrl()->name('name')->toHtml();
        $this->assertStringContainsString(
            'class="form-control url-name-component ' . $configComponentClasses . '"',
            $html
        );
    }

    public function testSetComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        $customComponentClasses = 'test-custom-class-component';
        config()->set('bootstrap-components.form.url.classes.component', [$customComponentClasses]);
        $html = bsUrl()->name('name')->componentClasses([$customComponentClasses])->toHtml();
        $this->assertStringContainsString(
            'class="form-control url-name-component ' . $customComponentClasses . '"',
            $html
        );
        $this->assertStringNotContainsString(
            'class="form-control url-name-component ' . $configComponentClasses . '"',
            $html
        );
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.url.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsUrl()->name('name')->toHtml();
        $this->assertStringContainsString($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.url.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsUrl()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertStringContainsString($customContainerAttributes, $html);
        $this->assertStringNotContainsString($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.url.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsUrl()->name('name')->toHtml();
        $this->assertStringContainsString($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.url.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsUrl()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertStringContainsString($customComponentAttributes, $html);
        $this->assertStringNotContainsString($configComponentAttributes, $html);
    }
}
