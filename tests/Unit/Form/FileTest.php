<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Illuminate\Support\MessageBag;
use Okipa\LaravelBootstrapComponents\Form\Input;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\UsersFaker;

class FileTest extends BootstrapComponentsTestCase
{
    use UsersFaker;

    public function testConfigStructure()
    {
        // components.form
        $this->assertTrue(array_key_exists('file', config('bootstrap-components.form')));
        // components.form.input
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.form.file')));
        $this->assertTrue(array_key_exists('prepend', config('bootstrap-components.form.file')));
        $this->assertTrue(array_key_exists('append', config('bootstrap-components.form.file')));
        $this->assertTrue(array_key_exists('show_remove_checkbox', config('bootstrap-components.form.file')));
        $this->assertTrue(array_key_exists('legend', config('bootstrap-components.form.file')));
        $this->assertTrue(array_key_exists('class', config('bootstrap-components.form.file')));
        $this->assertTrue(array_key_exists('html_attributes', config('bootstrap-components.form.file')));
        // components.form.file.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.file.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.file.class')));
        // components.form.file.html_attributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.file.html_attributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.file.html_attributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Input::class, get_parent_class(bsFile()));
    }

    public function testSetName()
    {
        $html = bsFile()->name('name')->toHtml();
        $this->assertContains('name="name"', $html);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Okipa\LaravelBootstrapComponents\Form\File : Missing $name property. Please use the
     *                           name() method to set a name.
     */
    public function testInputWithoutName()
    {
        bsFile()->toHtml();
    }

    public function testModelValue()
    {
        $user = $this->createUniqueUser();
        $html = bsFile()->model($user)->name('name')->toHtml();
        $this->assertContains('<label class="custom-file-label" for="file-name">' . $user->name . '</label>', $html);
    }

    public function testConfigPrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.form.file.prepend', $configPrepend);
        $html = bsFile()->name('name')->toHtml();
        $this->assertContains('input-group-prepend', $html);
        $this->assertContains('<span class="input-group-text">' . $configPrepend . '</span>', $html);
    }

    public function testSetPrepend()
    {
        $configPrepend = 'test-config-prepend';
        $customPrepend = 'test-custom-prepend';
        config()->set('bootstrap-components.form.file.prepend', $configPrepend);
        $html = bsFile()->name('name')->prepend($customPrepend)->toHtml();
        $this->assertContains('input-group-prepend', $html);
        $this->assertContains('<span class="input-group-text">' . $customPrepend . '</span>', $html);
        $this->assertNotContains('<span class="input-group-text">' . $configPrepend . '</span>', $html);
    }

    public function testNoPrepend()
    {
        config()->set('bootstrap-components.form.file.prepend', null);
        $html = bsFile()->name('name')->toHtml();
        $this->assertNotContains('input-group-prepend', $html);
    }

