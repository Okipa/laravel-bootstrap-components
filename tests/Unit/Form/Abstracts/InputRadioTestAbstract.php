<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts;

use Exception;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\RadioAbstract;

abstract class InputRadioTestAbstract extends InputTestAbstract
{
    public function testInstance()
    {
        $this->assertInstanceOf(RadioAbstract::class, $this->getComponent());
    }

    public function testInputWithoutValue()
    {
        $this->expectException(Exception::class);
        $this->getComponent()->name('name')->value(null)->toHtml();
    }

    public function testModelValue()
    {
        $user = $this->createUniqueUser();
        $html = $this->getComponent()->name('name')->model($user)->value($user->name)->toHtml();
        $this->assertStringContainsString('checked="checked"', $html);
    }

    public function testSetCustomPrepend()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringContainsString('<span class="label-prepend">default-prepend</span>', $html);
    }

    public function testSetPrependOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->prepend('custom-prepend')->toHtml();
        $this->assertStringContainsString('<span class="label-prepend">custom-prepend</span>', $html);
        $this->assertStringNotContainsString('<span class="label-prepend">default-prepend</span>', $html);
    }

    public function testHidePrepend()
    {
        $html = $this->getComponent()->name('name')->prepend(null)->toHtml();
        $this->assertStringNotContainsString('<div class="label-prepend">', $html);
    }

    public function testSetCustomAppend()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringContainsString('<span class="label-append">default-append</span>', $html);
    }

    public function testSetAppendOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->append('custom-append')->toHtml();
        $this->assertStringContainsString('<span class="label-append">custom-append</span>', $html);
        $this->assertStringNotContainsString('<span class="label-append">default-append</span>', $html);
    }

    public function testHideAppend()
    {
        $html = $this->getComponent()->name('name')->append(null)->toHtml();
        $this->assertStringNotContainsString('<div class="label-append">', $html);
    }

    public function testHidePrependHideAppend()
    {
        $html = $this->getComponent()->name('name')->prepend(null)->append(null)->toHtml();
        $this->assertStringNotContainsString('<div class="label-prepend">', $html);
        $this->assertStringNotContainsString('<div class="label-append">', $html);
    }

    public function testSetChecked()
    {
        $html = $this->getComponent()->name('name')->checked()->toHtml();
        $this->assertStringContainsString('checked="checked"', $html);
    }

    public function testNotChecked()
    {
        $html = $this->getComponent()->name('name')->checked(false)->toHtml();
        $this->assertStringNotContainsString('checked="checked"', $html);
    }

    public function testModelValueChecked()
    {
        $user = $this->createUniqueUser();
        $html = $this->getComponent()->name('name')->model($user)->value($user->name)->toHtml();
        $this->assertStringContainsString('checked="checked"', $html);
    }

    public function testOldValueChecked()
    {
        $oldValue = 'old-value';
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValue) {
                $request = request()->merge(['name' => $oldValue]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name')->value($oldValue)->checked(false)->toHtml();
        $this->assertStringContainsString('checked="checked', $html);
    }

    public function testOldValueNotChecked()
    {
        $oldValue = 'old-value';
        $customValue = 'custom-value';
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValue) {
                $request = request()->merge(['name' => $oldValue]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name')->value($customValue)->checked()->toHtml();
        $this->assertStringNotContainsString('checked="checked', $html);
    }

    public function testSetLabel()
    {
        $label = 'custom-label';
        $html = $this->getComponent()->name('name')->label($label)->toHtml();
        $this->assertStringContainsString(
            '<label class="custom-control-label" for="' . $this->getComponentType() . '-name-value">' . $label
            . '</label>',
            $html
        );
    }

    public function testSetTranslatedLabel()
    {
        $label = 'bootstrap-components::bootstrap-components.label.validate';
        $html = $this->getComponent()->name('name')->label($label)->toHtml();
        $this->assertStringContainsString(
            '<label class="custom-control-label" for="' . $this->getComponentType() . '-name-value">'
            . __($label) . '</label>',
            $html
        );
    }

    public function testNoLabel()
    {
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringContainsString(
            '<label class="custom-control-label" for="' . $this->getComponentType()
            . '-name-value">validation.attributes.name</label>',
            $html
        );
    }

    public function testHideLabel()
    {
        $html = $this->getComponent()->name('name')->label(false)->toHtml();
        $this->assertStringNotContainsString(
            '<label class="custom-control-label" for="' . $this->getComponentType()
            . '-name-value">validation.attributes.name</label>',
            $html
        );
    }

    public function testSetCustomLabelPositionedAbove()
    {
        // irrelevant
    }

    public function testSetLabelPositionedAboveOverridesDefault()
    {
        // irrelevant
    }

    public function testSetPlaceholder()
    {
        // irrelevant
    }

    public function testSetTranslatedPlaceholder()
    {
        // irrelevant
    }

    public function testSetPlaceholderWithLabel()
    {
        // irrelevant
    }

    public function testNoPlaceholder()
    {
        // irrelevant
    }

    public function testNoPlaceholderWithNoLabel()
    {
        // irrelevant
    }

    public function testHidePlaceholder()
    {
        // irrelevant
    }

    public function testSetNoComponentId()
    {
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringContainsString('<input id="' . $this->getComponentType() . '-name-value"', $html);
        $this->assertStringContainsString(' for="' . $this->getComponentType() . '-name-value"', $html);
    }

    public function testSetCustomContainerClasses()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringContainsString(
            'class="component-container form-group custom-control custom-checkbox default container classes"',
            $html
        );
    }

    public function testSetContainerClassesOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->containerClasses(['custom', 'container', 'classes'])->toHtml();
        $this->assertStringContainsString(
            'class="component-container form-group custom-control custom-checkbox custom container classes"',
            $html
        );
        $this->assertStringNotContainsString(
            'class="component-container form-group custom-control custom-checkbox default container classes"',
            $html
        );
    }

    public function testSetCustomComponentClasses()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringContainsString('class="component custom-control-input default component classes"', $html);
    }

    public function testSetComponentClassesOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->componentClasses(['custom', 'component', 'classes'])->toHtml();
        $this->assertStringContainsString('class="component custom-control-input custom component classes"', $html);
        $this->assertStringNotContainsString('class="component custom-control-input default component classes"', $html);
    }
}
