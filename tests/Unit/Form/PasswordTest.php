<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Exception;
use Illuminate\Support\MessageBag;
use Okipa\LaravelBootstrapComponents\Form\Input;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\UsersFaker;

class PasswordTest extends BootstrapComponentsTestCase
{
    use UsersFaker;

    public function testConfigStructure()
    {
        // components.form
        $this->assertTrue(array_key_exists('password', config('bootstrap-components.form')));
        // components.form.password
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.form.password')));
        $this->assertTrue(array_key_exists('icon', config('bootstrap-components.form.password')));
        $this->assertTrue(array_key_exists('legend', config('bootstrap-components.form.password')));
        $this->assertTrue(array_key_exists('class', config('bootstrap-components.form.password')));
        $this->assertTrue(array_key_exists('html_attributes', config('bootstrap-components.form.password')));
        // components.form.password.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.password.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.password.class')));
        // components.form.password.html_attributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.password.html_attributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.password.html_attributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Input::class, get_parent_class(bsPassword()));
    }

    public function testSetName()
    {
        $html = bsPassword()->name('name')->toHtml();
        $this->assertStringContainsString('name="name"', $html);
    }

    public function testType()
    {
        $html = bsPassword()->name('name')->toHtml();
        $this->assertStringContainsString('type="password"', $html);
    }

    public function testInputWithoutName()
    {
        $this->expectException(Exception::class);
        bsPassword()->toHtml();
    }

    public function testModelValue()
    {
        $user = $this->createUniqueUser();
        $html = bsPassword()->model($user)->name('name')->toHtml();
        $this->assertStringContainsString('value="' . $user->name . '"', $html);
    }

