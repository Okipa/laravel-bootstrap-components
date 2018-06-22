<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Illuminate\Support\MessageBag;
use Okipa\LaravelBootstrapComponents\Form\Input;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\UsersFaker;

class DatetimeTest extends BootstrapComponentsTestCase
{
    use UsersFaker;

    public function testConfigStructure()
    {
        // components.form
        $this->assertTrue(array_key_exists('datetime', config('bootstrap-components.form')));
        // components.form.datetime
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.form.datetime')));
        $this->assertTrue(array_key_exists('icon', config('bootstrap-components.form.datetime')));
        $this->assertTrue(array_key_exists('legend', config('bootstrap-components.form.datetime')));
        $this->assertTrue(array_key_exists('class', config('bootstrap-components.form.datetime')));
        $this->assertTrue(array_key_exists('html_attributes', config('bootstrap-components.form.datetime')));
        // components.form.datetime.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.datetime.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.datetime.class')));
        // components.form.datetime.html_attributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.datetime.html_attributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.datetime.html_attributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Input::class, get_parent_class(bsDatetime()));
    }

    public function testSetName()
    {
        $html = bsDatetime()->name('name')->toHtml();
        $this->assertContains('name="name"', $html);
    }

    public function testType()
    {
        $html = bsDatetime()->name('name')->toHtml();
        $this->assertContains('type="datetime-local"', $html);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Okipa\LaravelBootstrapComponents\Form\Datetime : Missing $name property. Please use the
     *                           name() method to set a name.
     */
    public function testInputWithoutName()
    {
        bsDatetime()->toHtml();
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Okipa\LaravelBootstrapComponents\Form\Datetime : the value must be a valid datetime
     *                           with datetime-local format (Y-m-dTH:i:s), « test-custom-name » given.
     */
    public function testWrongModelValue()
    {
        $user = $this->createUniqueUser();
        $user->name = 'test-custom-name';
        bsDatetime()->model($user)->name('name')->toHtml();
    }

    public function testModelDateTimeObjectValue()
    {
        $user = $this->createUniqueUser();
        $user->published_at = $this->faker->dateTime;
        $html = bsDatetime()->model($user)->name('published_at')->toHtml();
        $this->assertContains('value="' . $user->published_at->format('Y-m-d\TH:i:s') . '"', $html);
    }

    public function testModelDateTimeStringValue()
    {
        $user = $this->createUniqueUser();
        $user->published_at = $this->faker->dateTime->format('Y-m-d\TH:i:s');
        $html = bsDatetime()->model($user)->name('published_at')->toHtml();
        $this->assertContains('value="' . $user->published_at . '"', $html);
    }

    public function testConfigIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.form.datetime.icon', $configIcon);
        $html = bsDatetime()->name('name')->toHtml();
        $this->assertContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testSetIcon()
    {
        $configIcon = 'test-config-icon';
        $customIcon = 'test-custom-icon';
        config()->set('bootstrap-components.form.datetime.icon', $configIcon);
        $html = bsDatetime()->name('name')->icon($customIcon)->toHtml();
        $this->assertContains('<span class="icon input-group-text">' . $customIcon . '</span>', $html);
        $this->assertNotContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testNoIcon()
    {
        config()->set('bootstrap-components.form.datetime.icon', null);
        $html = bsDatetime()->name('name')->toHtml();
        $this->assertNotContains('<span class="icon input-group-text">', $html);
    }

    public function testHideIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.form.datetime.icon', $configIcon);
        $html = bsDatetime()->name('name')->hideIcon()->toHtml();
        $this->assertNotContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.datetime.legend', $configLegend);
        $html = bsDatetime()->name('name')->toHtml();
        $this->assertContains(
            '<small id="datetime-local-name-legend" class="form-text text-muted">' . $configLegend . '</small>',
            $html
        );
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.form.datetime.legend', $configLegend);
        $html = bsDatetime()->name('name')->legend($customLegend)->toHtml();
        $this->assertContains(
            '<small id="datetime-local-name-legend" class="form-text text-muted">' . $customLegend . '</small>',
            $html
        );
        $this->assertNotContains(
            '<small id="datetime-local-name-legend" class="form-text text-muted">' . $configLegend . '</small>',
            $html
        );
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.form.datetime.legend', null);
        $html = bsDatetime()->name('name')->toHtml();
        $this->assertNotContains('<small id="datetime-local-name-legend" class="form-text text-muted">"', $html);
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.datetime.legend', $configLegend);
        $html = bsDatetime()->name('name')->hideLegend()->toHtml();
        $this->assertNotContains(
            '<small id="datetime-local-name-legend" class="form-text text-muted">' . $configLegend . '</small>',
            $html
        );
    }

    public function testSetPlaceholder()
    {
        $placeholder = 'test-custom-placeholder';
        $html = bsDatetime()->name('name')->placeholder($placeholder)->toHtml();
        $this->assertContains('placeholder="' . $placeholder . '"', $html);
        $this->assertNotContains(
            'placeholder="validation.attributes.name"',
            $html
        );
    }

    public function testNoPlaceholder()
    {
        $html = bsDatetime()->name('name')->toHtml();
        $this->assertContains(
            'placeholder="validation.attributes.name"',
            $html
        );
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Okipa\LaravelBootstrapComponents\Form\Datetime : the value must be a valid datetime
     *                           with datetime-local format (Y-m-dTH:i:s), « test-custom-value » given.
     */
    public function testSetWrongValue()
    {
        $customValue = 'test-custom-value';
        $html = bsDatetime()->name('name')->value($customValue)->toHtml();
        $this->assertContains('value="' . $customValue . '"', $html);
    }

    public function testSetValue()
    {
        $customValue = $this->faker->dateTime;
        $html = bsDatetime()->name('name')->value($customValue)->toHtml();
        $this->assertContains('value="' . $customValue->format('Y-m-d\TH:i:s') . '"', $html);
    }

    public function testOldValue()
    {
        $oldValue = $this->faker->dateTime->format('Y-m-d\TH:i:s');
        $customValue = $this->faker->dateTime->format('Y-m-d\TH:i:s');
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function() use ($oldValue) {
                $request = request()->merge(['name' => $oldValue]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = bsDatetime()->name('name')->value($customValue)->toHtml();
        $this->assertContains('value="' . $oldValue . '"', $html);
        $this->assertNotContains('value="' . $customValue . '"', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsDatetime()->name('name')->label($label)->toHtml();
        $this->assertContains('<label for="datetime-local-name">' . $label . '</label>', $html);
        $this->assertContains('aria-label="' . $label . '"', $html);
    }

    public function testNoLabel()
    {
        $html = bsDatetime()->name('name')->toHtml();
        $this->assertContains(
            '<label for="datetime-local-name">validation.attributes.name</label>',
            $html
        );
        $this->assertContains(
            'aria-label="validation.attributes.name"',
            $html
        );
    }

    public function testHideLabel()
    {
        $html = bsDatetime()->name('name')->hideLabel()->toHtml();
        $this->assertNotContains(
            '<label for="datetime-local-name">validation.attributes.name</label>',
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
        $html = bsDatetime()->name('name')->render(['errors' => $messageBag]);
        $this->assertContains('<div class="valid-feedback d-block">', $html);
        $this->assertContains(trans('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html);
    }

    public function testNoSuccess()
    {
        $html = bsDatetime()->name('name')->toHtml();
        $this->assertNotContains('<div class="valid-feedback d-block">', $html);
    }

    public function testError()
    {
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsDatetime()->name('name')->render(['errors' => $messageBag]);
        $this->assertContains('<div class="invalid-feedback d-block">', $html);
        $this->assertContains($errorMessage, $html);
    }

    public function testNoError()
    {
        $html = bsDatetime()->name('name')->toHtml();
        $this->assertNotContains('<div class="invalid-feedback d-block">', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.form.datetime.class.container', [$configContainerCLass]);
        $html = bsDatetime()->name('name')->toHtml();
        $this->assertContains('class="datetime-local-name-container ' . $configContainerCLass . '"', $html);
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.form.datetime.class.container', [$configContainerCLass]);
        $html = bsDatetime()->name('name')->containerClass([$customContainerCLass])->toHtml();
        $this->assertContains('class="datetime-local-name-container ' . $customContainerCLass . '"', $html);
        $this->assertNotContains('class="datetime-local-name-container ' . $configContainerCLass . '"', $html);
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.form.datetime.class.component', [$configComponentCLass]);
        $html = bsDatetime()->name('name')->toHtml();
        $this->assertContains('class="form-control datetime-local-name-component ' . $configComponentCLass . '"',
            $html);
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.form.datetime.class.component', [$customComponentCLass]);
        $html = bsDatetime()->name('name')->componentClass([$customComponentCLass])->toHtml();
        $this->assertContains('class="form-control datetime-local-name-component ' . $customComponentCLass . '"',
            $html);
        $this->assertNotContains('class="form-control datetime-local-name-component ' . $configComponentCLass . '"',
            $html);
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.datetime.html_attributes.container', [$configContainerAttributes]);
        $html = bsDatetime()->name('name')->toHtml();
        $this->assertContains($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.datetime.html_attributes.container', [$configContainerAttributes]);
        $html = bsDatetime()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertContains($customContainerAttributes, $html);
        $this->assertNotContains($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.datetime.html_attributes.component', [$configComponentAttributes]);
        $html = bsDatetime()->name('name')->toHtml();
        $this->assertContains($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.datetime.html_attributes.component', [$configComponentAttributes]);
        $html = bsDatetime()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertContains($customComponentAttributes, $html);
        $this->assertNotContains($configComponentAttributes, $html);
    }
}
