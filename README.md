# laravel-bootstrap-backoffice-components

[![Source Code](https://img.shields.io/badge/source-okipa/laravel--bootstrap--components-blue.svg)](https://github.com/Okipa/laravel-bootstrap-components)
[![Latest Version](https://img.shields.io/github/release/okipa/laravel-bootstrap-components.svg?style=flat-square)](https://github.com/Okipa/laravel-bootstrap-components/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/okipa/laravel-bootstrap-components.svg?style=flat-square)](https://packagist.org/packages/okipa/laravel-bootstrap-components)
[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://opensource.org/licenses/MIT)
[![Build Status](https://scrutinizer-ci.com/g/Okipa/laravel-bootstrap-components/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Okipa/laravel-bootstrap-components/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/Okipa/laravel-bootstrap-components/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Okipa/laravel-bootstrap-components/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Okipa/laravel-bootstrap-components/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Okipa/laravel-bootstrap-components/?branch=master)

Laravel bootstrap components generator.  
This package provide components that are (re)used a significant number of times in almost every app.  
It has been built on the premise that :
 - it is useless to package a component that will not be used a lot of time.
 - it is useless to generate html that we would write faster.
 
 Respecting these principles, components will be added step by step in order to provide a usefull ready-to-use component library.

------------------------------------------------------------------------------------------------------------------------

## Installation

- Install the package with composer :
```bash
composer require okipa/laravel-bootstrap-component
```

- Laravel 5.5+ uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider.
If you don't use auto-discovery or if you use a Laravel 5.4- version, add the package service provider in the `register()` method from your `app/Providers/AppServiceProvider.php` :
```php
// laravel bootstrap components
// https://github.com/Okipa/laravel-bootstrap-components
$this->app->register(Okipa\LaravelBootstrapComponents\ComponentServiceProvider::class);
```

------------------------------------------------------------------------------------------------------------------------

## Usage

Just call the component you need in your view.

```
// example
{{ input()->type('text')->name('username') }}
```

------------------------------------------------------------------------------------------------------------------------

## Configuration

Each component default view and default values, class and attributes can be configured.  
Publish the package configuration and override the available config values : 
```bash
php artisan vendor:publish --tag=bootstrap-components::config
```

------------------------------------------------------------------------------------------------------------------------

## Translations

To customize the existing translations, publish the packages translations files to make the wanted changes :
```
php artisan vendor:publish --tag=bootstrap-components::translations
```

------------------------------------------------------------------------------------------------------------------------

## Customization

Customize the used templates to make this package fit to your needs.  
Publish the views with the command :
```
php artisan vendor:publish --tag=bootstrap-components::views
```

------------------------------------------------------------------------------------------------------------------------

## API


### Form > input()

**Available public methods :**
- `public function type(string $type): Input` (required)
- `public function name(string $name): Input` (required)
- `public function model(Model $model): Input` (optional)
- `public function icon(string $icon): Input` (optional)
  > default value : `config('bootstrap-components.input.icon')`
- `public function label(string $label): Input` (optional)
  > default value : `trans('validation.attributes.[name]')`
- `public function hideLabel(): Input` (optional)
- `public function placeholder(string $placeholder): Input` (optional)
  > default value : `$label`.
- `public function value($value): Input` (optional)
  > default value : `$model->{$name}`.
- `public function legend(string $legend): Input` (optional)
  > default value : `config('bootstrap-components.input.legend')`
  
### Form > InputText()
This component extends the `input()` component.

**Available public methods :**
- same as [input()](#form--input)

Locked values :
- type : `text`

Default values :
- icon : `config('bootstrap-components.input_text.icon')`

### Form > InputTel()
This component extends the `input()` component.

**Available public methods :**
- same as [input()](#form--input)

Locked values :
- type : `tel`

Default values :
- icon : `config('bootstrap-components.input_tel.icon')`

#### Form > InputEmail()
This component extends the `input()` component.

**Available public methods :**
- same as [input()](#form--input)

Locked values :
- type : `email`

Default values :
- icon : `config('bootstrap-components.input_email.icon')`

### Form > InputPassword()
This component extends the `input()` component.

**Available public methods :**
- same as [input()](#form--input)

Locked values :
- type : `password`

Default values :
- icon : `config('bootstrap-components.input_password.icon')`

### Form > InputFile()
This component extends the `input()` component.

**Available public methods :**
- same as [input()](#form--input)

Locked values :
- type : `file`

Default values :
- icon : `config('bootstrap-components.input_file.icon')`
  
------------------------------------------------------------------------------------------------------------------------

## Contributors

- [ACID-Solutions](https://github.com/ACID-Solutions)