    public function testConfigIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.form.password.icon', $configIcon);
        $html = bsPassword()->name('name')->toHtml();
        $this->assertStringContainsString(
            '<span class="icon input-group-text">' . $configIcon . '</span>',
            $html
        );
    }

    public function testSetIcon()
    {
        $configIcon = 'test-config-icon';
        $customIcon = 'test-custom-icon';
        config()->set('bootstrap-components.form.password.icon', $configIcon);
        $html = bsPassword()->name('name')->icon($customIcon)->toHtml();
        $this->assertStringContainsString(
            '<span class="icon input-group-text">' . $customIcon . '</span>',
            $html
        );
        $this->assertStringNotContainsString(
            '<span class="icon input-group-text">' . $configIcon . '</span>',
            $html
        );
    }

    public function testNoIcon()
    {
        config()->set('bootstrap-components.form.password.icon', null);
        $html = bsPassword()->name('name')->toHtml();
        $this->assertStringNotContainsString('<span class="icon input-group-text">', $html);
    }

    public function testHideIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.form.password.icon', $configIcon);
        $html = bsPassword()->name('name')->hideIcon()->toHtml();
        $this->assertStringNotContainsString(
            '<span class="icon input-group-text">' . $configIcon . '</span>',
            $html
        );
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.password.legend', $configLegend);
        $html = bsPassword()->name('name')->toHtml();
        $this->assertStringContainsString(
            '<small id="password-name-legend" class="form-text text-muted">bootstrap-components::'
            . $configLegend . '</small>',
            $html
        );
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.form.password.legend', $configLegend);
        $html = bsPassword()->name('name')->legend($customLegend)->toHtml();
        $this->assertStringContainsString(
            '<small id="password-name-legend" class="form-text text-muted">' . $customLegend . '</small>',
            $html
        );
        $this->assertStringNotContainsString(
            '<small id="password-name-legend" class="form-text text-muted">bootstrap-components::'
            . $configLegend . '</small>',
            $html
        );
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.form.password.legend', null);
        $html = bsPassword()->name('name')->toHtml();
        $this->assertStringNotContainsString(
            '<small id="password-name-legend" class="form-text text-muted">',
            $html
        );
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.password.legend', $configLegend);
        $html = bsPassword()->name('name')->hideLegend()->toHtml();
        $this->assertStringNotContainsString(
            '<small id="password-name-legend" class="form-text text-muted">',
            $html
        );
    }

    public function testSetValue()
    {
        $customValue = 'test-custom-value';
        $html = bsPassword()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString('value="' . $customValue . '"', $html);
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
        $html = bsPassword()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString('value="' . $oldValue . '"', $html);
        $this->assertStringNotContainsString('value="' . $customValue . '"', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsPassword()->name('name')->label($label)->toHtml();
        $this->assertStringContainsString('<label for="password-name">' . $label . '</label>', $html);
        $this->assertStringContainsString('placeholder="' . $label . '"', $html);
        $this->assertStringContainsString('aria-label="' . $label . '"', $html);
    }

    public function testNoLabel()
    {
        $html = bsPassword()->name('name')->toHtml();
        $this->assertStringContainsString(
            '<label for="password-name">validation.attributes.name</label>',
            $html
        );
        $this->assertStringContainsString(
            'aria-label="validation.attributes.name"',
            $html
        );
    }

    public function testHideLabel()
    {
        $html = bsPassword()->name('name')->hideLabel()->toHtml();
        $this->assertStringNotContainsString(
            '<label for="password-name">validation.attributes.name</label>',
            $html
        );
        $this->assertStringNotContainsString(
            'aria-label="validation.attributes.name"',
            $html
        );
    }

    public function testSetPlaceholder()
    {
        $placeholder = 'test-custom-placeholder';
        $html = bsPassword()->name('name')->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString('placeholder="' . $placeholder . '"', $html);
    }

    public function testSetPlaceholderWithLabel()
    {
        $label = 'test-custom-label';
        $placeholder = 'test-custom-placeholder';
        $html = bsPassword()->name('name')->label($label)->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString('placeholder="' . $placeholder . '"', $html);
    }

    public function testNoPlaceholder()
    {
        $html = bsPassword()->name('name')->toHtml();
        $this->assertStringContainsString('placeholder="validation.attributes.name"', $html);
    }

    public function testSuccess()
    {
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsPassword()->name('name')->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(
            trans('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testNoSuccess()
    {
        $html = bsPassword()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
    }

    public function testError()
    {
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsPassword()->name('name')->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errorMessage, $html);
    }

    public function testNoError()
    {
        $html = bsPassword()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
    }

    public function testSetNoContainerId()
    {
        $html = bsPassword()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = bsPassword()->name('name')->containerId($customContainerId)->toHtml();
        $this->assertStringContainsString('<div id="' . $customContainerId, $html);
    }

    public function testSetNoComponentId()
    {
        $html = bsPassword()->name('name')->toHtml();
        $this->assertStringContainsString('for="password-name"', $html);
        $this->assertStringContainsString('<input id="password-name"', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = bsPassword()->name('name')->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString('for="' . $customComponentId . '"', $html);
        $this->assertStringContainsString('<input id="' . $customComponentId . '"', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.form.password.class.container', [$configContainerCLass]);
        $html = bsPassword()->name('name')->toHtml();
        $this->assertStringContainsString(
            'class="password-name-container ' . $configContainerCLass . '"',
            $html
        );
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.form.password.class.container', [$configContainerCLass]);
        $html = bsPassword()->name('name')->containerClass([$customContainerCLass])->toHtml();
        $this->assertStringContainsString(
            'class="password-name-container ' . $customContainerCLass . '"',
            $html
        );
        $this->assertStringNotContainsString(
            'class="password-name-container ' . $configContainerCLass . '"',
            $html
        );
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.form.password.class.component', [$configComponentCLass]);
        $html = bsPassword()->name('name')->toHtml();
        $this->assertStringContainsString(
            'class="form-control password-name-component ' . $configComponentCLass . '"',
            $html
        );
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.form.password.class.component', [$customComponentCLass]);
        $html = bsPassword()->name('name')->componentClass([$customComponentCLass])->toHtml();
        $this->assertStringContainsString(
            'class="form-control password-name-component ' . $customComponentCLass . '"',
            $html
        );
        $this->assertStringNotContainsString(
            'class="form-control password-name-component ' . $configComponentCLass . '"',
            $html
        );
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.password.html_attributes.container', [$configContainerAttributes]);
        $html = bsPassword()->name('name')->toHtml();
        $this->assertStringContainsString($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.password.html_attributes.container', [$configContainerAttributes]);
        $html = bsPassword()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertStringContainsString($customContainerAttributes, $html);
        $this->assertStringNotContainsString($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.password.html_attributes.component', [$configComponentAttributes]);
        $html = bsPassword()->name('name')->toHtml();
        $this->assertStringContainsString($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.password.html_attributes.component', [$configComponentAttributes]);
        $html = bsPassword()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertStringContainsString($customComponentAttributes, $html);
        $this->assertStringNotContainsString($configComponentAttributes, $html);
    }
}
