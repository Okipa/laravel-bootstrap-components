<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts;

use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\CheckableAbstract;

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

    public function testSetZeroValue()
    {
        $html = $this->getComponent()->name('name')->value(0)->toHtml();
        $this->assertStringNotContainsString('checked="checked', $html);
    }

    public function testSetEmptyStringValue()
    {
        $html = $this->getComponent()->name('name')->value('')->toHtml();
        $this->assertStringNotContainsString('checked="checked', $html);
    }

    public function testSetNullValue()
    {
        $html = $this->getComponent()->name('name')->value(null)->toHtml();
        $this->assertStringNotContainsString('checked="checked', $html);
    }

    public function testSetValueFromClosure()
    {
        $html = $this->getComponent()->name('name')->value(function () {
            return true;
        })->toHtml();
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
        $value = false;
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValue) {
                $request = request()->merge(['active' => (string) $oldValue]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('active')->value($value)->toHtml();
        $this->assertStringContainsString('checked="checked', $html);
    }

    public function testOldArrayValue()
    {
        $oldValue = true;
        $value = false;
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValue) {
                $request = request()->merge(['active' => [0 => (string) $oldValue]]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('active[0]')->value($value)->toHtml();
        $this->assertStringContainsString('checked="checked', $html);
    }

    public function testOldValueNotChecked()
    {
        $oldValue = false;
        $value = true;
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValue) {
                $request = request()->merge(['active' => (string) $oldValue]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('active')->value($value)->toHtml();
        $this->assertStringNotContainsString('checked="checked', $html);
    }

    public function testSetLabel()
    {
        $html = $this->getComponent()->name('active')->label('custom-label')->toHtml();
        $this->assertStringContainsString(
            ' for="' . $this->getComponentType() . '-active">custom-label</label>',
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
        $this->markTestSkipped();
    }

    public function testSetLabelPositionedAboveOverridesDefault()
    {
        $this->markTestSkipped();
    }

    public function testDefaultPlaceholder()
    {
        $this->markTestSkipped();
    }

    public function testDefaultPlaceholderWithArrayName()
    {
        $this->markTestSkipped();
    }

    public function testSetPlaceholder()
    {
        $this->markTestSkipped();
    }

    public function testSetTranslatedPlaceholder()
    {
        $this->markTestSkipped();
    }

    public function testSetPlaceholderWithLabel()
    {
        $this->markTestSkipped();
    }

    public function testNoPlaceholderWithLabel()
    {
        $this->markTestSkipped();
    }

    public function testNoPlaceholderWithNoLabel()
    {
        $this->markTestSkipped();
    }

    public function testHidePlaceholder()
    {
        $this->markTestSkipped();
    }

    public function testSetCustomContainerClasses()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringContainsString(
            'class="component-container custom-control custom-' . $this->getComponentType()
            . ' default container classes"',
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
            'class="component-container custom-control custom-' . $this->getComponentType()
            . ' custom container classes"',
            $html
        );
        $this->assertStringNotContainsString(
            'class="component-container custom-control custom-' . $this->getComponentType()
            . ' default container classes"',
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
