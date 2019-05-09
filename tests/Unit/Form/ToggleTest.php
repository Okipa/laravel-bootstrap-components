<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Exception;
use Illuminate\Support\MessageBag;
use Okipa\LaravelBootstrapComponents\Form\Checkable;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\UsersFaker;

class ToggleTest extends BootstrapComponentsTestCase
{
    use UsersFaker;

    public function testConfigStructure()
    {
        // components.form
        $this->assertTrue(array_key_exists('toggle', config('bootstrap-components.form')));
        // components.form.toggle
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.form.toggle')));
        $this->assertTrue(array_key_exists('prepend', config('bootstrap-components.form.toggle')));
        $this->assertTrue(array_key_exists('append', config('bootstrap-components.form.toggle')));
        $this->assertTrue(array_key_exists('legend', config('bootstrap-components.form.toggle')));
        $this->assertTrue(array_key_exists('class', config('bootstrap-components.form.toggle')));
        $this->assertTrue(array_key_exists('htmlAttributes', config('bootstrap-components.form.toggle')));
        // components.form.toggle.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.toggle.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.toggle.class')));
        // components.form.toggle.htmlAttributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.toggle.htmlAttributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.toggle.htmlAttributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Checkable::class, get_parent_class(bsToggle()));
    }

    public function testName()
    {
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringContainsString('name="name"', $html);
    }

    public function testType()
    {
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringContainsString('type="checkbox"', $html);
    }

    public function testInputWithoutName()
    {
        $this->expectException(Exception::class);
        bsToggle()->toHtml();
    }

    public function testModelValue()
    {
        $user = $this->createUniqueUser();
        $html = bsToggle()->model($user)->name('name')->toHtml();
        $this->assertStringContainsString('checked="checked"', $html);
    }

