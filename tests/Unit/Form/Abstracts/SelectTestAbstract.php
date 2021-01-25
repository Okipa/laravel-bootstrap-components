<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts;

use InvalidArgumentException;
use Okipa\LaravelBootstrapComponents\Tests\Fakers\CompaniesFaker;

abstract class SelectTestAbstract extends InputTestAbstract
{
    use CompaniesFaker;

    /** @test */
    public function it_has_correct_type(): void
    {
        $html = $this->getComponent()->name('id')->toHtml();
        self::assertStringContainsString('<select', $html);
    }

    /** @test */
    public function it_can_set_no_option(): void
    {
        $html = $this->getComponent()->name('id')->toHtml();
        self::assertStringContainsString(
            '<option value="" selected="selected">validation.attributes.id</option>',
            $html
        );
    }

    /** @test */
    public function it_can_set_options_from_array(): void
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

    /** @test */
    public function it_cant_set_options_from_array_with_wrong_option_value_field(): void
    {
        $optionsList = [
            ['id' => 1, 'name' => $this->faker->word],
            ['id' => 2, 'name' => $this->faker->word],
        ];
        $this->expectException(InvalidArgumentException::class);
        $this->getComponent()->name('id')->options($optionsList, 'wrong', 'name')->toHtml();
    }

    /** @test */
    public function it_cant_set_options_from_array_with_wrong_option_label_field(): void
    {
        $optionsList = [
            ['id' => 1, 'name' => $this->faker->word],
            ['id' => 2, 'name' => $this->faker->word],
        ];
        $this->expectException(InvalidArgumentException::class);
        $this->getComponent()->name('id')->options($optionsList, 'id', 'wrong')->toHtml();
    }

    /** @test */
    public function it_can_set_options_from_models_collection(): void
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

    /** @test */
    public function it_can_set_options_from_models_collection_with_wrong_option_value_field(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $users = $this->createMultipleUsers(2);
        $this->getComponent()->name('id')->options($users, 'wrong', 'name')->toHtml();
    }

    /** @test */
    public function it_can_set_options_from_models_collection_with_wrong_option_label_field(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $users = $this->createMultipleUsers(2);
        $this->getComponent()->name('name')->options($users, 'id', 'wrong')->toHtml();
    }

    /** @test */
    public function it_can_get_value_from_model(): void
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

    /** @test */
    public function it_can_set_value(): void
    {
        self::markTestSkipped();
    }

    /** @test */
    public function it_can_set_zero_value(): void
    {
        self::markTestSkipped();
    }

    /** @test */
    public function it_can_set_empty_string_value(): void
    {
        self::markTestSkipped();
    }

    /** @test */
    public function it_can_set_null_value(): void
    {
        self::markTestSkipped();
    }

    /** @test */
    public function it_can_set_value_from_closure_with_disabled_multilingual(): void
    {
        self::markTestSkipped();
    }

    /** @test */
    public function it_can_set_selected_option_with_no_option(): void
    {
        $html = $this->getComponent()->name('id')->selected('id', 1)->toHtml();
        self::assertStringContainsString('<select', $html);
    }

    /** @test */
    public function it_cant_set_selected_option_from_wrong_type_value(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $users = $this->createMultipleUsers(2);
        $this->getComponent()->name('id')
            ->options($users, 'id', 'name')
            ->selected('id', ['test'])
            ->toHtml();
    }

    /** @test */
    public function it_can_set_selected_options_from_value(): void
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

    /** @test */
    public function it_can_set_selected_options_from_label(): void
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

    /** @test */
    public function it_can_set_no_selected_option(): void
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

    /** @test */
    public function it_can_take_old_value_from_string(): void
    {
        $users = $this->createMultipleUsers(3);
        $custom = $users->get(0);
        $model = $users->get(1);
        $old = $users->get(2);
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['name' => (string) $old->id])->flash(),
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

