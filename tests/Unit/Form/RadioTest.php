<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Exception;
use Illuminate\Support\MessageBag;
use Okipa\LaravelBootstrapComponents\Form\Checkable;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\UsersFaker;

class RadioTest extends BootstrapComponentsTestCase
{
    use UsersFaker;

    public function testConfigStructure()
    {
        // components.form
        $this->assertTrue(array_key_exists('radio', config('bootstrap-components.form')));
        // components.form.radio
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.form.radio')));
        $this->assertTrue(array_key_exists('prepend', config('bootstrap-components.form.radio')));
        $this->assertTrue(array_key_exists('append', config('bootstrap-components.form.radio')));
        $this->assertTrue(array_key_exists('legend', config('bootstrap-components.form.radio')));
        $this->assertTrue(array_key_exists('class', config('bootstrap-components.form.radio')));
        $this->assertTrue(array_key_exists('htmlAttributes', config('bootstrap-components.form.radio')));
        // components.form.radio.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.radio.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.radio.class')));
        // components.form.radio.htmlAttributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.radio.htmlAttributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.radio.htmlAttributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Checkable::class, get_parent_class(bsRadio()));
    }

    public function testName()
    {
        $html = bsRadio()->name('name')->toHtml();
        $this->assertStringContainsString('name="name"', $html);
    }

    public function testType()
    {
        $html = bsRadio()->name('name')->toHtml();
        $this->assertStringContainsString('type="radio"', $html);
    }

    public function testInputWithoutName()
    {
        $this->expectException(Exception::class);
        bsRadio()->toHtml();
    }

    public function testModelValue()
    {
        $user = $this->createUniqueUser();
        $html = bsRadio()->model($user)->name('name')->toHtml();
        $this->assertStringContainsString('checked="checked"', $html);
    }