    public function testConfigPrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.form.toggle.prepend', $configPrepend);
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringContainsString('<span class="label-prepend">' . $configPrepend . '</span>', $html);
    }

    public function testSetPrepend()
    {
        $configPrepend = 'test-config-prepend';
        $customPrepend = 'test-custom-prepend';
        config()->set('bootstrap-components.form.toggle.prepend', $configPrepend);
        $html = bsToggle()->name('name')->prepend($customPrepend)->toHtml();
        $this->assertStringContainsString('<span class="label-prepend">' . $customPrepend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="label-prepend">' . $configPrepend . '</span>', $html);
    }

    public function testNoPrepend()
    {
        config()->set('bootstrap-components.form.toggle.prepend', null);
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringNotContainsString('<span class="label-prepend">', $html);
    }

    public function testHidePrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.form.toggle.prepend', $configPrepend);
        $html = bsToggle()->name('name')->prepend(false)->toHtml();
        $this->assertStringNotContainsString('<span class="label-prepend">', $html);
    }

    public function testConfigAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.toggle.append', $configAppend);
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringContainsString('<span class="label-append">' . $configAppend . '</span>', $html);
    }

    public function testSetAppend()
    {
        $configAppend = 'test-config-append';
        $customAppend = 'test-custom-append';
        config()->set('bootstrap-components.form.toggle.append', $configAppend);
        $html = bsToggle()->name('name')->append($customAppend)->toHtml();
        $this->assertStringContainsString('<span class="label-append">' . $customAppend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="label-append">' . $configAppend . '</span>', $html);
    }

    public function testNoAppend()
    {
        config()->set('bootstrap-components.form.toggle.append', null);
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringNotContainsString('<span class="label-append">', $html);
    }

    public function testHideAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.toggle.append', $configAppend);
        $html = bsToggle()->name('name')->append(false)->toHtml();
        $this->assertStringNotContainsString('<span class="label-append">', $html);
    }

    public function testChecked()
    {
        $user = null;
        $html = bsToggle()->model($user)->name('name')->checked(true)->toHtml();
        $this->assertStringContainsString('checked="checked"', $html);
    }

    public function testNotChecked()
    {
        $user = $this->createUniqueUser();
        $html = bsToggle()->model($user)->name('name')->checked(false)->toHtml();
        $this->assertStringNotContainsString('checked="checked"', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.toggle.legend', $configLegend);
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringContainsString('toggle-name-legend', $html);
        $this->assertStringContainsString($configLegend, $html);
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.form.toggle.legend', $configLegend);
        $html = bsToggle()->name('name')->legend($customLegend)->toHtml();
        $this->assertStringContainsString('toggle-name-legend', $html);
        $this->assertStringContainsString($customLegend, $html);
        $this->assertStringNotContainsString($configLegend, $html);
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.form.toggle.legend', null);
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringNotContainsString('toggle-name-legend', $html);
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.toggle.legend', $configLegend);
        $html = bsToggle()->name('name')->legend(false)->toHtml();
        $this->assertStringNotContainsString('toggle-name-legend', $html);
    }

    public function testSetValueDefaultCheckStatus()
    {
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringNotContainsString('checked="checked', $html);
    }

    public function testSetValueChecked()
    {
        $customValue = true;
        $html = bsToggle()->name('name')->value($customValue)->toHtml();
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
        $html = bsToggle()->name('name')->value($customValue)->toHtml();
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
        $html = bsToggle()->name('name')->value($customValue)->toHtml();
        $this->assertStringNotContainsString('checked="checked', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsToggle()->name('name')->label($label)->toHtml();
        $this->assertStringContainsString('for="toggle-name">' . $label . '</label>', $html);
    }

    public function testNoLabel()
    {
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringContainsString(
            'for="toggle-name">validation.attributes.name</label>',
            $html
        );
    }

    public function testHideLabel()
    {
        $html = bsToggle()->name('name')->label(false)->toHtml();
        $this->assertStringNotContainsString(
            'for="toggle-name">validation.attributes.name</label>',
            $html
        );
    }

    public function testConfigDisplaySuccess()
    {
        config()->set('bootstrap-components.form.toggle.formValidation.displaySuccess', true);
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsToggle()->name('name')->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testConfigDoNotDisplaySuccess()
    {
        config()->set('bootstrap-components.form.toggle.formValidation.displaySuccess', false);
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsToggle()->name('name')->render(['errors' => $messageBag]);
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringNotContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testDisplaySuccess()
    {
        config()->set('bootstrap-components.form.toggle.formValidation.displaySuccess', false);
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsToggle()->name('name')->displaySuccess(true)->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testDoNotDisplaySuccess()
    {
        config()->set('bootstrap-components.form.toggle.formValidation.displaySuccess', true);
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsToggle()->name('name')->displaySuccess(false)->render(['errors' => $messageBag]);
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringNotContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testConfigDisplayFailure()
    {
        config()->set('bootstrap-components.form.toggle.formValidation.displayFailure', true);
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsToggle()->name('name')->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errorMessage, $html);
    }

    public function testConfigDoNotDisplayFailure()
    {
        config()->set('bootstrap-components.form.toggle.formValidation.displayFailure', false);
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsToggle()->name('name')->render(['errors' => $messageBag]);
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringNotContainsString($errorMessage, $html);
    }

    public function testDisplayFailure()
    {
        config()->set('bootstrap-components.form.toggle.formValidation.displayFailure', false);
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsToggle()->name('name')->displayFailure(true)->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errorMessage, $html);
    }

    public function testDoNotDisplayFailure()
    {
        config()->set('bootstrap-components.form.toggle.formValidation.displayFailure', true);
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsToggle()->name('name')->displayFailure(false)->render(['errors' => $messageBag]);
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringNotContainsString($errorMessage, $html);
    }

    public function testSetNoContainerId()
    {
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = bsToggle()->name('name')->containerId($customContainerId)->toHtml();
        $this->assertStringContainsString('<div id="' . $customContainerId, $html);
    }

    public function testSetNoComponentId()
    {
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringContainsString('for="toggle-name"', $html);
        $this->assertStringContainsString('<input id="toggle-name"', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = bsToggle()->name('name')->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString('for="' . $customComponentId . '"', $html);
        $this->assertStringContainsString('<input id="' . $customComponentId . '"', $html);
    }

    public function testConfigContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        config()->set('bootstrap-components.form.toggle.class.container', [$configContainerClasses]);
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringContainsString(
            'class="toggle-name-container switch custom-control ' . $configContainerClasses . '"',
            $html
        );
    }

    public function testSetContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        $customContainerClasses = 'test-custom-class-container';
        config()->set('bootstrap-components.form.toggle.class.container', [$configContainerClasses]);
        $html = bsToggle()->name('name')->containerClasses([$customContainerClasses])->toHtml();
        $this->assertStringContainsString(
            'class="toggle-name-container switch custom-control ' . $customContainerClasses . '"',
            $html
        );
        $this->assertStringNotContainsString(
            'class="toggle-name-container switch custom-control ' . $configContainerClasses . '"',
            $html
        );
    }

    public function testConfigComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        config()->set('bootstrap-components.form.toggle.class.component', [$configComponentClasses]);
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringContainsString(
            'class="toggle-name-component custom-control-input ' . $configComponentClasses . '"',
            $html
        );
    }

    public function testSetComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        $customComponentClasses = 'test-custom-class-component';
        config()->set('bootstrap-components.form.toggle.class.component', [$customComponentClasses]);
        $html = bsToggle()->name('name')->componentClasses([$customComponentClasses])->toHtml();
        $this->assertStringContainsString(
            'class="toggle-name-component custom-control-input ' . $customComponentClasses . '"',
            $html
        );
        $this->assertStringNotContainsString(
            'class="form-control toggle-name-component ' . $configComponentClasses . '"',
            $html
        );
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.toggle.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringContainsString($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.toggle.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsToggle()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertStringContainsString($customContainerAttributes, $html);
        $this->assertStringNotContainsString($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.toggle.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringContainsString($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.toggle.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsToggle()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertStringContainsString($customComponentAttributes, $html);
        $this->assertStringNotContainsString($configComponentAttributes, $html);
    }
}
