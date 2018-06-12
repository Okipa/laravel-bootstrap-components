<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Illuminate\Support\MessageBag;
use Okipa\LaravelBootstrapComponents\Form\Input;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\UsersFaker;

class InputTextareaTest extends BootstrapComponentsTestCase
{
    use UsersFaker;

    public function testConfigStructure()
    {
        // components
        $this->assertTrue(array_key_exists('input_textarea', config('bootstrap-components')));
        // components.input
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.input_textarea')));
        $this->assertTrue(array_key_exists('icon', config('bootstrap-components.input_textarea')));
        $this->assertTrue(array_key_exists('legend', config('bootstrap-components.input_textarea')));
        $this->assertTrue(array_key_exists('class', config('bootstrap-components.input_textarea')));
        $this->assertTrue(array_key_exists('html_attributes', config('bootstrap-components.input_textarea')));
        // components.input_textarea.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.input_textarea.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.input_textarea.class')));
        // components.input_textarea.html_attributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.input_textarea.html_attributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.input_textarea.html_attributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Input::class, get_parent_class(inputText()));
    }

    public function testSetTypeAndName()
    {
        $html = inputTextarea()->type('text')->name('name')->toHtml();
        $this->assertContains('<textarea id="textarea-name"', $html);
        $this->assertContains('name="name"', $html);
        $this->assertContains('aria-describedby="textarea-name"', $html);
    }

