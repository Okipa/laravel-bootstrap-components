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
- This version provides a bootstrap 4 components implementation.
- No implementation of bootstrap 3 has been done. Is someone is up to prepare views versions for bootstrap 3, I would merge them in another version number.
- Components implementation is in progress : help is welcomed !

------------------------------------------------------------------------------------------------------------------------

## Components

### [Form](#form-components)
- [text()](#text)
- [tel()](#tel)
- [email()](#email)
- [password()](#password)
- [fileUpload()](#fileupload)
- [textarea()](#textarea)
- [checkbox()](#checkbox)
- [toggle()](#toggle)
- [radio()](#radio)
- [select()](#select)

### [Clickable](#clickable-components)
- [buttonValidate()](#buttonvalidate)
- [buttonCreate()](#buttoncreate)
- [buttonUpdate()](#buttonupdate)
- [buttonCancel()](#buttoncancel)
- [buttonBack()](#buttonback)

### [Media](#media-components)
- [image()](#image)
- [audio()](#audio)
- [video()](#video)

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

## Usage

Just call the component you need in your view.

```
// example
{{ text()->name('username') }}
```

------------------------------------------------------------------------------------------------------------------------

## Styles

If you use some extra components ([see API](#api)), you will have to load the package styles.  
For this, load the package `css` or `scss` file from the `[path/to/composer/vendor]/okipa/laravel-bootstrap-components/styles` directory to your project.

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
| containerClass(array $containerClass): Component  | No | default value : `config('bootstrap-components.[component_config_key].class.container')` |
| public function componentClass(array $componentClass): Component  | No | default value : `config('bootstrap-components.[component_config_key].class.component')` |
| containerHtmlAttributes(array $containerHtmlAttributes): Component  | No | default value : `config('bootstrap-components.[component_config_key].html_attributes.container')` |
| componentHtmlAttributes(array $componentHtmlAttributes): Component  | No | default value : `config('bootstrap-components.[component_config_key].html_attributes.component')` |

### Form components

**Methods available for all form components**

| Signature | Required | Description |
|---|---|---|
| public function name(string $name): Input  | Yes |  |
| public function model(Model $model): Input  | No |  |
| public function icon(string $icon): Input  | No | default value : `config('bootstrap-components.input.icon')` |
| public function hideIcon(): Input  | No |  |
| public function label(string $label): Input  | No | default value : `trans('validation.attributes.[name]')` |
| public function hideLabel(): Input  | No |  |
| public function placeholder(string $placeholder): Input  | No | default value : `$label` |
| public function value($value): Input  | No | default value : `$model->{$name}` |
| public function legend(string $legend): Input  | No | default value : `config('bootstrap-components.input.legend')` |
| public function hideLegend(): Input  | No |  |
  
#### text()

```php
text()->name('name')
    ->model($user) // value is automatically detected from the field name
    ->value() // or manually set the value
    ->label('Name') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->placeholder() // override the default placeholder (label)
    ->icon('<i class="fas fa-hand-pointer"></i>') // override the default config
    ->hideIcon() // or hide the icon
    ->legend('Select a user.') // override the default config legend
    ->hideLegend() // or hide the legend
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

#### tel()

```php
tel()->name('phone_number')
    ->model($user) // value is automatically detected from the field name
    ->value() // or manually set the value
    ->label('Name') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->placeholder() // override the default placeholder (label)
    ->icon('<i class="fas fa-hand-pointer"></i>') // override the default config
    ->hideIcon() // or hide the icon
    ->legend('Select a user.') // override the default config legend
    ->hideLegend() // or hide the legend
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

#### email()

```php
email()->name('email')
    ->model($user) // value is automatically detected from the field name
    ->value() // or manually set the value
    ->label('Name') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->placeholder() // override the default placeholder (label)
    ->icon('<i class="fas fa-hand-pointer"></i>') // override the default config
    ->hideIcon() // or hide the icon
    ->legend('Select a user.') // override the default config legend
    ->hideLegend() // or hide the legend
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

#### password()

```php
email()->name('password')
    ->model($user) // value is automatically detected from the field name
    ->value() // or manually set the value
    ->label('Name') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->placeholder() // override the default placeholder (label)
    ->icon('<i class="fas fa-hand-pointer"></i>') // override the default config
    ->hideIcon() // or hide the icon
    ->legend('Select a user.') // override the default config legend
    ->hideLegend() // or hide the legend
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

#### fileUpload()

```php
fileUpload()->name('avatar')
    ->model($user) // value is automatically detected from the field name
    ->value() // or manually set the value
    ->label('Name') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->placeholder() // override the default placeholder (label)
    ->icon('<i class="fas fa-hand-pointer"></i>') // override the default config
    ->hideIcon() // or hide the icon
    ->legend('Select a user.') // override the default config legend
    ->hideLegend() // or hide the legend
    ->uploadedFile(function(){
        return '<div>Some HTML</div>'
    })
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

_Component additional methods_

| Signature | Required | Description |
|---|---|---|
| public function uploadedFile(Closure $uploadedFile): InputFile  | No | Allows to set html or another component to render the uploaded file |

#### textarea()

```php
textarea()->name('message')
    ->model($user) // value is automatically detected from the field name
    ->value() // or manually set the value
    ->label('Name') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->placeholder() // override the default placeholder (label)
    ->icon('<i class="fas fa-hand-pointer"></i>') // override the default config
    ->hideIcon() // or hide the icon
    ->legend('Select a user.') // override the default config legend
    ->hideLegend() // or hide the legend
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

#### checkbox()

```php
textarea()->name('active')
    ->model($user) // checked status is automatically detected from the field name
    ->value(true) // or manually set the value
    ->checked(true) // or use the alias for value
    ->label('Name') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->icon('<i class="fas fa-hand-pointer"></i>') // override the default config
    ->hideIcon() // or hide the icon
    ->legend('Select a user.') // override the default config legend
    ->hideLegend() // or hide the legend
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

_Component additional methods_

| Signature | Required | Description |
|---|---|---|
| checked(bool $checked = true): Input  | No |  |

#### toggle()

- Specific values :
  - type : `toggle`.
- Extra chainable methods :
  - `public function checked(bool $checked = true): Input` (optional)
  
*_Note :_* this component is an extra component not included in bootstrap and using it demands to [load the package styles](#styles).

#### radio()

- Specific chainable methods :
  - `public function checked(bool $checked = true): Input` (optional)
  
#### select()

```php
select()->name('selected')
    ->model($user) // selected option is automatically detected
    ->selected('id', 1) // or manually set the selected option
    ->options($usersList, 'id', 'name') // work with a models collection or an array
    ->label('Select a user') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->placeholder() // override the default placeholder (label)
    ->icon('<i class="fas fa-hand-pointer"></i>') // override the default config
    ->hideIcon() // or hide the icon
    ->legend('Select a user.') // override the default config legend
    ->hideLegend() // or hide the legend
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

_Component additional methods_

| Signature | Required | Description |
|---|---|---|
| options(iterable $optionsList, string $optionValueField, string $optionLabelField): Select  | No | Set the options list (array or models collection) and declare which fields should be used for the options values and labels. |
| selected(string $fieldToCompare, $valueToCompare): Select  | No | Choose which option should be selected, declaring the field and the value to compare with the declared options list. |

### Buttons components

**Methods available for all buttons components**

| Signature | Required | Description |
|---|---|---|
| icon(string $icon): Input  | No | default value : `config('bootstrap-components.button.icon')`. |
| public function hideIcon(): Input  | No |  |
| public function label(string $label): Input  | No | default value : `config('bootstrap-components.button.label')` |
| public function hideLabel(): Input  | No |  |

#### buttonValidate()

```php
buttonValidate()->label('Select a user') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->icon('<i class="fas fa-hand-pointer"></i>') // override the default config
    ->hideIcon() // or hide the icon
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

#### buttonCreate()

```php
buttonCreate()->label('Select a user') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->icon('<i class="fas fa-hand-pointer"></i>') // override the default config
    ->hideIcon() // or hide the icon
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

#### buttonUpdate()

```php
buttonUpdate()->label('Select a user') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->icon('<i class="fas fa-hand-pointer"></i>') // override the default config
    ->hideIcon() // or hide the icon
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

#### buttonCancel()

```php
buttonCancel()->url('https://www.google.com')
    ->route('users.index')
    ->label('Select a user') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->icon('<i class="fas fa-hand-pointer"></i>') // override the default config
    ->hideIcon() // or hide the icon
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

_Component additional methods_

| Signature | Required | Description |
|---|---|---|
| url(string $url): Button  | No | default value : `url()->back()`. |
| route(string $route): Button  | No | set the url value from a route key. |

#### buttonBack()

```php
buttonBack()->url('https://www.google.com')
    ->route('users.index')
    ->label('Select a user') // override the default trans('validation.attributes.[name]') label
    ->hideLabel() // or hide the label
    ->icon('<i class="fas fa-hand-pointer"></i>') // override the default config
    ->hideIcon() // or hide the icon
    ->containerClass(['container', 'class]) // override the default config container class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

_Component additional methods_

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
image()->src(https://yourapp.fr/public/media/image.jpg)
    ->alt('Image)
    ->width(250)
    ->height(150)
    ->containerClass(['container', 'class]) // override the default config container class list
    ->linkComponentClass(['link', 'component', 'class']) // override the default config link class list
    ->componentClass(['component', 'class']) // override the default config component class list
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default config container html attributes list
    ->linkHtmlAttributes(['link', 'component', 'class']) // override the default config link html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default config component html attributes list
```

_Component additional methods_

| Signature | Required | Description |
|---|---|---|
| linkUrl(string $linkUrl): Image  | No | Wrap the image in a link and set its url. |
| alt(string $alt): Image  | No |  |
| width(int $width): Image  | No |  |
| height(int $height): Image  | No |  |
| linkClass(array $linkClass): Image  | No | Default value : `config('bootstrap-components.media.image.class.link')`. |
| linkHtmlAttributes(array $linkHtmlAttributes): Image  | No | Default value : `config('bootstrap-components.media.image.html_attributes.link')`. |

#### audio()

```php
audio()->src(https://yourapp.fr/public/media/audio.mp3)
```

#### video()

```php
audio()->src(https://yourapp.fr/public/media/video.avi)
    ->poster(https://yourapp.fr/public/media/poster.jpg)
```

_Component additional methods_

| Signature | Required | Description |
|---|---|---|
| poster(string $poster): Video | No | Default value : `config('bootstrap-components.media.video.poster')`. |

------------------------------------------------------------------------------------------------------------------------

## Contributors

- [ACID-Solutions](https://github.com/ACID-Solutions)