    public function testConfigPrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.form.radio.prepend', $configPrepend);
        $html = bsRadio()->name('name')->toHtml();
        $this->assertStringContainsString('<span class="label-prepend">' . $configPrepend . '</span>', $html);
    }

    public function testSetPrepend()
    {
        $configPrepend = 'test-config-prepend';
        $customPrepend = 'test-custom-prepend';
        config()->set('bootstrap-components.form.radio.prepend', $configPrepend);
        $html = bsRadio()->name('name')->prepend($customPrepend)->toHtml();
        $this->assertStringContainsString('<span class="label-prepend">' . $customPrepend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="label-prepend">' . $configPrepend . '</span>', $html);
    }

    public function testNoPrepend()
    {
        config()->set('bootstrap-components.form.radio.prepend', null);
        $html = bsRadio()->name('name')->toHtml();
        $this->assertStringNotContainsString('<span class="label-prepend">', $html);
    }

    public function testHidePrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.form.radio.prepend', $configPrepend);
        $html = bsRadio()->name('name')->prepend(false)->toHtml();
        $this->assertStringNotContainsString('<span class="label-prepend">', $html);
    }

    public function testConfigAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.radio.append', $configAppend);
        $html = bsRadio()->name('name')->toHtml();
        $this->assertStringContainsString('<span class="label-append">' . $configAppend . '</span>', $html);
    }

    public function testSetAppend()
    {
        $configAppend = 'test-config-append';
        $customAppend = 'test-custom-append';
        config()->set('bootstrap-components.form.radio.append', $configAppend);
        $html = bsRadio()->name('name')->append($customAppend)->toHtml();
        $this->assertStringContainsString('<span class="label-append">' . $customAppend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="label-append">' . $configAppend . '</span>', $html);
    }

    public function testNoAppend()
    {
        config()->set('bootstrap-components.form.radio.append', null);
        $html = bsRadio()->name('name')->toHtml();
        $this->assertStringNotContainsString('<span class="label-append">', $html);
    }

    public function testHideAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.radio.append', $configAppend);
        $html = bsRadio()->name('name')->append(false)->toHtml();
        $this->assertStringNotContainsString('<span class="label-append">', $html);
    }

    public function testChecked()
    {
        $user = null;
        $html = bsRadio()->model($user)->name('name')->checked(true)->toHtml();
        $this->assertStringContainsString('checked="checked"', $html);
    }

    public function testNotChecked()
    {
        $user = $this->createUniqueUser();
        $html = bsRadio()->model($user)->name('name')->checked(false)->toHtml();
        $this->assertStringNotContainsString('checked="checked"', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.radio.legend', $configLegend);
        $html = bsRadio()->name('name')->toHtml();
        $this->assertStringContainsString('radio-name-legend', $html);
        $this->assertStringContainsString($configLegend, $html);
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.form.radio.legend', $configLegend);
        $html = bsRadio()->name('name')->legend($customLegend)->toHtml();
        $this->assertStringContainsString('radio-name-legend', $html);
        $this->assertStringContainsString($customLegend, $html);
        $this->assertStringNotContainsString($configLegend, $html);
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.form.radio.legend', null);
        $html = bsRadio()->name('name')->toHtml();
        $this->assertStringNotContainsString('radio-name-legend', $html);
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.radio.legend', $configLegend);
        $html = bsRadio()->name('name')->legend(false)->toHtml();
        $this->assertStringNotContainsString('radio-name-legend', $html);
    }

    public function testSetValueDefaultCheckStatus()
    {
        $html = bsRadio()->name('name')->toHtml();
        $this->assertStringNotContainsString('checked="checked', $html);
    }

    public function testSetValueChecked()
    {
        $customValue = true;
        $html = bsRadio()->name('name')->checked($customValue)->toHtml();
        $this->assertStringContainsString('checked="checked', $html);
    }

    public function testOldValueChecked()
    {
        $oldValue = true;
        $customValue = false;
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValue) {
                $request = request()->merge(['name' => $oldValue]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = bsRadio()->name('name')->checked($customValue)->toHtml();
        $this->assertStringContainsString('checked="checked', $html);
    }

    public function testOldValueNotChecked()
    {
        $oldValue = false;
        $customValue = true;
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValue) {
                $request = request()->merge(['name' => $oldValue]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = bsRadio()->name('name')->checked($customValue)->toHtml();
        $this->assertStringNotContainsString('checked="checked', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsRadio()->name('name')->label($label)->toHtml();
        $this->assertStringContainsString('for="radio-name">' . $label . '</label>', $html);
    }

    public function testNoLabel()
    {
        $html = bsRadio()->name('name')->toHtml();
        $this->assertStringContainsString('for="radio-name">validation.attributes.name</label>', $html);
    }

    public function testHideLabel()
    {
        $html = bsRadio()->name('name')->label(false)->toHtml();
        $this->assertStringNotContainsString('for="radio-name">validation.attributes.name</label>', $html);
    }

    public function testConfigDisplaySuccess()
    {
        config()->set('bootstrap-components.form.radio.formValidation.displaySuccess', true);
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsRadio()->name('name')->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testConfigDoNotDisplaySuccess()
    {
        config()->set('bootstrap-components.form.radio.formValidation.displaySuccess', false);
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsRadio()->name('name')->render(['errors' => $messageBag]);
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringNotContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testDisplaySuccess()
    {
        config()->set('bootstrap-components.form.radio.formValidation.displaySuccess', false);
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsRadio()->name('name')->displaySuccess(true)->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testDoNotDisplaySuccess()
    {
        config()->set('bootstrap-components.form.radio.formValidation.displaySuccess', true);
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsRadio()->name('name')->displaySuccess(false)->render(['errors' => $messageBag]);
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringNotContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testConfigDisplayFailure()
    {
        config()->set('bootstrap-components.form.radio.formValidation.displayFailure', true);
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsRadio()->name('name')->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errorMessage, $html);
    }

    public function testConfigDoNotDisplayFailure()
    {
        config()->set('bootstrap-components.form.radio.formValidation.displayFailure', false);
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsRadio()->name('name')->render(['errors' => $messageBag]);
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringNotContainsString($errorMessage, $html);
    }

    public function testDisplayFailure()
    {
        config()->set('bootstrap-components.form.radio.formValidation.displayFailure', false);
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsRadio()->name('name')->displayFailure(true)->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errorMessage, $html);
    }

    public function testDoNotDisplayFailure()
    {
        config()->set('bootstrap-components.form.radio.formValidation.displayFailure', true);
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsRadio()->name('name')->displayFailure(false)->render(['errors' => $messageBag]);
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringNotContainsString($errorMessage, $html);
    }

    public function testSetNoContainerId()
    {
        $html = bsRadio()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = bsRadio()->name('name')->containerId($customContainerId)->toHtml();
        $this->assertStringContainsString('<div id="' . $customContainerId, $html);
    }

    public function testSetNoComponentId()
    {
        $html = bsRadio()->name('name')->toHtml();
        $this->assertStringContainsString('for="radio-name"', $html);
        $this->assertStringContainsString('<input id="radio-name"', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = bsRadio()->name('name')->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString('for="' . $customComponentId . '"', $html);
        $this->assertStringContainsString('<input id="' . $customComponentId . '"', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.form.radio.class.container', [$configContainerCLass]);
        $html = bsRadio()->name('name')->toHtml();
        $this->assertStringContainsString(
            'class="radio-name-container custom-control custom-radio ' . $configContainerCLass . '"',
            $html
        );
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.form.radio.class.container', [$configContainerCLass]);
        $html = bsRadio()->name('name')->containerClass([$customContainerCLass])->toHtml();
        $this->assertStringContainsString(
            'class="radio-name-container custom-control custom-radio ' . $customContainerCLass . '"',
            $html
        );
        $this->assertStringNotContainsString(
            'class="radio-name-container custom-control custom-radio ' . $configContainerCLass . '"',
            $html
        );
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.form.radio.class.component', [$configComponentCLass]);
        $html = bsRadio()->name('name')->toHtml();
        $this->assertStringContainsString(
            'class="radio-name-component custom-control-input ' . $configComponentCLass . '"',
            $html
        );
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.form.radio.class.component', [$customComponentCLass]);
        $html = bsRadio()->name('name')->componentClass([$customComponentCLass])->toHtml();
        $this->assertStringContainsString(
            'class="radio-name-component custom-control-input ' . $customComponentCLass . '"',
            $html
        );
        $this->assertStringNotContainsString(
            'class="form-control radio-name-component ' . $configComponentCLass . '"',
            $html
        );
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.radio.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsRadio()->name('name')->toHtml();
        $this->assertStringContainsString($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.radio.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsRadio()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertStringContainsString($customContainerAttributes, $html);
        $this->assertStringNotContainsString($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.radio.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsRadio()->name('name')->toHtml();
        $this->assertStringContainsString($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.radio.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsRadio()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertStringContainsString($customComponentAttributes, $html);
        $this->assertStringNotContainsString($configComponentAttributes, $html);
    }
}
