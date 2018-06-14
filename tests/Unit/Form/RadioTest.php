<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Illuminate\Support\MessageBag;
use Okipa\LaravelBootstrapComponents\Form\Checkable;
use Okipa\LaravelBootstrapComponents\Form\Input;
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
        $this->assertTrue(array_key_exists('legend', config('bootstrap-components.form.radio')));
        $this->assertTrue(array_key_exists('class', config('bootstrap-components.form.radio')));
        $this->assertTrue(array_key_exists('html_attributes', config('bootstrap-components.form.radio')));
        // components.form.radio.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.radio.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.radio.class')));
        // components.form.radio.html_attributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.radio.html_attributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.radio.html_attributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Checkable::class, get_parent_class(radio()));
    }

    public function testName()
    {
        $html = radio()->name('name')->toHtml();
        $this->assertContains('name="name"', $html);
    }

    public function testType()
    {
        $html = radio()->name('name')->toHtml();
        $this->assertContains('type="radio"', $html);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Name must be declared for the Okipa\LaravelBootstrapComponents\Form\Radio component
     *                           generation.
     */
    public function testInputWithoutName()
    {
        radio()->toHtml();
    }

    public function testModelValue()
    {
        $user = $this->createUniqueUser();
        $html = radio()->model($user)->name('name')->toHtml();
        $this->assertContains('checked="checked"', $html);
    }
    
    public function testChecked()
    {
        $user = null;
        $html = radio()->model($user)->name('name')->checked(true)->toHtml();
        $this->assertContains('checked="checked"', $html);
    }

    public function testNotChecked()
    {
        $user = $this->createUniqueUser();
        $html = radio()->model($user)->name('name')->checked(false)->toHtml();
        $this->assertNotContains('checked="checked"', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.radio.legend', $configLegend);
        $html = radio()->name('name')->toHtml();
        $this->assertContains(
            '<small id="radio-name-legend" class="form-text text-muted">' . $configLegend . '</small>',
            $html
        );
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.form.radio.legend', $configLegend);
        $html = radio()->name('name')->legend($customLegend)->toHtml();
        $this->assertContains(
            '<small id="radio-name-legend" class="form-text text-muted">' . $customLegend . '</small>',
            $html
        );
        $this->assertNotContains(
            '<small id="radio-name-legend" class="form-text text-muted">' . $configLegend . '</small>',
            $html
        );
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.form.radio.legend', null);
        $html = radio()->name('name')->toHtml();
        $this->assertNotContains('<span class="icon input-group-text">', $html);
    }
    
    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.radio.legend', $configLegend);
        $html = radio()->name('name')->hideLegend()->toHtml();
        $this->assertNotContains('<span class="icon input-group-text">', $html);
    }

    public function testSetValueDefaultCheckStatus()
    {
        $html = radio()->name('name')->toHtml();
        $this->assertNotContains('checked="checked', $html);
    }
    
    public function testSetValueChecked()
    {
        $customValue = true;
        $html = radio()->name('name')->value($customValue)->toHtml();
        $this->assertContains('checked="checked', $html);
    }

    public function testOldValueChecked()
    {
        $oldValue = true;
        $customValue = false;
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function() use ($oldValue) {
                $request = request()->merge(['name' => $oldValue]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = radio()->name('name')->value($customValue)->toHtml();
        $this->assertContains('checked="checked', $html);
    }

    public function testOldValueNotChecked()
    {
        $oldValue = false;
        $customValue = true;
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function() use ($oldValue) {
                $request = request()->merge(['name' => $oldValue]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = radio()->name('name')->value($customValue)->toHtml();
        $this->assertNotContains('checked="checked', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = radio()->name('name')->label($label)->toHtml();
        $this->assertContains('for="radio-name">' . $label . '</label>', $html);
    }

    public function testNoLabel()
    {
        $html = radio()->name('name')->toHtml();
        $this->assertContains(
            'for="radio-name">validation.attributes.name</label>',
            $html
        );
    }

    public function testHideLabel()
    {
        $html = radio()->name('name')->hideLabel()->toHtml();
        $this->assertNotContains(
            'for="radio-name">validation.attributes.name</label>',
            $html
        );
    }

    public function testSuccess()
    {
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = radio()->name('name')->render(['errors' => $messageBag]);
        $this->assertContains('<span class="valid-feedback">', $html);
        $this->assertContains(trans('bootstrap-components::bootstrap-components.notification.validation.success'), $html);
    }

    public function testNoSuccess()
    {
        $html = radio()->name('name')->toHtml();
        $this->assertNotContains('<span class="valid-feedback">', $html);
    }

    public function testError()
    {
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = radio()->name('name')->render(['errors' => $messageBag]);
        $this->assertContains('<span class="invalid-feedback">', $html);
        $this->assertContains($errorMessage, $html);
    }

    public function testNoError()
    {
        $html = radio()->name('name')->toHtml();
        $this->assertNotContains('<span class="invalid-feedback">', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.form.radio.class.container', [$configContainerCLass]);
        $html = radio()->name('name')->toHtml();
        $this->assertContains('class="radio-name-container custom-control custom-radio ' . $configContainerCLass . '"', $html);
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.form.radio.class.container', [$configContainerCLass]);
        $html = radio()->name('name')->containerClass([$customContainerCLass])->toHtml();
        $this->assertContains('class="radio-name-container custom-control custom-radio ' . $customContainerCLass . '"', $html);
        $this->assertNotContains('class="radio-name-container custom-control custom-radio ' . $configContainerCLass . '"', $html);
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.form.radio.class.component', [$configComponentCLass]);
        $html = radio()->name('name')->toHtml();
        $this->assertContains('class="radio-name-component custom-control-input ' . $configComponentCLass . '"', $html);
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.form.radio.class.component', [$customComponentCLass]);
        $html = radio()->name('name')->componentClass([$customComponentCLass])->toHtml();
        $this->assertContains('class="radio-name-component custom-control-input ' . $customComponentCLass . '"', $html);
        $this->assertNotContains('class="form-control radio-name-component ' . $configComponentCLass . '"', $html);
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.radio.html_attributes.container', [$configContainerAttributes]);
        $html = radio()->name('name')->toHtml();
        $this->assertContains($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.radio.html_attributes.container', [$configContainerAttributes]);
        $html = radio()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertContains($customContainerAttributes, $html);
        $this->assertNotContains($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.radio.html_attributes.component', [$configComponentAttributes]);
        $html = radio()->name('name')->toHtml();
        $this->assertContains($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.radio.html_attributes.component', [$configComponentAttributes]);
        $html = radio()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertContains($customComponentAttributes, $html);
        $this->assertNotContains($configComponentAttributes, $html);
    }
}
