<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Illuminate\Support\MessageBag;
use Okipa\LaravelBootstrapComponents\Form\Input;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\UsersFaker;

class TelTest extends BootstrapComponentsTestCase
{
    use UsersFaker;

    public function testConfigStructure()
    {
        // components.form
        $this->assertTrue(array_key_exists('tel', config('bootstrap-components.form')));
        // components.form.tel
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.form.tel')));
        $this->assertTrue(array_key_exists('icon', config('bootstrap-components.form.tel')));
        $this->assertTrue(array_key_exists('legend', config('bootstrap-components.form.tel')));
        $this->assertTrue(array_key_exists('class', config('bootstrap-components.form.tel')));
        $this->assertTrue(array_key_exists('html_attributes', config('bootstrap-components.form.tel')));
        // components.form.tel.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.tel.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.tel.class')));
        // components.form.tel.html_attributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.tel.html_attributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.tel.html_attributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Input::class, get_parent_class(bsTel()));
    }

    public function testSetName()
    {
        $html = bsTel()->name('name')->toHtml();
        $this->assertContains('name="name"', $html);
    }

    public function testType()
    {
        $html = bsTel()->name('name')->toHtml();
        $this->assertContains('type="tel"', $html);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Okipa\LaravelBootstrapComponents\Form\Tel : Missing $name property. Please use the
     *                           name() method to set a name.
     */
    public function testInputWithoutName()
    {
        bsTel()->toHtml();
    }

    public function testModelValue()
    {
        $user = $this->createUniqueUser();
        $html = bsTel()->model($user)->name('name')->toHtml();
        $this->assertContains('value="' . $user->name . '"', $html);
    }

    public function testConfigIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.form.tel.icon', $configIcon);
        $html = bsTel()->name('name')->toHtml();
        $this->assertContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testSetIcon()
    {
        $configIcon = 'test-config-icon';
        $customIcon = 'test-custom-icon';
        config()->set('bootstrap-components.form.tel.icon', $configIcon);
        $html = bsTel()->name('name')->icon($customIcon)->toHtml();
        $this->assertContains('<span class="icon input-group-text">' . $customIcon . '</span>', $html);
        $this->assertNotContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testNoIcon()
    {
        config()->set('bootstrap-components.form.tel.icon', null);
        $html = bsTel()->name('name')->toHtml();
        $this->assertNotContains('<span class="icon input-group-text">', $html);
    }

    public function testHideIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.form.tel.icon', $configIcon);
        $html = bsTel()->name('name')->hideIcon()->toHtml();
        $this->assertNotContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.tel.legend', $configLegend);
        $html = bsTel()->name('name')->toHtml();
        $this->assertContains(
            '<small id="tel-name-legend" class="form-text text-muted">' . $configLegend . '</small>',
            $html
        );
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.form.tel.legend', $configLegend);
        $html = bsTel()->name('name')->legend($customLegend)->toHtml();
        $this->assertContains(
            '<small id="tel-name-legend" class="form-text text-muted">' . $customLegend . '</small>',
            $html
        );
        $this->assertNotContains(
            '<small id="tel-name-legend" class="form-text text-muted">' . $configLegend . '</small>',
            $html
        );
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.form.tel.legend', null);
        $html = bsTel()->name('name')->toHtml();
        $this->assertNotContains('<small id="tel-name-legend" class="form-text text-muted">"', $html);
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.tel.legend', $configLegend);
        $html = bsTel()->name('name')->hideLegend()->toHtml();
        $this->assertNotContains(
            '<small id="tel-name-legend" class="form-text text-muted">' . $configLegend . '</small>',
            $html
        );
    }

    public function testSetPlaceholder()
    {
        $placeholder = 'test-custom-placeholder';
        $html = bsTel()->name('name')->placeholder($placeholder)->toHtml();
        $this->assertContains('placeholder="' . $placeholder . '"', $html);
        $this->assertNotContains(
            'placeholder="validation.attributes.name"',
            $html
        );
    }

    public function testNoPlaceholder()
    {
        $html = bsTel()->name('name')->toHtml();
        $this->assertContains(
            'placeholder="validation.attributes.name"',
            $html
        );
    }

    public function testSetValue()
    {
        $customValue = 'test-custom-value';
        $html = bsTel()->name('name')->value($customValue)->toHtml();
        $this->assertContains('value="' . $customValue . '"', $html);
    }

    public function testOldValue()
    {
        $oldValue = 'test-old-value';
        $customValue = 'test-custom-value';
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function() use ($oldValue) {
                $request = request()->merge(['name' => $oldValue]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = bsTel()->name('name')->value($customValue)->toHtml();
        $this->assertContains('value="' . $oldValue . '"', $html);
        $this->assertNotContains('value="' . $customValue . '"', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsTel()->name('name')->label($label)->toHtml();
        $this->assertContains('<label for="tel-name">' . $label . '</label>', $html);
        $this->assertContains('aria-label="' . $label . '"', $html);
    }

    public function testNoLabel()
    {
        $html = bsTel()->name('name')->toHtml();
        $this->assertContains(
            '<label for="tel-name">validation.attributes.name</label>',
            $html
        );
        $this->assertContains(
            'aria-label="validation.attributes.name"',
            $html
        );
    }

    public function testHideLabel()
    {
        $html = bsTel()->name('name')->hideLabel()->toHtml();
        $this->assertNotContains(
            '<label for="tel-name">validation.attributes.name</label>',
            $html
        );
        $this->assertNotContains(
            'aria-label="validation.attributes.name"',
            $html
        );
    }

    public function testSuccess()
    {
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsTel()->name('name')->render(['errors' => $messageBag]);
        $this->assertContains('<div class="valid-feedback d-block">', $html);
        $this->assertContains(trans('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html);
    }

    public function testNoSuccess()
    {
        $html = bsTel()->name('name')->toHtml();
        $this->assertNotContains('<div class="valid-feedback d-block">', $html);
    }

    public function testError()
    {
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsTel()->name('name')->render(['errors' => $messageBag]);
        $this->assertContains('<div class="invalid-feedback d-block">', $html);
        $this->assertContains($errorMessage, $html);
    }

    public function testNoError()
    {
        $html = bsTel()->name('name')->toHtml();
        $this->assertNotContains('<div class="invalid-feedback d-block">', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.form.tel.class.container', [$configContainerCLass]);
        $html = bsTel()->name('name')->toHtml();
        $this->assertContains('class="tel-name-container ' . $configContainerCLass . '"', $html);
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.form.tel.class.container', [$configContainerCLass]);
        $html = bsTel()->name('name')->containerClass([$customContainerCLass])->toHtml();
        $this->assertContains('class="tel-name-container ' . $customContainerCLass . '"', $html);
        $this->assertNotContains('class="tel-name-container ' . $configContainerCLass . '"', $html);
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.form.tel.class.component', [$configComponentCLass]);
        $html = bsTel()->name('name')->toHtml();
        $this->assertContains('class="form-control tel-name-component ' . $configComponentCLass . '"', $html);
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.form.tel.class.component', [$customComponentCLass]);
        $html = bsTel()->name('name')->componentClass([$customComponentCLass])->toHtml();
        $this->assertContains('class="form-control tel-name-component ' . $customComponentCLass . '"', $html);
        $this->assertNotContains('class="form-control tel-name-component ' . $configComponentCLass . '"', $html);
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.tel.html_attributes.container', [$configContainerAttributes]);
        $html = bsTel()->name('name')->toHtml();
        $this->assertContains($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.tel.html_attributes.container', [$configContainerAttributes]);
        $html = bsTel()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertContains($customContainerAttributes, $html);
        $this->assertNotContains($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.tel.html_attributes.component', [$configComponentAttributes]);
        $html = bsTel()->name('name')->toHtml();
        $this->assertContains($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.tel.html_attributes.component', [$configComponentAttributes]);
        $html = bsTel()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertContains($customComponentAttributes, $html);
        $this->assertNotContains($configComponentAttributes, $html);
    }
}
