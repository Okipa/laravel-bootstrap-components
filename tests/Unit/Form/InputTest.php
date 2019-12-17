<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Exception;
use Illuminate\Support\MessageBag;
use Okipa\LaravelBootstrapComponents\Form\Abstracts\Form;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Dummy\Components\Url;
use Okipa\LaravelBootstrapComponents\Test\Fakers\UsersFaker;

class InputTest extends BootstrapComponentsTestCase
{
    use UsersFaker;

    public function testExtendsInput()
    {
        $this->assertEquals(Form::class, get_parent_class(inputUrl()));
    }

    public function testSetName()
    {
        $html = inputUrl()->name('name')->toHtml();
        $this->assertStringContainsString(' name="name"', $html);
    }

    public function testType()
    {
        $html = inputUrl()->name('name')->toHtml();
        $this->assertStringContainsString(' type="url"', $html);
    }

    public function testInputWithoutName()
    {
        $this->expectException(Exception::class);
        inputUrl()->toHtml();
    }

    public function testModelValue()
    {
        $user = $this->createUniqueUser();
        $html = inputUrl()->model($user)->name('name')->toHtml();
        $this->assertStringContainsString(' value="' . $user->name . '"', $html);
    }

    public function testCustomPrepend()
    {
        $customUrlComponent = new Class extends \Okipa\LaravelBootstrapComponents\Form\Components\Url {
            protected function setPrepend(): ?string
            {
                return 'default-prepend';
            }
        };
        config()->set('bootstrap-components.form.components.url', get_class($customUrlComponent));
        $html = inputUrl()->name('name')->toHtml();
        $this->assertStringContainsString('<span class="input-group-text">default-prepend</span>', $html);
    }

    public function testSetPrependOverridesDefault()
    {
        $customUrlComponent = new Class extends \Okipa\LaravelBootstrapComponents\Form\Components\Url {
            protected function setPrepend(): ?string
            {
                return 'default-prepend';
            }
        };
        config()->set('bootstrap-components.form.components.url', get_class($customUrlComponent));
        $html = inputUrl()->name('name')->prepend('custom-prepend')->toHtml();
        $this->assertStringContainsString('<span class="input-group-text">custom-prepend</span>', $html);
        $this->assertStringNotContainsString('<span class="input-group-text">default-prepend</span>', $html);
    }

    public function testHidePrepend()
    {
        $html = inputUrl()->name('name')->prepend(null)->toHtml();
        $this->assertStringNotContainsString('<div class="input-group-prepend">', $html);
    }

    public function testCustomAppend()
    {
        $customUrlComponent = new Class extends \Okipa\LaravelBootstrapComponents\Form\Components\Url {
            protected function setAppend(): ?string
            {
                return 'default-append';
            }
        };
        config()->set('bootstrap-components.form.components.url', get_class($customUrlComponent));
        $html = inputUrl()->name('name')->toHtml();
        $this->assertStringContainsString('<span class="input-group-text">default-append</span>', $html);
    }

    public function testSetAppendOverridesDefault()
    {
        $customUrlComponent = new Class extends \Okipa\LaravelBootstrapComponents\Form\Components\Url {
            protected function setPrepend(): ?string
            {
                return 'default-append';
            }
        };
        config()->set('bootstrap-components.form.components.url', get_class($customUrlComponent));
        $html = inputUrl()->name('name')->append('custom-append')->toHtml();
        $this->assertStringContainsString('<span class="input-group-text">custom-append</span>', $html);
        $this->assertStringNotContainsString('<span class="input-group-text">default-append</span>', $html);
    }

    public function testHideAppend()
    {
        $html = inputUrl()->name('name')->append(null)->toHtml();
        $this->assertStringNotContainsString('<div class="input-group-append">', $html);
    }

    public function testHidePrependHideAppend()
    {
        $html = inputUrl()->name('name')->prepend(null)->append(null)->toHtml();
        $this->assertStringNotContainsString('<div class="input-group">', $html);
    }

    public function testCustomLegend()
    {
        $customUrlComponent = new Class extends \Okipa\LaravelBootstrapComponents\Form\Components\Url {
            protected function setLegend(): ?string
            {
                return 'default-legend';
            }
        };
        config()->set('bootstrap-components.form.components.url', get_class($customUrlComponent));
        $html = inputUrl()->name('name')->toHtml();
        $this->assertStringContainsString('class="legend form-text text-muted">default-legend', $html);
    }

    public function testSetLegendOverridesDefault()
    {
        $customUrlComponent = new Class extends \Okipa\LaravelBootstrapComponents\Form\Components\Url {
            protected function setLegend(): ?string
            {
                return 'default-legend';
            }
        };
        config()->set('bootstrap-components.form.components.url', get_class($customUrlComponent));
        $html = inputUrl()->name('name')->legend('custom-legend')->toHtml();
        $this->assertStringContainsString('class="legend form-text text-muted">custom-legend', $html);
        $this->assertStringNotContainsString('class="legend form-text text-muted">default-legend', $html);
    }

