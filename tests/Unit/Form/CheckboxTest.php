<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

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
        $this->assertTrue(array_key_exists('icon', config('bootstrap-components.form.checkbox')));
        $this->assertTrue(array_key_exists('legend', config('bootstrap-components.form.checkbox')));
        $this->assertTrue(array_key_exists('class', config('bootstrap-components.form.checkbox')));
        $this->assertTrue(array_key_exists('html_attributes', config('bootstrap-components.form.checkbox')));
        // components.form.checkbox.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.checkbox.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.checkbox.class')));
        // components.form.checkbox.html_attributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.checkbox.html_attributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.checkbox.html_attributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Checkable::class, get_parent_class(bsCheckbox()));
    }

    public function testName()
    {
        $html = bsCheckbox()->name('name')->toHtml();
        $this->assertContains('name="name"', $html);
    }

    public function testType()
    {
        $html = bsCheckbox()->name('name')->toHtml();
        $this->assertContains('type="checkbox"', $html);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Okipa\LaravelBootstrapComponents\Form\Checkbox : Missing $name property. Please use
     *                           the name() method to set a name.
     */
    public function testInputWithoutName()
    {
        bsCheckbox()->toHtml();
    }

    public function testModelValue()
    {
        $user = $this->createUniqueUser();
        $html = bsCheckbox()->model($user)->name('name')->toHtml();
        $this->assertContains('checked="checked"', $html);
    }

    public function testConfigIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.form.checkbox.icon', $configIcon);
        $html = bsCheckbox()->name('name')->toHtml();
        $this->assertContains(
            '<label class="custom-control-label" for="checkbox-name"><span class="label-icon">'
            . $configIcon . '</span> validation.attributes.name</label>',
            $html
        );
    }

    public function testSetIcon()
    {
        $configIcon = 'test-config-icon';
        $customIcon = 'test-custom-icon';
        config()->set('bootstrap-components.form.checkbox.icon', $configIcon);
        $html = bsCheckbox()->name('name')->icon($customIcon)->toHtml();
        $this->assertNotContains(
            '<label class="custom-control-label" for="checkbox-name"><span class="label-icon">'
            . $configIcon . '</span> validation.attributes.name</label>',
            $html
        );
        $this->assertContains(
            '<label class="custom-control-label" for="checkbox-name"><span class="label-icon">'
            . $customIcon . '</span> validation.attributes.name</label>',
            $html
        );
    }

    public function testNoIcon()
    {
        config()->set('bootstrap-components.form.checkbox.icon', null);
        $html = bsCheckbox()->name('name')->toHtml();
        $this->assertNotContains('<span class="label-icon">', $html);
    }

    public function testChecked()
    {
        $user = null;
        $html = bsCheckbox()->model($user)->name('name')->checked(true)->toHtml();
        $this->assertContains('checked="checked"', $html);
    }

    public function testNotChecked()
    {
        $user = $this->createUniqueUser();
        $html = bsCheckbox()->model($user)->name('name')->checked(false)->toHtml();
        $this->assertNotContains('checked="checked"', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.checkbox.legend', $configLegend);
        $html = bsCheckbox()->name('name')->toHtml();
        $this->assertContains(
            '<small id="checkbox-name-legend" class="form-text text-muted">bootstrap-components::' . $configLegend
            . '</small>',
            $html
        );
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.form.checkbox.legend', $configLegend);
        $html = bsCheckbox()->name('name')->legend($customLegend)->toHtml();
        $this->assertContains(
            '<small id="checkbox-name-legend" class="form-text text-muted">' . $customLegend . '</small>',
            $html
        );
        $this->assertNotContains(
            '<small id="checkbox-name-legend" class="form-text text-muted">bootstrap-components::' . $configLegend
            . '</small>',
            $html
        );
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.form.checkbox.legend', null);
        $html = bsCheckbox()->name('name')->toHtml();
        $this->assertNotContains('<small id="checkbox-name-legend" class="form-text text-muted">', $html);
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.checkbox.legend', $configLegend);
        $html = bsCheckbox()->name('name')->hideLegend()->toHtml();
        $this->assertNotContains('<small id="checkbox-name-legend" class="form-text text-muted">', $html);
    }

    public function testSetValueDefaultCheckStatus()
    {
        $html = bsCheckbox()->name('name')->toHtml();
        $this->assertNotContains('checked="checked', $html);
    }

    public function testSetValueChecked()
    {
        $customValue = true;
        $html = bsCheckbox()->name('name')->value($customValue)->toHtml();
        $this->assertContains('checked="checked', $html);
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
        $html = bsCheckbox()->name('name')->value($customValue)->toHtml();
        $this->assertContains('checked="checked', $html);
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
        $html = bsCheckbox()->name('name')->value($customValue)->toHtml();
        $this->assertNotContains('checked="checked', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsCheckbox()->name('name')->label($label)->toHtml();
        $this->assertContains('for="checkbox-name">' . $label . '</label>', $html);
    }

    public function testNoLabel()
    {
        $html = bsCheckbox()->name('name')->toHtml();
        $this->assertContains(
            'for="checkbox-name">validation.attributes.name</label>',
            $html
        );
    }

    public function testHideLabel()
    {
        $html = bsCheckbox()->name('name')->hideLabel()->toHtml();
        $this->assertNotContains(
            'for="checkbox-name">validation.attributes.name</label>',
            $html
        );
    }

    public function testSuccess()
    {
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsCheckbox()->name('name')->render(['errors' => $messageBag]);
        $this->assertContains('<div class="valid-feedback d-block">', $html);
        $this->assertContains(
            trans('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testNoSuccess()
    {
        $html = bsCheckbox()->name('name')->toHtml();
        $this->assertNotContains('<div class="valid-feedback d-block">', $html);
    }

    public function testError()
    {
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsCheckbox()->name('name')->render(['errors' => $messageBag]);
        $this->assertContains('<div class="invalid-feedback d-block">', $html);
        $this->assertContains($errorMessage, $html);
    }

    public function testNoError()
    {
        $html = bsCheckbox()->name('name')->toHtml();
        $this->assertNotContains('<div class="invalid-feedback d-block">', $html);
    }

    public function testSetNoContainerId()
    {
        $html = bsCheckbox()->name('name')->toHtml();
        $this->assertNotContains('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = bsCheckbox()->name('name')->containerId($customContainerId)->toHtml();
        $this->assertContains('<div id="' . $customContainerId, $html);
    }

    public function testSetNoComponentId()
    {
        $html = bsCheckbox()->name('name')->toHtml();
        $this->assertContains('for="checkbox-name"', $html);
        $this->assertContains('<input id="checkbox-name"', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = bsCheckbox()->name('name')->componentId($customComponentId)->toHtml();
        $this->assertContains('for="' . $customComponentId . '"', $html);
        $this->assertContains('<input id="' . $customComponentId . '"', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.form.checkbox.class.container', [$configContainerCLass]);
        $html = bsCheckbox()->name('name')->toHtml();
        $this->assertContains('class="checkbox-name-container custom-control custom-checkbox ' . $configContainerCLass
                              . '"', $html);
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.form.checkbox.class.container', [$configContainerCLass]);
        $html = bsCheckbox()->name('name')->containerClass([$customContainerCLass])->toHtml();
        $this->assertContains('class="checkbox-name-container custom-control custom-checkbox ' . $customContainerCLass
                              . '"', $html);
        $this->assertNotContains('class="checkbox-name-container custom-control custom-checkbox '
                                 . $configContainerCLass . '"', $html);
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.form.checkbox.class.component', [$configComponentCLass]);
        $html = bsCheckbox()->name('name')->toHtml();
        $this->assertContains(
            'class="checkbox-name-component custom-control-input ' . $configComponentCLass . '"',
            $html
        );
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.form.checkbox.class.component', [$customComponentCLass]);
        $html = bsCheckbox()->name('name')->componentClass([$customComponentCLass])->toHtml();
        $this->assertContains(
            'class="checkbox-name-component custom-control-input ' . $customComponentCLass . '"',
            $html
        );
        $this->assertNotContains('class="form-control checkbox-name-component ' . $configComponentCLass . '"', $html);
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.checkbox.html_attributes.container', [$configContainerAttributes]);
        $html = bsCheckbox()->name('name')->toHtml();
        $this->assertContains($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.checkbox.html_attributes.container', [$configContainerAttributes]);
        $html = bsCheckbox()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertContains($customContainerAttributes, $html);
        $this->assertNotContains($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.checkbox.html_attributes.component', [$configComponentAttributes]);
        $html = bsCheckbox()->name('name')->toHtml();
        $this->assertContains($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.checkbox.html_attributes.component', [$configComponentAttributes]);
        $html = bsCheckbox()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertContains($customComponentAttributes, $html);
        $this->assertNotContains($configComponentAttributes, $html);
    }

    public function testConfigShowSuccessFeedback()
    {
        $messageBag = app(MessageBag::class)->add('other_name', null);
        config()->set('bootstrap-components.global.input.show_success_feedback', true);
        $html = bsCheckbox()->name('name')->render(['errors' => $messageBag]);
        $this->assertContains('<div class="valid-feedback d-block">', $html);
    }

    public function testConfigHideSuccessFeedback()
    {
        $messageBag = app(MessageBag::class)->add('other_name', null);
        config()->set('bootstrap-components.global.input.show_success_feedback', false);
        $html = bsCheckbox()->name('name')->render(['errors' => $messageBag]);
        $this->assertNotContains('<div class="valid-feedback d-block">', $html);
    }

    public function testSetShowSuccessFeedback()
    {
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsCheckbox()->name('name')->showSuccessFeedback()->render(['errors' => $messageBag]);
        $this->assertContains('<div class="valid-feedback d-block">', $html);
    }

    public function testSetHideSuccessFeedback()
    {
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsCheckbox()->name('name')->hideSuccessFeedback()->render(['errors' => $messageBag]);
        $this->assertNotContains('<div class="valid-feedback d-block">', $html);
    }
}
