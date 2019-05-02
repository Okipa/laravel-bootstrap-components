<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Exception;
use Illuminate\Support\MessageBag;
use Okipa\LaravelBootstrapComponents\Form\Input;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\UsersFaker;

class NumberTest extends BootstrapComponentsTestCase
{
    use UsersFaker;

    public function testConfigStructure()
    {
        // components.form
        $this->assertTrue(array_key_exists('number', config('bootstrap-components.form')));
        // components.form.number
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.form.number')));
        $this->assertTrue(array_key_exists('prepend', config('bootstrap-components.form.number')));
        $this->assertTrue(array_key_exists('append', config('bootstrap-components.form.number')));
        $this->assertTrue(array_key_exists('legend', config('bootstrap-components.form.number')));
        $this->assertTrue(array_key_exists('class', config('bootstrap-components.form.number')));
        $this->assertTrue(array_key_exists('html_attributes', config('bootstrap-components.form.number')));
        // components.form.number.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.number.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.number.class')));
        // components.form.number.html_attributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.number.html_attributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.number.html_attributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Input::class, get_parent_class(bsNumber()));
    }

    public function testName()
    {
        $html = bsNumber()->name('credit')->toHtml();
        $this->assertStringContainsString('name="credit"', $html);
    }

    public function testType()
    {
        $html = bsNumber()->name('credit')->toHtml();
        $this->assertStringContainsString('type="number"', $html);
    }

    public function testInputWithoutName()
    {
        $this->expectException(Exception::class);
        bsNumber()->toHtml();
    }

    public function testModelValue()
    {
        $user = $this->createUniqueUser();
        $html = bsNumber()->model($user)->name('credit')->toHtml();
        $this->assertStringContainsString('value="' . $user->credit . '"', $html);
    }