    public function testHidePrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.form.file.prepend', $configPrepend);
        $html = bsFile()->name('name')->prepend(false)->toHtml();
        $this->assertNotContains('input-group-prepend', $html);
    }

    public function testConfigAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.file.append', $configAppend);
        $html = bsFile()->name('name')->toHtml();
        $this->assertContains('input-group-append', $html);
        $this->assertContains('<span class="input-group-text">' . $configAppend . '</span>', $html);
    }

    public function testSetAppend()
    {
        $configAppend = 'test-config-append';
        $customAppend = 'test-custom-append';
        config()->set('bootstrap-components.form.file.append', $configAppend);
        $html = bsFile()->name('name')->append($customAppend)->toHtml();
        $this->assertContains('input-group-append', $html);
        $this->assertContains('<span class="input-group-text">' . $customAppend . '</span>', $html);
        $this->assertNotContains('<span class="input-group-text">' . $configAppend . '</span>', $html);
    }

    public function testNoAppend()
    {
        config()->set('bootstrap-components.form.file.append', null);
        $html = bsFile()->name('name')->toHtml();
        $this->assertNotContains('input-group-append', $html);
    }

    public function testHideAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.file.append', $configAppend);
        $html = bsFile()->name('name')->append(false)->toHtml();
        $this->assertNotContains('input-group-append', $html);
    }

    public function testNoPrependNoAppend()
    {
        config()->set('bootstrap-components.form.file.prepend', null);
        config()->set('bootstrap-components.form.file.append', null);
        $html = bsFile()->name('name')->toHtml();
        $this->assertNotContains('<div class="input-group">', $html);
    }

    public function testHidePrependHideAppend()
    {
        $configPrepend = 'test-config-prepend';
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.file.prepend', $configPrepend);
        config()->set('bootstrap-components.form.file.append', $configAppend);
        $html = bsFile()->name('name')->prepend(false)->append(false)->toHtml();
        $this->assertNotContains('<div class="input-group">', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.file.legend', $configLegend);
        $html = bsFile()->name('name')->toHtml();
        $this->assertContains(
            '<small id="file-name-legend" class="form-text text-muted">bootstrap-components::'
            . $configLegend . '</small>',
            $html
        );
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.form.file.legend', $configLegend);
        $html = bsFile()->name('name')->legend($customLegend)->toHtml();
        $this->assertContains(
            '<small id="file-name-legend" class="form-text text-muted">' . $customLegend . '</small>',
            $html
        );
        $this->assertNotContains(
            '<small id="file-name-legend" class="form-text text-muted">bootstrap-components::'
            . $configLegend . '</small>',
            $html
        );
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.form.file.legend', null);
        $html = bsFile()->name('name')->toHtml();
        $this->assertNotContains('<small id="file-name-legend" class="form-text text-muted">', $html);
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.file.legend', $configLegend);
        $html = bsFile()->name('name')->hideLegend()->toHtml();
        $this->assertNotContains('<small id="file-name-legend" class="form-text text-muted">', $html);
    }

    public function testSetValue()
    {
        $customValue = 'test-custom-value';
        $html = bsFile()->name('name')->value($customValue)->toHtml();
        $this->assertContains(
            '<label class="custom-file-label" for="file-name">' . $customValue . '</label>',
            $html
        );
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
        $html = bsFile()->name('name')->value($customValue)->toHtml();
        $this->assertContains(
            '<label class="custom-file-label" for="file-name">' . $oldValue . '</label>',
            $html
        );
        $this->assertNotContains(
            '<label class="custom-file-label" for="file-name">' . $customValue . '</label>',
            $html
        );
    }
    
    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsFile()->name('name')->label($label)->toHtml();
        $this->assertContains('<label for="file-name">' . $label . '</label>', $html);
        $this->assertContains('aria-label="' . $label . '"', $html);
    }

    public function testNoLabel()
    {
        $html = bsFile()->name('name')->toHtml();
        $this->assertContains('<label for="file-name">validation.attributes.name</label>', $html);
        $this->assertContains('aria-label="validation.attributes.name"', $html);
    }

    public function testHideLabel()
    {
        $html = bsFile()->name('name')->hideLabel()->toHtml();
        $this->assertNotContains('<label for="file-name">validation.attributes.name</label>', $html);
        $this->assertNotContains('aria-label="validation.attributes.name"', $html);
    }

    public function testNoPlaceholderWithDefaultLabel()
    {
        $html = bsFile()->name('name')->toHtml();
        $this->assertContains(
            '<label class="custom-file-label" for="file-name">'
            . trans('bootstrap-components::bootstrap-components.label.file')
            . '</label>',
            $html
        );
    }

    public function testNoPlaceholderWithNoLabel()
    {
        $html = bsFile()->name('name')->hideLabel()->toHtml();
        $this->assertContains(
            '<label class="custom-file-label" for="file-name">validation.attributes.name : '
            . trans('bootstrap-components::bootstrap-components.label.file') . '</label>',
            $html
        );
    }

    public function testSetPlaceholderWithDefaultLabel()
    {
        $placeholder = 'test-custom-placeholder';
        $label= 'test-custom-label';
        $html = bsFile()->name('name')->placeholder($placeholder)->label($label)->toHtml();
        $this->assertContains(
            '<label class="custom-file-label" for="file-name">'
            . trans('bootstrap-components::bootstrap-components.label.file') . '</label>',
            $html
        );
        $this->assertNotContains(
            '<label class="custom-file-label" for="file-name">' . $placeholder . ' : '
            . trans('bootstrap-components::bootstrap-components.label.file') . '</label>',
            $html
        );
        $this->assertNotContains(
            '<label class="custom-file-label" for="file-name">validation.attributes.name : '
            . trans('bootstrap-components::bootstrap-components.label.file') . '</label>',
            $html
        );
    }

    public function testSetPlaceholderWithNoLabel()
    {
        $placeholder = 'test-custom-placeholder';
        $html = bsFile()->name('name')->placeholder($placeholder)->hideLabel()->toHtml();
        $this->assertContains(
            '<label class="custom-file-label" for="file-name">' . $placeholder . ' : '
            . trans('bootstrap-components::bootstrap-components.label.file') . '</label>',
            $html
        );
        $this->assertNotContains(
            '<label class="custom-file-label" for="file-name">validation.attributes.name : '
            . trans('bootstrap-components::bootstrap-components.label.file') . '</label>',
            $html
        );
    }

    public function testSuccess()
    {
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsFile()->name('name')->render(['errors' => $messageBag]);
        $this->assertContains('<div class="valid-feedback d-block">', $html);
        $this->assertContains(
            trans('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testNoSuccess()
    {
        $html = bsFile()->name('name')->toHtml();
        $this->assertNotContains('<div class="valid-feedback d-block">', $html);
    }

    public function testError()
    {
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsFile()->name('name')->render(['errors' => $messageBag]);
        $this->assertContains('<div class="invalid-feedback d-block">', $html);
        $this->assertContains($errorMessage, $html);
    }

    public function testNoError()
    {
        $html = bsFile()->name('name')->toHtml();
        $this->assertNotContains('<div class="invalid-feedback d-block">', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.form.file.class.container', [$configContainerCLass]);
        $html = bsFile()->name('name')->toHtml();
        $this->assertContains('class="file-name-container ' . $configContainerCLass . '"', $html);
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.form.file.class.container', [$configContainerCLass]);
        $html = bsFile()->name('name')->containerClass([$customContainerCLass])->toHtml();
        $this->assertContains('class="file-name-container ' . $customContainerCLass . '"', $html);
        $this->assertNotContains('class="file-name-container ' . $configContainerCLass . '"', $html);
    }

    public function testSetNoContainerId()
    {
        $html = bsFile()->name('name')->toHtml();
        $this->assertNotContains('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = bsFile()->name('name')->containerId($customContainerId)->toHtml();
        $this->assertContains('<div id="' . $customContainerId, $html);
    }

    public function testSetNoComponentId()
    {
        $html = bsFile()->name('name')->toHtml();
        $this->assertContains('for="file-name"', $html);
        $this->assertContains('<input id="file-name"', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = bsFile()->name('name')->componentId($customComponentId)->toHtml();
        $this->assertContains('for="' . $customComponentId . '"', $html);
        $this->assertContains('<input id="' . $customComponentId . '"', $html);
    }
    
    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.form.file.class.component', [$configComponentCLass]);
        $html = bsFile()->name('name')->toHtml();
        $this->assertContains(
            'class="custom-file-input form-control file-name-component ' . $configComponentCLass . '"',
            $html
        );
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.form.file.class.component', [$customComponentCLass]);
        $html = bsFile()->name('name')->componentClass([$customComponentCLass])->toHtml();
        $this->assertContains(
            'class="custom-file-input form-control file-name-component ' . $customComponentCLass . '"',
            $html
        );
        $this->assertNotContains(
            'class="custom-file-input form-control file-name-component ' . $configComponentCLass . '"',
            $html
        );
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.file.html_attributes.container', [$configContainerAttributes]);
        $html = bsFile()->name('name')->toHtml();
        $this->assertContains($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.file.html_attributes.container', [$configContainerAttributes]);
        $html = bsFile()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertContains($customContainerAttributes, $html);
        $this->assertNotContains($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.file.html_attributes.component', [$configComponentAttributes]);
        $html = bsFile()->name('name')->toHtml();
        $this->assertContains($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.file.html_attributes.component', [$configComponentAttributes]);
        $html = bsFile()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertContains($customComponentAttributes, $html);
        $this->assertNotContains($configComponentAttributes, $html);
    }

    public function testUploadedfileUpload()
    {
        $html = bsFile()->name('name')->uploadedFile(function () {
            return 'Uploaded file !';
        })->toHtml();
        $this->assertContains('Uploaded file !', $html);
    }

    public function testConfigShowRemoveCheckboxWithUploadedFile()
    {
        config()->set('bootstrap-components.form.file.show_remove_checkbox', true);
        $html = bsFile()->name('name')->uploadedFile(function () {
            return 'html';
        })->toHtml();
        $this->assertContains('<input id="checkbox-remove-name"', $html);
        $this->assertContains('name="remove_name"', $html);
        $this->assertContains('for="checkbox-remove-name">'
                              . trans('bootstrap-components::bootstrap-components.label.remove')
                              . ' validation.attributes.name', $html);
    }

    public function testConfigShowRemoveCheckboxWithEmptyUploadedFile()
    {
        config()->set('bootstrap-components.form.file.show_remove_checkbox', true);
        $html = bsFile()->name('name')->uploadedFile(function () {
            return null;
        })->toHtml();
        $this->assertNotContains('<input id="checkbox-remove-name"', $html);
        $this->assertNotContains('name="remove_name"', $html);
    }

    public function testConfigShowRemoveCheckboxWithoutUploadedFile()
    {
        config()->set('bootstrap-components.form.file.show_remove_checkbox', true);
        $html = bsFile()->name('name')->toHtml();
        $this->assertNotContains('<input id="checkbox-remove-name"', $html);
        $this->assertNotContains('name="remove_name"', $html);
    }

    public function testConfigHideRemoveCheckboxWithUploadedFile()
    {
        config()->set('bootstrap-components.form.file.show_remove_checkbox', false);
        $html = bsFile()->name('name')->uploadedFile(function () {
            return 'html';
        })->toHtml();
        $this->assertNotContains('<input id="checkbox-remove-name"', $html);
        $this->assertNotContains('name="remove_name"', $html);
    }

    public function testShowRemoveCheckboxWithUploadedFile()
    {
        config()->set('bootstrap-components.form.file.show_remove_checkbox', false);
        $html = bsFile()->name('name')->uploadedFile(function () {
            return 'html';
        })->showRemoveCheckbox(true)->toHtml();
        $this->assertContains('<input id="checkbox-remove-name"', $html);
        $this->assertContains('for="checkbox-remove-name">'
                              . trans('bootstrap-components::bootstrap-components.label.remove')
                              . ' validation.attributes.name', $html);
    }

    public function testHideRemoveCheckbox()
    {
        config()->set('bootstrap-components.form.file.show_remove_checkbox', true);
        $html = bsFile()->name('name')->uploadedFile(function () {
            return 'html';
        })->showRemoveCheckbox(false)->toHtml();
        $this->assertNotContains('<input id="checkbox-remove-name"', $html);
        $this->assertNotContains('name="remove_name"', $html);
    }

    public function testShowRemoveCheckboxWithCustomRemoveLabel()
    {
        config()->set('bootstrap-components.form.file.show_remove_checkbox', false);
        $html = bsFile()->name('name')->uploadedFile(function () {
            return 'html';
        })->showRemoveCheckbox(true, 'Test')->toHtml();
        $this->assertContains('<input id="checkbox-remove-name"', $html);
        $this->assertContains('for="checkbox-remove-name">Test', $html);
    }
}
