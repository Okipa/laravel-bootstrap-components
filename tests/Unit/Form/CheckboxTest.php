<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Exception;
use Illuminate\Support\MessageBag;
use Okipa\LaravelBootstrapComponents\Form\Checkable;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\UsersFaker;

class CheckboxTest extends BootstrapComponentsTestCase
{
    use UsersFaker;

    public function testConfigStructure()
    {
        // components.form
        $this->assertTrue(array_key_exists('checkbox', config('bootstrap-components.form')));
        // components.form.checkbox
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.form.checkbox')));
        $this->assertTrue(array_key_exists('prepend', config('bootstrap-components.form.checkbox')));
        $this->assertTrue(array_key_exists('append', config('bootstrap-components.form.checkbox')));
        $this->assertTrue(array_key_exists('legend', config('bootstrap-components.form.checkbox')));
        $this->assertTrue(array_key_exists('class', config('bootstrap-components.form.checkbox')));
        $this->assertTrue(array_key_exists('htmlAttributes', config('bootstrap-components.form.checkbox')));
        // components.form.checkbox.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.checkbox.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.checkbox.class')));
        // components.form.checkbox.htmlAttributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.checkbox.htmlAttributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.checkbox.htmlAttributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Checkable::class, get_parent_class(bsCheckbox()));
    }

    public function testName()
    {
        $html = bsCheckbox()->name('active')->toHtml();
        $this->assertStringContainsString('name="active"', $html);
    }

    public function testType()
    {
        $html = bsCheckbox()->name('active')->toHtml();
        $this->assertStringContainsString('type="checkbox"', $html);
    }

    public function testInputWithoutName()
    {
        $this->expectException(Exception::class);
        bsCheckbox()->toHtml();
    }

    public function testModelValue()
    {
        $user = $this->createUniqueUser();
        $html = bsCheckbox()->model($user)->name('active')->toHtml();
        $this->assertStringContainsString('checked="checked"', $html);
    }

