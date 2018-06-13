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
        $this->assertTrue(array_key_exists('icon', config('bootstrap-components.form.file')));
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
        $this->assertEquals(Input::class, get_parent_class(fileUpload()));
    }

    public function testSetName()
    {
        $html = fileUpload()->name('name')->toHtml();
        $this->assertContains('name="name"', $html);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Name must be declared for the Okipa\LaravelBootstrapComponents\Form\File component
     *                           generation.
     */
    public function testInputWithoutName()
    {
        fileUpload()->toHtml();
    }

    public function testModelValue()
    {
        $user = $this->createUniqueUser();
        $html = fileUpload()->model($user)->name('name')->toHtml();
        $this->assertContains('<label class="custom-file-label" for="file-name">' . $user->name . '</label>', $html);
    }

    public function testConfigIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.form.file.icon', $configIcon);
        $html = fileUpload()->name('name')->toHtml();
        $this->assertContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }
    
    public function testSetIcon()
    {
        $configIcon = 'test-config-icon';
        $customIcon = 'test-custom-icon';
        config()->set('bootstrap-components.form.file.icon', $configIcon);
        $html = fileUpload()->name('name')->icon($customIcon)->toHtml();
        $this->assertContains('<span class="icon input-group-text">' . $customIcon . '</span>', $html);
        $this->assertNotContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testNoIcon()
    {
        config()->set('bootstrap-components.form.file.icon', null);
        $html = fileUpload()->name('name')->toHtml();
        $this->assertNotContains('<span class="icon input-group-text">', $html);
    }

    public function testHideIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.form.file.icon', $configIcon);
        $html = fileUpload()->name('name')->hideIcon()->toHtml();
        $this->assertNotContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.file.legend', $configLegend);
        $html = fileUpload()->name('name')->toHtml();
        $this->assertContains(
            '<small id="file-name-legend" class="form-text text-muted">' . $configLegend . '</small>',
            $html
        );
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.form.file.legend', $configLegend);
        $html = fileUpload()->name('name')->legend($customLegend)->toHtml();
        $this->assertContains(
            '<small id="file-name-legend" class="form-text text-muted">' . $customLegend . '</small>',
            $html
        );
        $this->assertNotContains(
            '<small id="file-name-legend" class="form-text text-muted">' . $configLegend . '</small>',
            $html
        );
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.form.file.legend', null);
        $html = fileUpload()->name('name')->toHtml();
        $this->assertNotContains('id="file-name-legend"', $html);
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.file.legend', $configLegend);
        $html = fileUpload()->name('name')->hideLegend()->toHtml();
        $this->assertNotContains(
            '<small id="file-name-legend" class="form-text text-muted">' . $configLegend . '</small>',
            $html
        );
    }

    public function testSetPlaceholder()
    {
        $placeholder = 'test-custom-placeholder';
        $html = fileUpload()->name('name')->placeholder($placeholder)->toHtml();
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

    public function testNoPlaceholder()
    {
        $html = fileUpload()->name('name')->toHtml();
        $this->assertContains(
            '<label class="custom-file-label" for="file-name">validation.attributes.name : '
            . trans('bootstrap-components::bootstrap-components.label.file') . '</label>',
            $html
        );
    }

    public function testSetValue()
    {
        $customValue = 'test-custom-value';
        $html = fileUpload()->name('name')->value($customValue)->toHtml();
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
            'middleware' => 'web', 'uses' => function() use ($oldValue) {
                $request = request()->merge(['name' => $oldValue]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = fileUpload()->name('name')->value($customValue)->toHtml();
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
        $html = fileUpload()->name('name')->label($label)->toHtml();
        $this->assertContains('<label for="file-name">' . $label . '</label>', $html);
        $this->assertContains('aria-label="' . $label . '"', $html);
    }

    public function testNoLabel()
    {
        $html = fileUpload()->name('name')->toHtml();
        $this->assertContains(
            '<label for="file-name">validation.attributes.name</label>',
            $html
        );
        $this->assertContains(
            'aria-label="validation.attributes.name"',
            $html
        );
    }

    public function testHideLabel()
    {
        $html = fileUpload()->name('name')->hideLabel()->toHtml();
        $this->assertNotContains(
            '<label for="file-name">validation.attributes.name</label>',
            $html
        );
        $this->assertNotContains(
            'aria-label="validation.attributes.name"',
            $html
        );
    }

    public function testSuccess()
    {
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = fileUpload()->name('name')->render(['errors' => $messageBag]);
        $this->assertContains('<div class="valid-feedback">', $html);
        $this->assertContains(trans('bootstrap-components::bootstrap-components.notification.validation.success'), $html);
    }

    public function testNoSuccess()
    {
        $html = fileUpload()->name('name')->toHtml();
        $this->assertNotContains('<div class="valid-feedback">', $html);
    }

    public function testError()
    {
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = fileUpload()->name('name')->render(['errors' => $messageBag]);
        $this->assertContains('<div class="invalid-feedback">', $html);
        $this->assertContains($errorMessage, $html);
    }

    public function testNoError()
    {
        $html = fileUpload()->name('name')->toHtml();
        $this->assertNotContains('<div class="invalid-feedback">', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.form.file.class.container', [$configContainerCLass]);
        $html = fileUpload()->name('name')->toHtml();
        $this->assertContains('class="file-name-container ' . $configContainerCLass . '"', $html);
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.form.file.class.container', [$configContainerCLass]);
        $html = fileUpload()->name('name')->containerClass([$customContainerCLass])->toHtml();
        $this->assertContains('class="file-name-container ' . $customContainerCLass . '"', $html);
        $this->assertNotContains('class="file-name-container ' . $configContainerCLass . '"', $html);
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.form.file.class.component', [$configComponentCLass]);
        $html = fileUpload()->name('name')->toHtml();
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
        $html = fileUpload()->name('name')->componentClass([$customComponentCLass])->toHtml();
        $this->assertContains(
            'class="custom-file-input form-control file-name-component ' . $customComponentCLass . '"',
            $html
        );$this->assertNotContains(
        'class="custom-file-input form-control file-name-component ' . $configComponentCLass . '"',
        $html
    );
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.file.html_attributes.container', [$configContainerAttributes]);
        $html = fileUpload()->name('name')->toHtml();
        $this->assertContains($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.file.html_attributes.container', [$configContainerAttributes]);
        $html = fileUpload()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertContains($customContainerAttributes, $html);
        $this->assertNotContains($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.file.html_attributes.component', [$configComponentAttributes]);
        $html = fileUpload()->name('name')->toHtml();
        $this->assertContains($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.file.html_attributes.component', [$configComponentAttributes]);
        $html = fileUpload()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertContains($customComponentAttributes, $html);
        $this->assertNotContains($configComponentAttributes, $html);
    }
    
    public function testUploadedfileUpload()
    {
        $html = fileUpload()->name('name')->uploadedFile(function(){
            return 'Uploaded file !';
        })->toHtml();
        $this->assertContains('Uploaded file !', $html);
    }
}
