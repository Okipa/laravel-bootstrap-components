<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Illuminate\Support\MessageBag;
use Okipa\LaravelBootstrapComponents\Form\Input;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\UsersFaker;

class InputToggleTest extends BootstrapComponentsTestCase
{
    use UsersFaker;

    public function testConfigStructure()
    {
        // components
        $this->assertTrue(array_key_exists('input_toggle', config('bootstrap-components')));
        // components.input
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.input_toggle')));
        $this->assertTrue(array_key_exists('icon', config('bootstrap-components.input_toggle')));
        $this->assertTrue(array_key_exists('legend', config('bootstrap-components.input_toggle')));
        $this->assertTrue(array_key_exists('class', config('bootstrap-components.input_toggle')));
        $this->assertTrue(array_key_exists('html_attributes', config('bootstrap-components.input_toggle')));
        // components.input.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.input_toggle.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.input_toggle.class')));
        // components.input.html_attributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.input_toggle.html_attributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.input_toggle.html_attributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Input::class, get_parent_class(inputText()));
    }

    public function testSetTypeAndName()
    {
        $html = inputToggle()->type('text')->name('name')->toHtml();
        $this->assertContains('<input id="toggle-name"', $html);
        $this->assertContains('name="name"', $html);
        $this->assertContains('type="checkbox"', $html);
    }

    public function testNoType()
    {
        $html = inputToggle()->name('name')->toHtml();
        $this->assertContains('type="checkbox"', $html);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Name must be declared for the Okipa\LaravelBootstrapComponents\Form\InputToggle component
     *                           generation.
     */
    public function testInputWithoutName()
    {
        inputToggle()->toHtml();
    }

    public function testSetModel()
    {
        $user = $this->createUniqueUser();
        $html = inputToggle()->model($user)->name('name')->toHtml();
        $this->assertContains('checked="checked"', $html);
    }

    public function testConfigIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.input_toggle.icon', $configIcon);
        $html = inputToggle()->name('name')->toHtml();
        $this->assertContains('<span class="switch-icon start">' . $configIcon . '</span>', $html);
    }

    public function testSetIcon()
    {
        $configIcon = 'test-config-icon';
        $customIcon = 'test-custom-icon';
        config()->set('bootstrap-components.input_toggle.icon', $configIcon);
        $html = inputToggle()->name('name')->icon($customIcon)->toHtml();
        $this->assertContains('<span class="switch-icon start">' . $customIcon . '</span>', $html);
        $this->assertNotContains('<span class="switch-icon start">' . $configIcon . '</span>', $html);
    }

    public function testNoIcon()
    {
        config()->set('bootstrap-components.input_toggle.icon', null);
        $html = inputToggle()->name('name')->toHtml();
        $this->assertNotContains('<span class="switch-icon start">', $html);
    }
    
