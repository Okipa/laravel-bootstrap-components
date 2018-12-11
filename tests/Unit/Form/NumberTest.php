<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

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
        // components.form.text
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.form.number')));
        $this->assertTrue(array_key_exists('icon', config('bootstrap-components.form.number')));
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
        $this->assertContains('name="credit"', $html);
    }

    public function testType()
    {
        $html = bsNumber()->name('credit')->toHtml();
        $this->assertContains('type="number"', $html);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Okipa\LaravelBootstrapComponents\Form\Number : Missing $name property. Please use the
     *                           name() method to set a name.
     */
    public function testInputWithoutName()
    {
        bsNumber()->toHtml();
    }

    public function testModelValue()
    {
        $user = $this->createUniqueUser();
        $html = bsNumber()->model($user)->name('credit')->toHtml();
        $this->assertContains('value="' . $user->credit . '"', $html);
    }

    public function testConfigIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.form.number.icon', $configIcon);
        $html = bsNumber()->name('credit')->toHtml();
        $this->assertContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testSetIcon()
    {
        $configIcon = 'test-config-icon';
        $customIcon = 'test-custom-icon';
        config()->set('bootstrap-components.form.number.icon', $configIcon);
        $html = bsNumber()->name('credit')->icon($customIcon)->toHtml();
        $this->assertContains('<span class="icon input-group-text">' . $customIcon . '</span>', $html);
        $this->assertNotContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testNoIcon()
    {
        config()->set('bootstrap-components.form.number.icon', null);
        $html = bsNumber()->name('credit')->toHtml();
        $this->assertNotContains('<span class="icon input-group-text">', $html);
    }

    public function testHideIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.form.number.icon', $configIcon);
        $html = bsNumber()->name('credit')->hideIcon()->toHtml();
        $this->assertNotContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.number.legend', $configLegend);
        $html = bsNumber()->name('credit')->toHtml();
        $this->assertContains(
            '<small id="number-credit-legend" class="form-text text-muted">bootstrap-components::'
            . $configLegend . '</small>',
            $html
        );
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.form.number.legend', $configLegend);
        $html = bsNumber()->name('credit')->legend($customLegend)->toHtml();
        $this->assertContains(
            '<small id="number-credit-legend" class="form-text text-muted">' . $customLegend . '</small>',
            $html
        );
        $this->assertNotContains(
            '<small id="number-credit-legend" class="form-text text-muted">bootstrap-components::'
            . $configLegend . '</small>',
            $html
        );
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.form.number.legend', null);
        $html = bsNumber()->name('credit')->toHtml();
        $this->assertNotContains('<small id="number-credit-legend" class="form-text text-muted">', $html);
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.number.legend', $configLegend);
        $html = bsNumber()->name('credit')->hideLegend()->toHtml();
        $this->assertNotContains('<small id="number-credit-legend" class="form-text text-muted">', $html);
    }

    public function testSetValue()
    {
        $customValue = 'test-custom-value';
        $html = bsNumber()->name('credit')->value($customValue)->toHtml();
        $this->assertContains('value="' . $customValue . '"', $html);
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
        $this->assertContains('value="' . $oldValue . '"', $html);
        $this->assertNotContains('value="' . $customValue . '"', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsNumber()->name('credit')->label($label)->toHtml();
        $this->assertContains('<label for="number-credit">' . $label . '</label>', $html);
        $this->assertContains('placeholder="' . $label . '"', $html);
        $this->assertContains('aria-label="' . $label . '"', $html);
    }

    public function testNoLabel()
    {
        $html = bsNumber()->name('credit')->toHtml();
        $this->assertContains('<label for="number-credit">validation.attributes.credit</label>', $html);
        $this->assertContains('aria-label="validation.attributes.credit"', $html);
    }

    public function testHideLabel()
    {
        $html = bsNumber()->name('credit')->hideLabel()->toHtml();
        $this->assertNotContains('<label for="number-credit">validation.attributes.name</label>', $html);
        $this->assertNotContains('aria-label="validation.attributes.credit"', $html);
    }

    public function testSetPlaceholder()
    {
        $placeholder = 'test-custom-placeholder';
        $html = bsNumber()->name('credit')->placeholder($placeholder)->toHtml();
        $this->assertContains('placeholder="' . $placeholder . '"', $html);
    }

    public function testSetPlaceholderWithLabel()
    {
        $label = 'test-custom-label';
        $placeholder = 'test-custom-placeholder';
        $html = bsNumber()->name('credit')->label($label)->placeholder($placeholder)->toHtml();
        $this->assertContains('placeholder="' . $placeholder . '"', $html);
    }

    public function testNoPlaceholder()
    {
        $html = bsNumber()->name('credit')->toHtml();
        $this->assertContains('placeholder="validation.attributes.credit"', $html);
    }

    public function testSuccess()
    {
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsNumber()->name('credit')->render(['errors' => $messageBag]);
        $this->assertContains('<div class="valid-feedback d-block">', $html);
        $this->assertContains(
            trans('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testNoSuccess()
    {
        $html = bsNumber()->name('credit')->toHtml();
        $this->assertNotContains('<div class="valid-feedback d-block">', $html);
    }

    public function testError()
    {
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('credit', $errorMessage);
        $html = bsNumber()->name('credit')->render(['errors' => $messageBag]);
        $this->assertContains('<div class="invalid-feedback d-block">', $html);
        $this->assertContains($errorMessage, $html);
    }

    public function testNoError()
    {
        $html = bsNumber()->name('credit')->toHtml();
        $this->assertNotContains('<div class="invalid-feedback d-block">', $html);
    }

    public function testSetNoContainerId()
    {
        $html = bsNumber()->name('credit')->toHtml();
        $this->assertNotContains('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = bsNumber()->name('credit')->containerId($customContainerId)->toHtml();
        $this->assertContains('<div id="' . $customContainerId . '"', $html);
    }

    public function testSetNoComponentId()
    {
        $html = bsNumber()->name('credit')->toHtml();
        $this->assertContains('for="number-credit"', $html);
        $this->assertContains('<input id="number-credit"', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = bsNumber()->name('credit')->componentId($customComponentId)->toHtml();
        $this->assertContains('for="' . $customComponentId . '"', $html);
        $this->assertContains('<input id="' . $customComponentId . '"', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.form.number.class.container', [$configContainerCLass]);
        $html = bsNumber()->name('credit')->toHtml();
        $this->assertContains('class="number-credit-container ' . $configContainerCLass . '"', $html);
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.form.number.class.container', [$configContainerCLass]);
        $html = bsNumber()->name('credit')->containerClass([$customContainerCLass])->toHtml();
        $this->assertContains('class="number-credit-container ' . $customContainerCLass . '"', $html);
        $this->assertNotContains('class="number-credit-container ' . $configContainerCLass . '"', $html);
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.form.number.class.component', [$configComponentCLass]);
        $html = bsNumber()->name('credit')->toHtml();
        $this->assertContains('class="form-control number-credit-component ' . $configComponentCLass . '"', $html);
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.form.number.class.component', [$customComponentCLass]);
        $html = bsNumber()->name('credit')->componentClass([$customComponentCLass])->toHtml();
        $this->assertContains('class="form-control number-credit-component ' . $customComponentCLass . '"', $html);
        $this->assertNotContains('class="form-control number-credit-component ' . $configComponentCLass . '"', $html);
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.number.html_attributes.container', [$configContainerAttributes]);
        $html = bsNumber()->name('credit')->toHtml();
        $this->assertContains($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.number.html_attributes.container', [$configContainerAttributes]);
        $html = bsNumber()->name('credit')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertContains($customContainerAttributes, $html);
        $this->assertNotContains($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.number.html_attributes.component', [$configComponentAttributes]);
        $html = bsNumber()->name('credit')->toHtml();
        $this->assertContains($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.number.html_attributes.component', [$configComponentAttributes]);
        $html = bsNumber()->name('credit')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertContains($customComponentAttributes, $html);
        $this->assertNotContains($configComponentAttributes, $html);
    }
}
