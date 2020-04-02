<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts;

use Exception;
use Illuminate\Support\MessageBag;
use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\FormAbstract;
use Okipa\LaravelBootstrapComponents\Tests\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Tests\Fakers\UsersFaker;

abstract class InputTestAbstract extends BootstrapComponentsTestCase
{
    use UsersFaker;

    public function testHelper()
    {
        $this->assertInstanceOf(get_class($this->getComponent()), $this->getHelper());
    }

    abstract protected function getComponent(): ComponentAbstract;

    abstract protected function getHelper(): ComponentAbstract;

    public function testFacade()
    {
        $this->assertInstanceOf(get_class($this->getComponent()), $this->getFacade());
    }

    abstract protected function getFacade(): ComponentAbstract;

    public function testInstance()
    {
        $this->assertInstanceOf(FormAbstract::class, $this->getComponent());
    }

    public function testSetName()
    {
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringContainsString(' name="name"', $html);
    }

    public function testType()
    {
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringContainsString(' type="' . $this->getComponentType() . '"', $html);
    }

    abstract protected function getComponentType(): string;

    public function testInputWithoutName()
    {
        $this->expectException(Exception::class);
        $this->getComponent()->toHtml();
    }

    public function testModelValue()
    {
        $user = $this->createUniqueUser();
        $html = $this->getComponent()->model($user)->name('name')->toHtml();
        $this->assertStringContainsString(' value="' . $user->name . '"', $html);
    }

