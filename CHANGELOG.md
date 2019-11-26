# Changelog

## [1.0.10](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/1.0.10)

2019-11-26

- Changed signature of `->displaySuccess()` form components to `public function displaySuccess(?bool $displaySuccess = true): self`.
- Changed signature of `->displayFailure()` form components to `public function displayFailure(?bool $displaySuccess = true): self`.
- Calling `->displaySuccess()` does not have an incidence on the `is-valid` class application : if set to false, the `is-valid` class will not be added even if the form is in success.
- Calling `->displayFailure()` does not have an incidence on the `is-invalid` class application : if set to false, the `is-invalid` class will not be added even if the form is in failure.
- removed internal `validationStatus()` helper.

## [1.0.9](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/1.0.9)

2019-10-22

- Form components error message can now display HTML.

## [1.0.8](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/1.0.8)

2019-10-15

- Fixed the translations publication and overriding as specified on the Laravel documentation : https://laravel.com/docs/packages#translations.
- Changed the command to publish the translations to : `php artisan vendor:publish --tag=bootstrap-components:translations`
- Changed the command to publish the configuration to : `php artisan vendor:publish --tag=bootstrap-components:config`
- Changed the command to publish the views to : `php artisan vendor:publish --tag=bootstrap-components:views`
- Improved testing with Travis CI (added some tests with `--prefer-lowest` composer tag to check the package compatibility with the lowest dependencies versions).

## [1.0.7](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/1.0.7)

2019-10-08

- Improved static analysis by updating return types and PHPDocs.
- Transferred PhpUnit builds tasks from Scrutinizer to Travis CI.
- Transferred code coverage storage from Scrutinizer to Coveralls.
- Re-authorized PHP7.1 as minimal version.

## [1.0.6](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/1.0.6)

2019-10-03

- Fixed missing translation for titles on buttons components.

## [1.0.5](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/1.0.5)

2019-09-10

- Fixed missing default remove-checkbox-label-translation.

## [1.0.4](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/1.0.4)

2019-09-05

- Fixed wrong use of https://github.com/Okipa/laravel-html-helper. Tests added to avoid regression.

## [1.0.3](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/1.0.3)

2019-09-05

- Fixed missing `bootstrap-components::` prefix for default config translations.

## [1.0.2](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/1.0.2)

2019-09-05

- Fixed missing labels, legends and placeholders translations on components.
- Added some tests to avoid regression issues about translated label, legends and placeholders.

## [1.0.1](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/1.0.1)

2019-09-05

- Fixed wrong label and legend translation process.

## [1.0.0](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/1.0.0)

2019-09-04

- First stable release.

## [0.10.0](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/0.10.0)

2019-09-04

- Added compatibility for Laravel 6.

## [0.9.3](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/0.9.3)

2019-09-04

- Fixed default config for `bsDate()` component => the default format has been corrected to `Y-m-d`, in order to respect the `date` input type standards.

## [0.9.2](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/0.9.2)

2019-09-03

- Fixed default config for `bsDatetime()` component => the default format has been corrected to `Y-m-d\TH:i`, in order to respect the `datetime-local` input type standards.

## [0.9.1](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/0.9.1)

2019-08-26

- Fixed html generation after https://github.com/Okipa/laravel-html-helper upgrade.

## [0.9.0](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/0.9.0)

2019-06-13
  
:warning: **Breaking changes** :warning:
- Added the possibility to choose the label positioning (above or under the input) for the `Form` components, except `bsCheckbox()`, `bsToggle()` and `bsRadio()`.
  - Those components label positioning is now handled with the `->labelPositionedAbove(bool $positionedAbove = true): self` method.
  - The default value is set here `config('bootstrap-components.[componentConfigKey].labelPositionedAbove')`.
  - This feature has been added in order to facilitate the Bootstrap 4 floating label implementation : https://getbootstrap.com/docs/4.3/examples/floating-labels.
  - Each concerned `Form` component has now the following added config values (add it in your published `config/bootstrap-components.php` file) :
  ```php
  // example
  'form' => [
      'text' => [
          // ...
          'labelPositionedAbove' => true, // add this config
      ], 
      // other components config
  ],
  ```
- Replaced `class` key by `classes` in the `config/bootstrap-components.php` file, so make sure you searched and replaced this key in your published config file.

## [0.8.3](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/0.8.3)

2019-05-24

- Fixed `bsRadio()` component, which was not really ready to use until now.

## [0.8.2](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/0.8.2)

2019-05-24

- Fixed `Form` components issue : `0` value was considered as no value at all.

## [0.8.1](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/0.8.1)

2019-05-20
  
- Fixed `bsSelect()` placeholder disappearing when the label is hidden (`->label(false)`).

## [0.8.0](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/0.8.0)

2019-05-09
  
:warning: **Breaking changes** :warning:
- Locked project compatibility to Laravel 5.5+ and PHP7.2+ to avoid issues.
- Replaced `->containerClass()` method by `->containerClasses()`.
- Replaced `->componentClass()` method by `->componentClasses()`.

## [0.7.0](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/0.7.0)

