<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Okipa\LaravelBootstrapComponents\Form\Input;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\UsersFaker;

class SelectTest extends BootstrapComponentsTestCase
{
    use UsersFaker;

    public function testConfigStructure()
    {
        // components.form
        $this->assertTrue(array_key_exists('select', config('bootstrap-components.form')));
        // components.form.select
        $this->assertTrue(array_key_exists('view', config('bootstrap-components.form.select')));
        $this->assertTrue(array_key_exists('legend', config('bootstrap-components.form.select')));
        $this->assertTrue(array_key_exists('class', config('bootstrap-components.form.select')));
        $this->assertTrue(array_key_exists('html_attributes', config('bootstrap-components.form.select')));
        // components.form.select.class
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.select.class')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.select.class')));
        // components.form.select.html_attributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.select.html_attributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.select.html_attributes')));
    }

    public function testExtendsInput()
    {
        $this->assertEquals(Input::class, get_parent_class(select()));
    }

    public function testName()
    {
        $html = select()->name('name')->toHtml();
        $this->assertContains('name="name"', $html);
    }

    public function testType()
    {
        $html = select()->name('name')->toHtml();
        $this->assertContains('<select', $html);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Name must be declared for the Okipa\LaravelBootstrapComponents\Form\Select component
     *                           generation.
     */
    public function testInputWithoutName()
    {
        select()->toHtml();
    }

    public function testSetNoOptions()
    {
        $html = select()->name('name')->toHtml();
        $this->assertContains('<option value="">validation.attributes.name</option>', $html);
    }

    public function testSetOptionsFromArray()
    {
        $optionsList = [
            ['id' => 1, 'name' => $this->faker->word],
            ['id' => 2, 'name' => $this->faker->word],
        ];
        $html = select()->name('name')->options($optionsList, 'id', 'name')->toHtml();
        $this->assertContains('<option value="">validation.attributes.name</option>', $html);
        $this->assertContains(
            '<option value="' . $optionsList[0]['id'] . '" >' . $optionsList[0]['name'] . '</option>',
            $html
        );
        $this->assertContains(
            '<option value="' . $optionsList[1]['id'] . '" >' . $optionsList[1]['name'] . '</option>',
            $html
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Okipa\LaravelBootstrapComponents\Form\Select : Invalid options() second
     *                           $optionValueField argument. « wrong »  does not exist the given first $optionsList
     *                           argument.
     */
    public function testSetOptionsFromArrayWithWrongOptionValueField()
    {
        $optionsList = [
            ['id' => 1, 'name' => $this->faker->word],
            ['id' => 2, 'name' => $this->faker->word],
        ];
        select()->name('name')->options($optionsList, 'wrong', 'name')->toHtml();
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Okipa\LaravelBootstrapComponents\Form\Select : Invalid options() third
     *                           $optionLabelField argument. « wrong »  does not exist the given first $optionsList
     *                           argument.
     */
    public function testSetOptionsFromArrayWithWrongOptionLabelField()
    {
        $optionsList = [
            ['id' => 1, 'name' => $this->faker->word],
            ['id' => 2, 'name' => $this->faker->word],
        ];
        select()->name('name')->options($optionsList, 'id', 'wrong')->toHtml();
    }

    public function testSetOptionsFromModelsCollection()
    {
        $users = $this->createMultipleUsers(2);
        $html = select()->name('name')->options($users, 'id', 'name')->toHtml();
        $users = $users->toArray();
        $this->assertContains('<option value="">validation.attributes.name</option>', $html);
        $this->assertContains('<option value="' . $users[0]['id'] . '" >' . $users[0]['name'] . '</option>', $html);
        $this->assertContains('<option value="' . $users[1]['id'] . '" >' . $users[1]['name'] . '</option>', $html);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Okipa\LaravelBootstrapComponents\Form\Select : Invalid options() second
     *                           $optionValueField argument. « wrong »  does not exist the given first $optionsList
     *                           argument.
     */
    public function testSetOptionsFromModelsCollectionWithWrongOptionValueField()
    {
        $users = $this->createMultipleUsers(2);
        select()->name('name')->options($users, 'wrong', 'name')->toHtml();
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Okipa\LaravelBootstrapComponents\Form\Select : Invalid options() third
     *                           $optionLabelField argument. « wrong »  does not exist the given first $optionsList
     *                           argument.
     */
    public function testSetOptionsFromModelsCollectionWithWrongOptionLabelField()
    {
        $users = $this->createMultipleUsers(2);
        select()->name('name')->options($users, 'id', 'wrong')->toHtml();
    }

    public function testSelectedFromModelValue()
    {
        $users = $this->createMultipleUsers(2);
        $user = $users->first();
        $html = select()->model($user)->name('name')->options($users, 'id', 'name')->toHtml();
        $users = $users->toArray();
        $this->assertContains('<option value="">validation.attributes.name</option>', $html);
        $this->assertContains(
            '<option value="' . $users[0]['id'] . '" selected="selected">' . $users[0]['name'] . '</option>',
            $html);
        $this->assertContains('<option value="' . $users[1]['id'] . '" >' . $users[1]['name'] . '</option>', $html);
    }

    public function testSetSelectedOptionWithoutDeclaredOptions()
    {
        $html = select()->name('name')->selected('id', 1)->toHtml();
        $this->assertContains('<select', $html);
    }

    public function testSetSelectedOptionFromValue()
    {
        $users = $this->createMultipleUsers(2);
        $user = null;
        $html = select()
            ->model($user)
            ->name('name')
            ->options($users, 'id', 'name')
            ->selected('id', $users->get(1)->id)
            ->toHtml();
        $this->assertContains('<option value="">validation.attributes.name</option>', $html);
        $this->assertContains(
            '<option value="' . $users[0]['id'] . '" >' . $users[0]['name'] . '</option>',
            $html
        );
        $this->assertContains(
            '<option value="' . $users[1]['id'] . '" selected="selected">' . $users[1]['name'] . '</option>',
            $html
        );
    }

    public function testSetSelectedOptionFromLabel()
    {
        $users = $this->createMultipleUsers(2);
        $user = null;
        $html = select()
            ->model($user)
            ->name('name')
            ->options($users, 'id', 'name')
            ->selected('name', $users->get(1)->name)
            ->toHtml();
        $this->assertContains('<option value="">validation.attributes.name</option>', $html);
        $this->assertContains(
            '<option value="' . $users[0]['id'] . '" >' . $users[0]['name'] . '</option>',
            $html
        );
        $this->assertContains(
            '<option value="' . $users[1]['id'] . '" selected="selected">' . $users[1]['name'] . '</option>',
            $html
        );
    }

    public function testNotSelected()
    {
        $users = $this->createMultipleUsers(2);
        $html = select()
            ->name('name')
            ->options($users, 'id', 'name')
            ->toHtml();
        $this->assertContains('<option value="">validation.attributes.name</option>', $html);
        $this->assertContains(
            '<option value="' . $users[0]['id'] . '" >' . $users[0]['name'] . '</option>',
            $html
        );
        $this->assertContains(
            '<option value="' . $users[1]['id'] . '" >' . $users[1]['name'] . '</option>',
            $html
        );
    }

    public function testConfigIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.form.select.icon', $configIcon);
        $html = select()->name('name')->toHtml();
        $this->assertContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testSetIcon()
    {
        $configIcon = 'test-config-icon';
        $customIcon = 'test-custom-icon';
        config()->set('bootstrap-components.form.select.icon', $configIcon);
        $html = select()->name('name')->icon($customIcon)->toHtml();
        $this->assertContains('<span class="icon input-group-text">' . $customIcon . '</span>', $html);
        $this->assertNotContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testNoIcon()
    {
        config()->set('bootstrap-components.form.select.icon', null);
        $html = select()->name('name')->toHtml();
        $this->assertNotContains('<span class="icon input-group-text">', $html);
    }

    public function testHideIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.form.select.icon', $configIcon);
        $html = select()->name('name')->hideIcon()->toHtml();
        $this->assertNotContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.select.legend', $configLegend);
        $html = select()->name('name')->toHtml();
        $this->assertContains(
            '<small id="select-name-legend" class="form-text text-muted">' . $configLegend . '</small>',
            $html
        );
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.form.select.legend', $configLegend);
        $html = select()->name('name')->legend($customLegend)->toHtml();
        $this->assertContains(
            '<small id="select-name-legend" class="form-text text-muted">' . $customLegend . '</small>',
            $html
        );
        $this->assertNotContains(
            '<small id="select-name-legend" class="form-text text-muted">' . $configLegend . '</small>',
            $html
        );
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.form.select.legend', null);
        $html = select()->name('name')->toHtml();
        $this->assertNotContains('id="select-name-legend"', $html);
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.select.legend', $configLegend);
        $html = select()->name('name')->hideLegend()->toHtml();
        $this->assertNotContains(
            '<small id="select-name-legend" class="form-text text-muted">' . $configLegend . '</small>',
            $html
        );
    }
    
    //    public function testSetLabel()
    //    {
    //        $label = 'test-custom-label';
    //        $html = select()->name('name')->label($label)->toHtml();
    //        $this->assertContains('for="select-name">' . $label . '</label>', $html);
    //    }
    //
    //    public function testNoLabel()
    //    {
    //        $html = select()->name('name')->toHtml();
    //        $this->assertContains(
    //            'for="select-name">validation.attributes.name</label>',
    //            $html
    //        );
    //    }
    //
    //    public function testHideLabel()
    //    {
    //        $html = select()->name('name')->hideLabel()->toHtml();
    //        $this->assertNotContains(
    //            'for="select-name">validation.attributes.name</label>',
    //            $html
    //        );
    //    }
    //
    //    public function testSuccess()
    //    {
    //        $messageBag = app(MessageBag::class)->add('other_name', null);
    //        $html = select()->name('name')->render(['errors' => $messageBag]);
    //        $this->assertContains('<div class="valid-feedback">', $html);
    //        $this->assertContains(trans('bootstrap-components::bootstrap-components.notification.validation.success'),
    //            $html);
    //    }
    //
    //    public function testNoSuccess()
    //    {
    //        $html = select()->name('name')->toHtml();
    //        $this->assertNotContains('<div class="valid-feedback">', $html);
    //    }
    //
    //    public function testError()
    //    {
    //        $errorMessage = 'This a test error message';
    //        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
    //        $html = select()->name('name')->render(['errors' => $messageBag]);
    //        $this->assertContains('<div class="invalid-feedback">', $html);
    //        $this->assertContains($errorMessage, $html);
    //    }
    //
    //    public function testNoError()
    //    {
    //        $html = select()->name('name')->toHtml();
    //        $this->assertNotContains('<div class="invalid-feedback">', $html);
    //    }
    //
    //    public function testConfigContainerClass()
    //    {
    //        $configContainerCLass = 'test-config-class-container';
    //        config()->set('bootstrap-components.form.select.class.container', [$configContainerCLass]);
    //        $html = select()->name('name')->toHtml();
    //        $this->assertContains('class="select-name-container custom-control custom-select ' . $configContainerCLass . '"',
    //            $html);
    //    }
    //
    //    public function testSetContainerClass()
    //    {
    //        $configContainerCLass = 'test-config-class-container';
    //        $customContainerCLass = 'test-custom-class-container';
    //        config()->set('bootstrap-components.form.select.class.container', [$configContainerCLass]);
    //        $html = select()->name('name')->containerClass([$customContainerCLass])->toHtml();
    //        $this->assertContains('class="select-name-container custom-control custom-select ' . $customContainerCLass . '"',
    //            $html);
    //        $this->assertNotContains('class="select-name-container custom-control custom-select ' . $configContainerCLass
    //                                 . '"', $html);
    //    }
    //
    //    public function testConfigComponentClass()
    //    {
    //        $configComponentCLass = 'test-config-class-component';
    //        config()->set('bootstrap-components.form.select.class.component', [$configComponentCLass]);
    //        $html = select()->name('name')->toHtml();
    //        $this->assertContains('class="select-name-component custom-control-input ' . $configComponentCLass . '"', $html);
    //    }
    //
    //    public function testSetComponentClass()
    //    {
    //        $configComponentCLass = 'test-config-class-component';
    //        $customComponentCLass = 'test-custom-class-component';
    //        config()->set('bootstrap-components.form.select.class.component', [$customComponentCLass]);
    //        $html = select()->name('name')->componentClass([$customComponentCLass])->toHtml();
    //        $this->assertContains('class="select-name-component custom-control-input ' . $customComponentCLass . '"', $html);
    //        $this->assertNotContains('class="form-control select-name-component ' . $configComponentCLass . '"', $html);
    //    }
    //
    //    public function testConfigContainerHtmlAttributes()
    //    {
    //        $configContainerAttributes = 'test-config-attributes-container';
    //        config()->set('bootstrap-components.form.select.html_attributes.container', [$configContainerAttributes]);
    //        $html = select()->name('name')->toHtml();
    //        $this->assertContains($configContainerAttributes, $html);
    //    }
    //
    //    public function testSetContainerHtmlAttributes()
    //    {
    //        $configContainerAttributes = 'test-config-attributes-container';
    //        $customContainerAttributes = 'test-custom-attributes-container';
    //        config()->set('bootstrap-components.form.select.html_attributes.container', [$configContainerAttributes]);
    //        $html = select()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
    //        $this->assertContains($customContainerAttributes, $html);
    //        $this->assertNotContains($configContainerAttributes, $html);
    //    }
    //
    //    public function testConfigComponentHtmlAttributes()
    //    {
    //        $configComponentAttributes = 'test-config-attributes-component';
    //        config()->set('bootstrap-components.form.select.html_attributes.component', [$configComponentAttributes]);
    //        $html = select()->name('name')->toHtml();
    //        $this->assertContains($configComponentAttributes, $html);
    //    }
    //
    //    public function testSetComponentHtmlAttributes()
    //    {
    //        $configComponentAttributes = 'test-config-attributes-component';
    //        $customComponentAttributes = 'test-custom-attributes-component';
    //        config()->set('bootstrap-components.form.select.html_attributes.component', [$configComponentAttributes]);
    //        $html = select()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
    //        $this->assertContains($customComponentAttributes, $html);
    //        $this->assertNotContains($configComponentAttributes, $html);
    //    }
}
