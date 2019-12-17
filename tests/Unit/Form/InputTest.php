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

    public function testSetCustomPrepend()
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

    public function testSetCustomAppend()
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
            protected function setAppend(): ?string
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

    public function testSetCustomLegend()
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
            'middleware' => 'web', 'uses' => function() use ($oldValue) {
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

    public function testSetCustomLabelPositionedAbove()
    {
        $customUrlComponent = new Class extends \Okipa\LaravelBootstrapComponents\Form\Components\Url {
            protected function setLabelPositionedAbove(): bool
            {
                return false;
            }
        };
        config()->set('bootstrap-components.form.components.url', get_class($customUrlComponent));
        $html = inputUrl()->name('name')->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        $this->assertLessThan($labelPosition, $inputPosition);
    }

    public function testSetLabelPositionedAboveOverridesDefault()
    {
        $customUrlComponent = new Class extends \Okipa\LaravelBootstrapComponents\Form\Components\Url {
            protected function setLabelPositionedAbove(): bool
            {
                return false;
            }
        };
        config()->set('bootstrap-components.form.components.url', get_class($customUrlComponent));
        $html = inputUrl()->name('name')->labelPositionedAbove()->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<input');
        $this->assertLessThan($inputPosition, $labelPosition);
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

    public function testSetCustomDisplaySuccess()
    {
        $customUrlComponent = new Class extends \Okipa\LaravelBootstrapComponents\Form\Components\Url {
            protected function setDisplaySuccess(): bool
            {
                return true;
            }
        };
        config()->set('bootstrap-components.form.components.url', get_class($customUrlComponent));
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

    public function testSetDisplaySuccessOverridesDefault()
    {
        $customUrlComponent = new Class extends \Okipa\LaravelBootstrapComponents\Form\Components\Url {
            protected function setDisplaySuccess(): bool
            {
                return true;
            }
        };
        config()->set('bootstrap-components.form.components.url', get_class($customUrlComponent));
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

    public function testSetCustomDisplayFailure()
    {
        $customUrlComponent = new Class extends \Okipa\LaravelBootstrapComponents\Form\Components\Url {
            protected function setDisplayFailure(): bool
            {
                return true;
            }
        };
        config()->set('bootstrap-components.form.components.url', get_class($customUrlComponent));
        $errors = app(MessageBag::class)->add('name', 'Dummy error message.');
        session()->put('errors', $errors);
        $html = inputUrl()->name('name')->render(compact('errors'));
        $this->assertStringContainsString('is-invalid', $html);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errors->first('name'), $html);
    }

    public function testSetDisplayFailureOverridesDefault()
    {
        $customUrlComponent = new Class extends \Okipa\LaravelBootstrapComponents\Form\Components\Url {
            protected function setDisplayFailure(): bool
            {
                return true;
            }
        };
        config()->set('bootstrap-components.form.components.url', get_class($customUrlComponent));
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

    public function testSetCustomContainerClasses()
    {
        $customUrlComponent = new Class extends \Okipa\LaravelBootstrapComponents\Form\Components\Url {
            protected function setContainerClasses(): array
            {
                return ['default', 'container', 'classes'];
            }
        };
        config()->set('bootstrap-components.form.components.url', get_class($customUrlComponent));
        $html = inputUrl()->name('name')->toHtml();
        $this->assertStringContainsString('class="component-container default container classes"', $html);
    }

    public function testSetContainerClassesOverridesDefault()
    {
        $customUrlComponent = new Class extends \Okipa\LaravelBootstrapComponents\Form\Components\Url {
            protected function setContainerClasses(): array
            {
                return ['default', 'container', 'classes'];
            }
        };
        config()->set('bootstrap-components.form.components.url', get_class($customUrlComponent));
        $html = inputUrl()->name('name')->containerClasses(['custom', 'container', 'classes'])->toHtml();
        $this->assertStringContainsString('class="component-container custom container classes"', $html);
        $this->assertStringNotContainsString('class="component-container default container classes"', $html);
    }

    public function testSetCustomComponentClasses()
    {
        $customUrlComponent = new Class extends \Okipa\LaravelBootstrapComponents\Form\Components\Url {
            protected function setComponentClasses(): array
            {
                return ['default', 'component', 'classes'];
            }
        };
        config()->set('bootstrap-components.form.components.url', get_class($customUrlComponent));
        $html = inputUrl()->name('name')->toHtml();
        $this->assertStringContainsString('class="component form-control default component classes"', $html);
    }

    public function testSetComponentClassesOverridesDefault()
    {
        $customUrlComponent = new Class extends \Okipa\LaravelBootstrapComponents\Form\Components\Url {
            protected function setComponentClasses(): array
            {
                return ['default', 'component', 'classes'];
            }
        };
        config()->set('bootstrap-components.form.components.url', get_class($customUrlComponent));
        $html = inputUrl()->name('name')->componentClasses(['custom', 'component', 'classes'])->toHtml();
        $this->assertStringContainsString('class="component form-control custom component classes"', $html);
        $this->assertStringNotContainsString('class="component form-control default component classes"', $html);
    }

    public function testSetCustomContainerHtmlAttributes()
    {
        $customUrlComponent = new Class extends \Okipa\LaravelBootstrapComponents\Form\Components\Url {
            protected function setContainerHtmlAttributes(): array
            {
                return ['default' => 'container', 'html' => 'attributes'];
            }
        };
        config()->set('bootstrap-components.form.components.url', get_class($customUrlComponent));
        $html = inputUrl()->name('name')->toHtml();
        $this->assertStringContainsString(
            '<div class="component-container" default="container" html="attributes">',
            $html
        );
    }

    public function testSetContainerHtmlAttributesOverridesDefault()
    {
        $customUrlComponent = new Class extends \Okipa\LaravelBootstrapComponents\Form\Components\Url {
            protected function setContainerHtmlAttributes(): array
            {
                return ['default' => 'container', 'html' => 'attributes'];
            }
        };
        config()->set('bootstrap-components.form.components.url', get_class($customUrlComponent));
        $html = inputUrl()->name('name')
            ->containerHtmlAttributes(['custom' => 'container', 'html' => 'attributes'])
            ->toHtml();
        $this->assertStringContainsString('custom="container" html="attributes">', $html);
        $this->assertStringNotContainsString('default="container" html="attributes">', $html);
    }

    public function testSetCustomComponentHtmlAttributes()
    {
        $customUrlComponent = new Class extends \Okipa\LaravelBootstrapComponents\Form\Components\Url {
            protected function setComponentHtmlAttributes(): array
            {
                return ['default' => 'component', 'html' => 'attributes'];
            }
        };
        config()->set('bootstrap-components.form.components.url', get_class($customUrlComponent));
        $html = inputUrl()->name('name')->toHtml();
        $this->assertStringContainsString('default="component" html="attributes">', $html);
    }

    public function testSetComponentHtmlAttributesOverridesDefault()
    {
        $customUrlComponent = new Class extends \Okipa\LaravelBootstrapComponents\Form\Components\Url {
            protected function setComponentHtmlAttributes(): array
            {
                return ['default' => 'component', 'html' => 'attributes'];
            }
        };
        config()->set('bootstrap-components.form.components.url', get_class($customUrlComponent));
        $html = inputUrl()->name('name')
            ->componentHtmlAttributes(['custom' => 'component', 'html' => 'attributes'])
            ->toHtml();
        $this->assertStringContainsString('custom="component" html="attributes">', $html);
        $this->assertStringNotContainsString('default="component" html="attributes">', $html);
    }
}
