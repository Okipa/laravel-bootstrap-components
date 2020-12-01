<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts;

use InvalidArgumentException;
use Okipa\LaravelBootstrapComponents\Tests\Fakers\CompaniesFaker;

abstract class SelectTestAbstract extends InputTestAbstract
{
    use CompaniesFaker;

    public function testType(): void
    {
        $html = $this->getComponent()->name('id')->toHtml();
        self::assertStringContainsString('<select', $html);
    }

    public function testSetNoOptions(): void
    {
        $html = $this->getComponent()->name('id')->toHtml();
        self::assertStringContainsString(
            '<option value="" selected="selected">validation.attributes.id</option>',
            $html
        );
    }

    public function testSetOptionsFromArray(): void
    {
        $optionsList = [
            ['id' => 1, 'name' => $this->faker->word],
            ['id' => 2, 'name' => $this->faker->word],
        ];
        $html = $this->getComponent()->name('id')->options($optionsList, 'id', 'name')->toHtml();
        self::assertStringContainsString(
            '<option value="" selected="selected">validation.attributes.id</option>',
            $html
        );
        self::assertStringContainsString(
            '<option value="' . $optionsList[0]['id'] . '">' . $optionsList[0]['name'] . '</option>',
            $html
        );
        self::assertStringContainsString(
            '<option value="' . $optionsList[1]['id'] . '">' . $optionsList[1]['name'] . '</option>',
            $html
        );
    }

    public function testSetOptionsFromArrayWithWrongOptionValueField(): void
    {
        $optionsList = [
            ['id' => 1, 'name' => $this->faker->word],
            ['id' => 2, 'name' => $this->faker->word],
        ];
        $this->expectException(InvalidArgumentException::class);
        $this->getComponent()->name('id')->options($optionsList, 'wrong', 'name')->toHtml();
    }

    public function testSetOptionsFromArrayWithWrongOptionLabelField(): void
    {
        $optionsList = [
            ['id' => 1, 'name' => $this->faker->word],
            ['id' => 2, 'name' => $this->faker->word],
        ];
        $this->expectException(InvalidArgumentException::class);
        $this->getComponent()->name('id')->options($optionsList, 'id', 'wrong')->toHtml();
    }

    public function testSetOptionsFromModelsCollection(): void
    {
        $users = $this->createMultipleUsers(2);
        $html = $this->getComponent()->name('id')->options($users, 'id', 'name')->toHtml();
        $users = $users->toArray();
        self::assertStringContainsString(
            '<option value="" selected="selected">validation.attributes.id</option>',
            $html
        );
        self::assertStringContainsString(
            '<option value="' . $users[0]['id'] . '">' . $users[0]['name'] . '</option>',
            $html
        );
        self::assertStringContainsString(
            '<option value="' . $users[1]['id'] . '">' . $users[1]['name'] . '</option>',
            $html
        );
    }

    public function testSetOptionsFromModelsCollectionWithWrongOptionValueField(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $users = $this->createMultipleUsers(2);
        $this->getComponent()->name('id')->options($users, 'wrong', 'name')->toHtml();
    }

    public function testSetOptionsFromModelsCollectionWithWrongOptionLabelField(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $users = $this->createMultipleUsers(2);
        $this->getComponent()->name('name')->options($users, 'id', 'wrong')->toHtml();
    }

    public function testModelValue(): void
    {
        $users = $this->createMultipleUsers(2);
        $user = $users->first();
        $html = $this->getComponent()->model($user)->name('id')->options($users, 'id', 'name')->toHtml();
        $users = $users->toArray();
        self::assertStringContainsString(
            '<option value="">validation.attributes.id</option>',
            $html
        );
        self::assertStringContainsString(
            '<option value="' . $users[0]['id'] . '" selected="selected">' . $users[0]['name'] . '</option>',
            $html
        );
        self::assertStringContainsString(
            '<option value="' . $users[1]['id'] . '">' . $users[1]['name'] . '</option>',
            $html
        );
    }

    public function testSetValue(): void
    {
        self::markTestSkipped();
    }

    public function testSetZeroValue(): void
    {
        self::markTestSkipped();
    }

    public function testSetEmptyStringValue(): void
    {
        self::markTestSkipped();
    }

    public function testSetNullValue(): void
    {
        self::markTestSkipped();
    }

    public function testSetValueFromClosureWithDisabledMultilingual(): void
    {
        self::markTestSkipped();
    }

    public function testSetSelectedOptionWithoutDeclaredOptions(): void
    {
        $html = $this->getComponent()->name('id')->selected('id', 1)->toHtml();
        self::assertStringContainsString('<select', $html);
    }

    public function testSetSelectedOptionFromWrongTypeValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $users = $this->createMultipleUsers(2);
        $this->getComponent()->name('id')
            ->options($users, 'id', 'name')
            ->selected('id', ['test'])
            ->toHtml();
    }

    public function testSetSelectedOptionFromValue(): void
    {
        $users = $this->createMultipleUsers(2);
        $user = null;
        $html = $this->getComponent()
            ->model($user)
            ->name('id')
            ->options($users, 'id', 'name')
            ->selected('id', $users->get(1)->id)
            ->toHtml();
        self::assertStringContainsString(
            '<option value="">validation.attributes.id</option>',
            $html
        );
        self::assertStringContainsString(
            '<option value="' . $users[0]['id'] . '">' . $users[0]['name'] . '</option>',
            $html
        );
        self::assertStringContainsString(
            '<option value="' . $users[1]['id'] . '" selected="selected">' . $users[1]['name'] . '</option>',
            $html
        );
    }

    public function testSetSelectedOptionFromLabel(): void
    {
        $users = $this->createMultipleUsers(2);
        $user = null;
        $html = $this->getComponent()
            ->model($user)
            ->name('name')
            ->options($users, 'name', 'name')
            ->selected('name', $users->get(1)->name)
            ->toHtml();
        self::assertStringContainsString(
            '<option value="">validation.attributes.name</option>',
            $html
        );
        self::assertStringContainsString(
            '<option value="' . $users[0]['name'] . '">' . $users[0]['name'] . '</option>',
            $html
        );
        self::assertStringContainsString(
            '<option value="' . $users[1]['name'] . '" selected="selected">' . $users[1]['name'] . '</option>',
            $html
        );
    }

    public function testNotSelected(): void
    {
        $users = $this->createMultipleUsers(2);
        $html = $this->getComponent()
            ->name('id')
            ->options($users, 'id', 'name')
            ->toHtml();
        self::assertStringContainsString(
            '<option value="" selected="selected">validation.attributes.id</option>',
            $html
        );
        self::assertStringContainsString(
            '<option value="' . $users[0]['id'] . '">' . $users[0]['name'] . '</option>',
            $html
        );
        self::assertStringContainsString(
            '<option value="' . $users[1]['id'] . '">' . $users[1]['name'] . '</option>',
            $html
        );
    }

    public function testOldValue(): void
    {
        $users = $this->createMultipleUsers(3);
        $custom = $users->get(0);
        $model = $users->get(1);
        $old = $users->get(2);
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($old) {
                $request = request()->merge(['name' => (string) $old->id]);
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
        self::assertStringContainsString(
            '<option value="' . $custom->id . '">' . $custom->name . '</option>',
            $html
        );
        self::assertStringContainsString(
            '<option value="' . $model->id . '">' . $model->name . '</option>',
            $html
        );
        self::assertStringContainsString(
            '<option value="' . $old->id . '" selected="selected">' . $old->name . '</option>',
            $html
        );
    }

    public function testOldArrayValue(): void
    {
        $users = $this->createMultipleUsers(3);
        $custom = $users->get(0);
        $model = $users->get(1);
        $old = $users->get(2);
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($old) {
                $request = request()->merge(['name' => [0 => (string) $old->id]]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()
            ->model($model)
            ->name('name[0]')
            ->selected('id', $custom->id)
            ->options($users, 'id', 'name')
            ->toHtml();
        self::assertStringContainsString(
            '<option value="' . $custom->id . '">' . $custom->name . '</option>',
            $html
        );
        self::assertStringContainsString(
            '<option value="' . $model->id . '">' . $model->name . '</option>',
            $html
        );
        self::assertStringContainsString(
            '<option value="' . $old->id . '" selected="selected">' . $old->name . '</option>',
            $html
        );
    }

    public function testSetDisabledOptions(): void
    {
        $users = $this->createMultipleUsers(3);
        $users->first()->update(['active' => false]);
        $html = $this->getComponent()
            ->name('name')
            ->options($users, 'id', 'name')
            ->disabled(function (array $option) {
                return ! $option['active'];
            })
            ->toHtml();
        foreach ($users as $user) {
            if ($user->active) {
                self::assertStringContainsString(
                    '<option value="' . $user->id . '">' . $user->name . '</option>',
                    $html
                );
            } else {
                self::assertStringContainsString(
                    '<option value="' . $user->id . '" disabled>' . $user->name . '</option>',
                    $html
                );
            }
        }
    }

    public function testSetMultiple(): void
    {
        $companies = $this->createMultipleCompanies(5);
        $html = $this->getComponent()->name('companies')->options($companies, 'id', 'name')->multiple()->toHtml();
        self::assertStringContainsString('companies[]', $html);
        self::assertStringContainsString('multiple>', $html);
    }

    public function testSelectMultipleWithModelAndNonExistentAttribute(): void
    {
        $user = $this->createUniqueUser();
        $companies = $this->createMultipleCompanies(5);
        $user->companies = $companies->take(2)->pluck('id')->toArray();
        $html = $this->getComponent()->name('wrong')
            ->model($user)
            ->options($companies, 'id', 'name')
            ->multiple()
            ->toHtml();
        self::assertStringContainsString(
            '<option value="" selected="selected">validation.attributes.wrong</option>',
            $html
        );
        foreach ($companies as $company) {
            self::assertStringContainsString(
                '<option value="' . $company->id . '">' . $company->name . '</option>',
                $html
            );
        }
    }

    public function testSelectMultipleWithModelAndWrongAttributeType(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $user = $this->createUniqueUser();
        $companies = $this->createMultipleCompanies(5);
        $user->companies = $companies->take(2)->pluck('id');
        $this->getComponent()->name('companies')->model($user)->options($companies, 'id', 'name')->multiple()->toHtml();
    }

    public function testSelectedMultipleFromModelEmptyValue(): void
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
        self::assertStringContainsString(
            '<option value="" selected="selected">validation.attributes.companies</option>',
            $html
        );
        foreach ($companies as $company) {
            self::assertStringContainsString(
                '<option value="' . $company->id . '">' . $company->name . '</option>',
                $html
            );
        }
    }

    public function testSelectedMultipleFromModelValue(): void
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
        self::assertStringContainsString(
            '<option value="">validation.attributes.companies</option>',
            $html
        );
        foreach ($companies as $company) {
            self::assertStringContainsString(
                '<option value="' . $company->id . '"'
                . (in_array($company->id, $user->companies, true) ? ' selected="selected"' : '') . '>'
                . $company->name
                . '</option>',
                $html
            );
        }
    }

    public function testSetSelectedMultipleOptionsFromEmptyValue(): void
    {
        $companies = $this->createMultipleCompanies(5);
        $html = $this->getComponent()
            ->name('companies')
            ->options($companies, 'id', 'name')
            ->multiple()
            ->selected('id', [])
            ->toHtml();
        self::assertStringContainsString(
            '<option value="" selected="selected">validation.attributes.companies</option>',
            $html
        );
        foreach ($companies as $company) {
            self::assertStringContainsString(
                '<option value="' . $company->id . '">' . $company->name . '</option>',
                $html
            );
        }
    }

    public function testSetSelectedMultipleOptionsFromWrongTypeValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $companies = $this->createMultipleCompanies(5);
        $this->getComponent()->name('companies')
            ->options($companies, 'id', 'name')
            ->multiple()
            ->selected('id', 'test')
            ->toHtml();
    }

    public function testSetSelectedMultipleOptionsFromValue(): void
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
        self::assertStringContainsString(
            '<option value="">validation.attributes.companies</option>',
            $html
        );
        foreach ($companies as $company) {
            self::assertStringContainsString(
                '<option value="' . $company->id . '"'
                . (in_array($company->id, $selectedCompanies, true) ? ' selected="selected"' : '') . '>'
                . $company->name
                . '</option>',
                $html
            );
        }
    }

    public function testSetSelectedMultipleOptionsFromLabel(): void
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
        self::assertStringContainsString(
            '<option value="">validation.attributes.companies</option>',
            $html
        );
        foreach ($companies as $company) {
            self::assertStringContainsString(
                '<option value="' . $company->id . '"'
                . (in_array($company->name, $selectedCompanies, true) ? ' selected="selected"' : '') . '>'
                . $company->name
                . '</option>',
                $html
            );
        }
    }

    public function testOldMultipleValue(): void
    {
        $user = $this->createUniqueUser();
        $companies = $this->createMultipleCompanies(6);
        $chunk = $companies->pluck('id')->chunk(2)->toArray();
        $user->companies = $chunk[0];
        $selectedCompanies = $chunk[1];
        $oldCompanies = array_map(static fn($id) => (string) $id, $chunk[2]);
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
        self::assertStringContainsString(
            '<option value="">validation.attributes.companies</option>',
            $html
        );
        foreach ($companies as $company) {
            self::assertStringContainsString(
                '<option value="' . $company->id . '"'
                . (in_array((string) $company->id, $oldCompanies, true) ? ' selected="selected"' : '') . '>'
                . $company->name
                . '</option>',
                $html
            );
        }
    }

    public function testOldMultipleArrayValue(): void
    {
        $user = $this->createUniqueUser();
        $companies = $this->createMultipleCompanies(6);
        $chunk = $companies->pluck('id')->chunk(2)->toArray();
        $user->companies = $chunk[0];
        $selectedCompanies = $chunk[1];
        $oldCompanies = array_map(static fn($id) => (string) $id, $chunk[2]);
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldCompanies) {
                $request = request()->merge(['companies' => [0 => $oldCompanies]]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('companies[0]')
            ->model($user)
            ->options($companies, 'id', 'name')
            ->multiple()
            ->selected('id', $selectedCompanies)
            ->toHtml();
        self::assertStringContainsString(
            '<option value="">validation.attributes.companies</option>',
            $html
        );
        foreach ($companies as $company) {
            self::assertStringContainsString(
                '<option value="' . $company->id . '"'
                . (in_array((string) $company->id, $oldCompanies, true) ? ' selected="selected"' : '') . '>'
                . $company->name
                . '</option>',
                $html
            );
        }
    }

    public function testSetCustomLabelPositionedAbove(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<select');
        self::assertLessThan($labelPosition, $inputPosition);
    }

    public function testSetLabelPositionedAboveReplacesDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->labelPositionedAbove()->toHtml();
        $labelPosition = strrpos($html, '<label for="');
        $inputPosition = strrpos($html, '<select');
        self::assertLessThan($inputPosition, $labelPosition);
    }

    public function testDefaultPlaceholder(): void
    {
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString(
            '<option value="" selected="selected">validation.attributes.name</option>',
            $html
        );
    }

    public function testDefaultPlaceholderWithArrayName(): void
    {
        $html = $this->getComponent()->name('name[0]')->toHtml();
        self::assertStringContainsString(
            '<option value="" selected="selected">validation.attributes.name</option>',
            $html
        );
    }

    public function testSetPlaceholder(): void
    {
        $placeholder = 'custom-placeholder';
        $html = $this->getComponent()->name('name')->placeholder($placeholder)->toHtml();
        self::assertStringContainsString(
            '<option value="" selected="selected">' . $placeholder . '</option>',
            $html
        );
    }

    public function testSetPlaceholderWithLabel(): void
    {
        $label = 'custom-label';
        $placeholder = 'test-custom-placeholder';
        $html = $this->getComponent()->name('name')->label($label)->placeholder($placeholder)->toHtml();
        self::assertStringContainsString(
            '<option value="" selected="selected">' . $placeholder . '</option>',
            $html
        );
    }

    public function testNoPlaceholderWithLabel(): void
    {
        $label = 'custom-label';
        $html = $this->getComponent()->name('name')->label($label)->toHtml();
        self::assertStringContainsString(
            '<option value="" selected="selected">' . $label . '</option>',
            $html
        );
        self::assertStringNotContainsString(
            '<option value="" selected="selected">validation.attributes.name</option>',
            $html
        );
    }

    public function testNoPlaceholderWithNoLabel(): void
    {
        $html = $this->getComponent()->name('name')->label(null)->toHtml();
        self::assertStringContainsString(
            '<option value="" selected="selected">validation.attributes.name</option>',
            $html
        );
    }

    public function testHidePlaceholder(): void
    {
        $html = $this->getComponent()->name('name')->placeholder(false)->toHtml();
        self::assertStringNotContainsString(
            '<option value="" selected="selected">',
            $html
        );
    }

    public function testDefaultComponentId(): void
    {
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString(' for="' . $this->getComponentType() . '-name"', $html);
        self::assertStringContainsString('<select id="' . $this->getComponentType() . '-name"', $html);
    }

    public function testDefaultComponentIdWithArrayName(): void
    {
        $html = $this->getComponent()->name('name[0]')->toHtml();
        self::assertStringContainsString(' for="' . $this->getComponentType() . '-name-0"', $html);
        self::assertStringContainsString('<select id="' . $this->getComponentType() . '-name-0"', $html);
    }

    public function testDefaultComponentIdFormatting(): void
    {
        $html = $this->getComponent()->name('camelCaseName')->toHtml();
        self::assertStringContainsString(' for="' . $this->getComponentType() . '-camel-case-name"', $html);
        self::assertStringContainsString('<select id="' . $this->getComponentType() . '-camel-case-name"', $html);
    }

    public function testSetComponentId(): void
    {
        $customComponentId = 'test-custom-component-id';
        $html = $this->getComponent()->name('name')->componentId($customComponentId)->toHtml();
        self::assertStringContainsString(' for="' . $customComponentId . '"', $html);
        self::assertStringContainsString('<select id="' . $customComponentId . '"', $html);
    }

    public function testSetCustomComponentClasses(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString('class="component custom-select default component classes"', $html);
    }

    public function testSetComponentClassesMergedToDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->componentClasses(['with', 'merged'])->toHtml();
        self::assertStringContainsString(
            'class="component custom-select default component classes with merged"',
            $html
        );
    }

    public function testSetComponentClassesReplacesDefault(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()
            ->name('name')
            ->componentClasses(['custom', 'component', 'classes'], true)
            ->toHtml();
        self::assertStringContainsString('class="component custom-select custom component classes"', $html);
    }
}
