<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit;

use Illuminate\Support\MessageBag;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\UsersFaker;

class InputTest extends BootstrapComponentsTestCase
{
    use UsersFaker;

    public function testConfigValues()
    {
        $icon = 'test-config-icon';
        $legend = 'test-config-legend';
        $containerCLass = ['test-config-class-container'];
        $componentCLass = ['test-config-class-component'];
        $containerAttributes = ['test-config-attributes-container'];
        $componentAttributes = ['test-config-attributes-component'];
        config()->set('components.input.icon', $icon);
        config()->set('components.input.legend', $legend);
        config()->set('components.input.class.container', $containerCLass);
        config()->set('components.input.class.component', $componentCLass);
        config()->set('components.input.attributes.container', $containerAttributes);
        config()->set('components.input.attributes.component', $componentAttributes);
        $html = input()->type('text')->name('name')->toHtml();
        $this->assertContains('<span class="icon input-group-text">' . $icon . '</span>', $html);
        $this->assertContains('<small id="input-name-legend" class="form-text text-muted">' . $legend . '</small>',
            $html);
        $this->assertContains('class="input-name-container ' . head($containerCLass) . '"', $html);
        $this->assertContains('class="form-control input-name-component ' . head($componentCLass) . '"', $html);
        $this->assertContains(head($containerAttributes), $html);
        $this->assertContains(head($componentAttributes), $html);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Type must be declared for the « input » component generation.
     */
    public function testInputWithoutType()
    {
        input()->name('name')->toHtml();
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Name must be declared for the « input » component generation.
     */
    public function testInputWithoutName()
    {
        input()->type('text')->toHtml();
    }

    public function testInputWithDefaultValues()
    {
        $html = input()->type('text')->name('name')->toHtml();
        $this->assertContains('<label for="input-name">', $html);
        $this->assertContains('validation.attributes.name', $html);
        $this->assertContains('<input id="input-name"', $html);
        $this->assertContains('name="name"', $html);
        $this->assertContains('placeholder="validation.attributes.name"', $html);
        $this->assertContains('aria-label="validation.attributes.name"', $html);
        $this->assertContains('aria-describedby="input-name"', $html);
        $this->assertContains('type="text"', $html);
    }

    public function testSetModel()
    {
        $user = $this->createUniqueUser();
        $html = input()->model($user)->type('text')->name('name')->toHtml();
        $this->assertContains('value="' . $user->name . '"', $html);
    }

    public function testSetIcon()
    {
        $configIcon = 'test-config-icon';
        $customIcon = 'test-custom-icon';
        config()->set('components.input.icon', $configIcon);
        $html = input()->type('text')->name('name')->icon($customIcon)->toHtml();
        $this->assertContains('class="icon input-group-text"', $html);
        $this->assertContains('<span class="icon input-group-text">' . $customIcon . '</span>', $html);
        $this->assertNotContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testNoIcon()
    {
        config()->set('components.input.icon', null);
        $html = input()->type('text')->name('name')->toHtml();
        $this->assertNotContains('<span class="icon input-group-text">', $html);
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('components.input.legend', $configLegend);
        $html = input()->type('text')->name('name')->legend($customLegend)->toHtml();
        $this->assertContains('<small id="input-name-legend" class="form-text text-muted">' . $customLegend
                              . '</small>', $html);
        $this->assertNotContains('<small id="input-name-legend" class="form-text text-muted">' . $configLegend
                                 . '</small>', $html);
    }

    public function testNoLegend()
    {
        config()->set('components.input.legend', null);
        $html = input()->type('text')->name('name')->toHtml();
        $this->assertNotContains('id="input-name-legend"', $html);
    }

    public function testSetPlaceholder()
    {
        $placeholder = 'test-custom-placeholder';
        $html = input()->type('text')->name('name')->placeholder($placeholder)->toHtml();
        $this->assertContains('placeholder="' . $placeholder . '"', $html);
        $this->assertNotContains('placeholder="validation.attributes.name"', $html);
    }

    //    public function testOldValue()
    //    {
    //        $this->app->make('Illuminate\Contracts\Http\Kernel')->pushMiddleware('Illuminate\Session\Middleware\StartSession');
    //        $oldValue = 'test-old-value';
    //        $request = request()->merge(['name' => $oldValue]);
    //        $request->flashOnly('name');
    //        $html = input()->type('text')->name('name')->toHtml();
    //        $this->assertContains('value="' . $oldValue . '"', $html);
    //    }

    public function testSetValue()
    {
        //        $oldValue = 'test-old-value';
        //        $request = request()->merge(['name' => $oldValue]);
        //        $request->flashOnly('name');
        $value = 'test-custom-value';
        $html = input()->type('text')->name('name')->value($value)->toHtml();
        $this->assertContains('value="' . $value . '"', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = input()->type('text')->name('name')->label($label)->toHtml();
        $this->assertContains('<label for="input-name">' . $label . '</label>', $html);
    }

    public function testNoLabel()
    {
        $html = input()->type('text')->name('name')->toHtml();
        $this->assertContains('<label for="input-name">validation.attributes.name</label>', $html);
    }

    public function testHideLabel()
    {
        $html = input()->type('text')->name('name')->hideLabel()->toHtml();
        $this->assertNotContains('<label for="input-name">validation.attributes.name</label>', $html);
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
}