    public function testConfigPrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.form.number.prepend', $configPrepend);
        $html = bsNumber()->name('name')->toHtml();
        $this->assertStringContainsString('input-group-prepend', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $configPrepend . '</span>', $html);
    }

    public function testSetPrepend()
    {
        $configPrepend = 'test-config-prepend';
        $customPrepend = 'test-custom-prepend';
        config()->set('bootstrap-components.form.number.prepend', $configPrepend);
        $html = bsNumber()->name('name')->prepend($customPrepend)->toHtml();
        $this->assertStringContainsString('input-group-prepend', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $customPrepend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="input-group-text">' . $configPrepend . '</span>', $html);
    }

    public function testNoPrepend()
    {
        config()->set('bootstrap-components.form.number.prepend', null);
        $html = bsNumber()->name('name')->toHtml();
        $this->assertStringNotContainsString('input-group-prepend', $html);
    }

    public function testHidePrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.form.number.prepend', $configPrepend);
        $html = bsNumber()->name('name')->prepend(false)->toHtml();
        $this->assertStringNotContainsString('input-group-prepend', $html);
    }

    public function testConfigAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.number.append', $configAppend);
        $html = bsNumber()->name('name')->toHtml();
        $this->assertStringContainsString('input-group-append', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $configAppend . '</span>', $html);
    }

    public function testSetAppend()
    {
        $configAppend = 'test-config-append';
        $customAppend = 'test-custom-append';
        config()->set('bootstrap-components.form.number.append', $configAppend);
        $html = bsNumber()->name('name')->append($customAppend)->toHtml();
        $this->assertStringContainsString('input-group-append', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $customAppend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="input-group-text">' . $configAppend . '</span>', $html);
    }

    public function testNoAppend()
    {
        config()->set('bootstrap-components.form.number.append', null);
        $html = bsNumber()->name('name')->toHtml();
        $this->assertStringNotContainsString('input-group-append', $html);
    }

    public function testHideAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.number.append', $configAppend);
        $html = bsNumber()->name('name')->append(false)->toHtml();
        $this->assertStringNotContainsString('input-group-append', $html);
    }

    public function testNoPrependNoAppend()
    {
        config()->set('bootstrap-components.form.number.prepend', null);
        config()->set('bootstrap-components.form.number.append', null);
        $html = bsNumber()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div class="input-group">', $html);
    }

    public function testHidePrependHideAppend()
    {
        $configPrepend = 'test-config-prepend';
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.number.prepend', $configPrepend);
        config()->set('bootstrap-components.form.number.append', $configAppend);
        $html = bsNumber()->name('name')->prepend(false)->append(false)->toHtml();
        $this->assertStringNotContainsString('<div class="input-group">', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.number.legend', $configLegend);
        $html = bsNumber()->name('name')->toHtml();
        $this->assertStringContainsString('number-name-legend', $html);
        $this->assertStringContainsString($configLegend, $html);
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.form.number.legend', $configLegend);
        $html = bsNumber()->name('name')->legend($customLegend)->toHtml();
        $this->assertStringContainsString('number-name-legend', $html);
        $this->assertStringContainsString($customLegend, $html);
        $this->assertStringNotContainsString($configLegend, $html);
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.form.number.legend', null);
        $html = bsNumber()->name('name')->toHtml();
        $this->assertStringNotContainsString('number-name-legend', $html);
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.number.legend', $configLegend);
        $html = bsNumber()->name('name')->legend(false)->toHtml();
        $this->assertStringNotContainsString('number-name-legend', $html);
    }

    public function testSetValue()
    {
        $customValue = 'test-custom-value';
        $html = bsNumber()->name('credit')->value($customValue)->toHtml();
        $this->assertStringContainsString('value="' . $customValue . '"', $html);
    }

    public function testOldValue()
    {
        $oldValue = 20;
        $customValue = 80;
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValue) {
                $request = request()->merge(['credit' => $oldValue]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = bsNumber()->name('credit')->value($customValue)->toHtml();
        $this->assertStringContainsString('value="' . $oldValue . '"', $html);
        $this->assertStringNotContainsString('value="' . $customValue . '"', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsNumber()->name('credit')->label($label)->toHtml();
        $this->assertStringContainsString('<label for="number-credit">' . $label . '</label>', $html);
        $this->assertStringContainsString('placeholder="' . $label . '"', $html);
        $this->assertStringContainsString('aria-label="' . $label . '"', $html);
    }

    public function testNoLabel()
    {
        $html = bsNumber()->name('credit')->toHtml();
        $this->assertStringContainsString(
            '<label for="number-credit">validation.attributes.credit</label>',
            $html
        );
        $this->assertStringContainsString('aria-label="validation.attributes.credit"', $html);
    }

    public function testHideLabel()
    {
        $html = bsNumber()->name('credit')->label(false)->toHtml();
        $this->assertStringNotContainsString(
            '<label for="number-credit">validation.attributes.name</label>',
            $html
        );
        $this->assertStringNotContainsString(
            'aria-label="validation.attributes.credit"',
            $html
        );
    }

    public function testSetPlaceholder()
    {
        $placeholder = 'test-custom-placeholder';
        $html = bsNumber()->name('credit')->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString('placeholder="' . $placeholder . '"', $html);
    }

    public function testSetPlaceholderWithLabel()
    {
        $label = 'test-custom-label';
        $placeholder = 'test-custom-placeholder';
        $html = bsNumber()->name('credit')->label($label)->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString('placeholder="' . $placeholder . '"', $html);
    }

    public function testNoPlaceholder()
    {
        $html = bsNumber()->name('credit')->toHtml();
        $this->assertStringContainsString('placeholder="validation.attributes.credit"', $html);
    }

    public function testHidePlaceholder()
    {
        $html = bsNumber()->name('name')->placeholder(false)->toHtml();
        $this->assertStringNotContainsString('placeholder="', $html);
    }

    public function testSuccess()
    {
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsNumber()->name('credit')->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testNoSuccess()
    {
        $html = bsNumber()->name('credit')->toHtml();
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
    }

    public function testError()
    {
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('credit', $errorMessage);
        $html = bsNumber()->name('credit')->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errorMessage, $html);
    }

    public function testNoError()
    {
        $html = bsNumber()->name('credit')->toHtml();
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
    }

    public function testSetNoContainerId()
    {
        $html = bsNumber()->name('credit')->toHtml();
        $this->assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = bsNumber()->name('credit')->containerId($customContainerId)->toHtml();
        $this->assertStringContainsString('<div id="' . $customContainerId . '"', $html);
    }

    public function testSetNoComponentId()
    {
        $html = bsNumber()->name('credit')->toHtml();
        $this->assertStringContainsString('for="number-credit"', $html);
        $this->assertStringContainsString('<input id="number-credit"', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = bsNumber()->name('credit')->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString('for="' . $customComponentId . '"', $html);
        $this->assertStringContainsString('<input id="' . $customComponentId . '"', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.form.number.class.container', [$configContainerCLass]);
        $html = bsNumber()->name('credit')->toHtml();
        $this->assertStringContainsString(
            'class="number-credit-container ' . $configContainerCLass . '"',
            $html
        );
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.form.number.class.container', [$configContainerCLass]);
        $html = bsNumber()->name('credit')->containerClass([$customContainerCLass])->toHtml();
        $this->assertStringContainsString(
            'class="number-credit-container ' . $customContainerCLass . '"',
            $html
        );
        $this->assertStringNotContainsString(
            'class="number-credit-container ' . $configContainerCLass . '"',
            $html
        );
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.form.number.class.component', [$configComponentCLass]);
        $html = bsNumber()->name('credit')->toHtml();
        $this->assertStringContainsString(
            'class="form-control number-credit-component ' . $configComponentCLass . '"',
            $html
        );
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.form.number.class.component', [$customComponentCLass]);
        $html = bsNumber()->name('credit')->componentClass([$customComponentCLass])->toHtml();
        $this->assertStringContainsString(
            'class="form-control number-credit-component ' . $customComponentCLass . '"',
            $html
        );
        $this->assertStringNotContainsString(
            'class="form-control number-credit-component ' . $configComponentCLass . '"',
            $html
        );
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.number.html_attributes.container', [$configContainerAttributes]);
        $html = bsNumber()->name('credit')->toHtml();
        $this->assertStringContainsString($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.number.html_attributes.container', [$configContainerAttributes]);
        $html = bsNumber()->name('credit')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertStringContainsString($customContainerAttributes, $html);
        $this->assertStringNotContainsString($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.number.html_attributes.component', [$configComponentAttributes]);
        $html = bsNumber()->name('credit')->toHtml();
        $this->assertStringContainsString($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.number.html_attributes.component', [$configComponentAttributes]);
        $html = bsNumber()->name('credit')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertStringContainsString($customComponentAttributes, $html);
        $this->assertStringNotContainsString($configComponentAttributes, $html);
    }
}