    public function testHideIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.input_toggle.icon', $configIcon);
        $html = inputToggle()->name('name')->hideIcon()->toHtml();
        $this->assertNotContains('<span class="switch-icon start">' . $configIcon . '</span>', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.input_toggle.legend', $configLegend);
        $html = inputToggle()->name('name')->toHtml();
        $this->assertContains(
            '<small id="toggle-name-legend" class="form-text text-muted">' . $configLegend . '</small>',
            $html
        );
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.input_toggle.legend', $configLegend);
        $html = inputToggle()->name('name')->legend($customLegend)->toHtml();
        $this->assertContains(
            '<small id="toggle-name-legend" class="form-text text-muted">' . $customLegend . '</small>',
            $html
        );
        $this->assertNotContains(
            '<small id="toggle-name-legend" class="form-text text-muted">' . $configLegend . '</small>',
            $html
        );
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.input_toggle.legend', null);
        $html = inputToggle()->name('name')->toHtml();
        $this->assertNotContains('<span class="icon input-group-text">', $html);
    }
    
    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.input_toggle.legend', $configLegend);
        $html = inputToggle()->name('name')->hideLegend()->toHtml();
        $this->assertNotContains('<span class="icon input-group-text">', $html);
    }

    public function testSetPlaceholder()
    {
        $placeholder = 'test-custom-placeholder';
        $html = inputToggle()->type('text')->name('name')->placeholder($placeholder)->toHtml();
        $this->assertContains('<span class="switch-label end">' . $placeholder . '</span>', $html);
        $this->assertNotContains(
            '<span class="switch-label end">bootstrap-components::bootstrap-components.validation.attributes.name</span>',
            $html
        );
    }

    public function testNoPlaceholder()
    {
        $html = inputToggle()->name('name')->toHtml();
        $this->assertContains(
            '<span class="switch-label end">bootstrap-components::bootstrap-components.validation.attributes.name</span>',
            $html
        );
    }

    public function testSetValueDefaultCheckStatus()
    {
        $html = inputToggle()->name('name')->toHtml();
        $this->assertNotContains('checked="checked', $html);
    }
    
    public function testSetValueChecked()
    {
        $customValue = true;
        $html = inputToggle()->name('name')->value($customValue)->toHtml();
        $this->assertContains('checked="checked', $html);
    }

    public function testOldValue()
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
        $html = inputToggle()->name('name')->value($customValue)->toHtml();
        $this->assertContains('checked="checked', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = inputToggle()->name('name')->label($label)->toHtml();
        $this->assertContains('<label for="toggle-name">' . $label . '</label>', $html);
    }

    public function testNoLabel()
    {
        $html = inputToggle()->name('name')->toHtml();
        $this->assertContains(
            '<label for="toggle-name">bootstrap-components::bootstrap-components.validation.attributes.name</label>',
            $html
        );
    }

    public function testHideLabel()
    {
        $html = inputToggle()->name('name')->hideLabel()->toHtml();
        $this->assertNotContains(
            '<label for="toggle-name">bootstrap-components::bootstrap-components.validation.attributes.name</label>',
            $html
        );
    }

    public function testError()
    {
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = inputToggle()->name('name')->render(['errors' => $messageBag]);
        $this->assertContains('<span class="invalid-feedback d-flex">', $html);
        $this->assertContains('<strong>' . $errorMessage . '</strong>', $html);
    }

    public function testNoError()
    {
        $html = inputToggle()->name('name')->render();
        $this->assertNotContains('<span class="invalid-feedback d-flex">', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.input_toggle.class.container', [$configContainerCLass]);
        $html = inputToggle()->name('name')->toHtml();
        $this->assertContains('class="toggle-name-container ' . $configContainerCLass . '"', $html);
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.input_toggle.class.container', [$configContainerCLass]);
        $html = inputToggle()->name('name')->containerClass([$customContainerCLass])->toHtml();
        $this->assertContains('class="toggle-name-container ' . $customContainerCLass . '"', $html);
        $this->assertNotContains('class="toggle-name-container ' . $configContainerCLass . '"', $html);
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.input_toggle.class.component', [$configComponentCLass]);
        $html = inputToggle()->name('name')->toHtml();
        $this->assertContains('class="form-control toggle-name-component ' . $configComponentCLass . '"', $html);
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.input_toggle.class.component', [$customComponentCLass]);
        $html = inputToggle()->name('name')->componentClass([$customComponentCLass])->toHtml();
        $this->assertContains('class="form-control toggle-name-component ' . $customComponentCLass . '"', $html);
        $this->assertNotContains('class="form-control toggle-name-component ' . $configComponentCLass . '"', $html);
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.input_toggle.html_attributes.container', [$configContainerAttributes]);
        $html = inputToggle()->name('name')->toHtml();
        $this->assertContains($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.input_toggle.html_attributes.container', [$configContainerAttributes]);
        $html = inputToggle()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertContains($customContainerAttributes, $html);
        $this->assertNotContains($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.input_toggle.html_attributes.component', [$configComponentAttributes]);
        $html = inputToggle()->name('name')->toHtml();
        $this->assertContains($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.input_toggle.html_attributes.component', [$configComponentAttributes]);
        $html = inputToggle()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertContains($customComponentAttributes, $html);
        $this->assertNotContains($configComponentAttributes, $html);
    }
}
