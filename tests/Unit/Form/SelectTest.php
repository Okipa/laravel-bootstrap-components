<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form;

use Exception;
use Illuminate\Support\MessageBag;
use InvalidArgumentException;
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
        $this->assertTrue(array_key_exists('prepend', config('bootstrap-components.form.select')));
        $this->assertTrue(array_key_exists('append', config('bootstrap-components.form.select')));
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
        $html = bsSelect()->name('id')->toHtml();
        $this->assertStringContainsString('name="id"', $html);
    }

    public function testType()
    {
        $html = bsSelect()->name('id')->toHtml();
        $this->assertStringContainsString('<select', $html);
    }

    public function testInputWithoutName()
    {
        $this->expectException(Exception::class);
        bsSelect()->toHtml();
    }

    public function testSetNoOptions()
    {
        $html = bsSelect()->name('id')->toHtml();
        $this->assertStringContainsString(
            '<option value="" disabled="disabled" selected="selected">validation.attributes.id</option>',
            $html
        );
    }

    public function testSetOptionsFromArray()
    {
        $optionsList = [
            ['id' => 1, 'name' => $this->faker->word],
            ['id' => 2, 'name' => $this->faker->word],
        ];
        $html = bsSelect()->name('id')->options($optionsList, 'id', 'name')->toHtml();
        $this->assertStringContainsString(
            '<option value="" disabled="disabled" selected="selected">validation.attributes.id</option>',
            $html
        );
        $this->assertStringContainsString(
            '<option value="' . $optionsList[0]['id'] . '" >' . $optionsList[0]['name'] . '</option>',
            $html
        );
        $this->assertStringContainsString(
            '<option value="' . $optionsList[1]['id'] . '" >' . $optionsList[1]['name'] . '</option>',
            $html
        );
    }

    public function testSetOptionsFromArrayWithWrongOptionValueField()
    {
        $this->expectException(InvalidArgumentException::class);
        $optionsList = [
            ['id' => 1, 'name' => $this->faker->word],
            ['id' => 2, 'name' => $this->faker->word],
        ];
        bsSelect()->name('id')->options($optionsList, 'wrong', 'name')->toHtml();
    }

    public function testSetOptionsFromArrayWithWrongOptionLabelField()
    {
        $this->expectException(InvalidArgumentException::class);
        $optionsList = [
            ['id' => 1, 'name' => $this->faker->word],
            ['id' => 2, 'name' => $this->faker->word],
        ];
        bsSelect()->name('id')->options($optionsList, 'id', 'wrong')->toHtml();
    }

    public function testSetOptionsFromModelsCollection()
    {
        $users = $this->createMultipleUsers(2);
        $html = bsSelect()->name('id')->options($users, 'id', 'name')->toHtml();
        $users = $users->toArray();
        $this->assertStringContainsString(
            '<option value="" disabled="disabled" selected="selected">validation.attributes.id</option>',
            $html
        );
        $this->assertStringContainsString(
            '<option value="' . $users[0]['id'] . '" >' . $users[0]['name'] . '</option>',
            $html
        );
        $this->assertStringContainsString(
            '<option value="' . $users[1]['id'] . '" >' . $users[1]['name'] . '</option>',
            $html
        );
    }

    public function testSetOptionsFromModelsCollectionWithWrongOptionValueField()
    {
        $this->expectException(InvalidArgumentException::class);
        $users = $this->createMultipleUsers(2);
        bsSelect()->name('id')->options($users, 'wrong', 'name')->toHtml();
    }

    public function testSetOptionsFromModelsCollectionWithWrongOptionLabelField()
    {
        $this->expectException(InvalidArgumentException::class);
        $users = $this->createMultipleUsers(2);
        bsSelect()->name('name')->options($users, 'id', 'wrong')->toHtml();
    }

    public function testSelectedFromModelValue()
    {
        $users = $this->createMultipleUsers(2);
        $user = $users->first();
        $html = bsSelect()->model($user)->name('id')->options($users, 'id', 'name')->toHtml();
        $users = $users->toArray();
        $this->assertStringContainsString(
            '<option value="" disabled="disabled" >validation.attributes.id</option>',
            $html
        );
        $this->assertStringContainsString(
            '<option value="' . $users[0]['id'] . '" selected="selected">' . $users[0]['name'] . '</option>',
            $html
        );
        $this->assertStringContainsString(
            '<option value="' . $users[1]['id'] . '" >' . $users[1]['name'] . '</option>',
            $html
        );
    }

    public function testSetSelectedOptionWithoutDeclaredOptions()
    {
        $html = bsSelect()->name('id')->selected('id', 1)->toHtml();
        $this->assertStringContainsString('<select', $html);
    }

    public function testSetSelectedOptionFromWrongTypeValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $users = $this->createMultipleUsers(2);
        bsSelect()->name('id')
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
            ->name('id')
            ->options($users, 'id', 'name')
            ->selected('id', $users->get(1)->id)
            ->toHtml();
        $this->assertStringContainsString(
            '<option value="" disabled="disabled" >validation.attributes.id</option>',
            $html
        );
        $this->assertStringContainsString(
            '<option value="' . $users[0]['id'] . '" >' . $users[0]['name'] . '</option>',
            $html
        );
        $this->assertStringContainsString(
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
            ->options($users, 'name', 'name')
            ->selected('name', $users->get(1)->name)
            ->toHtml();
        $this->assertStringContainsString(
            '<option value="" disabled="disabled" >validation.attributes.name</option>',
            $html
        );
        $this->assertStringContainsString(
            '<option value="' . $users[0]['name'] . '" >' . $users[0]['name'] . '</option>',
            $html
        );
        $this->assertStringContainsString(
            '<option value="' . $users[1]['name'] . '" selected="selected">' . $users[1]['name'] . '</option>',
            $html
        );
    }

    public function testNotSelected()
    {
        $users = $this->createMultipleUsers(2);
        $html = bsSelect()
            ->name('id')
            ->options($users, 'id', 'name')
            ->toHtml();
        $this->assertStringContainsString(
            '<option value="" disabled="disabled" selected="selected">validation.attributes.id</option>',
            $html
        );
        $this->assertStringContainsString(
            '<option value="' . $users[0]['id'] . '" >' . $users[0]['name'] . '</option>',
            $html
        );
        $this->assertStringContainsString(
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
            'middleware' => 'web', 'uses' => function () use ($old) {
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
        $this->assertStringContainsString(
            '<option value="' . $custom->id . '" >' . $custom->name . '</option>',
            $html
        );
        $this->assertStringContainsString(
            '<option value="' . $model->id . '" >' . $model->name . '</option>',
            $html
        );
        $this->assertStringContainsString(
            '<option value="' . $old->id . '" selected="selected">' . $old->name . '</option>',
            $html
        );
    }

    public function testSetMultiple()
    {
        $companies = $this->createMultipleCompanies(5);
        $html = bsSelect()->name('companies')->options($companies, 'id', 'name')->multiple()->toHtml();
        $this->assertStringContainsString('companies[]', $html);
        $this->assertStringContainsString('multiple>', $html);
    }

    public function testSelectMultipleWithModelAndNonExistentAttribute()
    {
        $user = $this->createUniqueUser();
        $companies = $this->createMultipleCompanies(5);
        $user->companies = $companies->take(2)->pluck('id')->toArray();
        $html = bsSelect()->name('wrong')->model($user)->options($companies, 'id', 'name')->multiple()->toHtml();
        $this->assertStringContainsString(
            '<option value="" disabled="disabled" selected="selected">validation.attributes.wrong</option>',
            $html
        );
        foreach ($companies as $company) {
            $this->assertStringContainsString(
                '<option value="' . $company->id . '" >' . $company->name . '</option>',
                $html
            );
        }
    }

    public function testSelectMultipleWithModelAndWrongAttributeType()
    {
        $this->expectException(InvalidArgumentException::class);
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
        $this->assertStringContainsString(
            '<option value="" disabled="disabled" selected="selected">validation.attributes.companies</option>',
            $html
        );
        foreach ($companies as $company) {
            $this->assertStringContainsString(
                '<option value="' . $company->id . '" >' . $company->name . '</option>',
                $html
            );
        }
    }

    public function testSelectedMultipleFromModelValue()
    {
        $user = $this->createUniqueUser();
        $companies = $this->createMultipleCompanies(5);
        $user->companies = $companies->take(2)->pluck('id')->toArray();
        $html = bsSelect()->model($user)->name('companies')->options($companies, 'id', 'name')->multiple()->toHtml();
        $this->assertStringContainsString(
            '<option value="" disabled="disabled" >validation.attributes.companies</option>',
            $html
        );
        foreach ($companies as $company) {
            $this->assertStringContainsString(
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
        $this->assertStringContainsString(
            '<option value="" disabled="disabled" selected="selected">validation.attributes.companies</option>',
            $html
        );
        foreach ($companies as $company) {
            $this->assertStringContainsString(
                '<option value="' . $company->id . '" >' . $company->name . '</option>',
                $html
            );
        }
    }

    public function testSetSelectedMultipleOptionsFromWrongTypeValue()
    {
        $this->expectException(InvalidArgumentException::class);
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
        $this->assertStringContainsString(
            '<option value="" disabled="disabled" >validation.attributes.companies</option>',
            $html
        );
        foreach ($companies as $company) {
            $this->assertStringContainsString(
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
        $this->assertStringContainsString(
            '<option value="" disabled="disabled" >validation.attributes.companies</option>',
            $html
        );
        foreach ($companies as $company) {
            $this->assertStringContainsString(
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
            'middleware' => 'web', 'uses' => function () use ($oldCompanies) {
                $request = request()->merge(['companies' => $oldCompanies]);
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
        $this->assertStringContainsString(
            '<option value="" disabled="disabled" >validation.attributes.companies</option>',
            $html
        );
        foreach ($companies as $company) {
            $this->assertStringContainsString(
                '<option value="' . $company->id . '" ' . (in_array($company->id, $oldCompanies)
                    ? 'selected="selected"'
                    : '') . '>' . $company->name . '</option>',
                $html
            );
        }
    }

    public function testConfigPrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.form.select.prepend', $configPrepend);
        $html = bsSelect()->name('name')->toHtml();
        $this->assertStringContainsString('input-group-prepend', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $configPrepend . '</span>', $html);
    }

    public function testSetPrepend()
    {
        $configPrepend = 'test-config-prepend';
        $customPrepend = 'test-custom-prepend';
        config()->set('bootstrap-components.form.select.prepend', $configPrepend);
        $html = bsSelect()->name('name')->prepend($customPrepend)->toHtml();
        $this->assertStringContainsString('input-group-prepend', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $customPrepend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="input-group-text">' . $configPrepend . '</span>', $html);
    }

    public function testNoPrepend()
    {
        config()->set('bootstrap-components.form.select.prepend', null);
        $html = bsSelect()->name('name')->toHtml();
        $this->assertStringNotContainsString('input-group-prepend', $html);
    }

    public function testHidePrepend()
    {
        $configPrepend = 'test-config-prepend';
        config()->set('bootstrap-components.form.select.prepend', $configPrepend);
        $html = bsSelect()->name('name')->prepend(false)->toHtml();
        $this->assertStringNotContainsString('input-group-prepend', $html);
    }

    public function testConfigAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.select.append', $configAppend);
        $html = bsSelect()->name('name')->toHtml();
        $this->assertStringContainsString('input-group-append', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $configAppend . '</span>', $html);
    }

    public function testSetAppend()
    {
        $configAppend = 'test-config-append';
        $customAppend = 'test-custom-append';
        config()->set('bootstrap-components.form.select.append', $configAppend);
        $html = bsSelect()->name('name')->append($customAppend)->toHtml();
        $this->assertStringContainsString('input-group-append', $html);
        $this->assertStringContainsString('<span class="input-group-text">' . $customAppend . '</span>', $html);
        $this->assertStringNotContainsString('<span class="input-group-text">' . $configAppend . '</span>', $html);
    }

    public function testNoAppend()
    {
        config()->set('bootstrap-components.form.select.append', null);
        $html = bsSelect()->name('name')->toHtml();
        $this->assertStringNotContainsString('input-group-append', $html);
    }

    public function testHideAppend()
    {
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.select.append', $configAppend);
        $html = bsSelect()->name('name')->append(false)->toHtml();
        $this->assertStringNotContainsString('input-group-append', $html);
    }

    public function testNoPrependNoAppend()
    {
        config()->set('bootstrap-components.form.select.prepend', null);
        config()->set('bootstrap-components.form.select.append', null);
        $html = bsSelect()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div class="input-group">', $html);
    }

    public function testHidePrependHideAppend()
    {
        $configPrepend = 'test-config-prepend';
        $configAppend = 'test-config-append';
        config()->set('bootstrap-components.form.select.prepend', $configPrepend);
        config()->set('bootstrap-components.form.select.append', $configAppend);
        $html = bsSelect()->name('name')->prepend(false)->append(false)->toHtml();
        $this->assertStringNotContainsString('<div class="input-group">', $html);
    }

    public function testConfigLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.select.legend', $configLegend);
        $html = bsSelect()->name('name')->toHtml();
        $this->assertStringContainsString('select-name-legend', $html);
        $this->assertStringContainsString($configLegend, $html);
    }

    public function testSetLegend()
    {
        $configLegend = 'test-config-legend';
        $customLegend = 'test-custom-legend';
        config()->set('bootstrap-components.form.select.legend', $configLegend);
        $html = bsSelect()->name('name')->legend($customLegend)->toHtml();
        $this->assertStringContainsString('select-name-legend', $html);
        $this->assertStringContainsString($customLegend, $html);
        $this->assertStringNotContainsString($configLegend, $html);
    }

    public function testNoLegend()
    {
        config()->set('bootstrap-components.form.select.legend', null);
        $html = bsSelect()->name('name')->toHtml();
        $this->assertStringNotContainsString('select-name-legend', $html);
    }

    public function testHideLegend()
    {
        $configLegend = 'test-config-legend';
        config()->set('bootstrap-components.form.select.legend', $configLegend);
        $html = bsSelect()->name('name')->legend(false)->toHtml();
        $this->assertStringNotContainsString('select-name-legend', $html);
    }

    public function testSetLabel()
    {
        $label = 'test-custom-label';
        $html = bsSelect()->name('name')->label($label)->toHtml();
        $this->assertStringContainsString('<label for="select-name">' . $label . '</label>', $html);
        $this->assertStringContainsString(
            '<option value="" disabled="disabled" selected="selected">' . $label . '</option>',
            $html
        );
    }

    public function testNoLabel()
    {
        $html = bsSelect()->name('name')->toHtml();
        $this->assertStringContainsString(
            '<label for="select-name">validation.attributes.name</label>',
            $html
        );
    }

    public function testHideLabel()
    {
        $html = bsSelect()->name('name')->label(false)->toHtml();
        $this->assertStringNotContainsString(
            '<label for="select-name">validation.attributes.name</label>',
            $html
        );
    }

    public function testSetPlaceholder()
    {
        $placeholder = 'test-custom-placeholder';
        $html = bsSelect()->name('name')->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString(
            '<option value="" disabled="disabled" selected="selected">' . $placeholder . '</option>',
            $html
        );
    }

    public function testSetPlaceholderWithLabel()
    {
        $label = 'test-custom-label';
        $placeholder = 'test-custom-placeholder';
        $html = bsSelect()->name('name')->label($label)->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString(
            '<option value="" disabled="disabled" selected="selected">' . $placeholder . '</option>',
            $html
        );
    }

    public function testNoPlaceholder()
    {
        $html = bsSelect()->name('name')->toHtml();
        $this->assertStringContainsString(
            '<option value="" disabled="disabled" selected="selected">validation.attributes.name</option>',
            $html
        );
    }

    public function testHidePlaceholder()
    {
        $html = bsSelect()->name('name')->placeholder(false)->toHtml();
        $this->assertStringNotContainsString(
            '<option value="" disabled="disabled" selected="selected">',
            $html
        );
    }

    public function testSuccess()
    {
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsSelect()->name('name')->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testNoSuccess()
    {
        $html = bsSelect()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
    }

    public function testError()
    {
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsSelect()->name('name')->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errorMessage, $html);
    }

    public function testNoError()
    {
        $html = bsSelect()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
    }

    public function testSetNoContainerId()
    {
        $html = bsSelect()->name('name')->toHtml();
        $this->assertStringNotContainsString('<div id="', $html);
    }

    public function testSetContainerId()
    {
        $customContainerId = 'test-custom-container-id';
        $html = bsSelect()->name('name')->containerId($customContainerId)->toHtml();
        $this->assertStringContainsString('<div id="' . $customContainerId, $html);
    }

    public function testSetNoComponentId()
    {
        $html = bsSelect()->name('name')->toHtml();
        $this->assertStringContainsString('for="select-name"', $html);
        $this->assertStringContainsString('<select id="select-name"', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = bsSelect()->name('name')->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString('for="' . $customComponentId . '"', $html);
        $this->assertStringContainsString('<select id="' . $customComponentId . '"', $html);
    }

    public function testConfigContainerClass()
    {
        $configContainerCLass = 'test-config-class-container';
        config()->set('bootstrap-components.form.select.class.container', [$configContainerCLass]);
        $html = bsSelect()->name('name')->toHtml();
        $this->assertStringContainsString(
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
        $this->assertStringContainsString(
            'class="select-name-container ' . $customContainerCLass . '"',
            $html
        );
        $this->assertStringNotContainsString(
            'class="select-name-container ' . $configContainerCLass . '"',
            $html
        );
    }

    public function testConfigComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        config()->set('bootstrap-components.form.select.class.component', [$configComponentCLass]);
        $html = bsSelect()->name('name')->toHtml();
        $this->assertStringContainsString(
            'class="select-name-component custom-select ' . $configComponentCLass . '"',
            $html
        );
    }

    public function testSetComponentClass()
    {
        $configComponentCLass = 'test-config-class-component';
        $customComponentCLass = 'test-custom-class-component';
        config()->set('bootstrap-components.form.select.class.component', [$customComponentCLass]);
        $html = bsSelect()->name('name')->componentClass([$customComponentCLass])->toHtml();
        $this->assertStringContainsString(
            'class="select-name-component custom-select ' . $customComponentCLass . '"',
            $html
        );
        $this->assertStringNotContainsString(
            'class="form-control select-name-component ' . $configComponentCLass . '"',
            $html
        );
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.select.html_attributes.container', [$configContainerAttributes]);
        $html = bsSelect()->name('name')->toHtml();
        $this->assertStringContainsString($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.select.html_attributes.container', [$configContainerAttributes]);
        $html = bsSelect()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertStringContainsString($customContainerAttributes, $html);
        $this->assertStringNotContainsString($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.select.html_attributes.component', [$configComponentAttributes]);
        $html = bsSelect()->name('name')->toHtml();
        $this->assertStringContainsString($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.select.html_attributes.component', [$configComponentAttributes]);
        $html = bsSelect()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertStringContainsString($customComponentAttributes, $html);
        $this->assertStringNotContainsString($configComponentAttributes, $html);
    }
}