    public function testSetCustomPrepend()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringContainsString('<span class="input-group-text">default-prepend</span>', $html);
    }

    protected function getComponentKey(): string
    {
        return $this->getComponentType();
    }

    abstract protected function getCustomComponent(): ComponentAbstract;

    public function testSetPrependOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->prepend('custom-prepend')->toHtml();
        $this->assertStringContainsString('<span class="input-group-text">custom-prepend</span>', $html);
        $this->assertStringNotContainsString('<span class="input-group-text">default-prepend</span>', $html);
    }

    public function testHidePrepend()
    {
        $html = $this->getComponent()->name('name')->prepend(null)->toHtml();
        $this->assertStringNotContainsString('<div class="input-group-prepend">', $html);
    }

    public function testSetCustomAppend()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringContainsString('<span class="input-group-text">default-append</span>', $html);
    }

    public function testSetAppendOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->append('custom-append')->toHtml();
        $this->assertStringContainsString('<span class="input-group-text">custom-append</span>', $html);
        $this->assertStringNotContainsString('<span class="input-group-text">default-append</span>', $html);
    }

    public function testHideAppend()
    {
        $html = $this->getComponent()->name('name')->append(null)->toHtml();
        $this->assertStringNotContainsString('<div class="input-group-append">', $html);
    }

    public function testHidePrependHideAppend()
    {
        $html = $this->getComponent()->name('name')->prepend(null)->append(null)->toHtml();
        $this->assertStringNotContainsString('<div class="input-group">', $html);
    }

    public function testSetCustomCaption()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringContainsString('class="caption form-text text-muted">default-caption', $html);
    }

    public function testSetCaptionOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->caption('custom-caption')->toHtml();
        $this->assertStringContainsString('class="caption form-text text-muted">custom-caption', $html);
        $this->assertStringNotContainsString('class="caption form-text text-muted">default-caption', $html);
    }

    public function testHideCaption()
    {
        $html = $this->getComponent()->name('name')->caption(null)->toHtml();
        $this->assertStringNotContainsString('class="caption form-text text-muted"', $html);
    }

    public function testSetValue()
    {
        $html = $this->getComponent()->name('name')->value('custom-value')->toHtml();
        $this->assertStringContainsString(' value="custom-value"', $html);
    }

    public function testSetZeroValue()
    {
        $html = $this->getComponent()->name('name')->value(0)->toHtml();
        $this->assertStringContainsString(' value="0"', $html);
    }

    public function testSetEmptyStringValue()
    {
        $html = $this->getComponent()->name('name')->value('')->toHtml();
        $this->assertStringContainsString(' value=""', $html);
    }

    public function testSetNullValue()
    {
        $html = $this->getComponent()->name('name')->value(null)->toHtml();
        $this->assertStringContainsString(' value=""', $html);
    }

    public function testSetValueFromClosure()
    {
        $html = $this->getComponent()->name('name')->value(function ($locale) {
            return 'closure-value-' . $locale;
        })->toHtml();
        $this->assertStringContainsString(' value="closure-value-' . app()->getLocale() . '"', $html);
    }

    public function testOldValue()
    {
        $oldValue = 'old-value';
        $value = 'custom-value';
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValue) {
                $request = request()->merge(['name' => $oldValue]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name')->value($value)->toHtml();
        $this->assertStringContainsString(' value="' . $oldValue . '"', $html);
        $this->assertStringNotContainsString(' value="' . $value . '"', $html);
    }

    public function testSetLabel()
    {
        $label = 'custom-label';
        $html = $this->getComponent()->name('name')->label($label)->toHtml();
        $this->assertStringContainsString(
            '<label for="' . $this->getComponentType() . '-name">' . $label . '</label>',
            $html
        );
    }

    public function testNoLabel()
    {
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringContainsString(
            '<label for="' . $this->getComponentType() . '-name">validation.attributes.name</label>',
            $html
        );
    }

    public function testHideLabel()
    {
        $html = $this->getComponent()->name('name')->label(false)->toHtml();
        $this->assertStringNotContainsString(
            '<label for="' . $this->getComponentType() . '-name">validation.attributes.name</label>',
            $html
        );
    }

    public function testSetCustomLabelPositionedAbove()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        $this->assertLessThan($labelPosition, $inputPosition);
    }

    public function testSetLabelPositionedAboveOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->labelPositionedAbove()->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        $this->assertLessThan($inputPosition, $labelPosition);
    }

    public function testSetPlaceholder()
    {
        $placeholder = 'custom-placeholder';
        $html = $this->getComponent()->name('name')->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString(' placeholder="' . $placeholder . '"', $html);
    }

    public function testSetPlaceholderWithLabel()
    {
        $label = 'custom-label';
        $placeholder = 'custom-placeholder';
        $html = $this->getComponent()->name('name')->label($label)->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString(' placeholder="' . $placeholder . '"', $html);
        $this->assertStringNotContainsString(' placeholder="' . $label . '"', $html);
    }

    public function testNoPlaceholder()
    {
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringContainsString(' placeholder="validation.attributes.name"', $html);
    }

    public function testNoPlaceholderWithNoLabel()
    {
        $html = $this->getComponent()->name('name')->label(false)->toHtml();
        $this->assertStringContainsString(' placeholder="validation.attributes.name"', $html);
    }

    public function testHidePlaceholder()
    {
        $html = $this->getComponent()->name('name')->placeholder(false)->toHtml();
        $this->assertStringNotContainsString(' placeholder="', $html);
    }

    public function testSetCustomDisplaySuccess()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $errors = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = $this->getComponent()->name('name')->render(compact('errors'));
        $this->assertStringContainsString('is-valid', $html);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(__('Field correctly filled.'), $html);
    }

    public function testSetDisplaySuccessOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $errors = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = $this->getComponent()->name('name')->displaySuccess(false)->render(compact('errors'));
        $this->assertStringNotContainsString('is-valid', $html);
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringNotContainsString(__('Field correctly filled.'), $html);
    }

    public function testSetCustomDisplayFailure()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $errors = app(MessageBag::class)->add('name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = $this->getComponent()->name('name')->render(compact('errors'));
        $this->assertStringContainsString('is-invalid', $html);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errors->first('name'), $html);
    }

    public function testSetDisplayFailureOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $errors = app(MessageBag::class)->add('name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = $this->getComponent()->name('name')->displayFailure(false)->render(compact('errors'));
        $this->assertStringNotContainsString('is-invalid', $html);
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringNotContainsString($errors->first('name'), $html);
    }

    public function testDisplayFailureWithArrayName()
    {
        $errors = app(MessageBag::class)->add('name.0', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = $this->getComponent()->name('name[0]')->render(compact('errors'));
        $this->assertStringContainsString('is-invalid', $html);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errors->first('name'), $html);
    }

    public function testSetNoContainerId()
    {
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'custom-container-id';
        $html = $this->getComponent()->name('name')->containerId($customContainerId)->toHtml();
        $this->assertStringContainsString('<div id="' . $customContainerId . '"', $html);
    }

    public function testDefaultComponentId()
    {
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringContainsString(' for="' . $this->getComponentType() . '-name"', $html);
        $this->assertStringContainsString('<input id="' . $this->getComponentType() . '-name"', $html);
    }

    public function testDefaultComponentIdWithArrayName()
    {
        $html = $this->getComponent()->name('name[0]')->toHtml();
        $this->assertStringContainsString(' for="' . $this->getComponentType() . '-name-0"', $html);
        $this->assertStringContainsString('<input id="' . $this->getComponentType() . '-name-0"', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'custom-component-id';
        $html = $this->getComponent()->name('name')->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString(' for="' . $customComponentId . '"', $html);
        $this->assertStringContainsString('<input id="' . $customComponentId . '"', $html);
    }

    public function testSetCustomContainerClasses()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringContainsString('class="component-container default container classes"', $html);
    }

    public function testSetContainerClassesOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->containerClasses(['custom', 'container', 'classes'])->toHtml();
        $this->assertStringContainsString('class="component-container custom container classes"', $html);
        $this->assertStringNotContainsString('class="component-container form-group default container classes"', $html);
    }

    public function testSetCustomComponentClasses()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringContainsString('class="component form-control default component classes"', $html);
    }

    public function testSetComponentClassesOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->componentClasses(['custom', 'component', 'classes'])->toHtml();
        $this->assertStringContainsString('class="component form-control custom component classes"', $html);
        $this->assertStringNotContainsString('class="component form-control default component classes"', $html);
    }

    public function testSetCustomContainerHtmlAttributes()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringContainsString(
            'default="container" html="attributes">',
            $html
        );
    }

    public function testSetContainerHtmlAttributesOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()
            ->name('name')
            ->containerHtmlAttributes(['custom' => 'container', 'html' => 'attributes'])
            ->toHtml();
        $this->assertStringContainsString('custom="container" html="attributes">', $html);
        $this->assertStringNotContainsString('default="container" html="attributes">', $html);
    }

    public function testSetCustomComponentHtmlAttributes()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->value(null)->toHtml();
        $this->assertStringContainsString('default="component" html="attributes">', $html);
    }

    public function testSetComponentHtmlAttributesOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')
            ->value(null)
            ->componentHtmlAttributes(['custom' => 'component', 'html' => 'attributes'])
            ->toHtml();
        $this->assertStringContainsString('custom="component" html="attributes">', $html);
        $this->assertStringNotContainsString('default="component" html="attributes">', $html);
    }
}
