<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\MessageBag;
use Okipa\LaravelBootstrapComponents\Form\Input;
use Okipa\LaravelBootstrapComponents\Form\TemporalComponent;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\UsersFaker;

class TimeTest extends BootstrapComponentsTestCase
{
    use UsersFaker;

    public function testConfigStructure()
    {
        // components.form
        $this->assertTrue(array_key_exists('time', config('bootstrap-components.form')));
        // components.form.time
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.form.time')));
        $this->assertTrue(array_key_exists('prepend', config('bootstrap-components.form.time')));
        $this->assertTrue(array_key_exists('append', config('bootstrap-components.form.time')));
        $this->assertTrue(array_key_exists('format', config('bootstrap-components.form.time')));
        $this->assertTrue(array_key_exists('labelPositionedAbove', config('bootstrap-components.form.time')));
        $this->assertTrue(array_key_exists('legend', config('bootstrap-components.form.time')));
        $this->assertTrue(array_key_exists('classes', config('bootstrap-components.form.time')));
        $this->assertTrue(array_key_exists('htmlAttributes', config('bootstrap-components.form.time')));
        // components.form.time.classes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.time.classes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.time.classes')));
        // components.form.time.htmlAttributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.time.htmlAttributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.time.htmlAttributes')));
        // components.form.time.formValidation
        $this->assertTrue(array_key_exists('displaySuccess', config('bootstrap-components.form.time.formValidation')));
        $this->assertTrue(array_key_exists('displayFailure', config('bootstrap-components.form.time.formValidation')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(TemporalComponent::class, get_parent_class(bsTime()));
    }

    public function testSetName()
    {
        $html = bsTime()->name('name')->toHtml();
        $this->assertStringContainsString(' name="name"', $html);
    }

    public function testType()
    {
        $html = bsTime()->name('name')->toHtml();
        $this->assertStringContainsString(' type="time"', $html);
    }

    public function testInputWithoutName()
    {
        $this->expectException(Exception::class);
        bsTime()->toHtml();
    }

    public function testWrongModelValue()
    {
        $user = $this->createUniqueUser();
        $user->name = 'test-custom-name';
        $this->expectException(Exception::class);
        bsTime()->model($user)->name('name')->toHtml();
    }

    public function testModelDateTimeObjectValue()
    {
        $user = $this->createUniqueUser();
        $user->published_at = $this->faker->dateTime;
        $html = bsTime()->model($user)->name('published_at')->toHtml();
        $this->assertStringContainsString(
            ' value="' . $user->published_at->format(config('bootstrap-components.form.time.format')) . '"',
            $html
        );
    }

    public function testModelDateTimeStringValue()
    {
        $user = $this->createUniqueUser();
        $user->published_at = $this->faker->dateTime->format('H:i:i');
        $html = bsTime()->model($user)->name('published_at')->toHtml();
        $this->assertStringContainsString(
            ' value="' . Carbon::parse($user->published_at)->format(config('bootstrap-components.form.time.format'))
            . '"',
            $html
        );
    }

    public function testSetConfigFormat()
    {
        $configFormat = 'H:i:s';
        config()->set('bootstrap-components.form.time.format', $configFormat);
        $user = $this->createUniqueUser();
        $user->published_at = $this->faker->dateTime;
        $html = bsTime()->model($user)->name('published_at')->toHtml();
        $this->assertStringContainsString($user->published_at->format($configFormat), $html);
    }

    public function testSetFormat()
    {
        $configFormat = 'H:i:s';
        $customFormat = 'H:i';
        config()->set('bootstrap-components.form.time.format', $configFormat);
        $user = $this->createUniqueUser();
        $user->published_at = $this->faker->dateTime;
        $html = bsTime()->model($user)->name('published_at')->format($customFormat)->toHtml();
        $this->assertStringContainsString($user->published_at->format($customFormat), $html);
    }

    public function testNoFormat()
    {
        config()->set('bootstrap-components.form.time.format', null);
        $user = $this->createUniqueUser();
        $user->published_at = $this->faker->dateTime;
        $this->expectException(Exception::class);
        bsTime()->model($user)->name('published_at')->toHtml();
    }

    public function testConfigPrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.form.time.prepend', $configPrepend);
        $html = bsTime()->name('name')->toHtml();
        $this->assertStringContainsString('input-group-prepend', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $configPrepend . '</span>', $html);
    }

    public function testSetPrepend()
    {
        $configPrepend = 'test-config-prepend';
        $customPrepend = 'test-custom-prepend';
        config()->set('bootstrap-components.form.time.prepend', $configPrepend);
        $html = bsTime()->name('name')->prepend($customPrepend)->toHtml();
        $this->assertStringContainsString('input-group-prepend', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $customPrepend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="input-group-text">' . $configPrepend . '</span>', $html);
    }

    public function testNoPrepend()
    {
        config()->set('bootstrap-components.form.time.prepend', null);
        $html = bsTime()->name('name')->toHtml();
        $this->assertStringNotContainsString('input-group-prepend', $html);
    }

    public function testHidePrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.form.time.prepend', $configPrepend);
        $html = bsTime()->name('name')->prepend(false)->toHtml();
        $this->assertStringNotContainsString('input-group-prepend', $html);
    }

    public function testConfigAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.time.append', $configAppend);
        $html = bsTime()->name('name')->toHtml();
        $this->assertStringContainsString('input-group-append', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $configAppend . '</span>', $html);
    }

