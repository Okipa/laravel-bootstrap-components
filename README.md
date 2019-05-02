# laravel-bootstrap-components

[![Source Code](https://img.shields.io/badge/source-okipa/laravel--bootstrap--components-blue.svg)](https://github.com/Okipa/laravel-bootstrap-components)
[![Latest Version](https://img.shields.io/github/release/okipa/laravel-bootstrap-components.svg?style=flat-square)](https://github.com/Okipa/laravel-bootstrap-components/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/okipa/laravel-bootstrap-components.svg?style=flat-square)](https://packagist.org/packages/okipa/laravel-bootstrap-components)
[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://opensource.org/licenses/MIT)
[![Build Status](https://scrutinizer-ci.com/g/Okipa/laravel-bootstrap-components/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Okipa/laravel-bootstrap-components/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/Okipa/laravel-bootstrap-components/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Okipa/laravel-bootstrap-components/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Okipa/laravel-bootstrap-components/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Okipa/laravel-bootstrap-components/?branch=master)

This package provides a ready-to-use and customizable bootstrap components library.  

**Notes :**
- Implemented components are stables.
- Implementation of new components is currently in progress.
- Help welcomed (you are free to send tested and documented PR).

------------------------------------------------------------------------------------------------------------------------

## Table of Contents
- [Installation](#installation)
- [Styles](#styles)
- [Usage](#usage)
- [Configuration](#configuration)
- [Translations](#translations)
- [Customization](#customization)
- [API](#api)
  - [Form components](#form-components)
    - [bsText()](#bstext)
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
    - [bsTextarea()](#bstextarea)
    - [bsCheckbox()](#bscheckbox)
    - [bsToggle()](#bstoggle)
    - [bsRadio()](#bsradio)
    - [bsSelect()](#bsselect)
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
- [Changelog](#changelog)
- [Testing](#testing)
- [Credits](#credits)
- [Licence](#license)

------------------------------------------------------------------------------------------------------------------------

## Installation

- Install the package with composer :
```bash
composer require okipa/laravel-bootstrap-components
```

- Laravel 5.5+ uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider.
If you don't use auto-discovery or if you use a Laravel 5.4- version, add the package service provider in the `register()` method from your `app/Providers/AppServiceProvider.php` :
```php
// laravel bootstrap components
// https://github.com/Okipa/laravel-bootstrap-components
$this->app->register(Okipa\LaravelBootstrapComponents\ComponentServiceProvider::class);
```

------------------------------------------------------------------------------------------------------------------------

## Styles

If you use some extra components ([see API](#api)), you will have to load the package styles.  
For this, load the package `sass` file from the `[path/to/composer/vendor]/okipa/laravel-bootstrap-components/styles/scss/bootstrap-components` directory to your project.

------------------------------------------------------------------------------------------------------------------------

## Usage

Just call the component you need in your view.

```
// example
{{ bsText()->name('username') }}
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

**Methods available for all components**
  
| Signature | Required | Description |
|---|---|---|
| containerId(string $containerId): Component  | No |  |
| componentId(string $componentId): Component  | No |  |
| containerClass(array $containerClass): Component  | No | default value : `config('bootstrap-components.[componentConfigKey].class.container')`. |
| componentClass(array $componentClass): Component  | No | default value : `config('bootstrap-components.[componentConfigKey].class.component')`. |
| containerHtmlAttributes(array $containerHtmlAttributes): Component  | No | default value : `config('bootstrap-components.[componentConfigKey].html_attributes.container')`. |
| componentHtmlAttributes(array $componentHtmlAttributes): Component  | No | default value : `config('bootstrap-components.[componentConfigKey].html_attributes.component')`. |

### Form components

**Methods available for all form components**

| Signature | Required | Description |
|---|---|---|
|  name(string $name): Input  | Yes |  |
| model(Model $model): Input  | No |  |
| prepend(?string $html): Input  | No | default value : `config('bootstrap-components.[componentConfigKey].prepend')` |
| append(?string $html): Input  | No | default value : `config('bootstrap-components.[componentConfigKey].append')` |
| label(string $label): Input  | No | default value : `trans('validation.attributes.[name]')`. |
| hideLabel(): Input  | No |  |
| placeholder(string $placeholder): Input  | No | default value : `$label`. |
| value($value): Input  | No | default value : `$model->{$name}`. |
| legend(string $legend): Input  | No | default value : `config('bootstrap-components.input.legend')`. |
| hideLegend(): Input  | No |  |
  
#### bsText()

```php
bsText()->name('name')
    ->model($user) // value is automatically detected from the field name
    ->value('John Doe') // or manually set the value
    ->label('Name') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->placeholder('Set your name') // override the default placeholder (label)
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->legend('Set your name here.') // override the default config legend
    ->hideLegend() // or hide the legend
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (text-[name])
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

#### bsNumber()

```php
bsNumber()->name('amount')
    ->model($invoice) // value is automatically detected from the field name
    ->value(20) // or manually set the value
    ->label('Amount') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->placeholder('Set the amount') // override the default placeholder (label)
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->legend('Set the amount here.') // override the default config legend
    ->hideLegend() // or hide the legend
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (text-[name])
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

#### bsTel()

```php
bsTel()->name('phone_number')
    ->model($user) // value is automatically detected from the field name
    ->value('+33612345678') // or manually set the value
    ->label('Phone number') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->placeholder('Set your phone number') // override the default placeholder (label)
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->legend('Set your phone number here.') // override the default config legend
    ->hideLegend() // or hide the legend
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (tel-[name])
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

#### bsDatetime()

```php
bsDatetime()->name('published_at')
    ->model($user) // value is automatically detected from the field name
    ->value('2018-01-01 12:30') // or manually set the value
    ->format('Y-m-d H:i') // override the default config format
    ->label('Publication date') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->placeholder('Set the publication date') // override the default placeholder (label)
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->legend('Set the publication date here.') // override the default config legend
    ->hideLegend() // or hide the legend
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (datetime-local-[name])
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

#### bsDate()

```php
bsDate()->name('birthday')
    ->model($user) // value is automatically detected from the field name
    ->value('1985-03-24') // or manually set the value
    ->format('Y-m-d') // override the default config format
    ->label('Birthday') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->placeholder('Set your birthday') // override the default placeholder (label)
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->legend('Set your birthday here.') // override the default config legend
    ->hideLegend() // or hide the legend
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (date-[name])
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

#### bsTime()

```php
bsTime()->name('opening')
    ->model($user) // value is automatically detected from the field name
    ->value('08:30') // or manually set the value
    ->format('H\h i\m\i\n') // override the default config format
    ->label('Opening') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->placeholder('Set the shop opening') // override the default placeholder (label)
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->legend('Set the shop opening here.') // override the default config legend
    ->hideLegend() // or hide the legend
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (date-[name])
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

#### bsUrl()

```php
bsUrl()->name('facebook_page')
    ->model($user) // value is automatically detected from the field name
    ->value('https://facebook.com') // or manually set the value
    ->label('Facebook page URL') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->placeholder('Set your Facebook page URL') // override the default placeholder (label)
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->legend('Set your Facebook page URL here.') // override the default config legend
    ->hideLegend() // or hide the legend
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (url-[name])
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

#### bsEmail()

```php
bsEmail()->name('email')
    ->model($user) // value is automatically detected from the field name
    ->value('john.doe@domain.com') // or manually set the value
    ->label('Email') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->placeholder('Set your e-mail') // override the default placeholder (label)
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->legend('Set your e-mail here.') // override the default config legend
    ->hideLegend() // or hide the legend
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (email-[name])
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

#### bsColor()

```php
bsColor()->name('color')
    ->model($user) // value is automatically detected from the field name
    ->value('#ffffff') // or manually set the value
    ->label('Color') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->placeholder('Choose the color") // override the default placeholder (label)
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->legend('Select a color here.') // override the default config legend
    ->hideLegend() // or hide the legend
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (url-[name])
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

#### bsPassword()

```php
bsPassword()->name('password')
    ->model($user) // value is automatically detected from the field name
    ->value('secret') // or manually set the value
    ->label('Password') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->placeholder('Set your password') // override the default placeholder (label)
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->legend('Set your password here.') // override the default config legend
    ->hideLegend() // or hide the legend
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (password-[name])
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

#### bsFile()

```php
bsFile()->name('avatar')
    ->model($user) // value is automatically detected from the field name
    ->value('https://website.com/storage/avatar-url.jpg') // or manually set the value
    ->label('Avatar') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->placeholder('Set your avatar') // override the default placeholder (label)
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->legend('Set your avatar here.') // override the default config legend
    ->hideLegend() // or hide the legend
    ->uploadedFile(function(){
        return '<div>Some HTML</div>'
    })
    -showRemoveCheckbox(true, 'Remove this file') // override the default config show remove checkbox status and the default remove-checkbox label.
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (file-[name])
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

_Component additional methods :_

| Signature | Required | Description |
|---|---|---|
| uploadedFile(Closure $uploadedFile): InputFile  | No | Allows to set html or another component to render the uploaded file. |
| showRemoveCheckbox(bool $showed = true, string $removeCheckboxLabel = null): File  | No | Show the file remove checkbox option (will appear only if an uploaded file is detected). Default value : `config('bootstrap-components.file.show_remove_checkbox')`. The remove checkbox label can be precised with the second parameter, by default, it will take the following value : `trans('bootstrap-components.label.remove') . ' ' . [name]` |

#### bsTextarea()

```php
bsTextarea()->name('message')
    ->model($user) // value is automatically detected from the field name
    ->value('Hello, this is a message.') // or manually set the value
    ->label('Message') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->placeholder('Set your message') // override the default placeholder (label)
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->legend('Set your message here.') // override the default config legend
    ->hideLegend() // or hide the legend
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (textarea-[name])
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

#### bsCheckbox()

```php
bsCheckbox()->name('active')
    ->model($user) // checked status is automatically detected from the field name
    ->checked(true) // or manually set the value
    ->label('Active') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->legend('Set your active status here.') // override the default config legend
    ->hideLegend() // or hide the legend
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (checkbox-[name])
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

_Component additional methods :_

| Signature | Required | Description |
|---|---|---|
| checked(bool $checked = true): Input  | No |  |

#### bsToggle()

```php
bsToggle()->name('active')
    ->model($user) // checked status is automatically detected from the field name
    ->checked(true) // or manually set the value
    ->label('Active') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->legend('Set your active status here.') // override the default config legend
    ->hideLegend() // or hide the legend
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (toggle-[name])
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

_Component additional methods :_

| Signature | Required | Description |
|---|---|---|
| checked(bool $checked = true): Input  | No |  |
  
_Notes :_
- This component is an extra component not included in bootstrap and using it demands to [load the package styles](#styles).
- The following class are applyable in the `containerClass()` method in order to manage the toggle size : `switch-sm` , `switch-lg`.

#### bsRadio()

```php
bsRadio()->name('gender')
    ->model($user) // checked status is automatically detected from the field name
    ->checked(true) // or manually set the value
    ->label('Name') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->legend('Set your gender here.') // override the default config legend
    ->hideLegend() // or hide the legend
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (radio-[name])
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

_Component additional methods :_

| Signature | Required | Description |
|---|---|---|
| checked(bool $checked = true): Input  | No |  |
  
#### bsSelect()

```php
bsSelect()->name('skills')
    ->model($user) // selected option is automatically detected
    ->selected('id', 1) // or manually set the selected option
    ->options($skills, 'id', 'title') // work with a models collection or an array
    ->multiple(true) // activate the multiple mode, default value = true
    ->label('Skills') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->placeholder('Select your skills') // override the default placeholder (label)
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->legend('Select your skills here.') // override the default config legend
    ->hideLegend() // or hide the legend
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (select-[name])
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

**Notes : ** 
- in `single` mode, the selected() method second attribute only accept a string or an integer.
- in `multiple` mode, the selected() method second attribute only accept an array.

_Component additional methods :_

| Signature | Required | Description |
|---|---|---|
| options(iterable $optionsList, string $optionValueField, string $optionLabelField): Select  | No | Set the options list (array or models collection) and declare which fields should be used for the options values and labels. |
| selected(string $fieldToCompare, $valueToCompare): Select  | No | Choose which option should be selected, declaring the field and the value to compare with the declared options list. |
| multiple(bool $multiple = true): Select  | No | Set the select multiple mode. |

### Buttons components

**Methods available for all buttons components**

| Signature | Required | Description |
|---|---|---|
| prepend(?string $html): Button  | No | default value : `config('bootstrap-components.button.prepend')`. |
| append(?string $html): Button  | No | default value : `config('bootstrap-components.button.append')`. |
| label(string $label): Button  | No | default value : `config('bootstrap-components.button.label')`. |
| hideLabel(): Button  | No |  |

#### bsValidate()

```php
bsValidate()->label('Send') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // set the component id
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

#### bsCreate()

```php
bsCreate()->label('Create a new user') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // set the component id
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

#### bsUpdate()

```php
bsUpdate()->label('Update this user') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // set the component id
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

#### bsCancel()

```php
bsCancel()->url('https://website.com/admin/users') // set the button url
    ->route('users.index') // or set the route name
    ->label('Cancel action') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // set the component id
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

_Component additional methods :_

| Signature | Required | Description |
|---|---|---|
| url(string $url): Button  | No | default value : `url()->back()`. |
| route(string $route): Button  | No | set the url value from a route key. |

#### bsBack()

```php
bsBack()->url('https://website.com/admin/users') // set the button url
    ->route('users.index') // or set the route name
    ->label('Back to the users list') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default prepend config
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // set the component id
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

_Component additional methods :_

| Signature | Required | Description |
|---|---|---|
| url(string $url): Button  | No | default value : `url()->back()`. |
| route(string $route): Button  | No | set the url value from a route key. |

### Media components
  
**Methods available for all form components**

| Signature | Required | Description |
|---|---|---|
| src(string $src): Media  | No |  |

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
    ->containerClass(['container', 'class]) // override the default config container class list
    ->linkComponentClass(['link', 'component', 'class']) // override the default config link class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->linkHtmlAttributes(['link', 'component', 'class']) // override the default config link html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

_Component additional methods :_

| Signature | Required | Description |
|---|---|---|
| linkUrl(string $linkUrl): Image  | No | Wrap the image in a link and set its url. |
| alt(string $alt): Image  | No |   |
| width(int $width): Image  | No |  |
| height(int $height): Image  | No |   |
| linkId(string $linkId): Image  | No |  |
| linkClass(array $linkClass): Image  | No | Default value : `config('bootstrap-components.media.image.class.link')`. |
| linkHtmlAttributes(array $linkHtmlAttributes): Image  | No | Default value : `config('bootstrap-components.media.image.html_attributes.link')`. |

#### audio()

```php
audio()->src(https://yourapp.fr/public/media/audio.mp3)
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // set the component id
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

#### video()

```php
audio()->src(https://yourapp.fr/public/media/video.avi)
    ->poster(https://yourapp.fr/public/media/poster.jpg)
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // set the component id
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

_Component additional methods :_

| Signature | Required | Description |
|---|---|---|
| poster(string $poster): Video | No | Default value : `config('bootstrap-components.media.video.poster')`. |

------------------------------------------------------------------------------------------------------------------------

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

------------------------------------------------------------------------------------------------------------------------

## Testing

```bash
composer test
```

------------------------------------------------------------------------------------------------------------------------

## Credits

- [Okipa](https://github.com/Okipa)
- [ACID-Solutions](https://github.com/ACID-Solutions)
- [Daniel Lucas](https://github.com/daniel-chris-lucas)
- [yepzy](https://github.com/yepzy)

------------------------------------------------------------------------------------------------------------------------

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