2019-05-02
  
:warning: **Breaking changes** :warning:
- Replaced `->icon()` method by `->prepend()` for `Button` and `Form` components.
- Added `->append()` for `Button` and `Form` components.
- Removed `->hideIcon()` method for `Button` and `Form` components. Hiding a prepended or appended html element can now be done with `->prepend(false)` or `->append(false)`.
- Removed `->hideLabel()` method for `Button` and `Form` components. Hiding a label can now be done with `->label(false)`.
- Removed `->hideLegend()` method for `Form` components. Hiding a legend can now be done with `->legend(false)`.
- Added possibility to hide placeholder value with `->placeholder(false)` for `Form` components.
- Added possibility to choose for all `Form` components if the the success / error status should be displayed or not after a form submission.
  - Each `Form` component has now the following added config values (add it in your published `config/bootstrap-components.php` file) :
  ```php
  // example
  'form'   => [
      'text'     => [
          // ...
          'formValidation' => [
              'displaySuccess' => false,
              'displayFailure' => true,
          ], // add this config
      ],
      // other components config
  ],
  ```
  - The default behavior can be set with the `config('bootstrap-components.[componentConfigKey].formValidation.displaySuccess')` and `config('bootstrap-components.[componentConfigKey].formValidation.displayFailure')` and a custom behaviour can be set with the `->displaySuccess()` and `->displayFailure()` methods on each of those components.
- Replace `html_attributes` config key by `htmlAttributes`.

## [0.6.1](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/0.6.1)

2019-04-30
 
- Updated `bsToggle()` default style to fix the default component background color since bootstrap `$custom-control-indicator-bg` sass variable has now `white` for value.

## [0.5.9](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/0.5.9)

2019-01-28
 
- Refactored form classes to improve maintainability.
- Updated the `showRemoveCheckbox()` from the `bsFile()` component in order the provide a default translation for the remove checkbox label. The component does now accept the following arguments : `bool $showed = true` and `  - string $removeCheckboxLabel = null`.
  - **Important :** You should now add the new `bootstrap-components.label.remove` translation if you have published the translations files.

## [0.5.8](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/0.5.8)

2018-12-11
 
- Added the [bsNumber()](https://github.com/Okipa/laravel-bootstrap-components#bsnumber) component (thanks to [Daniel Lucas](https://github.com/daniel-chris-lucas) !).

## [0.5.7](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/0.5.7)

2018-11-27
 
- Fixed the publish path so that Laravel can find the customized published views.

## [0.5.6](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/0.5.6)

2018-11-14

- Updated components examples in the readme doc to improve comprehension.
- Added the [bsColor](https://github.com/Okipa/laravel-bootstrap-components#bscolor) component.
  - **Important :** You should now add the new `bsColor` component config in your `config/bootstrap-components.php` file.
```php
// add these lines after the `email` config
'color' => [
    'view'            => 'bootstrap-components.form.input',
    'icon'            => '<i class="fas fa-palette"></i>',
    'legend'          => null,
    'classes'           => [
        'container' => ['form-group'],
        'component' => [],
    ],
    'html_attributes' => [
        'container' => [],
        'component' => [],
    ],
],
```

## [0.5.5](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/0.5.5)

2018-11-08

- Adjusted the `bsToggle` style to vertically center the label whatever its size or its number of lines.

## [0.5.4](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/0.5.4)

2018-11-08

- Updated the `bsToggle` component style to fix display for long labels on mobile screens (when label is displayed on more than one line). This component does now behave as the `bsCheckbox` component.

## [0.5.3](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/0.5.3)

2018-10-26

- Updated the `bsDatetime`, `bsDate` and `bsTime` default legend translations.

## [0.5.2](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/0.5.2)

2018-10-26

- Added the [bsTime()](https://github.com/Okipa/laravel-bootstrap-components#bstime) component.

## [0.5.1](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/0.5.1)

2018-10-25

- Added the missing implementation to set an icon for the `bsCheckbox`, `bsRadio` and `bsToggle` components :
  - **Important :** The listed components bellow should now have a config `icon` line with `null` as value by default, authorizing you to define a default icon for all those components.
```php
// the bsToggle component should now look like this
'toggle'   => [
    'view'            => 'bootstrap-components.form.toggle',
    'icon'            => null, // => add this line
    'legend'          => null,
    'classes'           => [
        'container' => ['form-group'],
        'component' => [],
    ],
    'html_attributes' => [
        'container' => [],
        'component' => [],
    ]
]
```

## [0.5.0](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/0.5.0)

2018-09-26

- Fixed the `->componentId()` method call for form components, which didn't update the associated label `for=""` tag content.

## [0.4.9](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/0.4.9)

2018-09-12

- Setting a custom label has does now also replace the default placeholder. If a custom placeholder is also set, this custom placeholder will be shown instead of the custom label.

## [0.4.8](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/0.4.8)

2018-09-11

- Added possibility to set custom ids with the methods `containerId()` and `->componentId()` for all components :
  - Form components, which have a default id, will have it replaced by the custom defined id.
  - Other components that have no default id will have no id, unless you define it.
