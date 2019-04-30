<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\MessageBag;
use Okipa\LaravelBootstrapComponents\Form\Input;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\UsersFaker;

class DateTest extends BootstrapComponentsTestCase
{
    use UsersFaker;

    public function testConfigStructure()
    {
        // components.form
        $this->assertTrue(array_key_exists('date', config('bootstrap-components.form')));
        // components.form.date
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.form.date')));
        $this->assertTrue(array_key_exists('icon', config('bootstrap-components.form.date')));
        $this->assertTrue(array_key_exists('format', config('bootstrap-components.form.date')));
        $this->assertTrue(array_key_exists('legend', config('bootstrap-components.form.date')));
        $this->assertTrue(array_key_exists('class', config('bootstrap-components.form.date')));
        $this->assertTrue(array_key_exists('html_attributes', config('bootstrap-components.form.date')));
        // components.form.date.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.date.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.date.class')));
        // components.form.date.html_attributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.date.html_attributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.date.html_attributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Input::class, get_parent_class(bsDate()));
    }

    public function testSetName()
    {
        $html = bsDate()->name('name')->toHtml();
        $this->assertStringContainsString('name="name"', $html);
    }

    public function testType()
    {
        $html = bsDate()->name('name')->toHtml();
        $this->assertStringContainsString('type="date"', $html);
    }

    public function testInputWithoutName()
    {
        $this->expectException(Exception::class);
        bsDate()->toHtml();
    }

    public function testWrongModelValue()
    {
        $this->expectException(Exception::class);
        $user = $this->createUniqueUser();
        $user->name = 'test-custom-name';
        bsDate()->model($user)->name('name')->toHtml();
    }

    public function testModelDateTimeObjectValue()
    {
        $user = $this->createUniqueUser();
        $user->published_at = $this->faker->dateTime;
        $html = bsDate()->model($user)->name('published_at')->toHtml();
        $this->assertStringContainsString(
            'value="' . $user->published_at->format(config('bootstrap-components.form.date.format')) . '"',
            $html
        );
    }

    public function testModelDateTimeStringValue()
    {
        $user = $this->createUniqueUser();
        $user->published_at = $this->faker->dateTime->format('Y-m-d');
        $html = bsDate()->model($user)->name('published_at')->toHtml();
        $this->assertStringContainsString(
            'value="' . Carbon::parse($user->published_at)->format(config('bootstrap-components.form.date.format'))
            . '"',
            $html
        );
    }

    public function testSetConfigFormat()
    {
        $configFormat = 'Y-m-d H:i:s';
        config()->set('bootstrap-components.form.date.format', $configFormat);
        $user = $this->createUniqueUser();
        $user->published_at = $this->faker->dateTime;
        $html = bsDate()->model($user)->name('published_at')->toHtml();
        $this->assertStringContainsString($user->published_at->format($configFormat), $html);
    }

    public function testSetFormat()
    {
        $configFormat = 'Y-m-d H:i:s';
        $customFormat = 'Y-m-d H:i';
        config()->set('bootstrap-components.form.date.format', $configFormat);
        $user = $this->createUniqueUser();
        $user->published_at = $this->faker->dateTime;
        $html = bsDate()->model($user)->name('published_at')->format($customFormat)->toHtml();
        $this->assertStringContainsString($user->published_at->format($customFormat), $html);
    }

    public function testNoFormat()
    {
        $this->expectException(Exception::class);
        config()->set('bootstrap-components.form.date.format', null);
        $user = $this->createUniqueUser();
        $user->published_at = $this->faker->dateTime;
        bsDate()->model($user)->name('published_at')->toHtml();
    }

