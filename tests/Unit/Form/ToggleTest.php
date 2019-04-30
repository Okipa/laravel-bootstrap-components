<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Exception;
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
        $this->assertTrue(array_key_exists('icon', config('bootstrap-components.form.toggle')));
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
        $this->assertStringContainsString('name="name"', $html);
    }

    public function testType()
    {
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringContainsString('type="checkbox"', $html);
    }

    public function testInputWithoutName()
    {
        $this->expectException(Exception::class);
        bsToggle()->toHtml();
    }

    public function testModelValue()
    {
        $user = $this->createUniqueUser();
        $html = bsToggle()->model($user)->name('name')->toHtml();
        $this->assertStringContainsString('checked="checked"', $html);
    }

    public function testConfigIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.form.toggle.icon', $configIcon);
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringContainsString(
            '<label class="custom-control-label" for="toggle-name"><span class="label-icon">'
            . $configIcon . '</span> validation.attributes.name</label>',
            $html
        );
    }

    public function testSetIcon()
    {
        $configIcon = 'test-config-icon';
        $customIcon = 'test-custom-icon';
        config()->set('bootstrap-components.form.toggle.icon', $configIcon);
        $html = bsToggle()->name('name')->icon($customIcon)->toHtml();
        $this->assertStringNotContainsString(
            '<label class="custom-control-label" for="toggle-name"><span class="label-icon">'
            . $configIcon . '</span> validation.attributes.name</label>',
            $html
        );
        $this->assertStringContainsString(
            '<label class="custom-control-label" for="toggle-name"><span class="label-icon">'
            . $customIcon . '</span> validation.attributes.name</label>',
            $html
        );
    }

    public function testNoIcon()
    {
        config()->set('bootstrap-components.form.toggle.icon', null);
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringNotContainsString('<span class="label-icon">', $html);
    }

    public function testChecked()
    {
        $user = null;
        $html = bsToggle()->model($user)->name('name')->checked(true)->toHtml();
        $this->assertStringContainsString('checked="checked"', $html);
    }

    public function testNotChecked()
    {
        $user = $this->createUniqueUser();
        $html = bsToggle()->model($user)->name('name')->checked(false)->toHtml();
        $this->assertStringNotContainsString('checked="checked"', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.toggle.legend', $configLegend);
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringContainsString(
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
        $this->assertStringContainsString(
            '<small id="toggle-name-legend" class="form-text text-muted">' . $customLegend . '</small>',
            $html
        );
        $this->assertStringNotContainsString(
            '<small id="toggle-name-legend" class="form-text text-muted">bootstrap-components::'
            . $configLegend . '</small>',
            $html
        );
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.form.toggle.legend', null);
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringNotContainsString(
            '<small id="toggle-name-legend" class="form-text text-muted">',
            $html
        );
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.toggle.legend', $configLegend);
        $html = bsToggle()->name('name')->hideLegend()->toHtml();
        $this->assertStringNotContainsString(
            '<small id="toggle-name-legend" class="form-text text-muted">',
            $html
        );
    }

    public function testSetValueDefaultCheckStatus()
    {
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringNotContainsString('checked="checked', $html);
    }

    public function testSetValueChecked()
    {
        $customValue = true;
        $html = bsToggle()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString('checked="checked', $html);
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
        $this->assertStringContainsString('checked="checked', $html);
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
        $this->assertStringNotContainsString('checked="checked', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsToggle()->name('name')->label($label)->toHtml();
        $this->assertStringContainsString('for="toggle-name">' . $label . '</label>', $html);
    }

    public function testNoLabel()
    {
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringContainsString(
            'for="toggle-name">validation.attributes.name</label>',
            $html
        );
    }

    public function testHideLabel()
    {
        $html = bsToggle()->name('name')->hideLabel()->toHtml();
        $this->assertStringNotContainsString(
            'for="toggle-name">validation.attributes.name</label>',
            $html
        );
    }

    public function testSuccess()
    {
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsToggle()->name('name')->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(
            trans('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testNoSuccess()
    {
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
    }

    public function testError()
    {
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsToggle()->name('name')->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errorMessage, $html);
    }

    public function testNoError()
    {
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
    }

    public function testSetNoContainerId()
    {
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = bsToggle()->name('name')->containerId($customContainerId)->toHtml();
        $this->assertStringContainsString('<div id="' . $customContainerId, $html);
    }

    public function testSetNoComponentId()
    {
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringContainsString('for="toggle-name"', $html);
        $this->assertStringContainsString('<input id="toggle-name"', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = bsToggle()->name('name')->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString('for="' . $customComponentId . '"', $html);
        $this->assertStringContainsString('<input id="' . $customComponentId . '"', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.form.toggle.class.container', [$configContainerCLass]);
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringContainsString(
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
        $this->assertStringContainsString(
            'class="toggle-name-container switch custom-control ' . $customContainerCLass . '"',
            $html
        );
        $this->assertStringNotContainsString(
            'class="toggle-name-container switch custom-control ' . $configContainerCLass . '"',
            $html
        );
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.form.toggle.class.component', [$configComponentCLass]);
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringContainsString(
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
        $this->assertStringContainsString(
            'class="toggle-name-component custom-control-input ' . $customComponentCLass . '"',
            $html
        );
        $this->assertStringNotContainsString(
            'class="form-control toggle-name-component ' . $configComponentCLass . '"',
            $html
        );
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.toggle.html_attributes.container', [$configContainerAttributes]);
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringContainsString($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.toggle.html_attributes.container', [$configContainerAttributes]);
        $html = bsToggle()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertStringContainsString($customContainerAttributes, $html);
        $this->assertStringNotContainsString($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.toggle.html_attributes.component', [$configComponentAttributes]);
        $html = bsToggle()->name('name')->toHtml();
        $this->assertStringContainsString($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.toggle.html_attributes.component', [$configComponentAttributes]);
        $html = bsToggle()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertStringContainsString($customComponentAttributes, $html);
        $this->assertStringNotContainsString($configComponentAttributes, $html);
    }
}
