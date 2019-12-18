<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Exception;
use Illuminate\Support\MessageBag;
use Okipa\LaravelBootstrapComponents\Form\Checkable;
use Okipa\LaravelBootstrapComponents\Tests\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Tests\Fakers\UsersFaker;

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
        $this->assertTrue(array_key_exists('classes', config('bootstrap-components.form.radio')));
        $this->assertTrue(array_key_exists('htmlAttributes', config('bootstrap-components.form.radio')));
        // components.form.radio.classes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.radio.classes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.radio.classes')));
        // components.form.radio.htmlAttributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.radio.htmlAttributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.radio.htmlAttributes')));
        // components.form.radio.formValidation
        $this->assertTrue(array_key_exists('displaySuccess', config('bootstrap-components.form.radio.formValidation')));
        $this->assertTrue(array_key_exists('displayFailure', config('bootstrap-components.form.radio.formValidation')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Checkable::class, get_parent_class(bsRadio()));
    }

    public function testName()
    {
        $customValue = 'test-custom-value';
        $html = bsRadio()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString(' name="name"', $html);
    }

    public function testType()
    {
        $customValue = 'test-custom-value';
        $html = bsRadio()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString(' type="radio"', $html);
    }

    public function testInputWithoutName()
    {
        $this->expectException(Exception::class);
        bsRadio()->toHtml();
    }

    public function testInputWithoutValue()
    {
        $this->expectException(Exception::class);
        bsRadio()->name('name')->toHtml();
    }

    public function testSetValue()
    {
        $customValue = 'test-custom-value';
        $html = bsRadio()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString(' value="' . $customValue . '"', $html);
    }

    public function testConfigPrepend()
    {
        $customValue = 'test-custom-value';
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.form.radio.prepend', $configPrepend);
        $html = bsRadio()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString('<span class="label-prepend">' . $configPrepend . '</span>', $html);
    }

    public function testSetPrepend()
    {
        $customValue = 'test-custom-value';
        $configPrepend = 'test-config-prepend';
        $customPrepend = 'test-custom-prepend';
        config()->set('bootstrap-components.form.radio.prepend', $configPrepend);
        $html = bsRadio()->name('name')->value($customValue)->prepend($customPrepend)->toHtml();
        $this->assertStringContainsString('<span class="label-prepend">' . $customPrepend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="label-prepend">' . $configPrepend . '</span>', $html);
    }

    public function testNoPrepend()
    {
        $customValue = 'test-custom-value';
        config()->set('bootstrap-components.form.radio.prepend', null);
        $html = bsRadio()->name('name')->value($customValue)->toHtml();
        $this->assertStringNotContainsString('<span class="label-prepend">', $html);
    }

    public function testHidePrepend()
    {
        $customValue = 'test-custom-value';
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.form.radio.prepend', $configPrepend);
        $html = bsRadio()->name('name')->value($customValue)->prepend(false)->toHtml();
        $this->assertStringNotContainsString('<span class="label-prepend">', $html);
    }

    public function testConfigAppend()
    {
        $customValue = 'test-custom-value';
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.radio.append', $configAppend);
        $html = bsRadio()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString('<span class="label-append">' . $configAppend . '</span>', $html);
    }

    public function testSetAppend()
    {
        $customValue = 'test-custom-value';
        $configAppend = 'test-config-append';
        $customAppend = 'test-custom-append';
        config()->set('bootstrap-components.form.radio.append', $configAppend);
        $html = bsRadio()->name('name')->value($customValue)->append($customAppend)->toHtml();
        $this->assertStringContainsString('<span class="label-append">' . $customAppend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="label-append">' . $configAppend . '</span>', $html);
    }

    public function testNoAppend()
    {
        $customValue = 'test-custom-value';
        config()->set('bootstrap-components.form.radio.append', null);
        $html = bsRadio()->name('name')->value($customValue)->toHtml();
        $this->assertStringNotContainsString('<span class="label-append">', $html);
    }

    public function testHideAppend()
    {
        $customValue = 'test-custom-value';
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.radio.append', $configAppend);
        $html = bsRadio()->name('name')->value($customValue)->append(false)->toHtml();
        $this->assertStringNotContainsString('<span class="label-append">', $html);
    }

    public function testSetValueDefaultCheckStatus()
    {
        $customValue = 'test-custom-value';
        $html = bsRadio()->name('name')->value($customValue)->toHtml();
        $this->assertStringNotContainsString('checked="checked', $html);
    }

    public function testChecked()
    {
        $customValue = 'test-custom-value';
        $html = bsRadio()->name('name')->value($customValue)->checked()->toHtml();
        $this->assertStringContainsString('checked="checked"', $html);
    }

    public function testNotChecked()
    {
        $customValue = 'test-custom-value';
        $html = bsRadio()->name('name')->value($customValue)->checked(false)->toHtml();
        $this->assertStringNotContainsString('checked="checked"', $html);
    }

    public function testModelValueChecked()
    {
        $user = $this->createUniqueUser();
        $html = bsRadio()->name('name')->model($user)->value($user->name)->toHtml();
        $this->assertStringContainsString('checked="checked"', $html);
    }

    public function testOldValueChecked()
    {
        $oldValue = 'test-old-value';
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValue) {
                $request = request()->merge(['name' => $oldValue]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = bsRadio()->name('name')->value($oldValue)->checked(false)->toHtml();
        $this->assertStringContainsString('checked="checked', $html);
    }

    public function testOldValueNotChecked()
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
        $html = bsRadio()->name('name')->value($customValue)->checked()->toHtml();
        $this->assertStringNotContainsString('checked="checked', $html);
    }

    public function testConfigLegend()
    {
        $customValue = 'test-custom-value';
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.radio.legend', $configLegend);
        $html = bsRadio()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString('radio-name-legend', $html);
        $this->assertStringContainsString('bootstrap-components::' . $configLegend, $html);
    }

    public function testSetLegend()
    {
        $customValue = 'test-custom-value';
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.form.radio.legend', $configLegend);
        $html = bsRadio()->name('name')->value($customValue)->legend($customLegend)->toHtml();
        $this->assertStringContainsString('radio-name-legend', $html);
        $this->assertStringContainsString($customLegend, $html);
        $this->assertStringNotContainsString($configLegend, $html);
    }

    public function testSetTranslatedLegend()
    {
        $customValue = 'test-custom-value';
        $legend = 'bootstrap-components::bootstrap-components.label.validate';
        $html = bsRadio()->name('name')->value($customValue)->legend($legend)->toHtml();
        $this->assertStringContainsString(__($legend), $html);
    }

    public function testNoLegend()
    {
        $customValue = 'test-custom-value';
        config()->set('bootstrap-components.form.radio.legend', null);
        $html = bsRadio()->name('name')->value($customValue)->toHtml();
        $this->assertStringNotContainsString('radio-name-legend', $html);
    }

    public function testHideLegend()
    {
        $customValue = 'test-custom-value';
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.radio.legend', $configLegend);
        $html = bsRadio()->name('name')->value($customValue)->legend(false)->toHtml();
        $this->assertStringNotContainsString('radio-name-legend', $html);
    }

    public function testSetLabel()
    {
        $customValue = 'test-custom-value';
        $label = 'test-custom-label';
        $html = bsRadio()->name('name')->value($customValue)->label($label)->toHtml();
        $this->assertStringContainsString(' for="radio-name-test-custom-value">' . $label . '</label>', $html);
    }

    public function testSetTranslatedLabel()
    {
        $customValue = 'test-custom-value';
        $label = 'bootstrap-components::bootstrap-components.label.validate';
        $html = bsRadio()->name('name')->value($customValue)->label($label)->toHtml();
        $this->assertStringContainsString(
            ' for="radio-name-test-custom-value">' . __($label) . '</label>',
            $html
        );
    }

    public function testNoLabel()
    {
        $customValue = 'test-custom-value';
        $html = bsRadio()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString('validation.attributes.name</label>', $html);
    }

    public function testHideLabel()
    {
        $customValue = 'test-custom-value';
        $html = bsRadio()->name('name')->value($customValue)->label(false)->toHtml();
        $this->assertStringNotContainsString(' for="radio-name">validation.attributes.name</label>', $html);
    }

    public function testConfigDisplaySuccess()
    {
        $customValue = 'test-custom-value';
        config()->set('bootstrap-components.form.radio.formValidation.displaySuccess', true);
        $errors = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsRadio()->name('name')->value($customValue)->render(compact('errors'));
        $this->assertStringContainsString('is-valid', $html);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testConfigDoNotDisplaySuccess()
    {
        $customValue = 'test-custom-value';
        config()->set('bootstrap-components.form.radio.formValidation.displaySuccess', false);
        $errors = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsRadio()->name('name')->value($customValue)->render(compact('errors'));
        $this->assertStringNotContainsString('is-valid', $html);
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringNotContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testDisplaySuccess()
    {
        $customValue = 'test-custom-value';
        config()->set('bootstrap-components.form.radio.formValidation.displaySuccess', false);
        $errors = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsRadio()->name('name')->value($customValue)->displaySuccess()->render(compact('errors'));
        $this->assertStringContainsString('is-valid', $html);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testDoNotDisplaySuccess()
    {
        $customValue = 'test-custom-value';
        config()->set('bootstrap-components.form.radio.formValidation.displaySuccess', true);
        $errors = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsRadio()->name('name')->value($customValue)->displaySuccess(false)->render(compact('errors'));
        $this->assertStringNotContainsString('is-valid', $html);
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringNotContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testConfigDisplayFailure()
    {
        $customValue = 'test-custom-value';
        config()->set('bootstrap-components.form.radio.formValidation.displayFailure', true);
        $errors = app(MessageBag::class)->add('name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsRadio()->name('name')->value($customValue)->render(compact('errors'));
        $this->assertStringContainsString('is-invalid', $html);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errors->first('name'), $html);
    }

    public function testConfigDoNotDisplayFailure()
    {
        $customValue = 'test-custom-value';
        config()->set('bootstrap-components.form.radio.formValidation.displayFailure', false);
        $errors = app(MessageBag::class)->add('name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsRadio()->name('name')->value($customValue)->render(compact('errors'));
        $this->assertStringNotContainsString('is-invalid', $html);
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringNotContainsString($errors->first('name'), $html);
    }

    public function testDisplayFailure()
    {
        $customValue = 'test-custom-value';
        config()->set('bootstrap-components.form.radio.formValidation.displayFailure', false);
        $errors = app(MessageBag::class)->add('name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsRadio()->name('name')->value($customValue)->displayFailure()->render(compact('errors'));
        $this->assertStringContainsString('is-invalid', $html);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errors->first('name'), $html);
    }

    public function testDoNotDisplayFailure()
    {
        $customValue = 'test-custom-value';
        config()->set('bootstrap-components.form.radio.formValidation.displayFailure', true);
        $errors = app(MessageBag::class)->add('name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsRadio()->name('name')->value($customValue)->displayFailure(false)->render(compact('errors'));
        $this->assertStringNotContainsString('is-invalid', $html);
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringNotContainsString($errors->first('name'), $html);
    }

    public function testSetNoContainerId()
    {
        $customValue = 'test-custom-value';
        $html = bsRadio()->name('name')->value($customValue)->toHtml();
        $this->assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customValue = 'test-custom-value';
        $customContainerId = 'test-custom-container-id';
        $html = bsRadio()->name('name')->value($customValue)->containerId($customContainerId)->toHtml();
        $this->assertStringContainsString('<div id="' . $customContainerId, $html);
    }

    public function testSetNoComponentId()
    {
        $customValue = 'test-custom-value';
        $html = bsRadio()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString(' for="radio-name-test-custom-value"', $html);
        $this->assertStringContainsString('<input id="radio-name-test-custom-value"', $html);
    }

    public function testSetComponentId()
    {
        $customValue = 'test-custom-value';
        $customComponentId = 'test-custom-component-id';
        $html = bsRadio()->name('name')->value($customValue)->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString(' for="' . $customComponentId . '"', $html);
        $this->assertStringContainsString('<input id="' . $customComponentId . '"', $html);
    }

    public function testConfigContainerClasses()
    {
        $customValue = 'test-custom-value';
        $configContainerClasses = 'test-config-class-container';
        config()->set('bootstrap-components.form.radio.classes.container', [$configContainerClasses]);
        $html = bsRadio()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString(
            ' class="component-container custom-control custom-radio ' . $configContainerClasses . '"',
            $html
        );
    }

    public function testSetContainerClasses()
    {
        $customValue = 'test-custom-value';
        $configContainerClasses = 'test-config-class-container';
        $customContainerClasses = 'test-custom-class-container';
        config()->set('bootstrap-components.form.radio.classes.container', [$configContainerClasses]);
        $html = bsRadio()->name('name')->value($customValue)->containerClasses([$customContainerClasses])->toHtml();
        $this->assertStringContainsString(
            ' class="component-container custom-control custom-radio ' . $customContainerClasses . '"',
            $html
        );
        $this->assertStringNotContainsString(
            ' class="component-container custom-control custom-radio ' . $configContainerClasses . '"',
            $html
        );
    }

    public function testConfigComponentClass()
    {
        $customValue = 'test-custom-value';
        $configComponentClasses = 'test-config-class-component';
        config()->set('bootstrap-components.form.radio.classes.component', [$configComponentClasses]);
        $html = bsRadio()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString(
            ' class="component custom-control-input ' . $configComponentClasses . '"',
            $html
        );
    }

    public function testSetComponentClass()
    {
        $customValue = 'test-custom-value';
        $configComponentClasses = 'test-config-class-component';
        $customComponentClasses = 'test-custom-class-component';
        config()->set('bootstrap-components.form.radio.classes.component', [$customComponentClasses]);
        $html = bsRadio()->name('name')->value($customValue)->componentClasses([$customComponentClasses])->toHtml();
        $this->assertStringContainsString(
            ' class="component custom-control-input ' . $customComponentClasses . '"',
            $html
        );
        $this->assertStringNotContainsString(
            ' class="form-control radio-name-component ' . $configComponentClasses . '"',
            $html
        );
    }

    public function testConfigContainerHtmlAttributes()
    {
        $customValue = 'test-custom-value';
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.radio.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsRadio()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $customValue = 'test-custom-value';
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.radio.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsRadio()
            ->name('name')
            ->value($customValue)
            ->containerHtmlAttributes([$customContainerAttributes])
            ->toHtml();
        $this->assertStringContainsString($customContainerAttributes, $html);
        $this->assertStringNotContainsString($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $customValue = 'test-custom-value';
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.radio.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsRadio()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $customValue = 'test-custom-value';
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.radio.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsRadio()
            ->name('name')
            ->value($customValue)
            ->componentHtmlAttributes([$customComponentAttributes])
            ->toHtml();
        $this->assertStringContainsString($customComponentAttributes, $html);
        $this->assertStringNotContainsString($configComponentAttributes, $html);
    }
}
