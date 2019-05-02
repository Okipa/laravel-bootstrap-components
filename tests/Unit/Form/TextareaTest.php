<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Exception;
use Illuminate\Support\MessageBag;
use Okipa\LaravelBootstrapComponents\Form\Input;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\UsersFaker;

class TextareaTest extends BootstrapComponentsTestCase
{
    use UsersFaker;

    public function testConfigStructure()
    {
        // components.form
        $this->assertTrue(array_key_exists('textarea', config('bootstrap-components.form')));
        // components.form.textarea
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.form.textarea')));
        $this->assertTrue(array_key_exists('prepend', config('bootstrap-components.form.textarea')));
        $this->assertTrue(array_key_exists('append', config('bootstrap-components.form.textarea')));
        $this->assertTrue(array_key_exists('legend', config('bootstrap-components.form.textarea')));
        $this->assertTrue(array_key_exists('class', config('bootstrap-components.form.textarea')));
        $this->assertTrue(array_key_exists('html_attributes', config('bootstrap-components.form.textarea')));
        // components.form.textarea.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.textarea.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.textarea.class')));
        // components.form.textarea.html_attributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.textarea.html_attributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.textarea.html_attributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Input::class, get_parent_class(bsTextarea()));
    }

    public function testSetName()
    {
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringContainsString('name="name"', $html);
    }

    public function testType()
    {
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringContainsString('<textarea', $html);
    }

    public function testInputWithoutName()
    {
        $this->expectException(Exception::class);
        bsTextarea()->toHtml();
    }

    public function testModelValue()
    {
        $user = $this->createUniqueUser();
        $html = bsTextarea()->model($user)->name('name')->toHtml();
        $this->assertStringContainsString(
            'aria-describedby="textarea-name">' . $user->name . '</textarea>',
            $html
        );
    }

