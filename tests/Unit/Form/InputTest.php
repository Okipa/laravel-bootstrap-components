<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Illuminate\Support\MessageBag;
use Okipa\LaravelBootstrapComponents\Component;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\UsersFaker;

class InputTest extends BootstrapComponentsTestCase
{
    use UsersFaker;

    public function testConfigStructure()
    {
        // components
        $this->assertTrue(array_key_exists('input', config('bootstrap-components')));
        // components.input
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.input')));
        $this->assertTrue(array_key_exists('icon', config('bootstrap-components.input')));
        $this->assertTrue(array_key_exists('legend', config('bootstrap-components.input')));
        $this->assertTrue(array_key_exists('class', config('bootstrap-components.input')));
        $this->assertTrue(array_key_exists('html_attributes', config('bootstrap-components.input')));
        // components.input.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.input.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.input.class')));
        // components.input.html_attributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.input.html_attributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.input.html_attributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Component::class, get_parent_class(input()));
    }

    public function testSetTypeAndName()
    {
        $html = input()->type('text')->name('name')->toHtml();
        $this->assertContains('<input id="text-name"', $html);
        $this->assertContains('name="name"', $html);
        $this->assertContains('aria-describedby="text-name"', $html);
        $this->assertContains('type="text"', $html);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Type must be declared for the Okipa\LaravelBootstrapComponents\Form\Input component
     *                           generation.
     */
    public function testNoType()
    {
        input()->name('name')->toHtml();
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Okipa\LaravelBootstrapComponents\Form\Input : the given « wrong » type is invalid and
     *                           should be one of the following : text, tel, email, password, file.
     */
    public function testSetWrongType()
    {
        input()->type('wrong')->name('name')->toHtml();
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Name must be declared for the Okipa\LaravelBootstrapComponents\Form\Input component
     *                           generation.
     */
    public function testInputWithoutName()
    {
        input()->type('text')->toHtml();
    }

    public function testSetModel()
    {
        $user = $this->createUniqueUser();
        $html = input()->model($user)->type('text')->name('name')->toHtml();
        $this->assertContains('value="' . $user->name . '"', $html);
    }

    public function testConfigIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.input.icon', $configIcon);
        $html = input()->type('text')->name('name')->toHtml();
        $this->assertContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testSetIcon()
    {
        $configIcon = 'test-config-icon';
        $customIcon = 'test-custom-icon';
        config()->set('bootstrap-components.input.icon', $configIcon);
        $html = input()->type('text')->name('name')->icon($customIcon)->toHtml();
        $this->assertContains('<span class="icon input-group-text">' . $customIcon . '</span>', $html);
        $this->assertNotContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testNoIcon()
    {
        config()->set('bootstrap-components.input.icon', null);
        $html = input()->type('text')->name('name')->toHtml();
        $this->assertNotContains('<span class="icon input-group-text">', $html);
    }

    public function testHideIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.input.icon', $configIcon);
        $html = input()->type('text')->name('name')->hideIcon()->toHtml();
        $this->assertNotContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.input.legend', $configLegend);
        $html = input()->type('text')->name('name')->toHtml();
        $this->assertContains(
            '<small id="text-name-legend" class="form-text text-muted">' . $configLegend . '</small>',
            $html
        );
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.input.legend', $configLegend);
        $html = input()->type('text')->name('name')->legend($customLegend)->toHtml();
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
        config()->set('bootstrap-components.input.legend', null);
        $html = input()->type('text')->name('name')->toHtml();
        $this->assertNotContains('<small id="text-name-legend" class="form-text text-muted">', $html);
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.input.legend', $configLegend);
        $html = input()->type('text')->name('name')->hideLegend()->toHtml();
        $this->assertNotContains(
            '<small id="text-name-legend" class="form-text text-muted">' . $configLegend . '</small>',
            $html
        );
    }

    public function testSetPlaceholder()
    {
        $placeholder = 'test-custom-placeholder';
        $html = input()->type('text')->name('name')->placeholder($placeholder)->toHtml();
        $this->assertContains('placeholder="' . $placeholder . '"', $html);
        $this->assertNotContains(
            'placeholder="validation.attributes.name"',
            $html
        );
    }

    public function testNoPlaceholder()
    {
        $html = input()->type('text')->name('name')->toHtml();
        $this->assertContains(
            'placeholder="validation.attributes.name"',
            $html
        );
    }

    public function testSetValue()
    {
        $customValue = 'test-custom-value';
        $html = input()->type('text')->name('name')->value($customValue)->toHtml();
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
        $html = input()->type('text')->name('name')->value($customValue)->toHtml();
        $this->assertContains('value="' . $oldValue . '"', $html);
        $this->assertNotContains('value="' . $customValue . '"', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = input()->type('text')->name('name')->label($label)->toHtml();
        $this->assertContains('<label for="text-name">' . $label . '</label>', $html);
        $this->assertContains('aria-label="' . $label . '"', $html);
    }

    public function testNoLabel()
    {
        $html = input()->type('text')->name('name')->toHtml();
        $this->assertContains(
            '<label for="text-name">validation.attributes.name</label>',
            $html
        );
        $this->assertContains(
            'aria-label="validation.attributes.name"',
            $html
        );
    }

    public function testHideLabel()
    {
        $html = input()->type('text')->name('name')->hideLabel()->toHtml();
        $this->assertNotContains(
            '<label for="text-name">validation.attributes.name</label>',
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
        $html = input()->type('text')->name('name')->render(['errors' => $messageBag]);
        $this->assertContains('<span class="invalid-feedback d-flex">', $html);
        $this->assertContains('<strong>' . $errorMessage . '</strong>', $html);
    }

    public function testNoError()
    {
        $html = input()->type('text')->name('name')->render();
        $this->assertNotContains('<span class="invalid-feedback d-flex">', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.input.class.container', [$configContainerCLass]);
        $html = input()->type('text')->name('name')->toHtml();
        $this->assertContains('class="text-name-container ' . $configContainerCLass . '"', $html);
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.input.class.container', [$configContainerCLass]);
        $html = input()->type('text')->name('name')->containerClass([$customContainerCLass])->toHtml();
        $this->assertContains('class="text-name-container ' . $customContainerCLass . '"', $html);
        $this->assertNotContains('class="text-name-container ' . $configContainerCLass . '"', $html);
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.input.class.component', [$configComponentCLass]);
        $html = input()->type('text')->name('name')->toHtml();
        $this->assertContains('class="form-control text-name-component ' . $configComponentCLass . '"', $html);
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.input.class.component', [$customComponentCLass]);
        $html = input()->type('text')->name('name')->componentClass([$customComponentCLass])->toHtml();
        $this->assertContains('class="form-control text-name-component ' . $customComponentCLass . '"', $html);
        $this->assertNotContains('class="form-control text-name-component ' . $configComponentCLass . '"', $html);
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.input.html_attributes.container', [$configContainerAttributes]);
        $html = input()->type('text')->name('name')->toHtml();
        $this->assertContains($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.input.html_attributes.container', [$configContainerAttributes]);
        $html = input()->type('text')->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertContains($customContainerAttributes, $html);
        $this->assertNotContains($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.input.html_attributes.component', [$configComponentAttributes]);
        $html = input()->type('text')->name('name')->toHtml();
        $this->assertContains($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.input.html_attributes.component', [$configComponentAttributes]);
        $html = input()->type('text')->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertContains($customComponentAttributes, $html);
        $this->assertNotContains($configComponentAttributes, $html);
    }
}
