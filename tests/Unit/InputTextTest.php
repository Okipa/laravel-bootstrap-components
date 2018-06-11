<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit;

use Illuminate\Support\MessageBag;
use Okipa\LaravelBootstrapComponents\Form\Input;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\UsersFaker;

class InputTextTest extends BootstrapComponentsTestCase
{
    use UsersFaker;

    public function testConfigStructure()
    {
        // components
        $this->assertTrue(array_key_exists('input_text', config('bootstrap-components')));
        // components.input
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.input_text')));
        $this->assertTrue(array_key_exists('icon', config('bootstrap-components.input_text')));
        $this->assertTrue(array_key_exists('legend', config('bootstrap-components.input_text')));
        $this->assertTrue(array_key_exists('class', config('bootstrap-components.input_text')));
        $this->assertTrue(array_key_exists('html_attributes', config('bootstrap-components.input_text')));
        // components.input.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.input_text.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.input_text.class')));
        // components.input.html_attributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.input_text.html_attributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.input_text.html_attributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Input::class, get_parent_class(inputText()));
    }

    public function testSetTypeAndName()
    {
        $html = inputText()->type('text')->name('name')->toHtml();
        $this->assertContains('<input id="text-name"', $html);
        $this->assertContains('name="name"', $html);
        $this->assertContains('aria-describedby="text-name"', $html);
        $this->assertContains('type="text"', $html);
    }

    public function testInputWithoutType()
    {
        $html = inputText()->name('name')->toHtml();
        $this->assertContains('type="text"', $html);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Name must be declared for the Okipa\LaravelBootstrapComponents\Form\Input component
     *                           generation.
     */
    public function testInputWithoutName()
    {
        inputText()->toHtml();
    }

    public function testSetModel()
    {
        $user = $this->createUniqueUser();
        $html = inputText()->model($user)->name('name')->toHtml();
        $this->assertContains('value="' . $user->name . '"', $html);
    }

    public function testConfigIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.input_text.icon', $configIcon);
        $html = inputText()->name('name')->toHtml();
        $this->assertContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testSetIcon()
    {
        $configIcon = 'test-config-icon';
        $customIcon = 'test-custom-icon';
        config()->set('bootstrap-components.input_text.icon', $configIcon);
        $html = inputText()->name('name')->icon($customIcon)->toHtml();
        $this->assertContains('<span class="icon input-group-text">' . $customIcon . '</span>', $html);
        $this->assertNotContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }
    
    public function testNoIcon()
    {
        config()->set('bootstrap-components.input_text.icon', null);
        $html = inputText()->name('name')->toHtml();
        $this->assertNotContains('<span class="icon input-group-text">', $html);
    }

    public function testHideIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.input_text.icon', $configIcon);
        $html = inputText()->name('name')->hideIcon()->toHtml();
        $this->assertNotContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.input_text.legend', $configLegend);
        $html = inputText()->name('name')->toHtml();
        $this->assertContains(
            '<small id="text-name-legend" class="form-text text-muted">' . $configLegend . '</small>',
            $html
        );
    }
    
    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.input_text.legend', $configLegend);
        $html = inputText()->name('name')->legend($customLegend)->toHtml();
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
        config()->set('bootstrap-components.input_text.legend', null);
        $html = inputText()->name('name')->toHtml();
        $this->assertNotContains('<small id="text-name-legend" class="form-text text-muted">', $html);
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.input_text.legend', $configLegend);
        $html = inputText()->name('name')->hideLegend()->toHtml();
        $this->assertNotContains(
            '<small id="text-name-legend" class="form-text text-muted">' . $configLegend . '</small>',
            $html
        );
    }

    public function testSetPlaceholder()
    {
        $placeholder = 'test-custom-placeholder';
        $html = inputText()->name('name')->placeholder($placeholder)->toHtml();
        $this->assertContains('placeholder="' . $placeholder . '"', $html);
        $this->assertNotContains(
            'placeholder="bootstrap-components::bootstrap-components.validation.attributes.name"',
            $html
        );
    }

    public function testNoPlaceholder()
    {
        $html = inputText()->name('name')->toHtml();
        $this->assertContains(
            'placeholder="bootstrap-components::bootstrap-components.validation.attributes.name"',
            $html
        );
    }

    public function testSetValue()
    {
        $customValue = 'test-custom-value';
        $html = inputText()->name('name')->value($customValue)->toHtml();
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
        $html = inputText()->name('name')->value($customValue)->toHtml();
        $this->assertContains('value="' . $oldValue . '"', $html);
        $this->assertNotContains('value="' . $customValue . '"', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = inputText()->name('name')->label($label)->toHtml();
        $this->assertContains('<label for="text-name">' . $label . '</label>', $html);
        $this->assertContains('aria-label="' . $label . '"', $html);
    }

    public function testNoLabel()
    {
        $html = inputText()->name('name')->toHtml();
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
        $html = inputText()->name('name')->hideLabel()->toHtml();
        $this->assertNotContains(
            '<label for="text-name">bootstrap-components::bootstrap-components.validation.attributes.name</label>',
            $html
        );
        $this->assertNotContains(
            'aria-label="bootstrap-components::bootstrap-components.validation.attributes.name"',
            $html
        );
    }

    public function testError()
    {
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = inputText()->name('name')->render(['errors' => $messageBag]);
        $this->assertContains('<span class="invalid-feedback d-flex">', $html);
        $this->assertContains('<strong>' . $errorMessage . '</strong>', $html);
    }

    public function testNoError()
    {
        $html = inputText()->name('name')->render();
        $this->assertNotContains('<span class="invalid-feedback d-flex">', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.input_text.class.container', [$configContainerCLass]);
        $html = inputText()->name('name')->toHtml();
        $this->assertContains('class="text-name-container ' . $configContainerCLass . '"', $html);
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.input_text.class.container', [$configContainerCLass]);
        $html = inputText()->name('name')->containerClass([$customContainerCLass])->toHtml();
        $this->assertContains('class="text-name-container ' . $customContainerCLass . '"', $html);
        $this->assertNotContains('class="text-name-container ' . $configContainerCLass . '"', $html);
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.input_text.class.component', [$configComponentCLass]);
        $html = inputText()->name('name')->toHtml();
        $this->assertContains('class="form-control text-name-component ' . $configComponentCLass . '"', $html);
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.input_text.class.component', [$customComponentCLass]);
        $html = inputText()->name('name')->componentClass([$customComponentCLass])->toHtml();
        $this->assertContains('class="form-control text-name-component ' . $customComponentCLass . '"', $html);
        $this->assertNotContains('class="form-control text-name-component ' . $configComponentCLass . '"', $html);
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.input_text.html_attributes.container', [$configContainerAttributes]);
        $html = inputText()->name('name')->toHtml();
        $this->assertContains($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.input_text.html_attributes.container', [$configContainerAttributes]);
        $html = inputText()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertContains($customContainerAttributes, $html);
        $this->assertNotContains($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.input_text.html_attributes.component', [$configComponentAttributes]);
        $html = inputText()->name('name')->toHtml();
        $this->assertContains($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.input_text.html_attributes.component', [$configComponentAttributes]);
        $html = inputText()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertContains($customComponentAttributes, $html);
        $this->assertNotContains($configComponentAttributes, $html);
    }
}