    /** @test */
    public function it_can_take_old_value_from_null(): void
    {
        $users = $this->createMultipleUsers(3);
        $custom = $users->get(0);
        $model = $users->get(1);
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['name' => null])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()
            ->model($model)
            ->name('name')
            ->selected('id', $custom->id)
            ->options($users, 'id', 'name')
            ->toHtml();
        self::assertStringContainsString(
            '<option value="" selected="selected">validation.attributes.name</option>',
            $html
        );
        self::assertStringContainsString(
            '<option value="' . $custom->id . '">' . $custom->name . '</option>',
            $html
        );
        self::assertStringContainsString(
            '<option value="' . $model->id . '">' . $model->name . '</option>',
            $html
        );
    }

    /** @test */
    public function it_can_take_old_value_from_array(): void
    {
        $users = $this->createMultipleUsers(3);
        $custom = $users->get(0);
        $model = $users->get(1);
        $old = $users->get(2);
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['name' => [0 => (string) $old->id]])->flash(),
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

    /** @test */
    public function it_can_disable_options(): void
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

    /** @test */
    public function it_can_set_multiple_mode(): void
    {
        $companies = $this->createMultipleCompanies(5);
        $html = $this->getComponent()->name('companies')->options($companies, 'id', 'name')->multiple()->toHtml();
        self::assertStringContainsString('companies[]', $html);
        self::assertStringContainsString('multiple>', $html);
    }

    /** @test */
    public function it_can_select_multiple_options_with_model_and_non_existent_attribute(): void
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

    /** @test */
    public function it_cant_select_multiple_options_with_model_and_wrong_attribute_type(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $user = $this->createUniqueUser();
        $companies = $this->createMultipleCompanies(5);
        $user->companies = $companies->take(2)->pluck('id');
        $this->getComponent()->name('companies')->model($user)->options($companies, 'id', 'name')->multiple()->toHtml();
    }

    /** @test */
    public function it_can_select_multiple_options_from_model_empty_value(): void
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

    /** @test */
    public function it_can_select_multiple_options_from_model_value(): void
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

    /** @test */
    public function it_can_set_selected_multiple_options_from_empty_value(): void
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

    /** @test */
    public function it_cant_set_selected_multiple_options_from_wrong_type_value(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $companies = $this->createMultipleCompanies(5);
        $this->getComponent()->name('companies')
            ->options($companies, 'id', 'name')
            ->multiple()
            ->selected('id', 'test')
            ->toHtml();
    }

    /** @test */
    public function it_cant_set_selected_multiple_options_from_value(): void
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

    /** @test */
    public function it_cant_set_selected_multiple_options_from_label(): void
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

    /** @test */
    public function it_can_take_old_multiple_values(): void
    {
        $user = $this->createUniqueUser();
        $companies = $this->createMultipleCompanies(6);
        $chunk = $companies->pluck('id')->chunk(2)->toArray();
        $user->companies = $chunk[0];
        $selectedCompanies = $chunk[1];
        $oldCompanies = array_map(static fn($id) => (string) $id, $chunk[2]);
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['companies' => $oldCompanies])->flash(),
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

    /** @test */
    public function it_can_take_old_multiple_null_values(): void
    {
        $user = $this->createUniqueUser();
        $companies = $this->createMultipleCompanies(6);
        $chunk = $companies->pluck('id')->chunk(2)->toArray();
        $user->companies = $chunk[0];
        $selectedCompanies = $chunk[1];
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['companies' => null])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('companies')
            ->model($user)
            ->options($companies, 'id', 'name')
            ->multiple()
            ->selected('id', $selectedCompanies)
            ->toHtml();
        self::assertStringContainsString(
            '<option value="" selected="selected">validation.attributes.companies</option>',
            $html
        );
        foreach ($companies as $company) {
            self::assertStringContainsString(
                '<option value="' . $company->id . '"' . '>' . $company->name . '</option>',
                $html
            );
        }
    }

    /** @test */
    public function it_can_take_old_multiple_array_values(): void
    {
        $user = $this->createUniqueUser();
        $companies = $this->createMultipleCompanies(6);
        $chunk = $companies->pluck('id')->chunk(2)->toArray();
        $user->companies = $chunk[0];
        $selectedCompanies = $chunk[1];
        $oldCompanies = array_map(static fn($id) => (string) $id, $chunk[2]);
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['companies' => [0 => $oldCompanies]])->flash(),
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

    /** @test */
    public function it_can_set_default_label_positioned_above_from_component_config(): void
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

    /** @test */
    public function it_can_replace_label_positioned_above(): void
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

    /** @test */
    public function it_can_generate_default_placeholder_from_string_name(): void
    {
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString(
            '<option value="" selected="selected">validation.attributes.name</option>',
            $html
        );
    }

    /** @test */
    public function it_can_generate_default_placeholder_from_array_name(): void
    {
        $html = $this->getComponent()->name('name[0]')->toHtml();
        self::assertStringContainsString(
            '<option value="" selected="selected">validation.attributes.name</option>',
            $html
        );
    }

    /** @test */
    public function it_can_replace_default_placeholder(): void
    {
        $placeholder = 'custom-placeholder';
        $html = $this->getComponent()->name('name')->placeholder($placeholder)->toHtml();
        self::assertStringContainsString(
            '<option value="" selected="selected">' . $placeholder . '</option>',
            $html
        );
    }

    /** @test */
    public function it_can_replace_default_placeholder_with_specific_label(): void
    {
        $label = 'custom-label';
        $placeholder = 'test-custom-placeholder';
        $html = $this->getComponent()->name('name')->label($label)->placeholder($placeholder)->toHtml();
        self::assertStringContainsString(
            '<option value="" selected="selected">' . $placeholder . '</option>',
            $html
        );
    }

    /** @test */
    public function it_can_generate_default_placeholder_with_specific_label(): void
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

    /** @test */
    public function it_can_generate_default_placehoder_with_hidden_label(): void
    {
        $html = $this->getComponent()->name('name')->label(null)->toHtml();
        self::assertStringContainsString(
            '<option value="" selected="selected">validation.attributes.name</option>',
            $html
        );
    }

    /** @test */
    public function it_can_hide_placeholder(): void
    {
        $html = $this->getComponent()->name('name')->placeholder(false)->toHtml();
        self::assertStringNotContainsString(
            '<option value="" selected="selected">',
            $html
        );
    }

    /** @test */
    public function it_can_generate_default_component_id(): void
    {
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString(' for="' . $this->getComponentType() . '-name"', $html);
        self::assertStringContainsString('<select id="' . $this->getComponentType() . '-name"', $html);
    }

    /** @test */
    public function it_can_generate_default_component_id_from_array_name(): void
    {
        $html = $this->getComponent()->name('name[0]')->toHtml();
        self::assertStringContainsString(' for="' . $this->getComponentType() . '-name-0"', $html);
        self::assertStringContainsString('<select id="' . $this->getComponentType() . '-name-0"', $html);
    }

    /** @test */
    public function it_can_generate_default_component_id_from_string_name_with_specific_format(): void
    {
        $html = $this->getComponent()->name('camelCaseName')->toHtml();
        self::assertStringContainsString(' for="' . $this->getComponentType() . '-camel-case-name"', $html);
        self::assertStringContainsString('<select id="' . $this->getComponentType() . '-camel-case-name"', $html);
    }

    /** @test */
    public function it_can_set_component_id(): void
    {
        $customComponentId = 'test-custom-component-id';
        $html = $this->getComponent()->name('name')->componentId($customComponentId)->toHtml();
        self::assertStringContainsString(' for="' . $customComponentId . '"', $html);
        self::assertStringContainsString('<select id="' . $customComponentId . '"', $html);
    }

    /** @test */
    public function it_can_set_default_component_classes_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->toHtml();
        self::assertStringContainsString('class="component custom-select default component classes"', $html);
    }

    /** @test */
    public function it_can_merge_component_classes_to_default(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->componentClasses(['merged'], true)->toHtml();
        self::assertStringContainsString('class="component custom-select default component classes merged"', $html);
    }

    /** @test */
    public function it_can_replace_default_component_classes(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $html = $this->getComponent()->name('name')->componentClasses(['replaced'])->toHtml();
        self::assertStringContainsString('class="component custom-select replaced"', $html);
    }
}
