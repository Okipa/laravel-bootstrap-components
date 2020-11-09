<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts;

use RuntimeException;
use Illuminate\Support\MessageBag;
use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\FormAbstract;
use Okipa\LaravelBootstrapComponents\Tests\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Tests\Fakers\UsersFaker;

abstract class InputTestAbstract extends BootstrapComponentsTestCase
{
    use UsersFaker;

    public function testHelper(): void
    {
        self::assertInstanceOf(get_class($this->getComponent()), $this->getHelper());
    }

    abstract protected function getComponent(): ComponentAbstract;

    abstract protected function getHelper(): ComponentAbstract;

    public function testFacade(): void
    {
        self::assertInstanceOf(get_class($this->getComponent()), $this->getFacade());
    }

    abstract protected function getFacade(): ComponentAbstract;

    public function testInstance(): void
    {
        self::assertInstanceOf(FormAbstract::class, $this->getComponent());
    }

    public function testSetName(): void
    {
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString(' name="name"', $html);
    }

    public function testSetCamelCaseName(): void
    {
        $html = $this->getComponent()->name('camelCaseName')->toHtml();
        self::assertStringContainsString(' name="camelCaseName"', $html);
    }

    public function testType(): void
    {
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString(' type="' . $this->getComponentType() . '"', $html);
    }

    abstract protected function getComponentType(): string;

    public function testInputWithoutName(): void
    {
        $this->expectException(RuntimeException::class);
        $this->getComponent()->toHtml();
    }

    public function testModelValue(): void
    {
        $user = $this->createUniqueUser();
        $html = $this->getComponent()->model($user)->name('name')->toHtml();
        self::assertStringContainsString(' value="' . $user->name . '"', $html);
    }

    public function testSetCustomPrepend(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString('<span class="input-group-text">default-prepend</span>', $html);
    }

    protected function getComponentKey(): string
    {
        return $this->getComponentType();
    }

    abstract protected function getCustomComponent(): ComponentAbstract;

