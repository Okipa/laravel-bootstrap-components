# Upgrade from v4 to v5

Follow the steps below to upgrade the package.

## Livewire support

There was an issue preventing the error message and the validation class to be displayed on form components when they were used into a livewire component.

This was related to the fact the session was used to detect errors, which can't work with livewire as the `$errors` variable is passed in the blade view on re-rendering.

This has been fixed and the error message + the validation class are now generated from the `$errors` variable given in the view instead of the session.

## Templates update

Related to the previous point (Livewire support added), the view templates provided with this package have been updated.

If you have published the views in order to make some customizations, you will have to [re-publish them](../../README.md#templates) and to redo your customizations.

## Named validation bag support

All form components can now correctly display validation class and error message when using a named validation bag.

If you validate an email this way:

```php
Validator::make(
    ['email' => 'spoof@email.test']
    ['email' => ['required', 'string', 'email:rfc,dns,spoof']],
])->validateWithBag('profileUpdate');
```

The `is-invalid` validation class and the input related error message will correctly will be displayed when the form will be submitted with:

```blade
{{ inputEmail()->name('email')->errorBag('profileUpdate') }}
```

## Methods signature update

The following methods have gained the ability to merge given HTML classes or HTML attributes to the component default ones instead of replacing them.

To use this new behaviour, you'll just have to set the second `$mergeMode` boolean attribute to `true`.

* All components: `componentClasses`
* All components: `containerClasses`
* All components: `componentHtmlAttributes`
* All components: `containerHtmlAttributes`
* Image component: `linkClasses`
* Image component: `linkHtmlAttributes`

For example, using `inputText()->name('name')->componentClasses(['merged', 'classes'], true)` will append the `merged classes` classes to the ones defined by default on the input text component.

## Components default config update

The `autocomplete="on"` HTML attribute has been added in the default configuration of the following components, in order to improve the default behavior (see https://developer.mozilla.org/en-US/docs/Web/HTML/Attributes/autocomplete):

* Input email component
* Input password component
* Input url component

## See all changes

See all change with the [comparison tool](https://github.com/Okipa/laravel-bootstrap-components/compare/4.0.0...5.0.0).

## Undocumented changes

If you see any forgotten and undocumented change, please submit a PR to add them to this upgrade guide.