    public function testConfigPrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.form.checkbox.prepend', $configPrepend);
        $html = bsCheckbox()->name('active')->toHtml();
        $this->assertStringContainsString('<span class="label-prepend">' . $configPrepend . '</span>', $html);
    }

    public function testSetPrepend()
    {
        $configPrepend = 'test-config-prepend';
        $customPrepend = 'test-custom-prepend';
        config()->set('bootstrap-components.form.checkbox.prepend', $configPrepend);
        $html = bsCheckbox()->name('active')->prepend($customPrepend)->toHtml();
        $this->assertStringContainsString('<span class="label-prepend">' . $customPrepend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="label-prepend">' . $configPrepend . '</span>', $html);
    }

    public function testNoPrepend()
    {
        config()->set('bootstrap-components.form.checkbox.prepend', null);
        $html = bsCheckbox()->name('active')->toHtml();
        $this->assertStringNotContainsString('<span class="label-prepend">', $html);
    }

    public function testHidePrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.form.checkbox.prepend', $configPrepend);
        $html = bsCheckbox()->name('active')->prepend(false)->toHtml();
        $this->assertStringNotContainsString('<span class="label-prepend">', $html);
    }

    public function testConfigAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.checkbox.append', $configAppend);
        $html = bsCheckbox()->name('active')->toHtml();
        $this->assertStringContainsString('<span class="label-append">' . $configAppend . '</span>', $html);
    }

    public function testSetAppend()
    {
        $configAppend = 'test-config-append';
        $customAppend = 'test-custom-append';
        config()->set('bootstrap-components.form.checkbox.append', $configAppend);
        $html = bsCheckbox()->name('active')->append($customAppend)->toHtml();
        $this->assertStringContainsString('<span class="label-append">' . $customAppend . '</span>', $html);
        $this->assertStringNotContainsString(
            '<span class="label-append">' . $configAppend . '</span>',
            $html
        );
    }

    public function testNoAppend()
    {
        config()->set('bootstrap-components.form.checkbox.append', null);
        $html = bsCheckbox()->name('active')->toHtml();
        $this->assertStringNotContainsString('<span class="label-append">', $html);
    }

    public function testHideAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.checkbox.append', $configAppend);
        $html = bsCheckbox()->name('active')->append(false)->toHtml();
        $this->assertStringNotContainsString('<span class="label-append">', $html);
    }

    public function testNoPrependNoAppend()
    {
        config()->set('bootstrap-components.form.checkbox.prepend', null);
        config()->set('bootstrap-components.form.checkbox.append', null);
        $html = bsCheckbox()->name('active')->toHtml();
        $this->assertStringNotContainsString('<div class="input-group">', $html);
    }

    public function testHidePrependHideAppend()
    {
        $configPrepend = 'test-config-prepend';
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.checkbox.prepend', $configPrepend);
        config()->set('bootstrap-components.form.checkbox.append', $configAppend);
        $html = bsCheckbox()->name('active')->prepend(false)->append(false)->toHtml();
        $this->assertStringNotContainsString('<div class="input-group">', $html);
    }

    public function testChecked()
    {
        $user = null;
        $html = bsCheckbox()->model($user)->name('active')->checked()->toHtml();
        $this->assertStringContainsString('checked="checked"', $html);
    }

    public function testNotChecked()
    {
        $user = $this->createUniqueUser();
        $html = bsCheckbox()->model($user)->name('active')->checked(false)->toHtml();
        $this->assertStringNotContainsString('checked="checked"', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.checkbox.legend', $configLegend);
        $html = bsCheckbox()->name('active')->toHtml();
        $this->assertStringContainsString('checkbox-active-legend', $html);
        $this->assertStringContainsString($configLegend, $html);
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.form.checkbox.legend', $configLegend);
        $html = bsCheckbox()->name('active')->legend($customLegend)->toHtml();
        $this->assertStringContainsString('checkbox-active-legend', $html);
        $this->assertStringContainsString($customLegend, $html);
        $this->assertStringNotContainsString($configLegend, $html);
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.form.checkbox.legend', null);
        $html = bsCheckbox()->name('active')->toHtml();
        $this->assertStringNotContainsString('checkbox-active-legend', $html);
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.checkbox.legend', $configLegend);
        $html = bsCheckbox()->name('active')->legend(false)->toHtml();
        $this->assertStringNotContainsString('checkbox-active-legend', $html);
    }

    public function testSetValueDefaultCheckStatus()
    {
        $html = bsCheckbox()->name('active')->toHtml();
        $this->assertStringNotContainsString('checked="checked', $html);
    }

    public function testSetValueChecked()
    {
        $html = bsCheckbox()->name('active')->value(true)->toHtml();
        $this->assertStringContainsString('checked="checked', $html);
    }

    public function testSetValueNotChecked()
    {
        $html = bsCheckbox()->name('active')->value(false)->toHtml();
        $this->assertStringNotContainsString('checked="checked', $html);
    }

    public function testOldValueChecked()
    {
        $oldValue = true;
        $customValue = false;
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValue) {
                $request = request()->merge(['active' => $oldValue]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = bsCheckbox()->name('active')->value($customValue)->toHtml();
        $this->assertStringContainsString('checked="checked', $html);
    }

    public function testOldValueNotChecked()
    {
        $oldValue = false;
        $customValue = true;
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValue) {
                $request = request()->merge(['active' => $oldValue]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = bsCheckbox()->name('active')->value($customValue)->toHtml();
        $this->assertStringNotContainsString('checked="checked', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsCheckbox()->name('active')->label($label)->toHtml();
        $this->assertStringContainsString($label . '</label>', $html);
    }

    public function testNoLabel()
    {
        $html = bsCheckbox()->name('active')->toHtml();
        $this->assertStringContainsString('validation.attributes.active</label>', $html);
    }

    public function testHideLabel()
    {
        $html = bsCheckbox()->name('active')->label(false)->toHtml();
        $this->assertStringNotContainsString('validation.attributes.active</label>', $html);
    }

    public function testConfigDisplaySuccess()
    {
        config()->set('bootstrap-components.form.checkbox.formValidation.displaySuccess', true);
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsCheckbox()->name('active')->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testConfigDoNotDisplaySuccess()
    {
        config()->set('bootstrap-components.form.checkbox.formValidation.displaySuccess', false);
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsCheckbox()->name('active')->render(['errors' => $messageBag]);
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringNotContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testDisplaySuccess()
    {
        config()->set('bootstrap-components.form.checkbox.formValidation.displaySuccess', false);
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsCheckbox()->name('active')->displaySuccess(true)->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testDoNotDisplaySuccess()
    {
        config()->set('bootstrap-components.form.checkbox.formValidation.displaySuccess', true);
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsCheckbox()->name('active')->displaySuccess(false)->render(['errors' => $messageBag]);
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringNotContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testConfigDisplayFailure()
    {
        config()->set('bootstrap-components.form.checkbox.formValidation.displayFailure', true);
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('active', $errorMessage);
        $html = bsCheckbox()->name('active')->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errorMessage, $html);
    }

    public function testConfigDoNotDisplayFailure()
    {
        config()->set('bootstrap-components.form.checkbox.formValidation.displayFailure', false);
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('active', $errorMessage);
        $html = bsCheckbox()->name('active')->render(['errors' => $messageBag]);
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringNotContainsString($errorMessage, $html);
    }

    public function testDisplayFailure()
    {
        config()->set('bootstrap-components.form.checkbox.formValidation.displayFailure', false);
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('active', $errorMessage);
        $html = bsCheckbox()->name('active')->displayFailure(true)->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errorMessage, $html);
    }

    public function testDoNotDisplayFailure()
    {
        config()->set('bootstrap-components.form.checkbox.formValidation.displayFailure', true);
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('active', $errorMessage);
        $html = bsCheckbox()->name('active')->displayFailure(false)->render(['errors' => $messageBag]);
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringNotContainsString($errorMessage, $html);
    }

    public function testSetNoContainerId()
    {
        $html = bsCheckbox()->name('active')->toHtml();
        $this->assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = bsCheckbox()->name('active')->containerId($customContainerId)->toHtml();
        $this->assertStringContainsString('<div id="' . $customContainerId, $html);
    }

    public function testSetNoComponentId()
    {
        $html = bsCheckbox()->name('active')->toHtml();
        $this->assertStringContainsString('for="checkbox-active"', $html);
        $this->assertStringContainsString('<input id="checkbox-active"', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = bsCheckbox()->name('active')->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString('for="' . $customComponentId . '"', $html);
        $this->assertStringContainsString('<input id="' . $customComponentId . '"', $html);
    }

    public function testConfigContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        config()->set('bootstrap-components.form.checkbox.class.container', [$configContainerClasses]);
        $html = bsCheckbox()->name('active')->toHtml();
        $this->assertStringContainsString(
            'class="checkbox-active-container custom-control custom-checkbox ' . $configContainerClasses . '"',
            $html
        );
    }

    public function testSetContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        $customContainerClasses = 'test-custom-class-container';
        config()->set('bootstrap-components.form.checkbox.class.container', [$configContainerClasses]);
        $html = bsCheckbox()->name('active')->containerClasses([$customContainerClasses])->toHtml();
        $this->assertStringContainsString(
            'class="checkbox-active-container custom-control custom-checkbox ' . $customContainerClasses . '"',
            $html
        );
        $this->assertStringNotContainsString(
            'class="checkbox-active-container custom-control custom-checkbox ' . $configContainerClasses . '"',
            $html
        );
    }

    public function testConfigComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        config()->set('bootstrap-components.form.checkbox.class.component', [$configComponentClasses]);
        $html = bsCheckbox()->name('active')->toHtml();
        $this->assertStringContainsString(
            'class="checkbox-active-component custom-control-input ' . $configComponentClasses . '"',
            $html
        );
    }

    public function testSetComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        $customComponentClasses = 'test-custom-class-component';
        config()->set('bootstrap-components.form.checkbox.class.component', [$customComponentClasses]);
        $html = bsCheckbox()->name('active')->componentClasses([$customComponentClasses])->toHtml();
        $this->assertStringContainsString(
            'class="checkbox-active-component custom-control-input ' . $customComponentClasses . '"',
            $html
        );
        $this->assertStringNotContainsString(
            'class="form-control checkbox-active-component ' . $configComponentClasses . '"',
            $html
        );
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.checkbox.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsCheckbox()->name('active')->toHtml();
        $this->assertStringContainsString($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.checkbox.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsCheckbox()->name('active')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertStringContainsString($customContainerAttributes, $html);
        $this->assertStringNotContainsString($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.checkbox.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsCheckbox()->name('active')->toHtml();
        $this->assertStringContainsString($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.checkbox.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsCheckbox()->name('active')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertStringContainsString($customComponentAttributes, $html);
        $this->assertStringNotContainsString($configComponentAttributes, $html);
    }
}