    public function testSetAppend()
    {
        $configAppend = 'test-config-append';
        $customAppend = 'test-custom-append';
        config()->set('bootstrap-components.form.time.append', $configAppend);
        $html = bsTime()->name('name')->append($customAppend)->toHtml();
        $this->assertStringContainsString('input-group-append', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $customAppend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="input-group-text">' . $configAppend . '</span>', $html);
    }

    public function testNoAppend()
    {
        config()->set('bootstrap-components.form.time.append', null);
        $html = bsTime()->name('name')->toHtml();
        $this->assertStringNotContainsString('input-group-append', $html);
    }

    public function testHideAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.time.append', $configAppend);
        $html = bsTime()->name('name')->append(false)->toHtml();
        $this->assertStringNotContainsString('input-group-append', $html);
    }

    public function testNoPrependNoAppend()
    {
        config()->set('bootstrap-components.form.time.prepend', null);
        config()->set('bootstrap-components.form.time.append', null);
        $html = bsTime()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div class="input-group">', $html);
    }

    public function testHidePrependHideAppend()
    {
        $configPrepend = 'test-config-prepend';
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.time.prepend', $configPrepend);
        config()->set('bootstrap-components.form.time.append', $configAppend);
        $html = bsTime()->name('name')->prepend(false)->append(false)->toHtml();
        $this->assertStringNotContainsString('<div class="input-group">', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.time.legend', $configLegend);
        $html = bsTime()->name('name')->toHtml();
        $this->assertStringContainsString('time-name-legend', $html);
        $this->assertStringContainsString('bootstrap-components::' . $configLegend, $html);
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.form.time.legend', $configLegend);
        $html = bsTime()->name('name')->legend($customLegend)->toHtml();
        $this->assertStringContainsString('time-name-legend', $html);
        $this->assertStringContainsString($customLegend, $html);
        $this->assertStringNotContainsString($configLegend, $html);
    }

    public function testSetTranslatedLegend()
    {
        $legend = 'bootstrap-components::bootstrap-components.label.validate';
        $html = bsTime()->name('name')->legend($legend)->toHtml();
        $this->assertStringContainsString(__($legend), $html);
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.form.time.legend', null);
        $html = bsTime()->name('name')->toHtml();
        $this->assertStringNotContainsString('time-name-legend', $html);
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.time.legend', $configLegend);
        $html = bsTime()->name('name')->legend(false)->toHtml();
        $this->assertStringNotContainsString('time-name-legend', $html);
    }

    public function testSetWrongValue()
    {
        $customValue = 'test-custom-value';
        $this->expectException(Exception::class);
        bsTime()->name('name')->value($customValue)->toHtml();
    }

    public function testSetValue()
    {
        $customValue = $this->faker->dateTime;
        $html = bsTime()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString(
            ' value="' . $customValue->format(config('bootstrap-components.form.time.format')) . '"',
            $html
        );
    }

    public function testOldValue()
    {
        $oldValue = $this->faker->dateTime->format('Y-m-d');
        $customValue = $this->faker->dateTime->format('Y-m-d');
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValue) {
                $request = request()->merge(['name' => $oldValue]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = bsTime()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString(' value="' . $oldValue . '"', $html);
        $this->assertStringNotContainsString(' value="' . $customValue . '"', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsTime()->name('name')->label($label)->toHtml();
        $this->assertStringContainsString('<label for="time-name">' . $label . '</label>', $html);
        $this->assertStringContainsString(' placeholder="' . $label . '"', $html);
    }

    public function testSetTranslatedLabel()
    {
        $label = 'bootstrap-components::bootstrap-components.label.validate';
        $html = bsTime()->name('name')->label($label)->toHtml();
        $this->assertStringContainsString('<label for="time-name">' . __($label) . '</label>', $html);
        $this->assertStringContainsString(' placeholder="' . __($label) . '"', $html);
    }

    public function testNoLabel()
    {
        $html = bsTime()->name('name')->toHtml();
        $this->assertStringContainsString(
            '<label for="time-name">validation.attributes.name</label>',
            $html
        );
    }

    public function testHideLabel()
    {
        $html = bsTime()->name('name')->label(false)->toHtml();
        $this->assertStringNotContainsString(
            '<label for="time-name">validation.attributes.name</label>',
            $html
        );
    }

    public function testConfigLabelPositionedAbove()
    {
        config()->set('bootstrap-components.form.time.labelPositionedAbove', true);
        $html = bsTime()->name('name')->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        $this->assertLessThan($inputPosition, $labelPosition);
    }

    public function testConfigLabelPositionedUnder()
    {
        config()->set('bootstrap-components.form.time.labelPositionedAbove', false);
        $html = bsTime()->name('name')->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        $this->assertLessThan($labelPosition, $inputPosition);
    }

    public function testLabelPositionedAbove()
    {
        config()->set('bootstrap-components.form.time.labelPositionedAbove', false);
        $html = bsTime()->name('name')->labelPositionedAbove()->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        $this->assertLessThan($inputPosition, $labelPosition);
    }

    public function testLabelPositionedUnder()
    {
        config()->set('bootstrap-components.form.time.labelPositionedAbove', true);
        $html = bsTime()->name('name')->labelPositionedAbove(false)->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        $this->assertLessThan($labelPosition, $inputPosition);
    }

    public function testSetPlaceholder()
    {
        $placeholder = 'test-custom-placeholder';
        $html = bsTime()->name('name')->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString(' placeholder="' . $placeholder . '"', $html);
    }

    public function testSetTranslatedPlaceholder()
    {
        $placeholder = 'bootstrap-components::bootstrap-components.label.validate';
        $html = bsTime()->name('name')->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString(' placeholder="' . __($placeholder) . '"', $html);
    }

    public function testSetPlaceholderWithLabel()
    {
        $label = 'test-custom-label';
        $placeholder = 'test-custom-placeholder';
        $html = bsTime()->name('name')->label($label)->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString(' placeholder="' . $placeholder . '"', $html);
    }

    public function testNoPlaceholder()
    {
        $html = bsTime()->name('name')->toHtml();
        $this->assertStringContainsString(' placeholder="validation.attributes.name"', $html);
    }

    public function testNoPlaceholderWithNoLabel()
    {
        $html = bsTime()->name('name')->label(false)->toHtml();
        $this->assertStringContainsString(' placeholder="validation.attributes.name"', $html);
    }

    public function testHidePlaceholder()
    {
        $html = bsTime()->name('name')->placeholder(false)->toHtml();
        $this->assertStringNotContainsString(' placeholder="', $html);
    }

    public function testConfigDisplaySuccess()
    {
        config()->set('bootstrap-components.form.time.formValidation.displaySuccess', true);
        $errors = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsTime()->name('name')->render(compact('errors'));
        $this->assertStringContainsString('is-valid', $html);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testConfigDoNotDisplaySuccess()
    {
        config()->set('bootstrap-components.form.time.formValidation.displaySuccess', false);
        $errors = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsTime()->name('name')->render(compact('errors'));
        $this->assertStringNotContainsString('is-valid', $html);
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringNotContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testDisplaySuccess()
    {
        config()->set('bootstrap-components.form.time.formValidation.displaySuccess', false);
        $errors = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsTime()->name('name')->displaySuccess()->render(compact('errors'));
        $this->assertStringContainsString('is-valid', $html);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testDoNotDisplaySuccess()
    {
        config()->set('bootstrap-components.form.time.formValidation.displaySuccess', true);
        $errors = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsTime()->name('name')->displaySuccess(false)->render(compact('errors'));
        $this->assertStringNotContainsString('is-valid', $html);
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringNotContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testConfigDisplayFailure()
    {
        config()->set('bootstrap-components.form.time.formValidation.displayFailure', true);
        $errors = app(MessageBag::class)->add('name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsTime()->name('name')->render(compact('errors'));
        $this->assertStringContainsString('is-invalid', $html);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errors->first('name'), $html);
    }

    public function testConfigDoNotDisplayFailure()
    {
        config()->set('bootstrap-components.form.time.formValidation.displayFailure', false);
        $errors = app(MessageBag::class)->add('name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsTime()->name('name')->render(compact('errors'));
        $this->assertStringNotContainsString('is-invalid', $html);
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringNotContainsString($errors->first('name'), $html);
    }

    public function testDisplayFailure()
    {
        config()->set('bootstrap-components.form.time.formValidation.displayFailure', false);
        $errors = app(MessageBag::class)->add('name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsTime()->name('name')->displayFailure()->render(compact('errors'));
        $this->assertStringContainsString('is-invalid', $html);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errors->first('name'), $html);
    }

    public function testDoNotDisplayFailure()
    {
        config()->set('bootstrap-components.form.time.formValidation.displayFailure', true);
        $errors = app(MessageBag::class)->add('name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = bsTime()->name('name')->displayFailure(false)->render(compact('errors'));
        $this->assertStringNotContainsString('is-invalid', $html);
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringNotContainsString($errors->first('name'), $html);
    }

    public function testSetNoContainerId()
    {
        $html = bsTime()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = bsTime()->name('name')->containerId($customContainerId)->toHtml();
        $this->assertStringContainsString('<div id="' . $customContainerId . '"', $html);
    }

    public function testSetNoComponentId()
    {
        $html = bsTime()->name('name')->toHtml();
        $this->assertStringContainsString(' for="time-name"', $html);
        $this->assertStringContainsString('<input id="time-name"', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = bsTime()->name('name')->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString(' for="' . $customComponentId . '"', $html);
        $this->assertStringContainsString('<input id="' . $customComponentId . '"', $html);
    }

    public function testConfigContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        config()->set('bootstrap-components.form.time.classes.container', [$configContainerClasses]);
        $html = bsTime()->name('name')->toHtml();
        $this->assertStringContainsString(' class="component-container ' . $configContainerClasses . '"', $html);
    }

    public function testSetContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        $customContainerClasses = 'test-custom-class-container';
        config()->set('bootstrap-components.form.time.classes.container', [$configContainerClasses]);
        $html = bsTime()->name('name')->containerClasses([$customContainerClasses])->toHtml();
        $this->assertStringContainsString(
            ' class="component-container ' . $customContainerClasses . '"',
            $html
        );
        $this->assertStringNotContainsString(
            ' class="component-container ' . $configContainerClasses . '"',
            $html
        );
    }

    public function testConfigComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        config()->set('bootstrap-components.form.time.classes.component', [$configComponentClasses]);
        $html = bsTime()->name('name')->toHtml();
        $this->assertStringContainsString(
            ' class="component form-control ' . $configComponentClasses . '"',
            $html
        );
    }

    public function testSetComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        $customComponentClasses = 'test-custom-class-component';
        config()->set('bootstrap-components.form.time.classes.component', [$customComponentClasses]);
        $html = bsTime()->name('name')->componentClasses([$customComponentClasses])->toHtml();
        $this->assertStringContainsString(
            ' class="component form-control ' . $customComponentClasses . '"',
            $html
        );
        $this->assertStringNotContainsString(
            ' class="component form-control ' . $configComponentClasses . '"',
            $html
        );
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.time.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsTime()->name('name')->toHtml();
        $this->assertStringContainsString($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.time.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsTime()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertStringContainsString($customContainerAttributes, $html);
        $this->assertStringNotContainsString($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.time.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsTime()->name('name')->toHtml();
        $this->assertStringContainsString($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.time.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsTime()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertStringContainsString($customComponentAttributes, $html);
        $this->assertStringNotContainsString($configComponentAttributes, $html);
    }
}