    public function testSetPrependOverridesDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->prepend('custom-prepend')->toHtml();
        self::assertStringContainsString('<span class="input-group-text">custom-prepend</span>', $html);
        self::assertStringNotContainsString('<span class="input-group-text">default-prepend</span>', $html);
    }

    public function testSetPrependFromClosureWithDisabledMultilingual(): void
    {
        $html = $this->getComponent()->name('name')->prepend(function ($locale) {
            return 'prepend-' . $locale;
        })->toHtml();
        self::assertStringContainsString('<span class="input-group-text">prepend-en</span>', $html);
    }

    public function testHidePrepend(): void
    {
        $html = $this->getComponent()->name('name')->prepend(null)->toHtml();
        self::assertStringNotContainsString('<div class="input-group-prepend">', $html);
    }

    public function testHidePrependFallbackWithFalse(): void
    {
        $html = $this->getComponent()->name('name')->prepend(false)->toHtml();
        self::assertStringNotContainsString('<div class="input-group-prepend">', $html);
    }

    public function testSetCustomAppend(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString('<span class="input-group-text">default-append</span>', $html);
    }

    public function testSetAppendOverridesDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->append('custom-append')->toHtml();
        self::assertStringContainsString('<span class="input-group-text">custom-append</span>', $html);
        self::assertStringNotContainsString('<span class="input-group-text">default-append</span>', $html);
    }

    public function testSetAppendFromClosureWithDisabledMultilingual(): void
    {
        $html = $this->getComponent()->name('name')->append(function ($locale) {
            return 'append-' . $locale;
        })->toHtml();
        self::assertStringContainsString('<span class="input-group-text">append-en</span>', $html);
    }

    public function testHideAppend(): void
    {
        $html = $this->getComponent()->name('name')->append(null)->toHtml();
        self::assertStringNotContainsString('<div class="input-group-append">', $html);
    }

    public function testHideAppendFallbackWithFalse(): void
    {
        $html = $this->getComponent()->name('name')->append(false)->toHtml();
        self::assertStringNotContainsString('<div class="input-group-append">', $html);
    }

    public function testHidePrependHideAppend(): void
    {
        $html = $this->getComponent()->name('name')->prepend(null)->append(null)->toHtml();
        self::assertStringNotContainsString('<div class="input-group">', $html);
    }

    public function testSetCustomCaption(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString('class="caption form-text text-muted">default-caption', $html);
    }

    public function testSetCaptionOverridesDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->caption('custom-caption')->toHtml();
        self::assertStringContainsString('class="caption form-text text-muted">custom-caption', $html);
        self::assertStringNotContainsString('class="caption form-text text-muted">default-caption', $html);
    }

    public function testHideCaption(): void
    {
        $html = $this->getComponent()->name('name')->caption(null)->toHtml();
        self::assertStringNotContainsString('class="caption form-text text-muted"', $html);
    }

    public function testSetValue(): void
    {
        $html = $this->getComponent()->name('name')->value('custom-value')->toHtml();
        self::assertStringContainsString(' value="custom-value"', $html);
    }

    public function testSetZeroValue(): void
    {
        $html = $this->getComponent()->name('name')->value(0)->toHtml();
        self::assertStringContainsString(' value="0"', $html);
    }

    public function testSetEmptyStringValue(): void
    {
        $html = $this->getComponent()->name('name')->value('')->toHtml();
        self::assertStringContainsString(' value=""', $html);
    }

    public function testSetNullValue(): void
    {
        $html = $this->getComponent()->name('name')->value(null)->toHtml();
        self::assertStringContainsString(' value=""', $html);
    }

    public function testSetValueFromClosureWithDisabledMultilingual(): void
    {
        $html = $this->getComponent()->name('name')->value(function ($locale) {
            return 'closure-value-' . $locale;
        })->toHtml();
        self::assertStringContainsString(' value="closure-value-' . app()->getLocale() . '"', $html);
    }

    public function testOldValue(): void
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
        self::assertStringContainsString(' value="' . $oldValue . '"', $html);
        self::assertStringNotContainsString(' value="' . $value . '"', $html);
    }

    public function testOldArrayValue(): void
    {
        $oldValue = 'old-value';
        $value = 'custom-value';
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValue) {
                $request = request()->merge(['name' => [0 => $oldValue]]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name[0]')->value($value)->toHtml();
        self::assertStringContainsString(' value="' . $oldValue . '"', $html);
        self::assertStringNotContainsString(' value="' . $value . '"', $html);
    }

    public function testSetLabel(): void
    {
        $label = 'custom-label';
        $html = $this->getComponent()->name('name')->label($label)->toHtml();
        self::assertStringContainsString(
            '<label for="' . $this->getComponentType() . '-name">' . $label . '</label>',
            $html
        );
    }

    public function testNoLabel(): void
    {
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString(
            '<label for="' . $this->getComponentType() . '-name">validation.attributes.name</label>',
            $html
        );
    }

    public function testHideLabel(): void
    {
        $html = $this->getComponent()->name('name')->label(null)->toHtml();
        self::assertStringNotContainsString(
            '<label for="' . $this->getComponentType() . '-name">validation.attributes.name</label>',
            $html
        );
    }

    public function testHideLabelFallbackWithFalse(): void
    {
        $html = $this->getComponent()->name('name')->label(false)->toHtml();
        self::assertStringNotContainsString(
            '<label for="' . $this->getComponentType() . '-name">validation.attributes.name</label>',
            $html
        );
    }

    public function testSetCustomLabelPositionedAbove(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        self::assertLessThan($labelPosition, $inputPosition);
    }

    public function testSetLabelPositionedAboveOverridesDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->labelPositionedAbove()->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        self::assertLessThan($inputPosition, $labelPosition);
    }

    public function testDefaultPlaceholder(): void
    {
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString(' placeholder="validation.attributes.name"', $html);
    }

    public function testDefaultPlaceholderWithArrayName(): void
    {
        $html = $this->getComponent()->name('name[0]')->toHtml();
        self::assertStringContainsString(' placeholder="validation.attributes.name"', $html);
    }

    public function testSetPlaceholder(): void
    {
        $placeholder = 'custom-placeholder';
        $html = $this->getComponent()->name('name')->placeholder($placeholder)->toHtml();
        self::assertStringContainsString(' placeholder="' . $placeholder . '"', $html);
    }

    public function testSetPlaceholderWithLabel(): void
    {
        $label = 'custom-label';
        $placeholder = 'custom-placeholder';
        $html = $this->getComponent()->name('name')->label($label)->placeholder($placeholder)->toHtml();
        self::assertStringContainsString(' placeholder="' . $placeholder . '"', $html);
        self::assertStringNotContainsString(' placeholder="' . $label . '"', $html);
    }

    public function testNoPlaceholderWithLabel(): void
    {
        $label = 'custom-label';
        $html = $this->getComponent()->name('name')->label($label)->toHtml();
        self::assertStringContainsString(' placeholder="' . $label . '"', $html);
        self::assertStringNotContainsString(' placeholder="validation.attributes.name"', $html);
    }

    public function testNoPlaceholderWithNoLabel(): void
    {
        $html = $this->getComponent()->name('name')->label(null)->toHtml();
        self::assertStringContainsString(' placeholder="validation.attributes.name"', $html);
    }

    public function testHidePlaceholder(): void
    {
        $html = $this->getComponent()->name('name')->placeholder(false)->toHtml();
        self::assertStringNotContainsString(' placeholder="', $html);
    }

    public function testSetCustomDisplaySuccess(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $errors = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = $this->getComponent()->name('name')->render(compact('errors'));
        self::assertStringContainsString('is-valid', $html);
        self::assertStringContainsString('<div class="valid-feedback d-block">', $html);
        self::assertStringContainsString(__('Field correctly filled.'), $html);
    }

    public function testSetDisplaySuccessOverridesDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $errors = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = $this->getComponent()->name('name')->displaySuccess(false)->render(compact('errors'));
        self::assertStringNotContainsString('is-valid', $html);
        self::assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
        self::assertStringNotContainsString(__('Field correctly filled.'), $html);
    }

    public function testSetCustomDisplayFailure(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $errors = app(MessageBag::class)->add('name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = $this->getComponent()->name('name')->render(compact('errors'));
        self::assertStringContainsString('is-invalid', $html);
        self::assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        self::assertStringContainsString($errors->first('name'), $html);
    }

    public function testSetDisplayFailureOverridesDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $errors = app(MessageBag::class)->add('name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = $this->getComponent()->name('name')->displayFailure(false)->render(compact('errors'));
        self::assertStringNotContainsString('is-invalid', $html);
        self::assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
        self::assertStringNotContainsString($errors->first('name'), $html);
    }

    public function testDisplayFailureWithArrayName(): void
    {
        $errors = app(MessageBag::class)->add('name.0', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = $this->getComponent()->name('name[0]')->render(compact('errors'));
        self::assertStringContainsString('is-invalid', $html);
        self::assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        self::assertStringContainsString($errors->first('name'), $html);
    }

    public function testSetNoContainerId(): void
    {
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId(): void
    {
        $customContainerId = 'custom-container-id';
        $html = $this->getComponent()->name('name')->containerId($customContainerId)->toHtml();
        self::assertStringContainsString('<div id="' . $customContainerId . '"', $html);
    }

    public function testDefaultComponentId(): void
    {
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString(' for="' . $this->getComponentType() . '-name"', $html);
        self::assertStringContainsString('<input id="' . $this->getComponentType() . '-name"', $html);
    }

    public function testDefaultComponentIdWithArrayName(): void
    {
        $html = $this->getComponent()->name('name[0]')->toHtml();
        self::assertStringContainsString(' for="' . $this->getComponentType() . '-name-0"', $html);
        self::assertStringContainsString('<input id="' . $this->getComponentType() . '-name-0"', $html);
    }

    public function testDefaultComponentIdFormatting(): void
    {
        $html = $this->getComponent()->name('camelCaseName')->toHtml();
        self::assertStringContainsString(' for="' . $this->getComponentType() . '-camel-case-name"', $html);
        self::assertStringContainsString('<input id="' . $this->getComponentType() . '-camel-case-name"', $html);
    }

    public function testSetComponentId(): void
    {
        $customComponentId = 'custom-component-id';
        $html = $this->getComponent()->name('name')->componentId($customComponentId)->toHtml();
        self::assertStringContainsString(' for="' . $customComponentId . '"', $html);
        self::assertStringContainsString('<input id="' . $customComponentId . '"', $html);
    }

    public function testSetCustomContainerClasses(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString('class="component-container default container classes"', $html);
    }

    public function testSetContainerClassesOverridesDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->containerClasses(['custom', 'container', 'classes'])->toHtml();
        self::assertStringContainsString('class="component-container custom container classes"', $html);
        self::assertStringNotContainsString('class="component-container form-group default container classes"', $html);
    }

    public function testSetCustomComponentClasses(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString('class="component form-control default component classes"', $html);
    }

    public function testSetComponentClassesOverridesDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->componentClasses(['custom', 'component', 'classes'])->toHtml();
        self::assertStringContainsString('class="component form-control custom component classes"', $html);
        self::assertStringNotContainsString('class="component form-control default component classes"', $html);
    }

    public function testSetCustomContainerHtmlAttributes(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString(
            'default="container" html="attributes">',
            $html
        );
    }

    public function testSetContainerHtmlAttributesOverridesDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()
            ->name('name')
            ->containerHtmlAttributes(['custom' => 'container', 'html' => 'attributes'])
            ->toHtml();
        self::assertStringContainsString('custom="container" html="attributes">', $html);
        self::assertStringNotContainsString('default="container" html="attributes">', $html);
    }

    public function testSetCustomComponentHtmlAttributes(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->value(null)->toHtml();
        self::assertStringContainsString('default="component" html="attributes">', $html);
    }

    public function testSetComponentHtmlAttributesOverridesDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')
            ->value(null)
            ->componentHtmlAttributes(['custom' => 'component', 'html' => 'attributes'])
            ->toHtml();
        self::assertStringContainsString('custom="component" html="attributes">', $html);
        self::assertStringNotContainsString('default="component" html="attributes">', $html);
    }
}
