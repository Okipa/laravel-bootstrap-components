<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Illuminate\Support\MessageBag;
use Okipa\LaravelBootstrapComponents\Form\Input;
use Okipa\LaravelBootstrapComponents\Test\BootstrapComponentsTestCase;
use Okipa\LaravelBootstrapComponents\Test\Fakers\CompaniesFaker;
use Okipa\LaravelBootstrapComponents\Test\Fakers\UsersFaker;

class SelectTest extends BootstrapComponentsTestCase
{
    use UsersFaker;
    use CompaniesFaker;

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
        $this->assertEquals(Input::class, get_parent_class(bsSelect()));
    }

    public function testName()
    {
        $html = bsSelect()->name('name')->toHtml();
        $this->assertContains('name="name"', $html);
    }

    public function testType()
    {
        $html = bsSelect()->name('name')->toHtml();
        $this->assertContains('<select', $html);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Okipa\LaravelBootstrapComponents\Form\Select : Missing $name property. Please use the
     *                           name() method to set a name.
     */
    public function testInputWithoutName()
    {
        bsSelect()->toHtml();
    }

    public function testSetNoOptions()
    {
        $html = bsSelect()->name('name')->toHtml();
        $this->assertContains('<option value="" disabled="disabled" selected="selected">validation.attributes.name</option>',
            $html);
    }

    public function testSetOptionsFromArray()
    {
        $optionsList = [
            ['id' => 1, 'name' => $this->faker->word],
            ['id' => 2, 'name' => $this->faker->word],
        ];
        $html = bsSelect()->name('name')->options($optionsList, 'id', 'name')->toHtml();
        $this->assertContains('<option value="" disabled="disabled" selected="selected">validation.attributes.name</option>',
            $html);
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
        bsSelect()->name('name')->options($optionsList, 'wrong', 'name')->toHtml();
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
        bsSelect()->name('name')->options($optionsList, 'id', 'wrong')->toHtml();
    }

    public function testSetOptionsFromModelsCollection()
    {
        $users = $this->createMultipleUsers(2);
        $html = bsSelect()->name('name')->options($users, 'id', 'name')->toHtml();
        $users = $users->toArray();
        $this->assertContains('<option value="" disabled="disabled" selected="selected">validation.attributes.name</option>',
            $html);
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
        bsSelect()->name('name')->options($users, 'wrong', 'name')->toHtml();
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
        bsSelect()->name('name')->options($users, 'id', 'wrong')->toHtml();
    }

    public function testSelectedFromModelValue()
    {
        $users = $this->createMultipleUsers(2);
        $user = $users->first();
        $html = bsSelect()->model($user)->name('name')->options($users, 'id', 'name')->toHtml();
        $users = $users->toArray();
        $this->assertContains('<option value="" disabled="disabled" >validation.attributes.name</option>', $html);
        $this->assertContains(
            '<option value="' . $users[0]['id'] . '" selected="selected">' . $users[0]['name'] . '</option>',
            $html);
        $this->assertContains('<option value="' . $users[1]['id'] . '" >' . $users[1]['name'] . '</option>', $html);
    }

    public function testSetSelectedOptionWithoutDeclaredOptions()
    {
        $html = bsSelect()->name('name')->selected('id', 1)->toHtml();
        $this->assertContains('<select', $html);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Okipa\LaravelBootstrapComponents\Form\Select : Invalid selected() second
     *                           $valueToCompare argument. This argument has to be an array when the bsSelect()
     *                           component is not in multiple mode : « array » type given.
     */
    public function testSetSelectedOptionFromWrongTypeValue()
    {
        $users = $this->createMultipleUsers(2);
        bsSelect()->name('name')
            ->options($users, 'id', 'name')
            ->selected('id', ['test'])
            ->toHtml();
    }

    public function testSetSelectedOptionFromValue()
    {
        $users = $this->createMultipleUsers(2);
        $user = null;
        $html = bsSelect()
            ->model($user)
            ->name('name')
            ->options($users, 'id', 'name')
            ->selected('id', $users->get(1)->id)
            ->toHtml();
        $this->assertContains('<option value="" disabled="disabled" >validation.attributes.name</option>', $html);
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
        $html = bsSelect()
            ->model($user)
            ->name('name')
            ->options($users, 'id', 'name')
            ->selected('name', $users->get(1)->name)
            ->toHtml();
        $this->assertContains('<option value="" disabled="disabled" >validation.attributes.name</option>', $html);
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
        $html = bsSelect()
            ->name('name')
            ->options($users, 'id', 'name')
            ->toHtml();
        $this->assertContains('<option value="" disabled="disabled" selected="selected">validation.attributes.name</option>',
            $html);
        $this->assertContains(
            '<option value="' . $users[0]['id'] . '" >' . $users[0]['name'] . '</option>',
            $html
        );
        $this->assertContains(
            '<option value="' . $users[1]['id'] . '" >' . $users[1]['name'] . '</option>',
            $html
        );
    }

    public function testOldValue()
    {
        $users = $this->createMultipleUsers(3);
        $custom = $users->get(0);
        $model = $users->get(1);
        $old = $users->get(2);
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function() use ($old) {
                $request = request()->merge(['name' => $old->id]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = bsSelect()
            ->model($model)
            ->name('name')
            ->selected('id', $custom->id)
            ->options($users, 'id', 'name')
            ->toHtml();
        $this->assertContains(
            '<option value="' . $custom->id . '" >' . $custom->name . '</option>',
            $html
        );
        $this->assertContains(
            '<option value="' . $model->id . '" >' . $model->name . '</option>',
            $html
        );
        $this->assertContains(
            '<option value="' . $old->id . '" selected="selected">' . $old->name . '</option>',
            $html
        );
    }

    public function testSetMultiple()
    {
        $companies = $this->createMultipleCompanies(5);
        $html = bsSelect()->name('companies')->options($companies, 'id', 'name')->multiple()->toHtml();
        $this->assertContains('companies[]', $html);
        $this->assertContains('multiple>', $html);
    }
    
    public function testSelectMultipleWithModelAndNonExistentAttribute()
    {
        $user = $this->createUniqueUser();
        $companies = $this->createMultipleCompanies(5);
        $user->companies = $companies->take(2)->pluck('id')->toArray();
        $html = bsSelect()->name('wrong')->model($user)->options($companies, 'id', 'name')->multiple()->toHtml();
        $this->assertContains(
            '<option value="" disabled="disabled" selected="selected">validation.attributes.wrong</option>',
            $html
        );
        foreach ($companies as $company) {
            $this->assertContains(
                '<option value="' . $company->id . '" >' . $company->name . '</option>',
                $html
            );
        }
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Okipa\LaravelBootstrapComponents\Form\Select : The « companies » attribute from the
     *                           given « Okipa\LaravelBootstrapComponents\Test\Models\User » model has to be an array
     *                           when the select is in multiple mode : « object » type given.
     */
    public function testSelectMultipleWithModelAndWrongAttributeType()
    {
        $user = $this->createUniqueUser();
        $companies = $this->createMultipleCompanies(5);
        $user->companies = $companies->take(2)->pluck('id');
        bsSelect()->name('companies')->model($user)->options($companies, 'id', 'name')->multiple()->toHtml();
    }

    public function testSelectedMultipleFromModelEmptyValue()
    {
        $user = $this->createUniqueUser();
        $companies = $this->createMultipleCompanies(5);
        $user->companies = [];
        $html = bsSelect()->model($user)->name('companies')->options($companies, 'id', 'name')->multiple()->toHtml();
        $this->assertContains('<option value="" disabled="disabled" selected="selected">validation.attributes.companies</option>',
            $html);
        foreach ($companies as $company) {
            $this->assertContains(
                '<option value="' . $company->id . '" >' . $company->name . '</option>',
                $html);
        }
    }

    public function testSelectedMultipleFromModelValue()
    {
        $user = $this->createUniqueUser();
        $companies = $this->createMultipleCompanies(5);
        $user->companies = $companies->take(2)->pluck('id')->toArray();
        $html = bsSelect()->model($user)->name('companies')->options($companies, 'id', 'name')->multiple()->toHtml();
        $this->assertContains(
            '<option value="" disabled="disabled" >validation.attributes.companies</option>',
            $html
        );
        foreach ($companies as $company) {
            $this->assertContains(
                '<option value="' . $company->id . '" ' . (in_array($company->id, $user->companies)
                    ? 'selected="selected"'
                    : '') . '>' . $company->name . '</option>',
                $html
            );
        }
    }

    public function testSetSelectedMultipleOptionsFromEmptyValue()
    {
        $companies = $this->createMultipleCompanies(5);
        $html = bsSelect()->name('companies')
            ->options($companies, 'id', 'name')
            ->multiple()
            ->selected('id', [])
            ->toHtml();
        $this->assertContains('<option value="" disabled="disabled" selected="selected">validation.attributes.companies</option>',
            $html);
        foreach ($companies as $company) {
            $this->assertContains(
                '<option value="' . $company->id . '" >' . $company->name . '</option>',
                $html);
        }
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Okipa\LaravelBootstrapComponents\Form\Select : Invalid selected() second
     *                           $valueToCompare argument. This argument has to be an array when the bsSelect()
     *                           component is in multiple mode : « string » type given.
     */
    public function testSetSelectedMultipleOptionsFromWrongTypeValue()
    {
        $companies = $this->createMultipleCompanies(5);
        bsSelect()->name('companies')
            ->options($companies, 'id', 'name')
            ->multiple()
            ->selected('id', 'test')
            ->toHtml();
    }

    public function testSetSelectedMultipleOptionsFromValue()
    {
        $user = $this->createUniqueUser();
        $companies = $this->createMultipleCompanies(5);
        $user->companies = $companies->take(2)->pluck('id')->toArray();
        $selectedCompanies = $companies->sortByDesc('id')->take(2)->pluck('id')->toArray();
        $html = bsSelect()->name('companies')
            ->model($user)
            ->options($companies, 'id', 'name')
            ->multiple()
            ->selected('id', $selectedCompanies)
            ->toHtml();
        $this->assertContains('<option value="" disabled="disabled" >validation.attributes.companies</option>', $html);
        foreach ($companies as $company) {
            $this->assertContains(
                '<option value="' . $company->id . '" ' . (in_array($company->id, $selectedCompanies)
                    ? 'selected="selected"'
                    : '') . '>' . $company->name . '</option>',
                $html
            );
        }
    }

    public function testSetSelectedMultipleOptionsFromLabel()
    {
        $user = $this->createUniqueUser();
        $companies = $this->createMultipleCompanies(5);
        $user->companies = $companies->take(2)->pluck('id')->toArray();
        $selectedCompanies = $companies->sortByDesc('id')->take(2)->pluck('name')->toArray();
        $html = bsSelect()->name('companies')
            ->model($user)
            ->options($companies, 'id', 'name')
            ->multiple()
            ->selected('name', $selectedCompanies)
            ->toHtml();
        $this->assertContains('<option value="" disabled="disabled" >validation.attributes.companies</option>', $html);
        foreach ($companies as $company) {
            $this->assertContains(
                '<option value="' . $company->id . '" ' . (in_array($company->name, $selectedCompanies)
                    ? 'selected="selected"'
                    : '') . '>' . $company->name . '</option>',
                $html
            );
        }
    }

    public function testOldMultipleValue()
    {
        $user = $this->createUniqueUser();
        $companies = $this->createMultipleCompanies(6);
        $chunk = $companies->pluck('id')->chunk(2)->toArray();
        $user->companies = $chunk[0];
        $selectedCompanies = $chunk[1];
        $oldCompanies = $chunk[2];
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function() use ($oldCompanies) {
                $request = request()->merge(['companies[]' => $oldCompanies]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = bsSelect()->name('companies')
            ->model($user)
            ->options($companies, 'id', 'name')
            ->multiple()
            ->selected('id', $selectedCompanies)
            ->toHtml();
        $this->assertContains('<option value="" disabled="disabled" >validation.attributes.companies</option>', $html);
        foreach ($companies as $company) {
            $this->assertContains(
                '<option value="' . $company->id . '" ' . (in_array($company->id, $oldCompanies)
                    ? 'selected="selected"'
                    : '') . '>' . $company->name . '</option>',
                $html
            );
        }
    }

    public function testConfigIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.form.select.icon', $configIcon);
        $html = bsSelect()->name('name')->toHtml();
        $this->assertContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testSetIcon()
    {
        $configIcon = 'test-config-icon';
        $customIcon = 'test-custom-icon';
        config()->set('bootstrap-components.form.select.icon', $configIcon);
        $html = bsSelect()->name('name')->icon($customIcon)->toHtml();
        $this->assertContains('<span class="icon input-group-text">' . $customIcon . '</span>', $html);
        $this->assertNotContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testNoIcon()
    {
        config()->set('bootstrap-components.form.select.icon', null);
        $html = bsSelect()->name('name')->toHtml();
        $this->assertNotContains('<span class="icon input-group-text">', $html);
    }

    public function testHideIcon()
    {
        $configIcon = 'test-config-icon';
        config()->set('bootstrap-components.form.select.icon', $configIcon);
        $html = bsSelect()->name('name')->hideIcon()->toHtml();
        $this->assertNotContains('<span class="icon input-group-text">' . $configIcon . '</span>', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.select.legend', $configLegend);
        $html = bsSelect()->name('name')->toHtml();
        $this->assertContains(
            '<small id="select-name-legend" class="form-text text-muted">bootstrap-components::' . $configLegend
            . '</small>',
            $html
        );
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.form.select.legend', $configLegend);
        $html = bsSelect()->name('name')->legend($customLegend)->toHtml();
        $this->assertContains(
            '<small id="select-name-legend" class="form-text text-muted">' . $customLegend . '</small>',
            $html
        );
        $this->assertNotContains(
            '<small id="select-name-legend" class="form-text text-muted">bootstrap-components::' . $configLegend
            . '</small>',
            $html
        );
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.form.select.legend', null);
        $html = bsSelect()->name('name')->toHtml();
        $this->assertNotContains('<small id="select-name-legend" class="form-text text-muted">', $html);
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.select.legend', $configLegend);
        $html = bsSelect()->name('name')->hideLegend()->toHtml();
        $this->assertNotContains('<small id="select-name-legend" class="form-text text-muted">', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsSelect()->name('name')->label($label)->toHtml();
        $this->assertContains('for="select-name">' . $label . '</label>', $html);
    }

    public function testNoLabel()
    {
        $html = bsSelect()->name('name')->toHtml();
        $this->assertContains(
            'for="select-name">validation.attributes.name</label>',
            $html
        );
    }

    public function testHideLabel()
    {
        $html = bsSelect()->name('name')->hideLabel()->toHtml();
        $this->assertNotContains(
            'for="select-name">validation.attributes.name</label>',
            $html
        );
    }

    public function testSuccess()
    {
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsSelect()->name('name')->render(['errors' => $messageBag]);
        $this->assertContains('<div class="valid-feedback d-block">', $html);
        $this->assertContains(trans('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html);
    }

    public function testNoSuccess()
    {
        $html = bsSelect()->name('name')->toHtml();
        $this->assertNotContains('<div class="valid-feedback d-block">', $html);
    }

    public function testError()
    {
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsSelect()->name('name')->render(['errors' => $messageBag]);
        $this->assertContains('<div class="invalid-feedback d-block">', $html);
        $this->assertContains($errorMessage, $html);
    }

    public function testNoError()
    {
        $html = bsSelect()->name('name')->toHtml();
        $this->assertNotContains('<div class="invalid-feedback d-block">', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.form.select.class.container', [$configContainerCLass]);
        $html = bsSelect()->name('name')->toHtml();
        $this->assertContains(
            'class="select-name-container ' . $configContainerCLass . '"',
            $html
        );
    }

    public function testSetContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        $customContainerCLass = 'test-custom-class-container';
        config()->set('bootstrap-components.form.select.class.container', [$configContainerCLass]);
        $html = bsSelect()->name('name')->containerClass([$customContainerCLass])->toHtml();
        $this->assertContains(
            'class="select-name-container ' . $customContainerCLass . '"',
            $html
        );
        $this->assertNotContains(
            'class="select-name-container ' . $configContainerCLass . '"',
            $html
        );
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.form.select.class.component', [$configComponentCLass]);
        $html = bsSelect()->name('name')->toHtml();
        $this->assertContains('class="select-name-component custom-select ' . $configComponentCLass . '"', $html);
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.form.select.class.component', [$customComponentCLass]);
        $html = bsSelect()->name('name')->componentClass([$customComponentCLass])->toHtml();
        $this->assertContains('class="select-name-component custom-select ' . $customComponentCLass . '"', $html);
        $this->assertNotContains('class="form-control select-name-component ' . $configComponentCLass . '"', $html);
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.select.html_attributes.container', [$configContainerAttributes]);
        $html = bsSelect()->name('name')->toHtml();
        $this->assertContains($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.select.html_attributes.container', [$configContainerAttributes]);
        $html = bsSelect()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertContains($customContainerAttributes, $html);
        $this->assertNotContains($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.select.html_attributes.component', [$configComponentAttributes]);
        $html = bsSelect()->name('name')->toHtml();
        $this->assertContains($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.select.html_attributes.component', [$configComponentAttributes]);
        $html = bsSelect()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertContains($customComponentAttributes, $html);
        $this->assertNotContains($configComponentAttributes, $html);
    }
}