    public function testConfigPrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.form.textarea.prepend', $configPrepend);
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringContainsString('input-group-prepend', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $configPrepend . '</span>', $html);
    }

    public function testSetPrepend()
    {
        $configPrepend = 'test-config-prepend';
        $customPrepend = 'test-custom-prepend';
        config()->set('bootstrap-components.form.textarea.prepend', $configPrepend);
        $html = bsTextarea()->name('name')->prepend($customPrepend)->toHtml();
        $this->assertStringContainsString('input-group-prepend', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $customPrepend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="input-group-text">' . $configPrepend . '</span>', $html);
    }

    public function testNoPrepend()
    {
        config()->set('bootstrap-components.form.textarea.prepend', null);
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringNotContainsString('input-group-prepend', $html);
    }

    public function testHidePrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.form.textarea.prepend', $configPrepend);
        $html = bsTextarea()->name('name')->prepend(false)->toHtml();
        $this->assertStringNotContainsString('input-group-prepend', $html);
    }

    public function testConfigAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.textarea.append', $configAppend);
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringContainsString('input-group-append', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $configAppend . '</span>', $html);
    }

    public function testSetAppend()
    {
        $configAppend = 'test-config-append';
        $customAppend = 'test-custom-append';
        config()->set('bootstrap-components.form.textarea.append', $configAppend);
        $html = bsTextarea()->name('name')->append($customAppend)->toHtml();
        $this->assertStringContainsString('input-group-append', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $customAppend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="input-group-text">' . $configAppend . '</span>', $html);
    }

    public function testNoAppend()
    {
        config()->set('bootstrap-components.form.textarea.append', null);
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringNotContainsString('input-group-append', $html);
    }

    public function testHideAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.textarea.append', $configAppend);
        $html = bsTextarea()->name('name')->append(false)->toHtml();
        $this->assertStringNotContainsString('input-group-append', $html);
    }

    public function testNoPrependNoAppend()
    {
        config()->set('bootstrap-components.form.textarea.prepend', null);
        config()->set('bootstrap-components.form.textarea.append', null);
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div class="input-group">', $html);
    }

    public function testHidePrependHideAppend()
    {
        $configPrepend = 'test-config-prepend';
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.textarea.prepend', $configPrepend);
        config()->set('bootstrap-components.form.textarea.append', $configAppend);
        $html = bsTextarea()->name('name')->prepend(false)->append(false)->toHtml();
        $this->assertStringNotContainsString('<div class="input-group">', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.textarea.legend', $configLegend);
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringContainsString(
            '<small id="textarea-name-legend" class="form-text text-muted">bootstrap-components::'
            . $configLegend . '</small>',
            $html
        );
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.form.textarea.legend', $configLegend);
        $html = bsTextarea()->name('name')->legend($customLegend)->toHtml();
        $this->assertStringContainsString(
            '<small id="textarea-name-legend" class="form-text text-muted">' . $customLegend . '</small>',
            $html
        );
        $this->assertStringNotContainsString(
            '<small id="textarea-name-legend" class="form-text text-muted">bootstrap-components::'
            . $configLegend . '</small>',
            $html
        );
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.form.textarea.legend', null);
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringNotContainsString('<small id="textarea-name-legend" class="form-text text-muted">', $html);
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.textarea.legend', $configLegend);
        $html = bsTextarea()->name('name')->hideLegend()->toHtml();
        $this->assertStringNotContainsString('<small id="textarea-name-legend" class="form-text text-muted">', $html);
    }

    public function testSetValue()
    {
        $customValue = 'test-custom-value';
        $html = bsTextarea()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString(
            'aria-describedby="textarea-name">' . $customValue . '</textarea>',
            $html
        );
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
        $html = bsTextarea()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString(
            'aria-describedby="textarea-name">' . $oldValue . '</textarea>',
            $html
        );
        $this->assertStringNotContainsString(
            'aria-describedby="textarea-name">' . $customValue . '</textarea>',
            $html
        );
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsTextarea()->name('name')->label($label)->toHtml();
        $this->assertStringContainsString('<label for="textarea-name">' . $label . '</label>', $html);
        $this->assertStringContainsString('placeholder="' . $label . '"', $html);
        $this->assertStringContainsString('aria-label="' . $label . '"', $html);
    }

    public function testNoLabel()
    {
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringContainsString(
            '<label for="textarea-name">validation.attributes.name</label>',
            $html
        );
        $this->assertStringContainsString(
            'aria-label="validation.attributes.name"',
            $html
        );
    }

    public function testHideLabel()
    {
        $html = bsTextarea()->name('name')->hideLabel()->toHtml();
        $this->assertStringNotContainsString(
            '<label for="textarea-name">validation.attributes.name</label>',
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
        $html = bsTextarea()->name('name')->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString('placeholder="' . $placeholder . '"', $html);
    }

    public function testSetPlaceholderWithLabel()
    {
        $label = 'test-custom-label';
        $placeholder = 'test-custom-placeholder';
        $html = bsTextarea()->name('name')->label($label)->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString('placeholder="' . $placeholder . '"', $html);
    }

    public function testNoPlaceholder()
    {
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringContainsString('placeholder="validation.attributes.name"', $html);
    }

    public function testSuccess()
    {
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsTextarea()->name('name')->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(
            trans('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testNoSuccess()
    {
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
    }

    public function testError()
    {
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsTextarea()->name('name')->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errorMessage, $html);
    }

    public function testNoError()
    {
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
    }

    public function testSetNoContainerId()
    {
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = bsTextarea()->name('name')->containerId($customContainerId)->toHtml();
        $this->assertStringContainsString('<div id="' . $customContainerId, $html);
    }

    public function testSetNoComponentId()
    {
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringContainsString('for="textarea-name"', $html);
        $this->assertStringContainsString('<textarea id="textarea-name"', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = bsTextarea()->name('name')->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString('for="' . $customComponentId . '"', $html);
        $this->assertStringContainsString('<textarea id="' . $customComponentId . '"', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.form.textarea.class.container', [$configContainerCLass]);
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringContainsString(
            'class="textarea-name-container ' . $configContainerCLass . '"',
            $html
        );
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.form.textarea.class.container', [$configContainerCLass]);
        $html = bsTextarea()->name('name')->containerClass([$customContainerCLass])->toHtml();
        $this->assertStringContainsString(
            'class="textarea-name-container ' . $customContainerCLass . '"',
            $html
        );
        $this->assertStringNotContainsString(
            'class="textarea-name-container ' . $configContainerCLass . '"',
            $html
        );
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.form.textarea.class.component', [$configComponentCLass]);
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringContainsString(
            'class="form-control textarea-name-component ' . $configComponentCLass . '"',
            $html
        );
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.form.textarea.class.component', [$customComponentCLass]);
        $html = bsTextarea()->name('name')->componentClass([$customComponentCLass])->toHtml();
        $this->assertStringContainsString(
            'class="form-control textarea-name-component ' . $customComponentCLass . '"',
            $html
        );
        $this->assertStringNotContainsString(
            'class="form-control textarea-name-component ' . $configComponentCLass . '"',
            $html
        );
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.textarea.html_attributes.container', [$configContainerAttributes]);
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringContainsString($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.textarea.html_attributes.container', [$configContainerAttributes]);
        $html = bsTextarea()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertStringContainsString($customContainerAttributes, $html);
        $this->assertStringNotContainsString($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.textarea.html_attributes.component', [$configComponentAttributes]);
        $html = bsTextarea()->name('name')->toHtml();
        $this->assertStringContainsString($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.textarea.html_attributes.component', [$configComponentAttributes]);
        $html = bsTextarea()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertStringContainsString($customComponentAttributes, $html);
        $this->assertStringNotContainsString($configComponentAttributes, $html);
    }
}
