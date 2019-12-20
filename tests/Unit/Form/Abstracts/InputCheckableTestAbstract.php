<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts;

use Okipa\LaravelBootstrapComponents\Form\Abstracts\CheckableAbstract;

abstract class InputCheckableTestAbstract extends InputTestAbstract
{
    public function testInstance()
    {
        $this->assertInstanceOf(CheckableAbstract::class, $this->getComponent());
    }

    public function testType()
    {
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringContainsString(' type="checkbox"', $html);
    }

    public function testModelValue()
    {
        $user = $this->createUniqueUser();
        $html = $this->getComponent()->model($user)->name('active')->toHtml();
        $this->assertStringContainsString(' checked="checked"', $html);
    }

    public function testSetCustomPrepend()
    {
        config()->set(
            'bootstrap-components.form.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringContainsString('<span class="label-prepend">default-prepend</span>', $html);
    }

    public function testSetPrependOverridesDefault()
    {
        config()->set(
            'bootstrap-components.form.components.' . $this->getComponentKey(),
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
            'bootstrap-components.form.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringContainsString('<span class="label-append">default-append</span>', $html);
    }

    public function testSetAppendOverridesDefault()
    {
        config()->set(
            'bootstrap-components.form.components.' . $this->getComponentKey(),
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
        $user = null;
        $html = $this->getComponent()->model($user)->name('active')->checked()->toHtml();
        $this->assertStringContainsString('checked="checked"', $html);
    }

    public function testSetCheckedOverridesModelValue()
    {
        $user = $this->createUniqueUser();
        $html = $this->getComponent()->model($user)->name('active')->checked(false)->toHtml();
        $this->assertStringNotContainsString('checked="checked"', $html);
    }

    public function testDefaultCheckStatus()
    {
        $html = $this->getComponent()->name('active')->toHtml();
        $this->assertStringNotContainsString('checked="checked', $html);
    }

    public function testSetValue()
    {
        $html = $this->getComponent()->name('active')->value(true)->toHtml();
        $this->assertStringContainsString('checked="checked', $html);
    }

    public function testSetValueNotChecked()
    {
        $html = $this->getComponent()->name('active')->value(false)->toHtml();
        $this->assertStringNotContainsString('checked="checked', $html);
    }

    public function testSetValueOverridesModelValue()
    {
        $user = $this->createUniqueUser();
        $html = $this->getComponent()->model($user)->name('active')->value(false)->toHtml();
        $this->assertStringContainsString('checked="checked', $html);
    }

    public function testOldValue()
    {
        $oldValue = true;
        $customValue = false;
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValue) {
                $request = request()->merge(['active' => $oldValue]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('active')->value($customValue)->toHtml();
        $this->assertStringContainsString('checked="checked', $html);
    }

    public function testOldValueNotChecked()
    {
        $oldValue = false;
        $customValue = true;
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValue) {
                $request = request()->merge(['active' => $oldValue]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('active')->value($customValue)->toHtml();
        $this->assertStringNotContainsString('checked="checked', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = $this->getComponent()->name('active')->label($label)->toHtml();
        $this->assertStringContainsString(
            ' for="' . $this->getComponentType() . '-active">' . $label . '</label>',
            $html
        );
    }

    public function testSetTranslatedLabel()
    {
        $label = 'bootstrap-components::bootstrap-components.label.validate';
        $html = $this->getComponent()->name('active')->label($label)->toHtml();
        $this->assertStringContainsString(
            ' for="' . $this->getComponentType() . '-active">' . __($label) . '</label>',
            $html
        );
    }

    public function testNoLabel()
    {
        $html = $this->getComponent()->name('active')->toHtml();
        $this->assertStringContainsString(' for="' . $this->getComponentType() . '-active">'
            . 'validation.attributes.active</label>', $html);
    }

    public function testHideLabel()
    {
        $html = $this->getComponent()->name('active')->label(false)->toHtml();
        $this->assertStringNotContainsString(' for="' . $this->getComponentType() . '-active">'
            . 'validation.attributes.active</label>', $html);
    }

    public function testSetCustomLabelPositionedAbove()
    {
        //
    }

    public function testSetLabelPositionedAboveOverridesDefault()
    {
        //
    }

    public function testSetPlaceholder()
    {
        //
    }

    public function testSetTranslatedPlaceholder()
    {
        //
    }

    public function testSetPlaceholderWithLabel()
    {
        //
    }

    public function testNoPlaceholder()
    {
        //
    }

    public function testNoPlaceholderWithNoLabel()
    {
        //
    }

    public function testHidePlaceholder()
    {
        //
    }

    public function testSetCustomContainerClasses()
    {
        config()->set(
            'bootstrap-components.form.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringContainsString(
            'class="component-container form-group custom-control custom-' . $this->getComponentType()
            . ' default container classes"',
            $html
        );
    }

    public function testSetContainerClassesOverridesDefault()
    {
        config()->set(
            'bootstrap-components.form.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->containerClasses(['custom', 'container', 'classes'])->toHtml();
        $this->assertStringContainsString(
            'class="component-container form-group custom-control custom-' . $this->getComponentType()
            . ' custom container classes"',
            $html
        );
        $this->assertStringNotContainsString(
            'class="component-container form-group custom-control custom-' . $this->getComponentType()
            . ' default container classes"',
            $html
        );
    }

    public function testSetCustomComponentClasses()
    {
        config()->set(
            'bootstrap-components.form.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringContainsString('class="component custom-control-input default component classes"', $html);
    }

    public function testSetComponentClassesOverridesDefault()
    {
        config()->set(
            'bootstrap-components.form.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->componentClasses(['custom', 'component', 'classes'])->toHtml();
        $this->assertStringContainsString('class="component custom-control-input custom component classes"', $html);
        $this->assertStringNotContainsString('class="component custom-control-input default component classes"', $html);
    }
}
