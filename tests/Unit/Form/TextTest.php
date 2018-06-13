<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Illuminate\Support\MessageBag;
use Okipa\LaravelBootstrapComponents\Form\Input;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\UsersFaker;

class InputTextTest extends BootstrapComponentsTestCase
{
    use UsersFaker;

    public function testConfigStructure()
    {
        // components.form
        $this->assertTrue(array_key_exists('text', config('bootstrap-components.form')));
        // components.form.text
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.form.text')));
        $this->assertTrue(array_key_exists('icon', config('bootstrap-components.form.text')));
        $this->assertTrue(array_key_exists('legend', config('bootstrap-components.form.text')));
        $this->assertTrue(array_key_exists('class', config('bootstrap-components.form.text')));
        $this->assertTrue(array_key_exists('html_attributes', config('bootstrap-components.form.text')));
        // components.form.text.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.text.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.text.class')));
        // components.form.text.html_attributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.text.html_attributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.text.html_attributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Input::class, get_parent_class(text()));
    }

    public function testName()
    {
        $html = text()->name('name')->toHtml();
        $this->assertContains('name="name"', $html);
    }

    public function testType()
    {
        $html = text()->name('name')->toHtml();
        $this->assertContains('type="text"', $html);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Name must be declared for the Okipa\LaravelBootstrapComponents\Form\Text component
     *                           generation.
     */
    public function testInputWithoutName()
    {
        text()->toHtml();
    }

    public function testModelValue()
    {
        $user = $this->createUniqueUser();
        $html = text()->model($user)->name('name')->toHtml();
        $this->assertContains('value="' . $user->name . '"', $html);
    }

    public function testConfigIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.form.text.icon', $configIcon);
        $html = text()->name('name')->toHtml();
        $this->assertContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testSetIcon()
    {
        $configIcon = 'test-config-icon';
        $customIcon = 'test-custom-icon';
        config()->set('bootstrap-components.form.text.icon', $configIcon);
        $html = text()->name('name')->icon($customIcon)->toHtml();
        $this->assertContains('<span class="icon input-group-text">' . $customIcon . '</span>', $html);
        $this->assertNotContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }
    
    public function testNoIcon()
    {
        config()->set('bootstrap-components.form.text.icon', null);
        $html = text()->name('name')->toHtml();
        $this->assertNotContains('<span class="icon input-group-text">', $html);
    }

    public function testHideIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.form.text.icon', $configIcon);
        $html = text()->name('name')->hideIcon()->toHtml();
        $this->assertNotContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.text.legend', $configLegend);
        $html = text()->name('name')->toHtml();
        $this->assertContains(
            '<small id="text-name-legend" class="form-text text-muted">' . $configLegend . '</small>',
            $html
        );
    }
    
    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.form.text.legend', $configLegend);
        $html = text()->name('name')->legend($customLegend)->toHtml();
        $this->assertContains(
            '<small id="text-name-legend" class="form-text text-muted">' . $customLegend . '</small>',
            $html
        );
        $this->assertNotContains(
            '<small id="text-name-legend" class="form-text text-muted">' . $configLegend . '</small>',
            $html
        );
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.form.text.legend', null);
        $html = text()->name('name')->toHtml();
        $this->assertNotContains('<small id="text-name-legend" class="form-text text-muted">', $html);
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.text.legend', $configLegend);
        $html = text()->name('name')->hideLegend()->toHtml();
        $this->assertNotContains(
            '<small id="text-name-legend" class="form-text text-muted">' . $configLegend . '</small>',
            $html
        );
    }

    public function testSetPlaceholder()
    {
        $placeholder = 'test-custom-placeholder';
        $html = text()->name('name')->placeholder($placeholder)->toHtml();
        $this->assertContains('placeholder="' . $placeholder . '"', $html);
        $this->assertNotContains(
            'placeholder="bootstrap-components::bootstrap-components.validation.attributes.name"',
            $html
        );
    }

    public function testNoPlaceholder()
    {
        $html = text()->name('name')->toHtml();
        $this->assertContains(
            'placeholder="bootstrap-components::bootstrap-components.validation.attributes.name"',
            $html
        );
    }

    public function testSetValue()
    {
        $customValue = 'test-custom-value';
        $html = text()->name('name')->value($customValue)->toHtml();
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
        $html = text()->name('name')->value($customValue)->toHtml();
        $this->assertContains('value="' . $oldValue . '"', $html);
        $this->assertNotContains('value="' . $customValue . '"', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = text()->name('name')->label($label)->toHtml();
        $this->assertContains('<label for="text-name">' . $label . '</label>', $html);
        $this->assertContains('aria-label="' . $label . '"', $html);
    }

    public function testNoLabel()
    {
        $html = text()->name('name')->toHtml();
        $this->assertContains(
            '<label for="text-name">bootstrap-components::bootstrap-components.validation.attributes.name</label>',
            $html
        );
        $this->assertContains(
            'aria-label="bootstrap-components::bootstrap-components.validation.attributes.name"',
            $html
        );
    }

    public function testHideLabel()
    {
        $html = text()->name('name')->hideLabel()->toHtml();
        $this->assertNotContains(
            '<label for="text-name">bootstrap-components::bootstrap-components.validation.attributes.name</label>',
            $html
        );
        $this->assertNotContains(
            'aria-label="bootstrap-components::bootstrap-components.validation.attributes.name"',
            $html
        );
    }

    public function testSuccess()
    {
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = text()->name('name')->render(['errors' => $messageBag]);
        $this->assertContains('<div class="valid-feedback">', $html);
        $this->assertContains(trans('bootstrap-components::bootstrap-components.notification.validation.success'), $html);
    }

    public function testNoSuccess()
    {
        $html = text()->name('name')->toHtml();
        $this->assertNotContains('<div class="valid-feedback">', $html);
    }

    public function testError()
    {
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = text()->name('name')->render(['errors' => $messageBag]);
        $this->assertContains('<div class="invalid-feedback">', $html);
        $this->assertContains($errorMessage, $html);
    }

    public function testNoError()
    {
        $html = text()->name('name')->toHtml();
        $this->assertNotContains('<div class="invalid-feedback">', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.form.text.class.container', [$configContainerCLass]);
        $html = text()->name('name')->toHtml();
        $this->assertContains('class="text-name-container ' . $configContainerCLass . '"', $html);
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.form.text.class.container', [$configContainerCLass]);
        $html = text()->name('name')->containerClass([$customContainerCLass])->toHtml();
        $this->assertContains('class="text-name-container ' . $customContainerCLass . '"', $html);
        $this->assertNotContains('class="text-name-container ' . $configContainerCLass . '"', $html);
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.form.text.class.component', [$configComponentCLass]);
        $html = text()->name('name')->toHtml();
        $this->assertContains('class="form-control text-name-component ' . $configComponentCLass . '"', $html);
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.form.text.class.component', [$customComponentCLass]);
        $html = text()->name('name')->componentClass([$customComponentCLass])->toHtml();
        $this->assertContains('class="form-control text-name-component ' . $customComponentCLass . '"', $html);
        $this->assertNotContains('class="form-control text-name-component ' . $configComponentCLass . '"', $html);
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.text.html_attributes.container', [$configContainerAttributes]);
        $html = text()->name('name')->toHtml();
        $this->assertContains($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.text.html_attributes.container', [$configContainerAttributes]);
        $html = text()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertContains($customContainerAttributes, $html);
        $this->assertNotContains($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.text.html_attributes.component', [$configComponentAttributes]);
        $html = text()->name('name')->toHtml();
        $this->assertContains($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.text.html_attributes.component', [$configComponentAttributes]);
        $html = text()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertContains($customComponentAttributes, $html);
        $this->assertNotContains($configComponentAttributes, $html);
    }
}