    public function testConfigIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.form.date.icon', $configIcon);
        $html = bsDate()->name('name')->toHtml();
        $this->assertStringContainsString(
            '<span class="icon input-group-text">' . $configIcon . '</span>',
            $html
        );
    }

    public function testSetIcon()
    {
        $configIcon = 'test-config-icon';
        $customIcon = 'test-custom-icon';
        config()->set('bootstrap-components.form.date.icon', $configIcon);
        $html = bsDate()->name('name')->icon($customIcon)->toHtml();
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
        config()->set('bootstrap-components.form.date.icon', null);
        $html = bsDate()->name('name')->toHtml();
        $this->assertStringNotContainsString('<span class="icon input-group-text">', $html);
    }

    public function testHideIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.form.date.icon', $configIcon);
        $html = bsDate()->name('name')->hideIcon()->toHtml();
        $this->assertStringNotContainsString(
            '<span class="icon input-group-text">' . $configIcon . '</span>',
            $html
        );
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.date.legend', $configLegend);
        $html = bsDate()->name('name')->toHtml();
        $this->assertStringContainsString(
            '<small id="date-name-legend" class="form-text text-muted">bootstrap-components::' . $configLegend
            . '</small>',
            $html
        );
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.form.date.legend', $configLegend);
        $html = bsDate()->name('name')->legend($customLegend)->toHtml();
        $this->assertStringContainsString(
            '<small id="date-name-legend" class="form-text text-muted">' . $customLegend
            . '</small>',
            $html
        );
        $this->assertStringNotContainsString(
            '<small id="date-name-legend" class="form-text text-muted">bootstrap-components::' . $configLegend
            . '</small>',
            $html
        );
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.form.date.legend', null);
        $html = bsDate()->name('name')->toHtml();
        $this->assertStringNotContainsString(
            '<small id="date-name-legend" class="form-text text-muted">',
            $html
        );
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.date.legend', $configLegend);
        $html = bsDate()->name('name')->hideLegend()->toHtml();
        $this->assertStringNotContainsString(
            '<small id="date-name-legend" class="form-text text-muted">',
            $html
        );
    }

    public function testSetWrongValue()
    {
        $this->expectException(Exception::class);
        $customValue = 'test-custom-value';
        $html = bsDate()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString('value="' . $customValue . '"', $html);
    }

    public function testSetValue()
    {
        $customValue = $this->faker->dateTime;
        $html = bsDate()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString(
            'value="' . $customValue->format(config('bootstrap-components.form.date.format')) . '"',
            $html
        );
    }

    public function testOldValue()
    {
        $oldValue = $this->faker->dateTime->format('Y-m-d');
        $customValue = $this->faker->dateTime->format('Y-m-d');
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValue) {
                $request = request()->merge(['name' => $oldValue]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = bsDate()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString('value="' . $oldValue . '"', $html);
        $this->assertStringNotContainsString('value="' . $customValue . '"', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsDate()->name('name')->label($label)->toHtml();
        $this->assertStringContainsString('<label for="date-name">' . $label . '</label>', $html);
        $this->assertStringContainsString('placeholder="' . $label . '"', $html);
        $this->assertStringContainsString('aria-label="' . $label . '"', $html);
    }

    public function testNoLabel()
    {
        $html = bsDate()->name('name')->toHtml();
        $this->assertStringContainsString('<label for="date-name">validation.attributes.name</label>', $html);
        $this->assertStringContainsString('aria-label="validation.attributes.name"', $html);
    }

    public function testHideLabel()
    {
        $html = bsDate()->name('name')->hideLabel()->toHtml();
        $this->assertStringNotContainsString('<label for="date-name">validation.attributes.name</label>', $html);
        $this->assertStringNotContainsString('aria-label="validation.attributes.name"', $html);
    }

    public function testSetPlaceholder()
    {
        $placeholder = 'test-custom-placeholder';
        $html = bsDate()->name('name')->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString('placeholder="' . $placeholder . '"', $html);
    }

    public function testSetPlaceholderWithLabel()
    {
        $label = 'test-custom-label';
        $placeholder = 'test-custom-placeholder';
        $html = bsDate()->name('name')->label($label)->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString('placeholder="' . $placeholder . '"', $html);
    }

    public function testNoPlaceholder()
    {
        $html = bsDate()->name('name')->toHtml();
        $this->assertStringContainsString('placeholder="validation.attributes.name"', $html);
    }

    public function testSuccess()
    {
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsDate()->name('name')->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(
            trans('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testNoSuccess()
    {
        $html = bsDate()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
    }

    public function testError()
    {
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsDate()->name('name')->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errorMessage, $html);
    }

    public function testNoError()
    {
        $html = bsDate()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
    }

    public function testSetNoContainerId()
    {
        $html = bsDate()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = bsDate()->name('name')->containerId($customContainerId)->toHtml();
        $this->assertStringContainsString('<div id="' . $customContainerId . '"', $html);
    }

    public function testSetNoComponentId()
    {
        $html = bsDate()->name('name')->toHtml();
        $this->assertStringContainsString('for="date-name"', $html);
        $this->assertStringContainsString('<input id="date-name"', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = bsDate()->name('name')->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString('for="' . $customComponentId . '"', $html);
        $this->assertStringContainsString('<input id="' . $customComponentId . '"', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.form.date.class.container', [$configContainerCLass]);
        $html = bsDate()->name('name')->toHtml();
        $this->assertStringContainsString('class="date-name-container ' . $configContainerCLass . '"', $html);
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.form.date.class.container', [$configContainerCLass]);
        $html = bsDate()->name('name')->containerClass([$customContainerCLass])->toHtml();
        $this->assertStringContainsString('class="date-name-container ' . $customContainerCLass . '"', $html);
        $this->assertStringNotContainsString('class="date-name-container ' . $configContainerCLass . '"', $html);
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.form.date.class.component', [$configComponentCLass]);
        $html = bsDate()->name('name')->toHtml();
        $this->assertStringContainsString(
            'class="form-control date-name-component ' . $configComponentCLass . '"',
            $html
        );
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.form.date.class.component', [$customComponentCLass]);
        $html = bsDate()->name('name')->componentClass([$customComponentCLass])->toHtml();
        $this->assertStringContainsString(
            'class="form-control date-name-component ' . $customComponentCLass . '"',
            $html
        );
        $this->assertStringNotContainsString(
            'class="form-control date-name-component ' . $configComponentCLass . '"',
            $html
        );
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.date.html_attributes.container', [$configContainerAttributes]);
        $html = bsDate()->name('name')->toHtml();
        $this->assertStringContainsString($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.date.html_attributes.container', [$configContainerAttributes]);
        $html = bsDate()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertStringContainsString($customContainerAttributes, $html);
        $this->assertStringNotContainsString($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.date.html_attributes.component', [$configComponentAttributes]);
        $html = bsDate()->name('name')->toHtml();
        $this->assertStringContainsString($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.date.html_attributes.component', [$configComponentAttributes]);
        $html = bsDate()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertStringContainsString($customComponentAttributes, $html);
        $this->assertStringNotContainsString($configComponentAttributes, $html);
    }
}