    public function testSetTranslatedLegend()
    {
        $legend = 'bootstrap-components::bootstrap-components.label.validate';
        $html = inputUrl()->name('name')->legend($legend)->toHtml();
        $this->assertStringContainsString(__($legend), $html);
    }

    public function testHideLegend()
    {
        $html = inputUrl()->name('name')->legend(null)->toHtml();
        $this->assertStringNotContainsString('class="legend form-text text-muted"', $html);
    }

    public function testSetValue()
    {
        $customValue = 'test-custom-value';
        $html = inputUrl()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString(' value="' . $customValue . '"', $html);
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
        $html = inputUrl()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString(' value="' . $oldValue . '"', $html);
        $this->assertStringNotContainsString(' value="' . $customValue . '"', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = inputUrl()->name('name')->label($label)->toHtml();
        $this->assertStringContainsString('<label for="url-name">' . $label . '</label>', $html);
        $this->assertStringContainsString(' placeholder="' . $label . '"', $html);
    }

    public function testSetTranslatedLabel()
    {
        $label = 'bootstrap-components::bootstrap-components.label.validate';
        $html = inputUrl()->name('name')->label($label)->toHtml();
        $this->assertStringContainsString('<label for="url-name">' . __($label) . '</label>', $html);
        $this->assertStringContainsString(' placeholder="' . __($label) . '"', $html);
    }

    public function testNoLabel()
    {
        $html = inputUrl()->name('name')->toHtml();
        $this->assertStringContainsString('<label for="url-name">validation.attributes.name</label>', $html);
    }

    public function testHideLabel()
    {
        $html = inputUrl()->name('name')->label(false)->toHtml();
        $this->assertStringNotContainsString('<label for="url-name">validation.attributes.name</label>', $html);
    }

    // here

    public function testConfigLabelPositionedAbove()
    {
        config()->set('bootstrap-components.form.url.labelPositionedAbove', true);
        $html = inputUrl()->name('name')->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        $this->assertLessThan($inputPosition, $labelPosition);
    }

    public function testConfigLabelPositionedUnder()
    {
        config()->set('bootstrap-components.form.url.labelPositionedAbove', false);
        $html = inputUrl()->name('name')->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        $this->assertLessThan($labelPosition, $inputPosition);
    }

    public function testLabelPositionedAbove()
    {
        config()->set('bootstrap-components.form.url.labelPositionedAbove', false);
        $html = inputUrl()->name('name')->labelPositionedAbove()->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        $this->assertLessThan($inputPosition, $labelPosition);
    }

    public function testLabelPositionedUnder()
    {
        config()->set('bootstrap-components.form.url.labelPositionedAbove', true);
        $html = inputUrl()->name('name')->labelPositionedAbove(false)->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        $this->assertLessThan($labelPosition, $inputPosition);
    }

    public function testSetPlaceholder()
    {
        $placeholder = 'test-custom-placeholder';
        $html = inputUrl()->name('name')->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString(' placeholder="' . $placeholder . '"', $html);
    }

    public function testSetTranslatedPlaceholder()
    {
        $placeholder = 'bootstrap-components::bootstrap-components.label.validate';
        $html = inputUrl()->name('name')->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString(' placeholder="' . __($placeholder) . '"', $html);
    }

    public function testSetPlaceholderWithLabel()
    {
        $label = 'test-custom-label';
        $placeholder = 'test-custom-placeholder';
        $html = inputUrl()->name('name')->label($label)->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString(' placeholder="' . $placeholder . '"', $html);
    }

    public function testNoPlaceholder()
    {
        $html = inputUrl()->name('name')->toHtml();
        $this->assertStringContainsString(' placeholder="validation.attributes.name"', $html);
    }

    public function testNoPlaceholderWithNoLabel()
    {
        $html = inputUrl()->name('name')->label(false)->toHtml();
        $this->assertStringContainsString(' placeholder="validation.attributes.name"', $html);
    }

    public function testHidePlaceholder()
    {
        $html = inputUrl()->name('name')->placeholder(false)->toHtml();
        $this->assertStringNotContainsString(' placeholder="', $html);
    }

    public function testConfigDisplaySuccess()
    {
        config()->set('bootstrap-components.form.url.formValidation.displaySuccess', true);
        $errors = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = inputUrl()->name('name')->render(compact('errors'));
        $this->assertStringContainsString('is-valid', $html);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testConfigDoNotDisplaySuccess()
    {
        config()->set('bootstrap-components.form.url.formValidation.displaySuccess', false);
        $errors = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = inputUrl()->name('name')->render(compact('errors'));
        $this->assertStringNotContainsString('is-valid', $html);
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringNotContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testDisplaySuccess()
    {
        config()->set('bootstrap-components.form.url.formValidation.displaySuccess', false);
        $errors = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = inputUrl()->name('name')->displaySuccess()->render(compact('errors'));
        $this->assertStringContainsString('is-valid', $html);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testDoNotDisplaySuccess()
    {
        config()->set('bootstrap-components.form.url.formValidation.displaySuccess', true);
        $errors = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = inputUrl()->name('name')->displaySuccess(false)->render(compact('errors'));
        $this->assertStringNotContainsString('is-valid', $html);
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringNotContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testConfigDisplayFailure()
    {
        config()->set('bootstrap-components.form.url.formValidation.displayFailure', true);
        $errors = app(MessageBag::class)->add('name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = inputUrl()->name('name')->render(compact('errors'));
        $this->assertStringContainsString('is-invalid', $html);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errors->first('name'), $html);
    }

    public function testConfigDoNotDisplayFailure()
    {
        config()->set('bootstrap-components.form.url.formValidation.displayFailure', false);
        $errors = app(MessageBag::class)->add('name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = inputUrl()->name('name')->render(compact('errors'));
        $this->assertStringNotContainsString('is-invalid', $html);
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringNotContainsString($errors->first('name'), $html);
    }

    public function testDisplayFailure()
    {
        config()->set('bootstrap-components.form.url.formValidation.displayFailure', false);
        $errors = app(MessageBag::class)->add('name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = inputUrl()->name('name')->displayFailure()->render(compact('errors'));
        $this->assertStringContainsString('is-invalid', $html);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errors->first('name'), $html);
    }

    public function testDoNotDisplayFailure()
    {
        config()->set('bootstrap-components.form.url.formValidation.displayFailure', true);
        $errors = app(MessageBag::class)->add('name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = inputUrl()->name('name')->displayFailure(false)->render(compact('errors'));
        $this->assertStringNotContainsString('is-invalid', $html);
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringNotContainsString($errors->first('name'), $html);
    }

    public function testSetNoContainerId()
    {
        $html = inputUrl()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = inputUrl()->name('name')->containerId($customContainerId)->toHtml();
        $this->assertStringContainsString('<div id="' . $customContainerId . '"', $html);
    }

    public function testSetNoComponentId()
    {
        $html = inputUrl()->name('name')->toHtml();
        $this->assertStringContainsString(' for="url-name"', $html);
        $this->assertStringContainsString('<input id="url-name"', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = inputUrl()->name('name')->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString(' for="' . $customComponentId . '"', $html);
        $this->assertStringContainsString('<input id="' . $customComponentId . '"', $html);
    }

    public function testConfigContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        config()->set('bootstrap-components.form.url.classes.container', [$configContainerClasses]);
        $html = inputUrl()->name('name')->toHtml();
        $this->assertStringContainsString('class="component-container ' . $configContainerClasses . '"', $html);
    }

    public function testSetContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        $customContainerClasses = 'test-custom-class-container';
        config()->set('bootstrap-components.form.url.classes.container', [$configContainerClasses]);
        $html = inputUrl()->name('name')->containerClasses([$customContainerClasses])->toHtml();
        $this->assertStringContainsString(
            'class="component-container ' . $customContainerClasses . '"',
            $html
        );
        $this->assertStringNotContainsString(
            'class="component-container ' . $configContainerClasses . '"',
            $html
        );
    }

    public function testConfigComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        config()->set('bootstrap-components.form.url.classes.component', [$configComponentClasses]);
        $html = inputUrl()->name('name')->toHtml();
        $this->assertStringContainsString(
            'class="component form-control ' . $configComponentClasses . '"',
            $html
        );
    }

    public function testSetComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        $customComponentClasses = 'test-custom-class-component';
        config()->set('bootstrap-components.form.url.classes.component', [$customComponentClasses]);
        $html = inputUrl()->name('name')->componentClasses([$customComponentClasses])->toHtml();
        $this->assertStringContainsString(
            'class="component form-control ' . $customComponentClasses . '"',
            $html
        );
        $this->assertStringNotContainsString(
            'class="component form-control ' . $configComponentClasses . '"',
            $html
        );
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.url.htmlAttributes.container', [$configContainerAttributes]);
        $html = inputUrl()->name('name')->toHtml();
        $this->assertStringContainsString($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.url.htmlAttributes.container', [$configContainerAttributes]);
        $html = inputUrl()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertStringContainsString($customContainerAttributes, $html);
        $this->assertStringNotContainsString($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.url.htmlAttributes.component', [$configComponentAttributes]);
        $html = inputUrl()->name('name')->toHtml();
        $this->assertStringContainsString($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.url.htmlAttributes.component', [$configComponentAttributes]);
        $html = inputUrl()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertStringContainsString($customComponentAttributes, $html);
        $this->assertStringNotContainsString($configComponentAttributes, $html);
    }
}
