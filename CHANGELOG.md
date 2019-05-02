# Changelog

## [0.7.0](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/0.7.0)
2019-01-28  
:warning: **Breaking changes** :warning:
- Replaced `->icon()` method by `->prepend()` for `Button` and `Form` components.
- Added `->append()` for `Button` and `Form` components.
- Removed `hideIcon()` method for `Button` and `Form` components. Hiding a prepended or appended html element can now be done with `->prepend(false)` or `->append(false)`.

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
    'class'           => [
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
    'class'           => [
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
