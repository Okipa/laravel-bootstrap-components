<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Illuminate\Support\MessageBag;
use Okipa\LaravelBootstrapComponents\Form\Input;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\UsersFaker;

class EmailTest extends BootstrapComponentsTestCase
{
    use UsersFaker;

    public function testConfigStructure()
    {
        // components.form
        $this->assertTrue(array_key_exists('email', config('bootstrap-components.form')));
        // components.form.email
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.form.email')));
        $this->assertTrue(array_key_exists('icon', config('bootstrap-components.form.email')));
        $this->assertTrue(array_key_exists('legend', config('bootstrap-components.form.email')));
        $this->assertTrue(array_key_exists('class', config('bootstrap-components.form.email')));
        $this->assertTrue(array_key_exists('html_attributes', config('bootstrap-components.form.email')));
        // components.form.email.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.email.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.email.class')));
        // components.form.email.html_attributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.email.html_attributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.email.html_attributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Input::class, get_parent_class(bsEmail()));
    }

    public function testSetName()
    {
        $html = bsEmail()->name('name')->toHtml();
        $this->assertContains('name="name"', $html);
    }

    public function testType()
    {
        $html = bsEmail()->name('name')->toHtml();
        $this->assertContains('type="email"', $html);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Okipa\LaravelBootstrapComponents\Form\Email : Missing $name property. Please use the
     *                           name() method to set a name.
     */
    public function testInputWithoutName()
    {
        bsEmail()->toHtml();
    }

    public function testModelValue()
    {
        $user = $this->createUniqueUser();
        $html = bsEmail()->model($user)->name('name')->toHtml();
        $this->assertContains('value="' . $user->name . '"', $html);
    }

    public function testConfigIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.form.email.icon', $configIcon);
        $html = bsEmail()->name('name')->toHtml();
        $this->assertContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testSetIcon()
    {
        $configIcon = 'test-config-icon';
        $customIcon = 'test-custom-icon';
        config()->set('bootstrap-components.form.email.icon', $configIcon);
        $html = bsEmail()->name('name')->icon($customIcon)->toHtml();
        $this->assertContains('<span class="icon input-group-text">' . $customIcon . '</span>', $html);
        $this->assertNotContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testNoIcon()
    {
        config()->set('bootstrap-components.form.email.icon', null);
        $html = bsEmail()->name('name')->toHtml();
        $this->assertNotContains('<span class="icon input-group-text">', $html);
    }

    public function testHideIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.form.email.icon', $configIcon);
        $html = bsEmail()->name('name')->hideIcon()->toHtml();
        $this->assertNotContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.email.legend', $configLegend);
        $html = bsEmail()->name('name')->toHtml();
        $this->assertContains(
            '<small id="email-name-legend" class="form-text text-muted">bootstrap-components::' . $configLegend . '</small>',
            $html
        );
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.form.email.legend', $configLegend);
        $html = bsEmail()->name('name')->legend($customLegend)->toHtml();
        $this->assertContains(
            '<small id="email-name-legend" class="form-text text-muted">' . $customLegend . '</small>',
            $html
        );
        $this->assertNotContains(
            '<small id="email-name-legend" class="form-text text-muted">bootstrap-components::' . $configLegend . '</small>',
            $html
        );
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.form.email.legend', null);
        $html = bsEmail()->name('name')->toHtml();
        $this->assertNotContains('<small id="email-name-legend" class="form-text text-muted">', $html);
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.email.legend', $configLegend);
        $html = bsEmail()->name('name')->hideLegend()->toHtml();
        $this->assertNotContains('<small id="email-name-legend" class="form-text text-muted">', $html);
    }

    public function testSetPlaceholder()
    {
        $placeholder = 'test-custom-placeholder';
        $html = bsEmail()->name('name')->placeholder($placeholder)->toHtml();
        $this->assertContains('placeholder="' . $placeholder . '"', $html);
        $this->assertNotContains(
            'placeholder="validation.attributes.name"',
            $html
        );
    }

    public function testNoPlaceholder()
    {
        $html = bsEmail()->name('name')->toHtml();
        $this->assertContains(
            'placeholder="validation.attributes.name"',
            $html
        );
    }

    public function testSetValue()
    {
        $customValue = 'test-custom-value';
        $html = bsEmail()->name('name')->value($customValue)->toHtml();
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
        $html = bsEmail()->name('name')->value($customValue)->toHtml();
        $this->assertContains('value="' . $oldValue . '"', $html);
        $this->assertNotContains('value="' . $customValue . '"', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsEmail()->name('name')->label($label)->toHtml();
        $this->assertContains('<label for="email-name">' . $label . '</label>', $html);
        $this->assertContains('aria-label="' . $label . '"', $html);
    }

    public function testNoLabel()
    {
        $html = bsEmail()->name('name')->toHtml();
        $this->assertContains(
            '<label for="email-name">validation.attributes.name</label>',
            $html
        );
        $this->assertContains(
            'aria-label="validation.attributes.name"',
            $html
        );
    }

    public function testHideLabel()
    {
        $html = bsEmail()->name('name')->hideLabel()->toHtml();
        $this->assertNotContains(
            '<label for="email-name">validation.attributes.name</label>',
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
        $html = bsEmail()->name('name')->render(['errors' => $messageBag]);
        $this->assertContains('<div class="valid-feedback d-block">', $html);
        $this->assertContains(trans('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html);
    }

    public function testNoSuccess()
    {
        $html = bsEmail()->name('name')->toHtml();
        $this->assertNotContains('<div class="valid-feedback d-block">', $html);
    }

    public function testError()
    {
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsEmail()->name('name')->render(['errors' => $messageBag]);
        $this->assertContains('<div class="invalid-feedback d-block">', $html);
        $this->assertContains($errorMessage, $html);
    }

    public function testNoError()
    {
        $html = bsEmail()->name('name')->toHtml();
        $this->assertNotContains('<div class="invalid-feedback d-block">', $html);
    }

    public function testSetNoContainerId()
    {
        $html = bsEmail()->name('name')->toHtml();
        $this->assertNotContains('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = bsEmail()->name('name')->containerId($customContainerId)->toHtml();
        $this->assertContains('<div id="' . $customContainerId . '"', $html);
    }

    public function testSetNoComponentId()
    {
        $html = bsEmail()->name('name')->toHtml();
        $this->assertContains('<input id="email-name', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = bsEmail()->name('name')->componentId($customComponentId)->toHtml();
        $this->assertContains('<input id="' . $customComponentId . '"', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.form.email.class.container', [$configContainerCLass]);
        $html = bsEmail()->name('name')->toHtml();
        $this->assertContains('class="email-name-container ' . $configContainerCLass . '"', $html);
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.form.email.class.container', [$configContainerCLass]);
        $html = bsEmail()->name('name')->containerClass([$customContainerCLass])->toHtml();
        $this->assertContains('class="email-name-container ' . $customContainerCLass . '"', $html);
        $this->assertNotContains('class="email-name-container ' . $configContainerCLass . '"', $html);
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.form.email.class.component', [$configComponentCLass]);
        $html = bsEmail()->name('name')->toHtml();
        $this->assertContains('class="form-control email-name-component ' . $configComponentCLass . '"', $html);
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.form.email.class.component', [$customComponentCLass]);
        $html = bsEmail()->name('name')->componentClass([$customComponentCLass])->toHtml();
        $this->assertContains('class="form-control email-name-component ' . $customComponentCLass . '"', $html);
        $this->assertNotContains('class="form-control email-name-component ' . $configComponentCLass . '"', $html);
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.email.html_attributes.container', [$configContainerAttributes]);
        $html = bsEmail()->name('name')->toHtml();
        $this->assertContains($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.email.html_attributes.container', [$configContainerAttributes]);
        $html = bsEmail()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertContains($customContainerAttributes, $html);
        $this->assertNotContains($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.email.html_attributes.component', [$configComponentAttributes]);
        $html = bsEmail()->name('name')->toHtml();
        $this->assertContains($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.email.html_attributes.component', [$configComponentAttributes]);
        $html = bsEmail()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertContains($customComponentAttributes, $html);
        $this->assertNotContains($configComponentAttributes, $html);
    }
}
