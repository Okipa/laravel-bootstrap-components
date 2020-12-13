![Laravel Bootstrap Components](/docs/laravel-bootstrap-components.png)
<p align="center">
    <a href="https://github.com/Okipa/laravel-bootstrap-components/releases" title="Latest Stable Version">
        <img src="https://img.shields.io/github/release/Okipa/laravel-bootstrap-components.svg?style=flat-square" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/Okipa/laravel-bootstrap-components" title="Total Downloads">
        <img src="https://img.shields.io/packagist/dt/okipa/laravel-bootstrap-components.svg?style=flat-square" alt="Total Downloads">
    </a>
    <a href="https://github.com/Okipa/laravel-bootstrap-components/actions" title="Build Status">
        <img src="https://github.com/Okipa/laravel-bootstrap-components/workflows/CI/badge.svg" alt="Build Status">
    </a>
    <a href="https://coveralls.io/github/Okipa/laravel-bootstrap-components?branch=master" title="Coverage Status">
        <img src="https://coveralls.io/repos/github/Okipa/laravel-bootstrap-components/badge.svg?branch=master" alt="Coverage Status">
    </a>
    <a href="/LICENSE.md" title="License: MIT">
        <img src="https://img.shields.io/badge/License-MIT-blue.svg" alt="License: MIT">
    </a>
</p>

Save time and take advantage of a set of dynamical, ready-to-use and fully customizable bootstrap form components.

Found this package helpful? Please consider supporting my work!

[![Donate](https://img.shields.io/badge/Buy_me_a-Ko--fi-ff5f5f.svg)](https://ko-fi.com/arthurlorent)
[![Donate](https://img.shields.io/badge/Donate_on-PayPal-green.svg)](https://paypal.me/arthurlorent)

## Compatibility

| Laravel | PHP | Bootstrap | Package |
|---|---|---|---|
| ^7.0 | ^7.4 | ^4.0 | ^5.0 |
| ^7.0 | ^7.4 | ^4.0 | ^4.0 |
| ^7.0 | ^7.4 | ^4.0 | ^3.0 |
| ^5.8 | ^7.2 | ^4.0 | ^2.0 |
| ^5.5 | ^7.1 | ^4.0 | ^1.0 |

## Upgrade guide

* [From V4 to V5](/docs/upgrade-guides/from-v4-to-v5.md)
* [From V3 to V4](/docs/upgrade-guides/from-v3-to-v4.md)
* [From V2 to V3](/docs/upgrade-guides/from-v2-to-v3.md)
* [From V1 to V2](/docs/upgrade-guides/from-v1-to-v2.md)

## Usage

Just call the components you need in your views and let this package take care of the HTML generation annoying part.

### Standard use case

Call this component to display it in your blade view:

```blade
{{-- Helper style --}}
{{ inputEmail()->name('email') }}

{{-- Facade style --}}
{{ InputEmail::name('email') }}
```

![Simple input](/docs/simple-input.png)

And get this HTML generated for you:

```blade
<div class="component-container form-group">
    <label for="text-name">
        Name
    </label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fas fa-font"></i>
            </span>
        </div>
        <input id="text-name"
            class="component form-control"
            type="text"
            name="name"
            value=""
            placeholder="Name">
    </div>
</div>
```

### Multilingual use case

Call this component to display it in your blade view:

```blade
{{-- Helper style --}}
{{ inputText()->name('title')->localized(['fr', 'en']) }}

{{-- Facade style --}}
{{ InputText::name('title')->localized(['fr', 'en']) }}
```

![Simple input](/docs/localized-input.png)

And get this HTML generated for you:

```html
<div class="component-container form-group">
    <label for="text-title-fr">
        Title (FR)
    </label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fas fa-font"></i>
            </span>
        </div>
        <input id="text-title-fr"
            class="component form-control"
            type="text"
            name="title[fr]"
            value=""
            placeholder="Title (FR)"
            data-locale="fr">
    </div>
</div>
<div class="component-container form-group">
    <label for="text-title-en">
        Title (EN)
    </label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fas fa-font"></i>
            </span>
        </div>
        <input id="text-title-en"
            class="component form-control"
            type="text"
            name="title[en]"
            value=""
            placeholder="Title (EN)"
            data-locale="en">
    </div>
</div>
```

### Use with livewire

You can easily bind you inputs with a Livewire component.

```blade
{{-- Will bind this input with: wire:model.lazy="user.email" --}}
{{ inputEmail()->name('email')->model(App\Models\User::first())->wire('lazy') }}
```

## Table of Contents

* [Installation](#installation)
* [Configuration](#configuration)
* [Translations](#translations)
* [Views](#views)
* [API documentation](#api-documentation)
* [Testing](#testing)
* [Changelog](#changelog)
* [Contributing](#contributing)
* [Credits](#credits)
* [Licence](#license)

## Installation

* Install the package with composer:
```bash
composer require okipa/laravel-bootstrap-components
```

## Configuration
  
Publish the package configuration file to customize it if necessary: 

```bash
php artisan vendor:publish --tag=bootstrap-components:config
```

:warning: You may have to run a `composer dump-autoload` after changing a path in your configuration file.

## Translations

All displayed labels or sentences are translatable.

See how to translate them on the Laravel official documentation: https://laravel.com/docs/localization#using-translation-strings-as-keys.

Here is the list of the words and sentences available for translation:

* `Create`
* `Update`
* `Validate`
* `Back`
* `Cancel`
* `Remove`
* `No file selected.`
* `Awaited format: Day/Month/Year.`
* `Awaited format: Hour:Minutes.`
* `Awaited format: Day/Month/Year Hour:Minutes.`
* `Your browser does not support the :tag HTML5 tag.`

You will also have to define each attribute you define in the `->name()` method in the `validation` (`attributes` key) translation file.

## Views

Publish the package views to customize them if necessary: 

```bash
php artisan vendor:publish --tag=bootstrap-components:views
```

## API documentation

* [Components list](/docs/api/components.md)
* [Component types](/docs/api/types.md)

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

* [Arthur LORENT](https://github.com/okipa)
* [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
