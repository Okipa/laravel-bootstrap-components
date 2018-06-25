<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Illuminate\Support\MessageBag;
use Okipa\LaravelBootstrapComponents\Form\Input;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\UsersFaker;

class UrlTest extends BootstrapComponentsTestCase
{
    use UsersFaker;

    public function testConfigStructure()
    {
        // components.form
        $this->assertTrue(array_key_exists('url', config('bootstrap-components.form')));
        // components.form.url
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.form.url')));
        $this->assertTrue(array_key_exists('icon', config('bootstrap-components.form.url')));
        $this->assertTrue(array_key_exists('legend', config('bootstrap-components.form.url')));
        $this->assertTrue(array_key_exists('class', config('bootstrap-components.form.url')));
        $this->assertTrue(array_key_exists('html_attributes', config('bootstrap-components.form.url')));
        // components.form.url.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.url.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.url.class')));
        // components.form.url.html_attributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.url.html_attributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.url.html_attributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Input::class, get_parent_class(bsUrl()));
    }

    public function testSetName()
    {
        $html = bsUrl()->name('name')->toHtml();
        $this->assertContains('name="name"', $html);
    }

    public function testType()
    {
        $html = bsUrl()->name('name')->toHtml();
        $this->assertContains('type="url"', $html);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Okipa\LaravelBootstrapComponents\Form\Url : Missing $name property. Please use the
     *                           name() method to set a name.
     */
    public function testInputWithoutName()
    {
        bsUrl()->toHtml();
    }

    public function testModelValue()
    {
        $user = $this->createUniqueUser();
        $html = bsUrl()->model($user)->name('name')->toHtml();
        $this->assertContains('value="' . $user->name . '"', $html);
    }

    public function testConfigIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.form.url.icon', $configIcon);
        $html = bsUrl()->name('name')->toHtml();
        $this->assertContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testSetIcon()
    {
        $configIcon = 'test-config-icon';
        $customIcon = 'test-custom-icon';
        config()->set('bootstrap-components.form.url.icon', $configIcon);
        $html = bsUrl()->name('name')->icon($customIcon)->toHtml();
        $this->assertContains('<span class="icon input-group-text">' . $customIcon . '</span>', $html);
        $this->assertNotContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testNoIcon()
    {
        config()->set('bootstrap-components.form.url.icon', null);
        $html = bsUrl()->name('name')->toHtml();
        $this->assertNotContains('<span class="icon input-group-text">', $html);
    }

    public function testHideIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.form.url.icon', $configIcon);
        $html = bsUrl()->name('name')->hideIcon()->toHtml();
        $this->assertNotContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.url.legend', $configLegend);
        $html = bsUrl()->name('name')->toHtml();
        $this->assertContains(
            '<small id="url-name-legend" class="form-text text-muted">bootstrap-components::' . $configLegend . '</small>',
            $html
        );
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.form.url.legend', $configLegend);
        $html = bsUrl()->name('name')->legend($customLegend)->toHtml();
        $this->assertContains(
            '<small id="url-name-legend" class="form-text text-muted">bootstrap-components::' . $customLegend . '</small>',
            $html
        );
        $this->assertNotContains(
            '<small id="url-name-legend" class="form-text text-muted">bootstrap-components::' . $configLegend . '</small>',
            $html
        );
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.form.url.legend', null);
        $html = bsUrl()->name('name')->toHtml();
        $this->assertNotContains('<small id="url-name-legend" class="form-text text-muted">"', $html);
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.url.legend', $configLegend);
        $html = bsUrl()->name('name')->hideLegend()->toHtml();
        $this->assertNotContains('<small id="url-name-legend" class="form-text text-muted">', $html);
    }

    public function testSetPlaceholder()
    {
        $placeholder = 'test-custom-placeholder';
        $html = bsUrl()->name('name')->placeholder($placeholder)->toHtml();
        $this->assertContains('placeholder="' . $placeholder . '"', $html);
        $this->assertNotContains(
            'placeholder="validation.attributes.name"',
            $html
        );
    }

    public function testNoPlaceholder()
    {
        $html = bsUrl()->name('name')->toHtml();
        $this->assertContains(
            'placeholder="validation.attributes.name"',
            $html
        );
    }

    public function testSetValue()
    {
        $customValue = 'test-custom-value';
        $html = bsUrl()->name('name')->value($customValue)->toHtml();
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
        $html = bsUrl()->name('name')->value($customValue)->toHtml();
        $this->assertContains('value="' . $oldValue . '"', $html);
        $this->assertNotContains('value="' . $customValue . '"', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsUrl()->name('name')->label($label)->toHtml();
        $this->assertContains('<label for="url-name">' . $label . '</label>', $html);
        $this->assertContains('aria-label="' . $label . '"', $html);
    }

    public function testNoLabel()
    {
        $html = bsUrl()->name('name')->toHtml();
        $this->assertContains(
            '<label for="url-name">validation.attributes.name</label>',
            $html
        );
        $this->assertContains(
            'aria-label="validation.attributes.name"',
            $html
        );
    }

    public function testHideLabel()
    {
        $html = bsUrl()->name('name')->hideLabel()->toHtml();
        $this->assertNotContains(
            '<label for="url-name">validation.attributes.name</label>',
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
        $html = bsUrl()->name('name')->render(['errors' => $messageBag]);
        $this->assertContains('<div class="valid-feedback d-block">', $html);
        $this->assertContains(trans('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html);
    }

    public function testNoSuccess()
    {
        $html = bsUrl()->name('name')->toHtml();
        $this->assertNotContains('<div class="valid-feedback d-block">', $html);
    }

    public function testError()
    {
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsUrl()->name('name')->render(['errors' => $messageBag]);
        $this->assertContains('<div class="invalid-feedback d-block">', $html);
        $this->assertContains($errorMessage, $html);
    }

    public function testNoError()
    {
        $html = bsUrl()->name('name')->toHtml();
        $this->assertNotContains('<div class="invalid-feedback d-block">', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.form.url.class.container', [$configContainerCLass]);
        $html = bsUrl()->name('name')->toHtml();
        $this->assertContains('class="url-name-container ' . $configContainerCLass . '"', $html);
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.form.url.class.container', [$configContainerCLass]);
        $html = bsUrl()->name('name')->containerClass([$customContainerCLass])->toHtml();
        $this->assertContains('class="url-name-container ' . $customContainerCLass . '"', $html);
        $this->assertNotContains('class="url-name-container ' . $configContainerCLass . '"', $html);
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.form.url.class.component', [$configComponentCLass]);
        $html = bsUrl()->name('name')->toHtml();
        $this->assertContains('class="form-control url-name-component ' . $configComponentCLass . '"', $html);
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.form.url.class.component', [$customComponentCLass]);
        $html = bsUrl()->name('name')->componentClass([$customComponentCLass])->toHtml();
        $this->assertContains('class="form-control url-name-component ' . $customComponentCLass . '"', $html);
        $this->assertNotContains('class="form-control url-name-component ' . $configComponentCLass . '"', $html);
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.url.html_attributes.container', [$configContainerAttributes]);
        $html = bsUrl()->name('name')->toHtml();
        $this->assertContains($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.url.html_attributes.container', [$configContainerAttributes]);
        $html = bsUrl()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertContains($customContainerAttributes, $html);
        $this->assertNotContains($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.url.html_attributes.component', [$configComponentAttributes]);
        $html = bsUrl()->name('name')->toHtml();
        $this->assertContains($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.url.html_attributes.component', [$configComponentAttributes]);
        $html = bsUrl()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertContains($customComponentAttributes, $html);
        $this->assertNotContains($configComponentAttributes, $html);
    }
}
