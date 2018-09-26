<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Illuminate\Support\MessageBag;
use Okipa\LaravelBootstrapComponents\Form\Checkable;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\UsersFaker;

class ToggleTest extends BootstrapComponentsTestCase
{
    use UsersFaker;

    public function testConfigStructure()
    {
        // components.form
        $this->assertTrue(array_key_exists('toggle', config('bootstrap-components.form')));
        // components.form.toggle
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.form.toggle')));
        $this->assertTrue(array_key_exists('legend', config('bootstrap-components.form.toggle')));
        $this->assertTrue(array_key_exists('class', config('bootstrap-components.form.toggle')));
        $this->assertTrue(array_key_exists('html_attributes', config('bootstrap-components.form.toggle')));
        // components.form.toggle.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.toggle.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.toggle.class')));
        // components.form.toggle.html_attributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.toggle.html_attributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.toggle.html_attributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Checkable::class, get_parent_class(bsToggle()));
    }

    public function testName()
    {
        $html = bsToggle()->name('name')->toHtml();
        $this->assertContains('name="name"', $html);
    }

    public function testType()
    {
        $html = bsToggle()->name('name')->toHtml();
        $this->assertContains('type="checkbox"', $html);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Okipa\LaravelBootstrapComponents\Form\Toggle : Missing $name property. Please use the
     *                           name() method to set a name.
     */
    public function testInputWithoutName()
    {
        bsToggle()->toHtml();
    }

    public function testModelValue()
    {
        $user = $this->createUniqueUser();
        $html = bsToggle()->model($user)->name('name')->toHtml();
        $this->assertContains('checked="checked"', $html);
    }

    public function testChecked()
    {
        $user = null;
        $html = bsToggle()->model($user)->name('name')->checked(true)->toHtml();
        $this->assertContains('checked="checked"', $html);
    }

    public function testNotChecked()
    {
        $user = $this->createUniqueUser();
        $html = bsToggle()->model($user)->name('name')->checked(false)->toHtml();
        $this->assertNotContains('checked="checked"', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.toggle.legend', $configLegend);
        $html = bsToggle()->name('name')->toHtml();
        $this->assertContains(
            '<small id="toggle-name-legend" class="form-text text-muted">bootstrap-components::'
            . $configLegend . '</small>',
            $html
        );
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.form.toggle.legend', $configLegend);
        $html = bsToggle()->name('name')->legend($customLegend)->toHtml();
        $this->assertContains(
            '<small id="toggle-name-legend" class="form-text text-muted">' . $customLegend . '</small>',
            $html
        );
        $this->assertNotContains(
            '<small id="toggle-name-legend" class="form-text text-muted">bootstrap-components::'
            . $configLegend . '</small>',
            $html
        );
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.form.toggle.legend', null);
        $html = bsToggle()->name('name')->toHtml();
        $this->assertNotContains('<small id="toggle-name-legend" class="form-text text-muted">', $html);
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.toggle.legend', $configLegend);
        $html = bsToggle()->name('name')->hideLegend()->toHtml();
        $this->assertNotContains('<small id="toggle-name-legend" class="form-text text-muted">', $html);
    }

    public function testSetValueDefaultCheckStatus()
    {
        $html = bsToggle()->name('name')->toHtml();
        $this->assertNotContains('checked="checked', $html);
    }

    public function testSetValueChecked()
    {
        $customValue = true;
        $html = bsToggle()->name('name')->value($customValue)->toHtml();
        $this->assertContains('checked="checked', $html);
    }

    public function testOldValueChecked()
    {
        $oldValue = true;
        $customValue = false;
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValue) {
                $request = request()->merge(['name' => $oldValue]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = bsToggle()->name('name')->value($customValue)->toHtml();
        $this->assertContains('checked="checked', $html);
    }

    public function testOldValueNotChecked()
    {
        $oldValue = false;
        $customValue = true;
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValue) {
                $request = request()->merge(['name' => $oldValue]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = bsToggle()->name('name')->value($customValue)->toHtml();
        $this->assertNotContains('checked="checked', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsToggle()->name('name')->label($label)->toHtml();
        $this->assertContains('for="toggle-name">' . $label . '</label>', $html);
    }

    public function testNoLabel()
    {
        $html = bsToggle()->name('name')->toHtml();
        $this->assertContains('for="toggle-name">validation.attributes.name</label>', $html);
    }

    public function testHideLabel()
    {
        $html = bsToggle()->name('name')->hideLabel()->toHtml();
        $this->assertNotContains('for="toggle-name">validation.attributes.name</label>', $html);
    }

    public function testSuccess()
    {
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsToggle()->name('name')->render(['errors' => $messageBag]);
        $this->assertContains('<div class="valid-feedback d-block">', $html);
        $this->assertContains(
            trans('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testNoSuccess()
    {
        $html = bsToggle()->name('name')->toHtml();
        $this->assertNotContains('<div class="valid-feedback d-block">', $html);
    }

    public function testError()
    {
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsToggle()->name('name')->render(['errors' => $messageBag]);
        $this->assertContains('<div class="invalid-feedback d-block">', $html);
        $this->assertContains($errorMessage, $html);
    }

    public function testNoError()
    {
        $html = bsToggle()->name('name')->toHtml();
        $this->assertNotContains('<div class="invalid-feedback d-block">', $html);
    }

    public function testSetNoContainerId()
    {
        $html = bsToggle()->name('name')->toHtml();
        $this->assertNotContains('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = bsToggle()->name('name')->containerId($customContainerId)->toHtml();
        $this->assertContains('<div id="' . $customContainerId, $html);
    }

    public function testSetNoComponentId()
    {
        $html = bsToggle()->name('name')->toHtml();
        $this->assertContains('for="toggle-name"', $html);
        $this->assertContains('<input id="toggle-name"', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = bsToggle()->name('name')->componentId($customComponentId)->toHtml();
        $this->assertContains('for="' . $customComponentId . '"', $html);
        $this->assertContains('<input id="' . $customComponentId . '"', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.form.toggle.class.container', [$configContainerCLass]);
        $html = bsToggle()->name('name')->toHtml();
        $this->assertContains(
            'class="toggle-name-container switch custom-control ' . $configContainerCLass . '"',
            $html
        );
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.form.toggle.class.container', [$configContainerCLass]);
        $html = bsToggle()->name('name')->containerClass([$customContainerCLass])->toHtml();
        $this->assertContains(
            'class="toggle-name-container switch custom-control ' . $customContainerCLass . '"',
            $html
        );
        $this->assertNotContains(
            'class="toggle-name-container switch custom-control ' . $configContainerCLass . '"',
            $html
        );
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.form.toggle.class.component', [$configComponentCLass]);
        $html = bsToggle()->name('name')->toHtml();
        $this->assertContains(
            'class="toggle-name-component custom-control-input ' . $configComponentCLass . '"',
            $html
        );
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.form.toggle.class.component', [$customComponentCLass]);
        $html = bsToggle()->name('name')->componentClass([$customComponentCLass])->toHtml();
        $this->assertContains(
            'class="toggle-name-component custom-control-input ' . $customComponentCLass . '"',
            $html
        );
        $this->assertNotContains('class="form-control toggle-name-component ' . $configComponentCLass . '"', $html);
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.toggle.html_attributes.container', [$configContainerAttributes]);
        $html = bsToggle()->name('name')->toHtml();
        $this->assertContains($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.toggle.html_attributes.container', [$configContainerAttributes]);
        $html = bsToggle()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertContains($customContainerAttributes, $html);
        $this->assertNotContains($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.toggle.html_attributes.component', [$configComponentAttributes]);
        $html = bsToggle()->name('name')->toHtml();
        $this->assertContains($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.toggle.html_attributes.component', [$configComponentAttributes]);
        $html = bsToggle()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertContains($customComponentAttributes, $html);
        $this->assertNotContains($configComponentAttributes, $html);
    }
}
