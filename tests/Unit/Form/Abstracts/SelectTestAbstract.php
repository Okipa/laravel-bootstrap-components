<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts;

use InvalidArgumentException;
use Okipa\LaravelBootstrapComponents\Tests\Fakers\CompaniesFaker;

abstract class SelectTestAbstract extends InputTestAbstract
{
    use CompaniesFaker;

    public function testType()
    {
        $html = $this->getComponent()->name('id')->toHtml();
        $this->assertStringContainsString('<select', $html);
    }

    public function testSetNoOptions()
    {
        $html = $this->getComponent()->name('id')->toHtml();
        $this->assertStringContainsString(
            '<option value="" selected="selected">validation.attributes.id</option>',
            $html
        );
    }

    public function testSetOptionsFromArray()
    {
        $optionsList = [
            ['id' => 1, 'name' => $this->faker->word],
            ['id' => 2, 'name' => $this->faker->word],
        ];
        $html = $this->getComponent()->name('id')->options($optionsList, 'id', 'name')->toHtml();
        $this->assertStringContainsString(
            '<option value="" selected="selected">validation.attributes.id</option>',
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
        $optionsList = [
            ['id' => 1, 'name' => $this->faker->word],
            ['id' => 2, 'name' => $this->faker->word],
        ];
        $this->expectException(InvalidArgumentException::class);
        $this->getComponent()->name('id')->options($optionsList, 'wrong', 'name')->toHtml();
    }

    public function testSetOptionsFromArrayWithWrongOptionLabelField()
    {
        $optionsList = [
            ['id' => 1, 'name' => $this->faker->word],
            ['id' => 2, 'name' => $this->faker->word],
        ];
        $this->expectException(InvalidArgumentException::class);
        $this->getComponent()->name('id')->options($optionsList, 'id', 'wrong')->toHtml();
    }

    public function testSetOptionsFromModelsCollection()
    {
        $users = $this->createMultipleUsers(2);
        $html = $this->getComponent()->name('id')->options($users, 'id', 'name')->toHtml();
        $users = $users->toArray();
        $this->assertStringContainsString(
            '<option value="" selected="selected">validation.attributes.id</option>',
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
        $this->getComponent()->name('id')->options($users, 'wrong', 'name')->toHtml();
    }

    public function testSetOptionsFromModelsCollectionWithWrongOptionLabelField()
    {
        $this->expectException(InvalidArgumentException::class);
        $users = $this->createMultipleUsers(2);
        $this->getComponent()->name('name')->options($users, 'id', 'wrong')->toHtml();
    }

    public function testModelValue()
    {
        $users = $this->createMultipleUsers(2);
        $user = $users->first();
        $html = $this->getComponent()->model($user)->name('id')->options($users, 'id', 'name')->toHtml();
        $users = $users->toArray();
        $this->assertStringContainsString(
            '<option value="">validation.attributes.id</option>',
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

    public function testSetValue()
    {
        $this->markTestSkipped();
    }

    public function testSetValueFromClosure()
    {
        $this->markTestSkipped();
    }

    public function testSetSelectedOptionWithoutDeclaredOptions()
    {
        $html = $this->getComponent()->name('id')->selected('id', 1)->toHtml();
        $this->assertStringContainsString('<select', $html);
    }

    public function testSetSelectedOptionFromWrongTypeValue()
    {
        $this->expectException(InvalidArgumentException::class);
        $users = $this->createMultipleUsers(2);
        $this->getComponent()->name('id')
            ->options($users, 'id', 'name')
            ->selected('id', ['test'])
            ->toHtml();
    }

    public function testSetSelectedOptionFromValue()
    {
        $users = $this->createMultipleUsers(2);
        $user = null;
        $html = $this->getComponent()
            ->model($user)
            ->name('id')
            ->options($users, 'id', 'name')
            ->selected('id', $users->get(1)->id)
            ->toHtml();
        $this->assertStringContainsString(
            '<option value="">validation.attributes.id</option>',
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
        $html = $this->getComponent()
            ->model($user)
            ->name('name')
            ->options($users, 'name', 'name')
            ->selected('name', $users->get(1)->name)
            ->toHtml();
        $this->assertStringContainsString(
            '<option value="">validation.attributes.name</option>',
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
        $html = $this->getComponent()
            ->name('id')
            ->options($users, 'id', 'name')
            ->toHtml();
        $this->assertStringContainsString(
            '<option value="" selected="selected">validation.attributes.id</option>',
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
        $html = $this->getComponent()
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
        $html = $this->getComponent()->name('companies')->options($companies, 'id', 'name')->multiple()->toHtml();
        $this->assertStringContainsString('companies[]', $html);
        $this->assertStringContainsString('multiple>', $html);
    }

    public function testSelectMultipleWithModelAndNonExistentAttribute()
    {
        $user = $this->createUniqueUser();
        $companies = $this->createMultipleCompanies(5);
        $user->companies = $companies->take(2)->pluck('id')->toArray();
        $html = $this->getComponent()->name('wrong')
            ->model($user)
            ->options($companies, 'id', 'name')
            ->multiple()
            ->toHtml();
        $this->assertStringContainsString(
            '<option value="" selected="selected">validation.attributes.wrong</option>',
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
        $this->getComponent()->name('companies')->model($user)->options($companies, 'id', 'name')->multiple()->toHtml();
    }

    public function testSelectedMultipleFromModelEmptyValue()
    {
        $user = $this->createUniqueUser();
        $companies = $this->createMultipleCompanies(5);
        $user->companies = [];
        $html = $this->getComponent()
            ->model($user)
            ->name('companies')
            ->options($companies, 'id', 'name')
            ->multiple()
            ->toHtml();
        $this->assertStringContainsString(
            '<option value="" selected="selected">validation.attributes.companies</option>',
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
        $html = $this->getComponent()
            ->model($user)
            ->name('companies')
            ->options($companies, 'id', 'name')
            ->multiple()
            ->toHtml();
        $this->assertStringContainsString(
            '<option value="">validation.attributes.companies</option>',
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
        $html = $this->getComponent()->name('companies')
            ->options($companies, 'id', 'name')
            ->multiple()
            ->selected('id', [])
            ->toHtml();
        $this->assertStringContainsString(
            '<option value="" selected="selected">validation.attributes.companies</option>',
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
        $this->getComponent()->name('companies')
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
        $html = $this->getComponent()->name('companies')
            ->model($user)
            ->options($companies, 'id', 'name')
            ->multiple()
            ->selected('id', $selectedCompanies)
            ->toHtml();
        $this->assertStringContainsString(
            '<option value="">validation.attributes.companies</option>',
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
        $html = $this->getComponent()->name('companies')
            ->model($user)
            ->options($companies, 'id', 'name')
            ->multiple()
            ->selected('name', $selectedCompanies)
            ->toHtml();
        $this->assertStringContainsString(
            '<option value="">validation.attributes.companies</option>',
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
        $html = $this->getComponent()->name('companies')
            ->model($user)
            ->options($companies, 'id', 'name')
            ->multiple()
            ->selected('id', $selectedCompanies)
            ->toHtml();
        $this->assertStringContainsString(
            '<option value="">validation.attributes.companies</option>',
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

    public function testSetCustomLabelPositionedAbove()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<select');
        $this->assertLessThan($labelPosition, $inputPosition);
    }

    public function testSetLabelPositionedAboveOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->labelPositionedAbove()->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<select');
        $this->assertLessThan($inputPosition, $labelPosition);
    }

    public function testSetPlaceholder()
    {
        $placeholder = 'custom-placeholder';
        $html = $this->getComponent()->name('name')->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString(
            '<option value="" selected="selected">' . $placeholder . '</option>',
            $html
        );
    }

    public function testSetPlaceholderWithLabel()
    {
        $label = 'custom-label';
        $placeholder = 'test-custom-placeholder';
        $html = $this->getComponent()->name('name')->label($label)->placeholder($placeholder)->toHtml();
        $this->assertStringContainsString(
            '<option value="" selected="selected">' . $placeholder . '</option>',
            $html
        );
    }

    public function testNoPlaceholder()
    {
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringContainsString(
            '<option value="" selected="selected">validation.attributes.name</option>',
            $html
        );
    }

    public function testNoPlaceholderWithNoLabel()
    {
        $html = $this->getComponent()->name('name')->label(false)->toHtml();
        $this->assertStringContainsString(
            '<option value="" selected="selected">validation.attributes.name</option>',
            $html
        );
    }

    public function testHidePlaceholder()
    {
        $html = $this->getComponent()->name('name')->placeholder(false)->toHtml();
        $this->assertStringNotContainsString(
            '<option value="" selected="selected">',
            $html
        );
    }

    public function testSetNoComponentId()
    {
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringContainsString(' for="' . $this->getComponentType() . '-name"', $html);
        $this->assertStringContainsString('<select id="' . $this->getComponentType() . '-name"', $html);
    }

    public function testSetComponentId()
    {
        $customComponentId = 'test-custom-component-id';
        $html = $this->getComponent()->name('name')->componentId($customComponentId)->toHtml();
        $this->assertStringContainsString(' for="' . $customComponentId . '"', $html);
        $this->assertStringContainsString('<select id="' . $customComponentId . '"', $html);
    }

    public function testSetCustomComponentClasses()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        $this->assertStringContainsString('class="component custom-select default component classes"', $html);
    }

    public function testSetComponentClassesOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->componentClasses(['custom', 'component', 'classes'])->toHtml();
        $this->assertStringContainsString('class="component custom-select custom component classes"', $html);
        $this->assertStringNotContainsString('class="component custom-select default component classes"', $html);
    }
}
