# Ready-to-use and customizable components.

[![Source Code](https://img.shields.io/badge/source-okipa/laravel--bootstrap--components-blue.svg)](https://github.com/Okipa/laravel-bootstrap-components)
[![Latest Version](https://img.shields.io/github/release/okipa/laravel-bootstrap-components.svg?style=flat-square)](https://github.com/Okipa/laravel-bootstrap-components/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/okipa/laravel-bootstrap-components.svg?style=flat-square)](https://packagist.org/packages/okipa/laravel-bootstrap-components)
[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://opensource.org/licenses/MIT)
[![Build Status](https://travis-ci.org/Okipa/laravel-bootstrap-components.svg?branch=master)](https://travis-ci.org/Okipa/laravel-bootstrap-components)
[![Coverage Status](https://coveralls.io/repos/github/Okipa/laravel-bootstrap-components/badge.svg?branch=master)](https://coveralls.io/github/Okipa/laravel-bootstrap-components?branch=master)
[![Quality Score](https://img.shields.io/scrutinizer/g/Okipa/laravel-bootstrap-components.svg?style=flat-square)](https://scrutinizer-ci.com/g/Okipa/laravel-bootstrap-components/?branch=master)

Save time and take advantage of an extended set of ready-to-use and fully customizable bootstrap components.

You feel like there is a missing component ? Feel free to open an issue or submit a fully tested and documented PR.

## Compatibility

| Laravel version | PHP version | Bootstrap version | Package version |
|---|---|---|---|
| ^5.5 | ^7.1 | ^4.0 | ^2.0 |
| ^5.5 | ^7.1 | ^4.0 | ^1.0 |

## Upgrade guide

* [From V1 to V2](/doc/upgrade-guide/from-v1-to-v2.md)

## Usage

Just call the components you need in your views and let this package take care of the HTML generation annoying part.

### Standard use case

Call this component in your view :

```blade
{{-- helper style --}}
{{ inputText()->name('name') }}

{{-- facade style --}}
{{ InputText::name('name') }}
```

And get this HTML generated for you :

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

Call this component in your view :

```blade
{{-- helper style --}}
{{ inputText()->name('title')->localized(['fr', 'en']) }}

{{-- facade style --}}
{{ InputText::name('title')->localized(['fr', 'en']) }}
```

And get this HTML generated for you :

```html
<div class="component-container form-group" data-locale="fr">
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
            placeholder="Title (FR)">
    </div>
</div>
<div class="component-container form-group" data-locale="en">
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
            placeholder="Title (EN)">
    </div>
</div>
```

## Table of Contents

* [Installation](#installation)
* [Styles](#styles)
* [Configuration](#configuration)
* [Translations](#translations)
* [Templates](#templates)
* [API documentation](#api-documentation)
* [Testing](#testing)
* [Changelog](#changelog)
* [Contributing](#contributing)
* [Credits](#credits)
* [Licence](#license)

## Installation

* Install the package with composer :
```bash
composer require "okipa/laravel-bootstrap-components:^2.0"
```

## Styles

You will have to load the package styles to use the following extra components (not provided by bootstrap) :

* `inputToggle()`

Load the package `scss` from the following path and override the declared in the `styles/scss/_variables.scss` file if needed.

```scss
@import '/path/to/composer/vendor/okipa/laravel-bootstrap-components/styles/scss/bootstrap-components';
``` 

## Configuration
  
Publish the package configuration file to customize it if necessary : 

```bash
php artisan vendor:publish --tag=bootstrap-components:config
```

## Translations

Publish the package translations files to customize them if necessary : 

```bash
php artisan vendor:publish --tag=bootstrap-components:translations
```

## Templates

Publish the package views to customize them if necessary : 

```bash
php artisan vendor:publish --tag=bootstrap-components:views
```

## API documentation

* [Components list](/doc/api/components.md)
* [Component types](/doc/api/types.md)

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
