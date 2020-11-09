# Upgrade from v3 to v4

Follow the steps below to upgrade the package.

## Input toggle component replacement

Since switch component is now being natively handled by Bootstrap, this package custom input toggle component has been replaced and the related sass resources have been removed.

As so, you'll have to report the following changes:
* Replace occurrences of `InputToggle::` by `InputSwitch::`
* Replace occurrences of `inputToggle(` by `inputSwitch(`
* Remove sass import of `/vendor/okipa/laravel-bootstrap-components/resources/styles/scss/bootstrap-components` which has been removed
* Replace `toggle` by `switch` in the config file if you have published it.

## Upgraded https://github.com/Okipa/laravel-html-helper to v2

If you published the package views, you will have to follow the `laravel-html-helper` package upgrade guide to report the required changes.

## Naming changes

Some naming changes have been made to avoid conflicts with PHP reserved words. As so, you'll have to report the following changes:
* Rename occurrences of `Okipa\LaravelBootstrapComponents\Components\Buttons\Back` by `Okipa\LaravelBootstrapComponents\Components\Buttons\ButtonBack`
* Rename occurrences of `Okipa\LaravelBootstrapComponents\Components\Buttons\Cancel` by `Okipa\LaravelBootstrapComponents\Components\Buttons\ButtonCancel`
* Rename occurrences of `Okipa\LaravelBootstrapComponents\Components\Buttons\Link` by `Okipa\LaravelBootstrapComponents\Components\Buttons\ButtonLink`
* Rename occurrences of `Okipa\LaravelBootstrapComponents\Components\Buttons\Create` by `Okipa\LaravelBootstrapComponents\Components\Buttons\SubmitCreate`
* Rename occurrences of `Okipa\LaravelBootstrapComponents\Components\Buttons\Update` by `Okipa\LaravelBootstrapComponents\Components\Buttons\SubmitUpdate`
* Rename occurrences of `Okipa\LaravelBootstrapComponents\Components\Buttons\Validate` by `Okipa\LaravelBootstrapComponents\Components\Buttons\SubmitValidate`
* Rename occurrences of `Okipa\LaravelBootstrapComponents\Components\Form\Checkbox` by `Okipa\LaravelBootstrapComponents\Components\Form\InputCheckbox`
* Rename occurrences of `Okipa\LaravelBootstrapComponents\Components\Form\Color` by `Okipa\LaravelBootstrapComponents\Components\Form\InputColor`
* Rename occurrences of `Okipa\LaravelBootstrapComponents\Components\Form\Date` by `Okipa\LaravelBootstrapComponents\Components\Form\InputDate`
* Rename occurrences of `Okipa\LaravelBootstrapComponents\Components\Form\Datetime` by `Okipa\LaravelBootstrapComponents\Components\Form\InputDatetime`
* Rename occurrences of `Okipa\LaravelBootstrapComponents\Components\Form\Email` by `Okipa\LaravelBootstrapComponents\Components\Form\InputEmail`
* Rename occurrences of `Okipa\LaravelBootstrapComponents\Components\Form\File` by `Okipa\LaravelBootstrapComponents\Components\Form\InputFile`
* Rename occurrences of `Okipa\LaravelBootstrapComponents\Components\Form\Number` by `Okipa\LaravelBootstrapComponents\Components\Form\InputNumber`
* Rename occurrences of `Okipa\LaravelBootstrapComponents\Components\Form\Password` by `Okipa\LaravelBootstrapComponents\Components\Form\InputPassword`
* Rename occurrences of `Okipa\LaravelBootstrapComponents\Components\Form\Radio` by `Okipa\LaravelBootstrapComponents\Components\Form\InputRadio`
* Rename occurrences of `Okipa\LaravelBootstrapComponents\Components\Form\Toggle` by `Okipa\LaravelBootstrapComponents\Components\Form\InputSwitch`
* Rename occurrences of `Okipa\LaravelBootstrapComponents\Components\Form\Tel` by `Okipa\LaravelBootstrapComponents\Components\Form\InputTel`
* Rename occurrences of `Okipa\LaravelBootstrapComponents\Components\Form\Text` by `Okipa\LaravelBootstrapComponents\Components\Form\InputText`
* Rename occurrences of `Okipa\LaravelBootstrapComponents\Components\Form\Time` by `Okipa\LaravelBootstrapComponents\Components\Form\InputTime`
* Rename occurrences of `Okipa\LaravelBootstrapComponents\Components\Form\Url` by `Okipa\LaravelBootstrapComponents\Components\Form\InputUrl`

## Exceptions triggering changes

`\RuntimeException` is now triggered in replacement of standard `\Exception` everywhere it was setup. If you did intercept exceptions, you may want to update the intercepted exception type.

## See all changes

See all change with the [comparison tool](https://github.com/Okipa/laravel-bootstrap-components/compare/3.0.3...4.0.0).

## Undocumented changes

If you see any forgotten and undocumented change, please submit a PR to add them to this upgrade guide.
