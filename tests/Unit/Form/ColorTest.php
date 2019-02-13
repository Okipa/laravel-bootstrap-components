<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

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
        $this->assertTrue(array_key_exists('legend', config('bootstrap-components.form.color')));
        $this->assertTrue(array_key_exists('class', config('bootstrap-components.form.color')));
        $this->assertTrue(array_key_exists('html_attributes', config('bootstrap-components.form.color')));
        // components.form.color.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.color.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.color.class')));
        // components.form.color.html_attributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.color.html_attributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.color.html_attributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Input::class, get_parent_class(bsColor()));
    }

    public function testName()
    {
        $html = bsColor()->name('name')->toHtml();
        $this->assertContains('name="name"', $html);
    }

    public function testType()
    {
        $html = bsColor()->name('name')->toHtml();
        $this->assertContains('type="color"', $html);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Okipa\LaravelBootstrapComponents\Form\Color : Missing $name property. Please use the
     *                           name() method to set a name.
     */
    public function testInputWithoutName()
    {
        bsColor()->toHtml();
    }

    public function testModelValue()
    {
        $user = $this->createUniqueUser();
        $html = bsColor()->model($user)->name('name')->toHtml();
        $this->assertContains('value="' . $user->name . '"', $html);
    }

    public function testConfigPrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.form.color.prepend', $configPrepend);
        $html = bsColor()->name('name')->toHtml();
        $this->assertContains('input-group-prepend', $html);
        $this->assertContains('<span class="input-group-text">' . $configPrepend . '</span>', $html);
    }

    public function testSetPrepend()
    {
        $configPrepend = 'test-config-prepend';
        $customPrepend = 'test-custom-prepend';
        config()->set('bootstrap-components.form.color.prepend', $configPrepend);
        $html = bsColor()->name('name')->prepend($customPrepend)->toHtml();
        $this->assertContains('input-group-prepend', $html);
        $this->assertContains('<span class="input-group-text">' . $customPrepend . '</span>', $html);
        $this->assertNotContains('<span class="input-group-text">' . $configPrepend . '</span>', $html);
    }

    public function testNoPrepend()
    {
        config()->set('bootstrap-components.form.color.prepend', null);
        $html = bsColor()->name('name')->toHtml();
        $this->assertNotContains('input-group-prepend', $html);
    }

    public function testHidePrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.form.color.prepend', $configPrepend);
        $html = bsColor()->name('name')->prepend(false)->toHtml();
        $this->assertNotContains('input-group-prepend', $html);
    }

    public function testConfigAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.color.append', $configAppend);
        $html = bsColor()->name('name')->toHtml();
        $this->assertContains('input-group-append', $html);
        $this->assertContains('<span class="input-group-text">' . $configAppend . '</span>', $html);
    }

    public function testSetAppend()
    {
        $configAppend = 'test-config-append';
        $customAppend = 'test-custom-append';
        config()->set('bootstrap-components.form.color.append', $configAppend);
        $html = bsColor()->name('name')->append($customAppend)->toHtml();
        $this->assertContains('input-group-append', $html);
        $this->assertContains('<span class="input-group-text">' . $customAppend . '</span>', $html);
        $this->assertNotContains('<span class="input-group-text">' . $configAppend . '</span>', $html);
    }

    public function testNoAppend()
    {
        config()->set('bootstrap-components.form.color.append', null);
        $html = bsColor()->name('name')->toHtml();
        $this->assertNotContains('input-group-append', $html);
    }

    public function testHideAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.color.append', $configAppend);
        $html = bsColor()->name('name')->append(false)->toHtml();
        $this->assertNotContains('input-group-append', $html);
    }

    public function testNoPrependNoAppend()
    {
        config()->set('bootstrap-components.form.color.prepend', null);
        config()->set('bootstrap-components.form.color.append', null);
        $html = bsColor()->name('name')->toHtml();
        $this->assertNotContains('<div class="input-group">', $html);
    }

    public function testHidePrependHideAppend()
    {
        $configPrepend = 'test-config-prepend';
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.color.prepend', $configPrepend);
        config()->set('bootstrap-components.form.color.append', $configAppend);
        $html = bsColor()->name('name')->prepend(false)->append(false)->toHtml();
        $this->assertNotContains('<div class="input-group">', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.color.legend', $configLegend);
        $html = bsColor()->name('name')->toHtml();
        $this->assertContains(
            '<small id="color-name-legend" class="form-text text-muted">bootstrap-components::'
            . $configLegend . '</small>',
            $html
        );
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.form.color.legend', $configLegend);
        $html = bsColor()->name('name')->legend($customLegend)->toHtml();
        $this->assertContains(
            '<small id="color-name-legend" class="form-text text-muted">' . $customLegend . '</small>',
            $html
        );
        $this->assertNotContains(
            '<small id="color-name-legend" class="form-text text-muted">bootstrap-components::'
            . $configLegend . '</small>',
            $html
        );
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.form.color.legend', null);
        $html = bsColor()->name('name')->toHtml();
        $this->assertNotContains('<small id="color-name-legend" class="form-text text-muted">', $html);
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.color.legend', $configLegend);
        $html = bsColor()->name('name')->hideLegend()->toHtml();
        $this->assertNotContains('<small id="color-name-legend" class="form-text text-muted">', $html);
    }

    public function testSetValue()
    {
        $customValue = 'test-custom-value';
        $html = bsColor()->name('name')->value($customValue)->toHtml();
        $this->assertContains('value="' . $customValue . '"', $html);
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
        $this->assertContains('value="' . $oldValue . '"', $html);
        $this->assertNotContains('value="' . $customValue . '"', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsColor()->name('name')->label($label)->toHtml();
        $this->assertContains('<label for="color-name">' . $label . '</label>', $html);
        $this->assertContains('placeholder="' . $label . '"', $html);
        $this->assertContains('aria-label="' . $label . '"', $html);
    }

    public function testNoLabel()
    {
        $html = bsColor()->name('name')->toHtml();
        $this->assertContains('<label for="color-name">validation.attributes.name</label>', $html);
        $this->assertContains('aria-label="validation.attributes.name"', $html);
    }

    public function testHideLabel()
    {
        $html = bsColor()->name('name')->hideLabel()->toHtml();
        $this->assertNotContains('<label for="color-name">validation.attributes.name</label>', $html);
        $this->assertNotContains('aria-label="validation.attributes.name"', $html);
    }

    public function testSetPlaceholder()
    {
        $placeholder = 'test-custom-placeholder';
        $html = bsColor()->name('name')->placeholder($placeholder)->toHtml();
        $this->assertContains('placeholder="' . $placeholder . '"', $html);
    }

    public function testSetPlaceholderWithLabel()
    {
        $label = 'test-custom-label';
        $placeholder = 'test-custom-placeholder';
        $html = bsColor()->name('name')->label($label)->placeholder($placeholder)->toHtml();
        $this->assertContains('placeholder="' . $placeholder . '"', $html);
    }

    public function testNoPlaceholder()
    {
        $html = bsColor()->name('name')->toHtml();
        $this->assertContains('placeholder="validation.attributes.name"', $html);
    }

    public function testSuccess()
    {
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsColor()->name('name')->render(['errors' => $messageBag]);
        $this->assertContains('<div class="valid-feedback d-block">', $html);
        $this->assertContains(
            trans('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testNoSuccess()
    {
        $html = bsColor()->name('name')->toHtml();
        $this->assertNotContains('<div class="valid-feedback d-block">', $html);
    }

    public function testError()
    {
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsColor()->name('name')->render(['errors' => $messageBag]);
        $this->assertContains('<div class="invalid-feedback d-block">', $html);
        $this->assertContains($errorMessage, $html);
    }

    public function testNoError()
    {
        $html = bsColor()->name('name')->toHtml();
        $this->assertNotContains('<div class="invalid-feedback d-block">', $html);
    }

    public function testSetNoContainerId()
    {
        $html = bsColor()->name('name')->toHtml();
        $this->assertNotContains('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = bsColor()->name('name')->containerId($customContainerId)->toHtml();
        $this->assertContains('<div id="' . $customContainerId . '"', $html);
    }

    public function testSetNoComponentId()
    {
        $html = bsColor()->name('name')->toHtml();
        $this->assertContains('for="color-name"', $html);
        $this->assertContains('<input id="color-name"', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = bsColor()->name('name')->componentId($customComponentId)->toHtml();
        $this->assertContains('for="' . $customComponentId . '"', $html);
        $this->assertContains('<input id="' . $customComponentId . '"', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.form.color.class.container', [$configContainerCLass]);
        $html = bsColor()->name('name')->toHtml();
        $this->assertContains('class="color-name-container ' . $configContainerCLass . '"', $html);
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.form.color.class.container', [$configContainerCLass]);
        $html = bsColor()->name('name')->containerClass([$customContainerCLass])->toHtml();
        $this->assertContains('class="color-name-container ' . $customContainerCLass . '"', $html);
        $this->assertNotContains('class="color-name-container ' . $configContainerCLass . '"', $html);
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.form.color.class.component', [$configComponentCLass]);
        $html = bsColor()->name('name')->toHtml();
        $this->assertContains('class="form-control color-name-component ' . $configComponentCLass . '"', $html);
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.form.color.class.component', [$customComponentCLass]);
        $html = bsColor()->name('name')->componentClass([$customComponentCLass])->toHtml();
        $this->assertContains('class="form-control color-name-component ' . $customComponentCLass . '"', $html);
        $this->assertNotContains('class="form-control color-name-component ' . $configComponentCLass . '"', $html);
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.color.html_attributes.container', [$configContainerAttributes]);
        $html = bsColor()->name('name')->toHtml();
        $this->assertContains($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.color.html_attributes.container', [$configContainerAttributes]);
        $html = bsColor()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertContains($customContainerAttributes, $html);
        $this->assertNotContains($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.color.html_attributes.component', [$configComponentAttributes]);
        $html = bsColor()->name('name')->toHtml();
        $this->assertContains($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.color.html_attributes.component', [$configComponentAttributes]);
        $html = bsColor()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertContains($customComponentAttributes, $html);
        $this->assertNotContains($configComponentAttributes, $html);
    }
}