    public function testNoType()
    {
        $html = inputTextarea()->name('name')->toHtml();
        $this->assertContains('<textarea id="textarea-name"', $html);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Name must be declared for the Okipa\LaravelBootstrapComponents\Form\InputTextarea component
     *                           generation.
     */
    public function testInputWithoutName()
    {
        inputTextarea()->toHtml();
    }

    public function testSetModel()
    {
        $user = $this->createUniqueUser();
        $html = inputTextarea()->model($user)->name('name')->toHtml();
        $this->assertContains('aria-describedby="textarea-name">' . $user->name . '</textarea>', $html);
    }

    public function testConfigIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.input_textarea.icon', $configIcon);
        $html = inputTextarea()->name('name')->toHtml();
        $this->assertContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testSetIcon()
    {
        $configIcon = 'test-config-icon';
        $customIcon = 'test-custom-icon';
        config()->set('bootstrap-components.input_textarea.icon', $configIcon);
        $html = inputTextarea()->name('name')->icon($customIcon)->toHtml();
        $this->assertContains('<span class="icon input-group-text">' . $customIcon . '</span>', $html);
        $this->assertNotContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testNoIcon()
    {
        config()->set('bootstrap-components.input_textarea.icon', null);
        $html = inputTextarea()->name('name')->toHtml();
        $this->assertNotContains('<span class="icon input-group-text">', $html);
    }

    public function testHideIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.input_textarea.icon', $configIcon);
        $html = inputTextarea()->name('name')->hideIcon()->toHtml();
        $this->assertNotContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.input_textarea.legend', $configLegend);
        $html = inputTextarea()->name('name')->toHtml();
        $this->assertContains(
            '<small id="textarea-name-legend" class="form-text text-muted">' . $configLegend . '</small>',
            $html
        );
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.input_textarea.legend', $configLegend);
        $html = inputTextarea()->name('name')->legend($customLegend)->toHtml();
        $this->assertContains(
            '<small id="textarea-name-legend" class="form-text text-muted">' . $customLegend . '</small>',
            $html
        );
        $this->assertNotContains(
            '<small id="textarea-name-legend" class="form-text text-muted">' . $configLegend . '</small>',
            $html
        );
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.input_textarea.legend', null);
        $html = inputTextarea()->name('name')->toHtml();
        $this->assertNotContains('<small id="textarea-name-legend" class="form-text text-muted">', $html);
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.input_textarea.legend', $configLegend);
        $html = inputTextarea()->name('name')->hideLegend()->toHtml();
        $this->assertNotContains(
            '<small id="textarea-name-legend" class="form-text text-muted">' . $configLegend . '</small>',
            $html
        );
    }

    public function testSetPlaceholder()
    {
        $placeholder = 'test-custom-placeholder';
        $html = inputTextarea()->name('name')->placeholder($placeholder)->toHtml();
        $this->assertContains('placeholder="' . $placeholder . '"', $html);
        $this->assertNotContains(
            'placeholder="validation.attributes.name"',
            $html
        );
    }

    public function testNoPlaceholder()
    {
        $html = inputTextarea()->name('name')->toHtml();
        $this->assertContains(
            'placeholder="validation.attributes.name"',
            $html
        );
    }

    public function testSetValue()
    {
        $customValue = 'test-custom-value';
        $html = inputTextarea()->name('name')->value($customValue)->toHtml();
        $this->assertContains('aria-describedby="textarea-name">' . $customValue . '</textarea>', $html);
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
        $html = inputTextarea()->name('name')->value($customValue)->toHtml();
        $this->assertContains('aria-describedby="textarea-name">' . $oldValue . '</textarea>', $html);
        $this->assertNotContains('aria-describedby="textarea-name">' . $customValue . '</textarea>', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = inputTextarea()->name('name')->label($label)->toHtml();
        $this->assertContains('<label for="textarea-name">' . $label . '</label>', $html);
        $this->assertContains('aria-label="' . $label . '"', $html);
    }

    public function testNoLabel()
    {
        $html = inputTextarea()->name('name')->toHtml();
        $this->assertContains(
            '<label for="textarea-name">validation.attributes.name</label>',
            $html
        );
        $this->assertContains(
            'aria-label="validation.attributes.name"',
            $html
        );
    }

    public function testHideLabel()
    {
        $html = inputTextarea()->name('name')->hideLabel()->toHtml();
        $this->assertNotContains(
            '<label for="textarea-name">validation.attributes.name</label>',
            $html
        );
        $this->assertNotContains(
            'aria-label="validation.attributes.name"',
            $html
        );
    }

    public function testError()
    {
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = inputTextarea()->name('name')->render(['errors' => $messageBag]);
        $this->assertContains('<span class="invalid-feedback d-flex">', $html);
        $this->assertContains('<strong>' . $errorMessage . '</strong>', $html);
    }

    public function testNoError()
    {
        $html = inputTextarea()->name('name')->render();
        $this->assertNotContains('<span class="invalid-feedback d-flex">', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.input_textarea.class.container', [$configContainerCLass]);
        $html = inputTextarea()->name('name')->toHtml();
        $this->assertContains('class="textarea-name-container ' . $configContainerCLass . '"', $html);
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.input_textarea.class.container', [$configContainerCLass]);
        $html = inputTextarea()->name('name')->containerClass([$customContainerCLass])->toHtml();
        $this->assertContains('class="textarea-name-container ' . $customContainerCLass . '"', $html);
        $this->assertNotContains('class="textarea-name-container ' . $configContainerCLass . '"', $html);
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.input_textarea.class.component', [$configComponentCLass]);
        $html = inputTextarea()->name('name')->toHtml();
        $this->assertContains('class="form-control textarea-name-component ' . $configComponentCLass . '"', $html);
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.input_textarea.class.component', [$customComponentCLass]);
        $html = inputTextarea()->name('name')->componentClass([$customComponentCLass])->toHtml();
        $this->assertContains('class="form-control textarea-name-component ' . $customComponentCLass . '"', $html);
        $this->assertNotContains('class="form-control textarea-name-component ' . $configComponentCLass . '"', $html);
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.input_textarea.html_attributes.container', [$configContainerAttributes]);
        $html = inputTextarea()->name('name')->toHtml();
        $this->assertContains($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.input_textarea.html_attributes.container', [$configContainerAttributes]);
        $html = inputTextarea()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertContains($customContainerAttributes, $html);
        $this->assertNotContains($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.input_textarea.html_attributes.component', [$configComponentAttributes]);
        $html = inputTextarea()->name('name')->toHtml();
        $this->assertContains($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.input_textarea.html_attributes.component', [$configComponentAttributes]);
        $html = inputTextarea()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertContains($customComponentAttributes, $html);
        $this->assertNotContains($configComponentAttributes, $html);
    }
}
