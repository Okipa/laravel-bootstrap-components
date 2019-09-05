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
        $this->assertTrue(array_key_exists('labelPositionedAbove', config('bootstrap-components.form.select')));
        $this->assertTrue(array_key_exists('legend', config('bootstrap-components.form.select')));
        $this->assertTrue(array_key_exists('classes', config('bootstrap-components.form.select')));
        $this->assertTrue(array_key_exists('htmlAttributes', config('bootstrap-components.form.select')));
        // components.form.select.classes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.select.classes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.select.classes')));
        // components.form.select.htmlAttributes
        $this->assertTrue(array_key_exists('container', config('bootstrap-components.form.select.htmlAttributes')));
        $this->assertTrue(array_key_exists('component', config('bootstrap-components.form.select.htmlAttributes')));
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
            '<option value="' . $optionsList[0]['id'] . '">' . $optionsList[0]['name'] . '</option>',
            $html
        );
        $this->assertStringContainsString(
            '<option value="' . $optionsList[1]['id'] . '">' . $optionsList[1]['name'] . '</option>',
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
            '<option value="' . $users[0]['id'] . '">' . $users[0]['name'] . '</option>',
            $html
        );
        $this->assertStringContainsString(
            '<option value="' . $users[1]['id'] . '">' . $users[1]['name'] . '</option>',
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
            '<option value="" disabled="disabled">validation.attributes.id</option>',
            $html
        );
        $this->assertStringContainsString(
            '<option value="' . $users[0]['id'] . '" selected="selected">' . $users[0]['name'] . '</option>',
            $html
        );
        $this->assertStringContainsString(
            '<option value="' . $users[1]['id'] . '">' . $users[1]['name'] . '</option>',
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
            '<option value="" disabled="disabled">validation.attributes.id</option>',
            $html
        );
        $this->assertStringContainsString(
            '<option value="' . $users[0]['id'] . '">' . $users[0]['name'] . '</option>',
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
            '<option value="" disabled="disabled">validation.attributes.name</option>',
            $html
        );
        $this->assertStringContainsString(
            '<option value="' . $users[0]['name'] . '">' . $users[0]['name'] . '</option>',
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
            '<option value="' . $users[0]['id'] . '">' . $users[0]['name'] . '</option>',
            $html
        );
        $this->assertStringContainsString(
            '<option value="' . $users[1]['id'] . '">' . $users[1]['name'] . '</option>',
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
            '<option value="' . $custom->id . '">' . $custom->name . '</option>',
            $html
        );
        $this->assertStringContainsString(
            '<option value="' . $model->id . '">' . $model->name . '</option>',
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
                '<option value="' . $company->id . '">' . $company->name . '</option>',
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
                '<option value="' . $company->id . '">' . $company->name . '</option>',
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
            '<option value="" disabled="disabled">validation.attributes.companies</option>',
            $html
        );
        foreach ($companies as $company) {
            $this->assertStringContainsString(
                '<option value="' . $company->id . '"'
                . (in_array($company->id, $user->companies) ? ' selected="selected"' : '') . '>'
                . $company->name
                . '</option>',
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
                '<option value="' . $company->id . '">' . $company->name . '</option>',
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
            '<option value="" disabled="disabled">validation.attributes.companies</option>',
            $html
        );
        foreach ($companies as $company) {
            $this->assertStringContainsString(
                '<option value="' . $company->id . '"'
                . (in_array($company->id, $selectedCompanies) ? ' selected="selected"' : '') . '>'
                . $company->name
                . '</option>',
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
            '<option value="" disabled="disabled">validation.attributes.companies</option>',
            $html
        );
        foreach ($companies as $company) {
            $this->assertStringContainsString(
                '<option value="' . $company->id . '"'
                . (in_array($company->name, $selectedCompanies) ? ' selected="selected"' : '') . '>'
                . $company->name
                . '</option>',
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
            '<option value="" disabled="disabled">validation.attributes.companies</option>',
            $html
        );
        foreach ($companies as $company) {
            $this->assertStringContainsString(
                '<option value="' . $company->id . '"'
                . (in_array($company->id, $oldCompanies) ? ' selected="selected"' : '') . '>'
                . $company->name
                . '</option>',
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

    public function testSetTranslatedLegend()
    {
        $legend = 'bootstrap-components::bootstrap-components.label.validate';
        $html = bsSelect()->name('name')->legend($legend)->toHtml();
        $this->assertStringContainsString(__($legend), $html);
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

    public function testSetTranslatedLabel()
    {
        $label = 'bootstrap-components::bootstrap-components.label.validate';
        $html = bsSelect()->name('name')->label($label)->toHtml();
        $this->assertStringContainsString('<label for="select-name">' . __($label) . '</label>', $html);
        $this->assertStringContainsString(
            '<option value="" disabled="disabled" selected="selected">' . __($label) . '</option>',
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

    public function testConfigLabelPositionedAbove()
    {
        config()->set('bootstrap-components.form.select.labelPositionedAbove', true);
        $html = bsSelect()->name('name')->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<select');
        $this->assertLessThan($inputPosition, $labelPosition);
    }

    public function testConfigLabelPositionedUnder()
    {
        config()->set('bootstrap-components.form.select.labelPositionedAbove', false);
        $html = bsSelect()->name('name')->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<select');
        $this->assertLessThan($labelPosition, $inputPosition);
    }

    public function testLabelPositionedAbove()
    {
        config()->set('bootstrap-components.form.select.labelPositionedAbove', false);
        $html = bsSelect()->name('name')->labelPositionedAbove()->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<select');
        $this->assertLessThan($inputPosition, $labelPosition);
    }

    public function testLabelPositionedUnder()
    {
        config()->set('bootstrap-components.form.select.labelPositionedAbove', true);
        $html = bsSelect()->name('name')->labelPositionedAbove(false)->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<select');
        $this->assertLessThan($labelPosition, $inputPosition);
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

    public function testSetTranslatedPlaceholder()
    {
        $placeholder = 'bootstrap-components::bootstrap-components.label.validate';
        $html = bsSelect()->name('name')->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString(
            '<option value="" disabled="disabled" selected="selected">' . __($placeholder) . '</option>',
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

    public function testNoPlaceholderWithNoLabel()
    {
        $html = bsSelect()->name('name')->label(false)->toHtml();
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

    public function testConfigDisplaySuccess()
    {
        config()->set('bootstrap-components.form.select.formValidation.displaySuccess', true);
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsSelect()->name('name')->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testConfigDoNotDisplaySuccess()
    {
        config()->set('bootstrap-components.form.select.formValidation.displaySuccess', false);
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsSelect()->name('name')->render(['errors' => $messageBag]);
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringNotContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testDisplaySuccess()
    {
        config()->set('bootstrap-components.form.select.formValidation.displaySuccess', false);
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsSelect()->name('name')->displaySuccess(true)->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testDoNotDisplaySuccess()
    {
        config()->set('bootstrap-components.form.select.formValidation.displaySuccess', true);
        $messageBag = app(MessageBag::class)->add('other_name', null);
        $html = bsSelect()->name('name')->displaySuccess(false)->render(['errors' => $messageBag]);
        $this->assertStringNotContainsString('<div class="valid-feedback d-block">', $html);
        $this->assertStringNotContainsString(
            __('bootstrap-components::bootstrap-components.notification.validation.success'),
            $html
        );
    }

    public function testConfigDisplayFailure()
    {
        config()->set('bootstrap-components.form.select.formValidation.displayFailure', true);
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsSelect()->name('name')->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errorMessage, $html);
    }

    public function testConfigDoNotDisplayFailure()
    {
        config()->set('bootstrap-components.form.select.formValidation.displayFailure', false);
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsSelect()->name('name')->render(['errors' => $messageBag]);
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringNotContainsString($errorMessage, $html);
    }

    public function testDisplayFailure()
    {
        config()->set('bootstrap-components.form.select.formValidation.displayFailure', false);
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsSelect()->name('name')->displayFailure(true)->render(['errors' => $messageBag]);
        $this->assertStringContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringContainsString($errorMessage, $html);
    }

    public function testDoNotDisplayFailure()
    {
        config()->set('bootstrap-components.form.select.formValidation.displayFailure', true);
        $errorMessage = 'This a test error message';
        $messageBag = app(MessageBag::class)->add('name', $errorMessage);
        $html = bsSelect()->name('name')->displayFailure(false)->render(['errors' => $messageBag]);
        $this->assertStringNotContainsString('<div class="invalid-feedback d-block">', $html);
        $this->assertStringNotContainsString($errorMessage, $html);
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

    public function testConfigContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        config()->set('bootstrap-components.form.select.classes.container', [$configContainerClasses]);
        $html = bsSelect()->name('name')->toHtml();
        $this->assertStringContainsString(
            'class="select-name-container ' . $configContainerClasses . '"',
            $html
        );
    }

    public function testSetContainerClasses()
    {
        $configContainerClasses = 'test-config-class-container';
        $customContainerClasses = 'test-custom-class-container';
        config()->set('bootstrap-components.form.select.classes.container', [$configContainerClasses]);
        $html = bsSelect()->name('name')->containerClasses([$customContainerClasses])->toHtml();
        $this->assertStringContainsString(
            'class="select-name-container ' . $customContainerClasses . '"',
            $html
        );
        $this->assertStringNotContainsString(
            'class="select-name-container ' . $configContainerClasses . '"',
            $html
        );
    }

    public function testConfigComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        config()->set('bootstrap-components.form.select.classes.component', [$configComponentClasses]);
        $html = bsSelect()->name('name')->toHtml();
        $this->assertStringContainsString(
            'class="select-name-component custom-select ' . $configComponentClasses . '"',
            $html
        );
    }

    public function testSetComponentClass()
    {
        $configComponentClasses = 'test-config-class-component';
        $customComponentClasses = 'test-custom-class-component';
        config()->set('bootstrap-components.form.select.classes.component', [$customComponentClasses]);
        $html = bsSelect()->name('name')->componentClasses([$customComponentClasses])->toHtml();
        $this->assertStringContainsString(
            'class="select-name-component custom-select ' . $customComponentClasses . '"',
            $html
        );
        $this->assertStringNotContainsString(
            'class="form-control select-name-component ' . $configComponentClasses . '"',
            $html
        );
    }

    public function testConfigContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        config()->set('bootstrap-components.form.select.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsSelect()->name('name')->toHtml();
        $this->assertStringContainsString($configContainerAttributes, $html);
    }

    public function testSetContainerHtmlAttributes()
    {
        $configContainerAttributes = 'test-config-attributes-container';
        $customContainerAttributes = 'test-custom-attributes-container';
        config()->set('bootstrap-components.form.select.htmlAttributes.container', [$configContainerAttributes]);
        $html = bsSelect()->name('name')->containerHtmlAttributes([$customContainerAttributes])->toHtml();
        $this->assertStringContainsString($customContainerAttributes, $html);
        $this->assertStringNotContainsString($configContainerAttributes, $html);
    }

    public function testConfigComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        config()->set('bootstrap-components.form.select.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsSelect()->name('name')->toHtml();
        $this->assertStringContainsString($configComponentAttributes, $html);
    }

    public function testSetComponentHtmlAttributes()
    {
        $configComponentAttributes = 'test-config-attributes-component';
        $customComponentAttributes = 'test-custom-attributes-component';
        config()->set('bootstrap-components.form.select.htmlAttributes.component', [$configComponentAttributes]);
        $html = bsSelect()->name('name')->componentHtmlAttributes([$customComponentAttributes])->toHtml();
        $this->assertStringContainsString($customComponentAttributes, $html);
        $this->assertStringNotContainsString($configComponentAttributes, $html);
    }
}
