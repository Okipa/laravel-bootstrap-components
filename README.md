# Save time and take advantage of ready-to-use and customizable bootstrap components.

[![Source Code](https://img.shields.io/badge/source-okipa/laravel--bootstrap--components-blue.svg)](https://github.com/Okipa/laravel-bootstrap-components)
[![Latest Version](https://img.shields.io/github/release/okipa/laravel-bootstrap-components.svg?style=flat-square)](https://github.com/Okipa/laravel-bootstrap-components/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/okipa/laravel-bootstrap-components.svg?style=flat-square)](https://packagist.org/packages/okipa/laravel-bootstrap-components)
[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://opensource.org/licenses/MIT)
[![Build Status](https://travis-ci.org/Okipa/laravel-bootstrap-components.svg?branch=master)](https://travis-ci.org/Okipa/laravel-bootstrap-components)
[![Coverage Status](https://coveralls.io/repos/github/Okipa/laravel-bootstrap-components/badge.svg?branch=master)](https://coveralls.io/github/Okipa/laravel-bootstrap-components?branch=master)
[![Quality Score](https://img.shields.io/scrutinizer/g/Okipa/laravel-bootstrap-components.svg?style=flat-square)](https://scrutinizer-ci.com/g/Okipa/laravel-bootstrap-components/?branch=master)

This package provides an extended set of ready-to-use and fully customizable bootstrap components.  
The components which have been created are use on a daily basis. You feel like there is a missing component ? Feel free to open an issue or submit a fully tested and documented PR, we'll see what we can do !

## Compatibility

| Laravel version | PHP version | Bootstrap version | Package version |
|---|---|---|---|
| ^5.5 | ^7.1 | ^4.0 | ^1.0 |

## Usage

Just call the component you need in your view :

```blade
{{ bsText()->name('address') }}
```

Instead of redundantly writing or copying this HTML :

```blade
<div class="text-address-container form-group">
    <label for="text-address">
        Adress
    </label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fas fa-map-marker"></i>
            </span>
        </div>
        <input id="text-address"
            class="form-control text-address-component"
            type="text" name="address"
            value=""
            placeholder="Adress"
            aria-label="Adress"
            aria-describedby="text-address">
    </div>
</div>
```

## Table of Contents
- [Installation](#installation)
- [Styles](#styles)
- [Configuration](#configuration)
- [Translations](#translations)
- [Customization](#customization)
- [API](#api)
  - [Form components](#form-components)
    - [Multilingual](#multilingual)
      - [bsText()](#bstext)
      - [bsTextarea()](#bstextarea)
    - [Standard](#standard)
      - [bsNumber()](#bsnumber)
      - [bsTel()](#bstel)
      - [bsDatetime()](#bsdatetime)
      - [bsDate()](#bsdate)
      - [bsTime()](#bstime)
      - [bsUrl()](#bsurl)
      - [bsEmail()](#bsemail)
      - [bsColor()](#bscolor)
      - [bsPassword()](#bspassword)
      - [bsFile()](#bsfile)
      - [bsSelect()](#bsselect)
      - [bsCheckbox()](#bscheckbox)
      - [bsToggle()](#bstoggle)
      - [bsRadio()](#bsradio)
  - [Buttons components](#buttons-components)
    - [bsValidate()](#bsvalidate)
    - [bsCreate()](#bscreate)
    - [bsUpdate()](#bsupdate)
    - [bsCancel()](#bscancel)
    - [bsBack()](#bsback)
  - [Media components](#media-components)
    - [image()](#image)
    - [audio()](#audio)
    - [video()](#video)
- [Testing](#testing)
- [Changelog](#changelog)
- [Contributing](#contributing)
- [Credits](#credits)
- [Licence](#license)

## Installation

- Install the package with composer :
```bash
composer require "okipa/laravel-bootstrap-components:^1.0"
```

- Laravel 5.5+ uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider.
If you don't use auto-discovery or if you use a Laravel 5.4- version, add the package service provider in the `register()` method from your `app/Providers/AppServiceProvider.php` :
```php
// laravel bootstrap components
// https://github.com/Okipa/laravel-bootstrap-components
$this->app->register(Okipa\LaravelBootstrapComponents\ComponentServiceProvider::class);
```

## Styles

If you use some extra components ([see API](#api)), you will have to load the package styles.  
For this, load the package `sass` file from the `[path/to/composer/vendor]/okipa/laravel-bootstrap-components/styles/scss/bootstrap-components` directory to your project.

## Configuration

Each component default view and default values, classes and attributes can be configured.  
Publish the package configuration and override the available config values : 

```bash
php artisan vendor:publish --tag=bootstrap-components:config
```

## Translations

To customize the existing translations, publish the packages translations files to make the wanted changes :

```
php artisan vendor:publish --tag=bootstrap-components:translations
```

## Customization

Customize the used templates to make this package fit to your needs.  
Publish the views with the command :

```
php artisan vendor:publish --tag=bootstrap-components:views
```

## API

**Methods available for all components**
  
| Signature | Required | Description |
|---|---|---|
| containerId(string $containerId): self  | No | Set the component container id. |
| componentId(string $componentId): self  | No | Set the component id. |
| containerClasses(array $containerClasses): self  | No | Set the component container classes. Default value : `config('bootstrap-components.[componentConfigKey].classes.container')`. |
| componentClasses(array $componentClasses): self  | No | Set the component classes. Default value : `config('bootstrap-components.[componentConfigKey].classes.component')`. |
| containerHtmlAttributes(array $containerHtmlAttributes): self  | No | Set the component container html attributes. Default value : `config('bootstrap-components.[componentConfigKey].htmlAttributes.container')`. |
| componentHtmlAttributes(array $componentHtmlAttributes): self  | No | Set the component html attributes. Default value : `config('bootstrap-components.[componentConfigKey].htmlAttributes.component')`. |

### Form components

**Methods available for all form components**

| Signature | Required | Description |
|---|---|---|
| name(string $name): self  | Yes | Set the component input name tag. |
| model(Model $model): self  | No | Set the component associated model. |
| prepend(?string $html): self  | No | Prepend html to the component input group. Default value : `config('bootstrap-components.[componentConfigKey].prepend')`. |
| append(?string $html): self  | No | Append html to the component input group. Default value : `config('bootstrap-components.[componentConfigKey].append')`. |
| label(?string $label): self  | No | Set the component input label. Default value : `__('validation.attributes.[name]')`. |
| labelPositionedAbove(bool $positionedAbove = true): self  | No | Set the label above-positioning status. If not positioned above, the label will be positioned under the input. Default value : `config('bootstrap-components.[componentConfigKey].labelPositionedAbove')`. Value will set as `true` if the config value is not found. |
| placeholder(?string $placeholder): self  | No | Set the component input placeholder. Default value : `$label`. |
| value($value): self  | No | Set the component input value. |
| legend(?string $legend): self  | No | Set the component legend. Default value : `config('bootstrap-components.[componentConfigKey].legend')`. |
| displaySuccess(?bool $displaySuccess = true): self  | No | Set the component input validation success display status. Default value : `config('bootstrap-components.[componentConfigKey].formValidation.displaySuccess')`. |
| displayFailure(?bool $displayFailure = true): self  | No | Set the component input validation failure display status.. Default value : `config('bootstrap-components.[componentConfigKey].formValidation.displayFailure')`. |

#### Multilingual

**Methods available / overridden for multilingual form components**

| Signature | Required | Description |
|---|---|---|
| locales(array $locales): self  | No | Set the component input language locales to handle. |
| value(Closure $value): self  | No | Set the component input value. The value has to be set from this closure result : « ->value(function($locale){}) ». |

**:warning: Notes :**
* You can use your own `MultilingualResolver` by replacing the path defined in the `config('bootstrap-components.form.multilingual.resolver')`, allowing you to define :
  * The default locales to handle (by default `[]`).
  * The component localized `name` attribute format (by default `<name>[<locale>]`.
  * The component error message extraction, in order to correctly display the localized attribute name (by default, transform `Dummy __('validation.attributes.name.en) error message` into `Dummy __('validation.attributes.name) (EN) error message.`.
  * The component html identifier, used to generate the container class, the component class and the `aria-describedby` attribute values (by default `<type>-<name>-<locale>`.
  
* The use of the `->locales()` method will produce a component for each locale keys you declared. For example, if you declare the `fr` and `en` locale keys for a `title` text component, you will get two `Title (FR)` and `Title (EN)` generated text components.
* The localization treatment will only occur if you have more than one locales declared : there is not point to generate localized components with only one declared locales.

##### bsText()

```php
bsText()->name('name') // set the input name
    ->locales(['fr', 'en']) // override the default locales config value
    ->model($user) // value is automatically detected from the field name
    ->value(function($locale){ return $name[$locale]; }) // or manually set the value
    ->label('Name') // override the default __('validation.attributes.[name]') label or set `false` to hide it
    ->labelPositionedAbove() // Set the label above-position status, default value : `true`
    ->placeholder('Set your name') // override the default placeholder (label) or set `false` to hide it
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config value or set `false` to hide it
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default append config value or set `false` to hide it
    ->legend('Set your legend here.') // override the default legend config value or set `false` to hide it
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (text-[name])
    ->containerClasses(['container', 'classes']) // override the default container classes config value
    ->componentClasses(['component', 'classes']) // override the default component classes config value
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default container html attributes config value
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default component html attributes config value
    ->displaySuccess(false) // // override the default form validation display success config value
    ->displayFailure(false) // // override the default form validation display failure config value
```

##### bsTextarea()

```php
bsTextarea()->name('message') // set the input name
    ->locales(['fr', 'en']) // override the default locales config value
    ->model($user) // value is automatically detected from the field name
    ->value(function($locale){ return $message[$locale]; }) // or manually set the value
    ->label('Message') // override the default __('validation.attributes.[name]') label or set `false` to hide it
    ->labelPositionedAbove() // Set the label above-position status, default value : `true`
    ->placeholder('Set your message') // override the default placeholder (label) or set `false` to hide it
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config value or set `false` to hide it
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default append config value or set `false` to hide it
    ->legend('Set your legend here.') // override the default legend config value or set `false` to hide it
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (textarea-[name])
    ->containerClasses(['container', 'classes']) // override the default container classes config value
    ->componentClasses(['component', 'classes']) // override the default component classes config value
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default container html attributes config value
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default component html attributes config value
    ->displaySuccess(false) // // override the default form validation display success config value
    ->displayFailure(false) // // override the default form validation display failure config value
```

#### Standard

##### bsNumber()

```php
bsNumber()->name('amount') // set the input name
    ->model($invoice) // value is automatically detected from the field name
    ->value(20) // or manually set the value
    ->label('Amount') // override the default __('validation.attributes.[name]') label or set `false` to hide it
    ->labelPositionedAbove() // Set the label above-position status, default value : `true`
    ->placeholder('Set the amount') // override the default placeholder (label) or set `false` to hide it
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config value or set `false` to hide it
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default append config value or set `false` to hide it
    ->legend('Set your legend here.') // override the default legend config value or set `false` to hide it
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (text-[name])
    ->containerClasses(['container', 'classes']) // override the default container classes config value
    ->componentClasses(['component', 'classes']) // override the default component classes config value
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default container html attributes config value
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default component html attributes config value
    ->displaySuccess(false) // // override the default form validation display success config value
    ->displayFailure(false) // // override the default form validation display failure config value
```

##### bsTel()

```php
bsTel()->name('phone_number') // set the input name
    ->model($user) // value is automatically detected from the field name
    ->value('+33612345678') // or manually set the value
    ->label('Phone number') // override the default __('validation.attributes.[name]') label or set `false` to hide it
    ->labelPositionedAbove() // Set the label above-position status, default value : `true`
    ->placeholder('Set your phone number') // override the default placeholder (label) or set `false` to hide it
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config value or set `false` to hide it
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default append config value or set `false` to hide it
    ->legend('Set your legend here.') // override the default legend config value or set `false` to hide it
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (tel-[name])
    ->containerClasses(['container', 'classes']) // override the default container classes config value
    ->componentClasses(['component', 'classes']) // override the default component classes config value
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default container html attributes config value
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default component html attributes config value
    ->displaySuccess(false) // // override the default form validation display success config value
    ->displayFailure(false) // // override the default form validation display failure config value
```

##### bsDatetime()

```php
bsDatetime()->name('published_at') // set the input name
    ->model($user) // value is automatically detected from the field name
    ->value('2018-01-01 12:30') // or manually set the value
    ->format('Y-m-d H:i') // override the default config format
    ->label('Publication date') // override the default __('validation.attributes.[name]') label or set `false` to hide it
    ->labelPositionedAbove() // Set the label above-position status, default value : `true`
    ->placeholder('Set the publication date') // override the default placeholder (label) or set `false` to hide it
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config value or set `false` to hide it
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default append config value or set `false` to hide it
    ->legend('Set your legend here.') // override the default legend config value or set `false` to hide it
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (datetime-local-[name])
    ->containerClasses(['container', 'classes']) // override the default container classes config value
    ->componentClasses(['component', 'classes']) // override the default component classes config value
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default container html attributes config value
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default component html attributes config value
    ->displaySuccess(false) // // override the default form validation display success config value
    ->displayFailure(false) // // override the default form validation display failure config value
```

##### bsDate()

```php
bsDate()->name('birthday') // set the input name
    ->model($user) // value is automatically detected from the field name
    ->value('1985-03-24') // or manually set the value
    ->format('Y-m-d') // override the default config format
    ->label('Birthday') // override the default __('validation.attributes.[name]') label or set `false` to hide it
    ->labelPositionedAbove() // Set the label above-position status, default value : `true`
    ->placeholder('Set your birthday') // override the default placeholder (label) or set `false` to hide it
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config value or set `false` to hide it
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default append config value or set `false` to hide it
    ->legend('Set your legend here.') // override the default legend config value or set `false` to hide it
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (date-[name])
    ->containerClasses(['container', 'classes']) // override the default container classes config value
    ->componentClasses(['component', 'classes']) // override the default component classes config value
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default container html attributes config value
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default component html attributes config value
    ->displaySuccess(false) // // override the default form validation display success config value
    ->displayFailure(false) // // override the default form validation display failure config value
```

##### bsTime()

```php
bsTime()->name('opening') // set the input name
    ->model($user) // value is automatically detected from the field name
    ->value('08:30') // or manually set the value
    ->format('H\h i\m\i\n') // override the default config format
    ->label('Opening') // override the default __('validation.attributes.[name]') label or set `false` to hide it
    ->labelPositionedAbove() // Set the label above-position status, default value : `true`
    ->placeholder('Set the shop opening') // override the default placeholder (label) or set `false` to hide it
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config value or set `false` to hide it
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default append config value or set `false` to hide it
    ->legend('Set your legend here.') // override the default legend config value or set `false` to hide it
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (date-[name])
    ->containerClasses(['container', 'classes']) // override the default container classes config value
    ->componentClasses(['component', 'classes']) // override the default component classes config value
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default container html attributes config value
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default component html attributes config value
    ->displaySuccess(false) // // override the default form validation display success config value
    ->displayFailure(false) // // override the default form validation display failure config value
```

##### bsUrl()

```php
bsUrl()->name('facebook_page') // set the input name
    ->model($user) // value is automatically detected from the field name
    ->value('https://facebook.com') // or manually set the value
    ->label('Facebook page URL') // override the default __('validation.attributes.[name]') label or set `false` to hide it
    ->labelPositionedAbove() // Set the label above-position status, default value : `true`
    ->placeholder('Set your Facebook page URL') // override the default placeholder (label) or set `false` to hide it
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config value or set `false` to hide it
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default append config value or set `false` to hide it
    ->legend('Set your legend here.') // override the default legend config value or set `false` to hide it
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (url-[name])
    ->containerClasses(['container', 'classes']) // override the default container classes config value
    ->componentClasses(['component', 'classes']) // override the default component classes config value
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default container html attributes config value
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default component html attributes config value
    ->displaySuccess(false) // // override the default form validation display success config value
    ->displayFailure(false) // // override the default form validation display failure config value
```

##### bsEmail()

```php
bsEmail()->name('email') // set the input name
    ->model($user) // value is automatically detected from the field name
    ->value('john.doe@domain.com') // or manually set the value
    ->label('Email') // override the default __('validation.attributes.[name]') label or set `false` to hide it
    ->labelPositionedAbove() // Set the label above-position status, default value : `true`
    ->placeholder('Set your e-mail') // override the default placeholder (label) or set `false` to hide it
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config value or set `false` to hide it
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default append config value or set `false` to hide it
    ->legend('Set your legend here.') // override the default legend config value or set `false` to hide it
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (email-[name])
    ->containerClasses(['container', 'classes']) // override the default container classes config value
    ->componentClasses(['component', 'classes']) // override the default component classes config value
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default container html attributes config value
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default component html attributes config value
    ->displaySuccess(false) // // override the default form validation display success config value
    ->displayFailure(false) // // override the default form validation display failure config value
```

##### bsColor()

```php
bsColor()->name('color') // set the input name
    ->model($user) // value is automatically detected from the field name
    ->value('#ffffff') // or manually set the value
    ->label('Color') // override the default __('validation.attributes.[name]') label or set `false` to hide it
    ->labelPositionedAbove() // Set the label above-position status, default value : `true`
    ->placeholder('Choose the color") // override the default placeholder (label) or set `false` to hide it
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config value or set `false` to hide it
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default append config value or set `false` to hide it
    ->legend('Set your legend here.') // override the default legend config value or set `false` to hide it
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (url-[name])
    ->containerClasses(['container', 'classes']) // override the default container classes config value
    ->componentClasses(['component', 'classes']) // override the default component classes config value
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default container html attributes config value
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default component html attributes config value
    ->displaySuccess(false) // // override the default form validation display success config value
    ->displayFailure(false) // // override the default form validation display failure config value
```

##### bsPassword()

```php
bsPassword()->name('password') // set the input name
    ->model($user) // value is automatically detected from the field name
    ->value('secret') // or manually set the value
    ->label('Password') // override the default __('validation.attributes.[name]') label or set `false` to hide it
    ->labelPositionedAbove() // Set the label above-position status, default value : `true`
    ->placeholder('Set your password') // override the default placeholder (label) or set `false` to hide it
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config value or set `false` to hide it
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default append config value or set `false` to hide it
    ->legend('Set your legend here.') // override the default legend config value or set `false` to hide it
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (password-[name])
    ->containerClasses(['container', 'classes']) // override the default container classes config value
    ->componentClasses(['component', 'classes']) // override the default component classes config value
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default container html attributes config value
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default component html attributes config value
    ->displaySuccess(false) // // override the default form validation display success config value
    ->displayFailure(false) // // override the default form validation display failure config value
```

##### bsFile()

```php
bsFile()->name('avatar') // set the input name
    ->model($user) // value is automatically detected from the field name
    ->value('https://website.com/storage/avatar-url.jpg') // or manually set the value
    ->label('Avatar') // override the default __('validation.attributes.[name]') label or set `false` to hide it
    ->labelPositionedAbove() // Set the label above-position status, default value : `true`
    ->placeholder('Set your avatar') // override the default placeholder (label) or set `false` to hide it
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config value or set `false` to hide it
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default append config value or set `false` to hide it
    ->legend('Set your legend here.') // override the default legend config value or set `false` to hide it
    ->uploadedFile(function(){
        return '<div>Some HTML</div>'
    })
    -showRemoveCheckbox(true, 'Remove this file') // override the default config show remove checkbox status and the default remove-checkbox label.
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (file-[name])
    ->containerClasses(['container', 'classes']) // override the default container classes config value
    ->componentClasses(['component', 'classes']) // override the default component classes config value
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default container html attributes config value
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default component html attributes config value
    ->displaySuccess(false) // // override the default form validation display success config value
    ->displayFailure(false) // // override the default form validation display failure config value
```

**:bulb: Additional methods :**

| Signature | Required | Description |
|---|---|---|
| uploadedFile(Closure $uploadedFile): self  | No | Allows to set html or another component to render the uploaded file. |
| showRemoveCheckbox(bool $showRemoveCheckbox = true, string $removeCheckboxLabel = null): self | No | Show the file remove checkbox option (will appear only if an uploaded file is detected). Default value : `config('bootstrap-components.file.showRemoveCheckbox')`. The remove checkbox label can be precised with the second parameter, by default, it will take the following value : `__('bootstrap-components.label.remove') . ' ' . [name]` |

#### bsSelect()

```php
bsSelect()->name('skills') // set the input name
    ->model($user) // selected option is automatically detected
    ->selected('id', 1) // or manually set the selected option
    ->options($skills, 'id', 'title') // work with a models collection or an array
    ->multiple() // activate the multiple mode, default value : `true`
    ->label('Skills') // override the default __('validation.attributes.[name]') label or set `false` to hide it
    ->placeholder('Select your skills') // override the default placeholder (label) or set `false` to hide it
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config value or set `false` to hide it
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default append config value or set `false` to hide it
    ->legend('Set your legend here.') // override the default legend config value or set `false` to hide it
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (select-[name])
    ->containerClasses(['container', 'classes']) // override the default container classes config value
    ->componentClasses(['component', 'classes']) // override the default component classes config value
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default container html attributes config value
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default component html attributes config value
    ->displaySuccess(false) // // override the default form validation display success config value
    ->displayFailure(false) // // override the default form validation display failure config value
```

**:bulb: Additional methods :**

| Signature | Required | Description |
|---|---|---|
| options(iterable $optionsList, string $optionValueField, string $optionLabelField): self  | No | Set the options list (array or models collection) and declare which fields should be used for the options values and labels. |
| selected(string $fieldToCompare, $valueToCompare): self  | No | Choose which option should be selected, declaring the field and the value to compare with the declared options list. |
| multiple(bool $multiple = true): self  | No | Set the select multiple mode. |

**:warning: Notes :**
- in `single` mode, the selected() method second attribute only accept a string or an integer.
- in `multiple` mode, the selected() method second attribute only accept an array.

#### bsCheckbox()

```php
bsCheckbox()->name('active') // set the input name
    ->model($user) // checked status is automatically detected from the model field name
    ->checked() // or manually set the value, default value : `true`
    ->label('Active') // override the default __('validation.attributes.[name]') label or set `false` to hide it
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config value or set `false` to hide it
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default append config value or set `false` to hide it
    ->legend('Set your legend here.') // override the default legend config value or set `false` to hide it
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (checkbox-[name])
    ->containerClasses(['container', 'classes']) // override the default container classes config value
    ->componentClasses(['component', 'classes']) // override the default component classes config value
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default container html attributes config value
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default component html attributes config value
    ->displaySuccess(false) // // override the default form validation display success config value
    ->displayFailure(false) // // override the default form validation display failure config value
```

**:bulb: Additional methods :**

| Signature | Required | Description |
|---|---|---|
| checked(bool $checked = true): self  | No | Set the checkable component checked status. |

**:warning: Notes :**

- the `->labelPositionedAbove()` will have no effect in this component.

#### bsToggle()

```php
bsToggle()->name('active') // set the input name
    ->model($user) // checked status is automatically detected from the model field name
    ->checked() // or manually set the value, default value : `true`
    ->label('Active') // override the default __('validation.attributes.[name]') label or set `false` to hide it
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config value or set `false` to hide it
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default append config value or set `false` to hide it
    ->legend('Set your legend here.') // override the default legend config value or set `false` to hide it
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (toggle-[name])
    ->containerClasses(['container', 'classes']) // override the default container classes config value
    ->componentClasses(['component', 'classes']) // override the default component classes config value
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default container html attributes config value
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default component html attributes config value
    ->displaySuccess(false) // // override the default form validation display success config value
    ->displayFailure(false) // // override the default form validation display failure config value
```

**:bulb: Additional methods :**

| Signature | Required | Description |
|---|---|---|
| checked(bool $checked = true): self  | No | Set the checkable component check status. |
  
**:warning: Notes :**

- This component is an extra component not included in bootstrap and using it demands to [load the package styles](#styles).
- The following classes can be applied in the `containerClasses()` method in order to manage the toggle size : `switch-sm` , `switch-lg`.
- the `->labelPositionedAbove()` will have no effect in this component.

#### bsRadio()

```php
bsRadio()->name('gender') // set the input name
    ->value('female') // set the radio button value (mandatory, see the notice above)
    ->model($user) // checked status is automatically detected from the model field name
    ->checked() // or manually set the value, default value : `true`
    ->label('Name') // override the default __('validation.attributes.[name]') label or set `false` to hide it
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config value or set `false` to hide it
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default append config value or set `false` to hide it
    ->legend('Set your legend here.') // override the default legend config value or set `false` to hide it
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (radio-[name]-[value])
    ->containerClasses(['container', 'classes']) // override the default container classes config value
    ->componentClasses(['component', 'classes']) // override the default component classes config value
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default container html attributes config value
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default component html attributes config value
    ->displaySuccess(false) // // override the default form validation display success config value
    ->displayFailure(false) // // override the default form validation display failure config value
```

**:bulb: Additional methods :**

| Signature | Required | Description |
|---|---|---|
| checked(bool $checked = true): self  | No | Set the radio checked status. |

**:warning: Notes :**

- Setting the value is mandatory for this component.
- Differently from other `Form` components, the value will not be set from the associated model. Associating a model will only detect the checked status for the radio button.
- the `->labelPositionedAbove()` will have no effect in this component.

### Buttons components

**Methods available for all buttons components**

| Signature | Required | Description |
|---|---|---|
| prepend(?string $html): Button  | No | Prepend html to the button component label. Default value : `config('bootstrap-components.button.[componentConfigKey].prepend')`. |
| append(?string $html): Button  | No | Append html to the button component label. Default value : `config('bootstrap-components.button.[componentConfigKey].append')`. |
| label(string $label): Button  | No | Set the button component label. Default value : `config('bootstrap-components.button.[componentConfigKey].label')`. |
| url(string $url): Button  | No | Set the button component url. Will only be effective for « button » typed button components. Default value : `url()->previous()`. |
| route(string $route, array $params = []): Button | No | Set the button component route. Will only be effective for « button » typed button components. |

#### bsValidate()

```php
bsValidate()->label('Send') // override the default __('validation.attributes.[name]') label or set `false` to hide it
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config value or set `false` to hide it
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default append config value or set `false` to hide it
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // set the component id
    ->containerClasses(['container', 'classes']) // override the default container classes config value
    ->componentClasses(['component', 'classes']) // override the default component classes config value
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default container html attributes config value
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default component html attributes config value
```

**:warning: Notes :**

- This component is a `submit` typed button.

#### bsCreate()

```php
bsCreate()->label('Create a new user') // override the default __('validation.attributes.[name]') label or set `false` to hide it
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config value or set `false` to hide it
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default append config value or set `false` to hide it
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // set the component id
    ->containerClasses(['container', 'classes']) // override the default container classes config value
    ->componentClasses(['component', 'classes']) // override the default component classes config value
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default container html attributes config value
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default component html attributes config value
```

**:warning: Notes :**

- This component is a `submit` typed button.

#### bsUpdate()

```php
bsUpdate()->label('Update this user') // override the default __('validation.attributes.[name]') label or set `false` to hide it
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config value or set `false` to hide it
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default append config value or set `false` to hide it
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // set the component id
    ->containerClasses(['container', 'classes']) // override the default container classes config value
    ->componentClasses(['component', 'classes']) // override the default component classes config value
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default container html attributes config value
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default component html attributes config value
```

**:warning: Notes :**

- This component is a `submit` typed button.

#### bsCancel()

```php
bsCancel()->url('https://website.com/admin/users') // set the button url
    ->route('users.index') // or set the route name
    ->label('Cancel action') // override the default __('validation.attributes.[name]') label or set `false` to hide it
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config value or set `false` to hide it
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default append config value or set `false` to hide it
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // set the component id
    ->containerClasses(['container', 'classes']) // override the default container classes config value
    ->componentClasses(['component', 'classes']) // override the default component classes config value
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default container html attributes config value
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default component html attributes config value
```

**:warning: Notes :**

- This component is a `button` typed button.

#### bsBack()

```php
bsBack()->url('https://website.com/admin/users') // set the button url
    ->route('users.index') // or set the route name
    ->label('Back to the users list') // override the default __('validation.attributes.[name]') label or set `false` to hide it
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config value or set `false` to hide it
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default append config value or set `false` to hide it
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // set the component id
    ->containerClasses(['container', 'classes']) // override the default container classes config value
    ->componentClasses(['component', 'classes']) // override the default component classes config value
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default container html attributes config value
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default component html attributes config value
```

- This component is a `button` typed button.

### Media components
  
**Methods available for all form components**

| Signature | Required | Description |
|---|---|---|
| src(string $src): self  | No |  |

#### image()

```php
image()->src(https://yourapp.fr/public/media/image-thumb.jpg)
    ->linkUrl(https://yourapp.fr/public/media/image-zoom.jpg)
    ->alt('Image')
    ->width(250)
    ->height(150)
    ->containerId('container-id') // set the container id
    ->linkId('link-id') // set the link id
    ->componentId('component-id') // set the component id
    ->containerClasses(['container', 'classes']) // override the default container classes config value
    ->linkComponentClasses(['link', 'component', 'classes']) // override the default config link class list
    ->componentClasses(['component', 'classes']) // override the default component classes config value
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default container html attributes config value
    ->linkHtmlAttributes(['link', 'component', 'classes']) // override the default config link html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default component html attributes config value
```

**:bulb: Additional methods :**

| Signature | Required | Description |
|---|---|---|
| linkUrl(string $linkUrl): self  | No | Wrap the component image html tag in a link and set its url. |
| alt(string $alt): self  | No | Define the image component alt html tag. |
| width(int $width): self  | No | Define the component image html tag width. |
| height(int $height): self  | No | Define the component image html tag height. |
| linkId(string $linkId): self  | No | Set the image component link id. |
| linkClasses(array $linkClasses): self  | No | Set the image component link classes. Default value : `config('bootstrap-components.media.image.classes.link')`. |
| linkHtmlAttributes(array $linkHtmlAttributes): self  | No | Set the image component link html attributes. Default value : `config('bootstrap-components.media.image.htmlAttributes.link')`. |

#### audio()

```php
audio()->src(https://yourapp.fr/public/media/audio.mp3)
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // set the component id
    ->containerClasses(['container', 'classes']) // override the default container classes config value
    ->componentClasses(['component', 'classes']) // override the default component classes config value
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default container html attributes config value
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default component html attributes config value
```

#### video()

```php
audio()->src(https://yourapp.fr/public/media/video.avi)
    ->poster(https://yourapp.fr/public/media/poster.jpg)
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // set the component id
    ->containerClasses(['container', 'classes']) // override the default container classes config value
    ->componentClasses(['component', 'classes']) // override the default component classes config value
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default container html attributes config value
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default component html attributes config value
```

**:bulb: Additional methods :**

| Signature | Required | Description |
|---|---|---|
| poster(string $poster): self | No | Set the video component poster. Default value : `config('bootstrap-components.media.video.poster')`. |

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Arthur LORENT](https://github.com/okipa)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
