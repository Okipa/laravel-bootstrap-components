# Upgrade from v1 to v2

The v2 is a major rewrite of a big part of the package.

Follow the steps below to upgrade the package.

## New components exposition

Components are now exposed with renamed helpers and new facades.

You will have to update the helper calls with the new helper signatures.

**Form components**

* `bsText()` => `inputText()`
* `bsEmail()` => `inputEmail()`
* `bsPassword()` => `inputPassword()`
* `bsUrl()` => `inputUrl()`
* `bsTel()` => `inputTel()`
* `bsNumber()` => `inputNumber()`
* `bsColor()` => `inputColor()`
* `bsDate()` => `inputDate()`
* `bsTime()` => `inputTime()`
* `bsDatetime()` => `inputDatetime()`
* `bsFile()` => `inputFile()`
* `bsCheckbox()` => `inputCheckbox()`
* `bsToggle()` => `inputToggle()`
* `bsRadio()` => `inputRadio()`
* `bsTextarea()` => `textarea()`
* `bsSelect()` => `select()`

**Button components**

* `bsCreate()` => `submitCreate()`
* `bsUpdate()` => `submitUpdate()`
* `bsValidate()` => `submitValidate()`
* `bsBack()` => `buttonBack()`
* `bsCancel()` => `buttonCancel()`

If you wish to use the new available facades, please refer to [the documentation](../../docs/api/components.md).

## Components behaviour updated

* The `Select` component placeholder is not disabled anymore in order to allow user to disable a selection.

## Validation status helper removed
   
The `validationStatus()` helper has been removed.

Check if you use it in your project and update your code accordingly.

## Configuration file restructured

The configuration file has been restructured, you will have to [re-publish it](../../README.md#configuration).

## Templates updated

The view templates provided with this package have been updated.

If you have published the views in order to make some customizations, you will have to [re-publish them](../../README.md#templates) and to redo your customizations.

## New multilingual features

The following components are now handling multilingual features.

* [Input text](../../docs/api/components.md#input-text)
* [Textarea](../../docs/api/components.md#textarea)

## New components

Missing button components are now available.

* [Submit](../../docs/api/components.md#submit)
* [Button](../../docs/api/components.md#button)
* [Button link](../../docs/api/components.md#button-link)

## See all changes

See all change with the [comparison tool](https://github.com/Okipa/laravel-bootstrap-components/compare/1.0.10...2.0.0).

## Undocumented changes

If you see any forgotten and undocumented change, please submit a PR to add them to this upgrade guide.
