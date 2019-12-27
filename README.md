# Ready-to-use and customizable components.

[![Source Code](https://img.shields.io/badge/source-okipa/laravel--bootstrap--components-blue.svg)](https://github.com/Okipa/laravel-bootstrap-components)
[![Latest Version](https://img.shields.io/github/release/okipa/laravel-bootstrap-components.svg?style=flat-square)](https://github.com/Okipa/laravel-bootstrap-components/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/okipa/laravel-bootstrap-components.svg?style=flat-square)](https://packagist.org/packages/okipa/laravel-bootstrap-components)
[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://opensource.org/licenses/MIT)
[![Build Status](https://travis-ci.org/Okipa/laravel-bootstrap-components.svg?branch=master)](https://travis-ci.org/Okipa/laravel-bootstrap-components)
[![Coverage Status](https://coveralls.io/repos/github/Okipa/laravel-bootstrap-components/badge.svg?branch=master)](https://coveralls.io/github/Okipa/laravel-bootstrap-components?branch=master)
[![Quality Score](https://img.shields.io/scrutinizer/g/Okipa/laravel-bootstrap-components.svg?style=flat-square)](https://scrutinizer-ci.com/g/Okipa/laravel-bootstrap-components/?branch=master)

Save time and take advantage of ready-to-use and customizable bootstrap components.

This package provides an extended set of ready-to-use and fully customizable bootstrap components.
  
You feel like there is a missing component ? Feel free to open an issue or submit a fully tested and documented PR, we'll see what we can do !

## Compatibility

| Laravel version | PHP version | Bootstrap version | Package version |
|---|---|---|---|
| ^5.5 | ^7.1 | ^4.0 | ^2.0 |
| ^5.5 | ^7.1 | ^4.0 | ^1.0 |

## Upgrade guide

* [Upgrade from V1 to V2](/doc/upgrade-guide/v1-to-v2.md)

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
* [API](#api)
  * [Form components](#form-components)
    * [Monolingual form components](#monolingual-form-components)
      * [inputEmail()](#inputemail)
      * [inputPassword()](#inputpassword)
      * [inputUrl()](#inputurl)
      * [inputTel()](#inputtel)
      * [inputNumber()](#inputnumber)
      * [inputColor()](#inputcolor)
      * [inputDate()](#inputdate)
      * [inputTime()](#inputtime)
      * [inputDatetime()](#inputdatetime)
      * [inputFile()](#inputfile)
      * [inputCheckbox()](#bscheckbox)
      * [inputToggle()](#bstoggle)
      * [bsRadio()](#bsradio)
      * [bsSelect()](#bsselect)
    * [Multilingual form components](#multilingual-form-components)
      * [inputText()](#inputtext)
      * [inputTextarea()](#inputtextarea)
  * [Button components](#button-components)
    * [submitValidate()](#submitvalidate)
    * [submitCreate()](#submitcreate)
    * [submitUpdate()](#submitupdate)
    * [buttonCancel()](#buttoncancel)
    * [buttonBack()](#buttonback)
  * [Media components](#media-components)
    * [image()](#image)
    * [audio()](#audio)
    * [video()](#video)
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

## Components

**Methods available for all components**
  
| Signature | Required | Description |
|---|---|---|
| `componentId(string $componentId): self` | No | Set the component id. |
| `containerId(string $containerId): self` | No | Set the component container id. |
| `componentClasses(array $componentClasses): self` | No | Set the component classes. |
| `containerClasses(array $containerClasses): self` | No | Set the component container classes. |
| `componentHtmlAttributes(array $componentHtmlAttributes): self` | No | Set the component html attributes. |
| `containerHtmlAttributes(array $containerHtmlAttributes): self` | No | Set the component container html attributes. |

The component can be used as following :

```php
<component>
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (email-[name])
    ->containerClasses(['container', 'classes']) // override the default component container classes
    ->componentClasses(['component', 'classes']) // override the default component classes
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default component container html attributes
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default component html attributes
```

### Form components

**Methods available for all form components**

| Signature | Required | Description |
|---|---|---|
| name(string $name): self  | Yes | Set the component input name tag. |
| model(Model $model): self  | No | Set the component associated model. |
| prepend(?string $html): self  | No | Prepend html to the component input group. |
| append(?string $html): self  | No | Append html to the component input group. |
| label(?string $label): self  | No | Set the component input label. Default value : `__('validation.attributes.[name]')`. |
| labelPositionedAbove(bool $positionedAbove = true): self  | No | Set the label above-positioning status. If not positioned above, the label will be positioned under the input (may be useful for bootstrap 4 floating labels). |
| placeholder(?string $placeholder): self  | No | Set the component input placeholder. Default value : `$label`. |
| value($value): self  | No | Set the component input value. |
| legend(?string $legend): self  | No | Set the component legend. |
| displaySuccess(?bool $displaySuccess = true): self  | No | Set the component input validation success display status. |
| displayFailure(?bool $displayFailure = true): self  | No | Set the component input validation failure display status. |

#### Standard inputs

The standard input component can be used as following :

```php
<standard-input>
    ->name('email') // set the input name
    ->model($user) // value is automatically detected from the field name
    ->value('john.doe@domain.com') // manually set the value
    ->label('Email') // override the default __('validation.attributes.[name]') label or set `false` to hide it
    ->labelPositionedAbove() // set the label above-position status, default value : `true`
    ->placeholder('Set your e-mail') // override the default placeholder (label) or set `false` to hide it
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default component prepend or set `false` to hide it
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default component append or set `false` to hide it
    ->legend('Set your legend here.') // override the default component legend or set `false` to hide it
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // override the default component id (email-[name])
    ->containerClasses(['container', 'classes']) // override the default component container classes
    ->componentClasses(['component', 'classes']) // override the default component classes
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default component container html attributes
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default component html attributes
    ->displaySuccess(false) // override the default component form validation display success status
    ->displayFailure(false); // override the default component form validation failure success status
```

The standard input component is shipped with the following pre-configuration :
* Label positioned above : `config('bootstrap-components.form.labelPositionedAbove')`
* Display success : `config('bootstrap-components.form.formValidation.displaySuccess')`
* Display failure : `config('bootstrap-components.form.formValidation.displayFailure')`

##### inputEmail()

This component inherits the standard input component and is shipped with the following pre-configuration :
* Prepend : `<i class="fas fa-at"></i>`

##### inputPassword()

This component inherits the standard input component and is shipped with the following pre-configuration :
* Prepend : `<i class="fas fa-user-secret"></i>`

##### inputUrl()

This component inherits the standard input component and is shipped with the following pre-configuration :
* Prepend : `<i class="fas fa-user-secret"></i>`

##### inputTel()

This component inherits the standard input component and is shipped with the following pre-configuration :
* Prepend : `<i class="fas fa-phone"></i>`

##### inputNumber()

This component inherits the standard input component and is shipped with the following pre-configuration :
* Prepend : `<i class="fas fa-euro-sign"></i>`

##### inputColor()

This component inherits the standard input component and is shipped with the following pre-configuration :
* Prepend : `<i class="fas fa-palette"></i>`

#### Temporal input

**:bulb: Additional methods :**

| Signature | Required | Description |
|---|---|---|
| format(string $format): self  | Yes | Set the temporal format. |

The temporal input component inherits the standard input component and can be used as following :

```php
<temporal-input>
    // all standard input methods are available
    ->format('Y-m-d H:i'); // mandatorily set the format
```

##### inputDate()

This component inherits the temporal input component and is shipped with the following pre-configuration :
* Prepend : `<i class="fas fa-calendar-alt"></i>`
* Format : `Y-m-d`

##### inputTime()

This component inherits the temporal input component and is shipped with the following pre-configuration :
* Prepend : `<i class="fas fa-clock"></i>`
* Format : `H:i:s`

##### inputDatetime()

This component inherits the temporal input component and is shipped with the following pre-configuration :
* Prepend : `<i class="fas fa-calendar-alt"></i>`
* Format : `Y-m-d H:i:s`

#### Uploadable inputs

**:bulb: Additional methods :**

| Signature | Required | Description |
|---|---|---|
| uploadedFile(Closure $uploadedFile): self  | No | Allows to set html or another component to render the uploaded file. |
| showRemoveCheckbox(bool $showRemoveCheckbox = true, string $removeCheckboxLabel = null): self | No | Show the file remove checkbox option (will appear only if an uploaded file is detected). Default value : `config('bootstrap-components.file.showRemoveCheckbox')`. The remove checkbox label can be precised with the second parameter, by default, it will take the following value : `__('bootstrap-components.label.remove') . ' ' . [name]` |

The uploadable input component inherits the standard input component and can be used as following :

```php
<uploadable-input>
    // all standard input methods are available
    ->uploadedFile(function(){ // insert html between the label and the input to show the uploaded file.
        return '<div>Some HTML</div>';
    })
    -showRemoveCheckbox(true, 'Remove this file'); // override the default component show remove checkbox status and the default remove-checkbox label
```

##### inputFile()

This component inherits the uploadable input component.

#### Checkable inputs

**:bulb: Additional methods :**

| Signature | Required | Description |
|---|---|---|
| checked(bool $checked = true): self  | No | Set the component checked status. |

**:warning: Notes :**

* the `->labelPositionedAbove()` will have no effect in this component.

The checkable input component inherits the standard input component and can be used as following :

```php
<checkable-input>
    // all standard input methods are available
    ->checked(); // manually set the checked status
```

##### inputCheckbox()

This component inherits the checkable input component.

##### inputToggle()

**:warning: Notes :**

* This component is an extra component not included in bootstrap and using it demands to [load the package styles](#styles).
* The following classes can be applied in the `containerClasses()` method in order to manage the input toggle size : `toggle-sm` , `toggle-lg`.

This component inherits the checkable input component.

##### bsRadio()

**:warning: Notes :**

* Setting the value is mandatory for this component.
* Differently from other `Form` components, the value will not be set from the associated model. Associating a model will only detect the checked status for the radio button.

This component inherits the checkable input component.

#### Selectable inputs

**:bulb: Additional methods :**

| Signature | Required | Description |
|---|---|---|
| options(iterable $optionsList, string $optionValueField, string $optionLabelField): self  | No | Set the options list (array or models collection) and declare which fields should be used for the options values and labels. |
| selected(string $fieldToCompare, $valueToCompare): self  | No | Choose which option should be selected, declaring the field and the value to compare with the declared options list. |
| multiple(bool $multiple = true): self  | No | Set the select multiple mode. |

**:warning: Notes :**
* in `single` mode, the selected() method second attribute only accept a string or an integer.
* in `multiple` mode, the selected() method second attribute only accept an array.

The selectable input component inherits the standard input component and can be used as following :

```php
<selectable-input>
    // all standard input methods are available
    ->options(collect([
        ['id' => 1, 'title' => 'Item 1'],
        ['id' => 2, 'title' => 'Item 2'],
    ]), 'id', 'title') // work with a models collection or an array
    ->selected('id', 1) // manually set the selected option
    ->multiple(); // activate (or deactivate with `false`) the multiple mode
```

##### bsSelect()

This component inherits the selectable input component.

#### Multilingual components

**:bulb: Additional/overridden methods :**

| Signature | Required | Description |
|---|---|---|
| locales(array $locales): self  | No | Set the component input language locales to handle. |
| value(Closure $value): self  | No | Set the component input value. The value has to be set from this closure result : `->value(function($locale){})`. |

**:bulb: Notes :**

* Each multilingual form component will behave as a monolingual form component as long as the `->locales()` method is not used or as long as only one locale is declared.
* The use of the `->locales()` method will replicate the component for each locale keys you declared.
  * For example, if you declare the `fr` and `en` locale keys for a text input component with the `title` attribute, you will get two `Title (FR)` and `Title (EN)` generated text input components.
* Each multilingual component provides an extra `data-locale="<locale>"` attribute to help with eventual javascript treatments.
* You can use your own multilingual `Resolver` by replacing the path defined in the `config('bootstrap-components.form.multilingualResolver')`, allowing you to customize your multilingual form components localization behaviour :
  * The default locales to handle (by default `[]`).
  * The component localized `name` attribute resolution (default : `$name[$locale]`.
  * The component localized old value resolution in case of errors (default : `old($name)[$locale]`).
  * The component localized model value resolution (default : `$model->{$name}[$locales]`).
  * The component localized error message bag key resolution, used for the error message extraction and for the validation class generation (default : `$name . $locale`).
  * The component error message resolution, in order to correctly display the localized attribute name (default : transform `Dummy __('validation.attributes.name.en) error message` into `Dummy __('validation.attributes.name) (EN) error message.`.

The select component inherits the standard input component and can be used as following :

```php
<multilingual-input>
    // all standard input methods are available
    ->locales(['fr', 'en']) // override the multilingual resolver default locales 
    ->value(function($locale){ return $name[$locale]; }); // manually set the value closure
```

##### inputText()

This component inherits the multilingual input component and is shipped with the following pre-configuration :
* Prepend : `<i class="fas fa-font"></i>`

##### inputTextarea()

This component inherits the multilingual input component and is shipped with the following pre-configuration :
* Prepend : `<i class="fas fa-comment"></i>`

### Button components

**Methods available for all buttons components**

| Signature | Required | Description |
|---|---|---|
| prepend(?string $html): self  | No | Prepend html to the button component label. |
| append(?string $html): self  | No | Append html to the button component label. |
| label(string $label): self  | No | Set the button component label. |

#### Submit button

The submit button can be used as following :

```php
<submit-button>
    ->label('Back to the users list') // set the button label
    ->prepend('<i class="fas fa-hand-pointer"></i>') // override the default component prepend or set `false` to hide it
    ->append('<i class="fas fa-hand-pointer"></i>') // override the default component append or set `false` to hide it
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // set the component id
    ->containerClasses(['container', 'classes']) // override the default component container classes
    ->componentClasses(['component', 'classes']) // override the default component classes
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default component container html attributes
    ->componentHtmlAttributes(['component', 'html', 'attributes']); // override the default component html attributes
```

##### submit()

This component inherit the submit button and is shipped with the following pre-configuration :
* Component container classes : `btn-primary`.

##### submitValidate()

This component inherit the submit button and is shipped with the following pre-configuration :
* Prepend : `<i class="fas fa-check fa-fw"></i>`
* Label : `__('bootstrap-components::bootstrap-components.label.validate')`

##### submitCreate()

This component inherit the submit button and is shipped with the following pre-configuration :
* Prepend : `<i class="fas fa-plus-circle fa-fw"></i>`
* Label : `__('bootstrap-components::bootstrap-components.label.create')`

##### submitUpdate()

This component inherit the submit button and is shipped with the following pre-configuration :
* Prepend : `<i class="fas fa-save fa-fw"></i>`
* Label : `__('bootstrap-components::bootstrap-components.label.update')`

#### Link button

**:bulb: Additional methods :**

| Signature | Required | Description |
|---|---|---|
| url(string $url): self  | No | Set the button component url. |
| route(string $route, array $params = []): self | No | Set the button component route. |

The link button inherits the submit button and can be used as following :

```php
<button-component>
    // all submit button methods are available
    ->url('https://website.com/admin/users') // set the button url
    ->route('users.index'); // set the url from the route name
```

##### button()

This component inherit the link button.

##### buttonLink()

This component inherit the link button and is shipped with the following pre-configuration :
* Container classes : `btn-primary btn-link`.

##### buttonBack()

This component inherit the link button and is shipped with the following pre-configuration :
* Url : `url()->previous()`
* Prepend : `<i class="fas fa-undo fa-fw"></i>`
* Label : `__('bootstrap-components::bootstrap-components.label.back')`
* Container classes : `btn-secondary`.

##### buttonCancel()

This component inherit the link button and is shipped with the following pre-configuration :
* Url : `url()->previous()`
* Prepend : `<i class="fas fa-ban fa-fw"></i>`
* Label : `__('bootstrap-components::bootstrap-components.label.cancel')`
* Container classes : `btn-secondary`.

### Media components
  
**Methods available for all media components**

| Signature | Required | Description |
|---|---|---|
| label(?string $label): self  | No | Set the component label. |
| src(string $src): self  | No | Set the component src attribute. |
| legend(?string $legend): self  | No | Set the component legend. |

The media component can be used as following :

```php
<media-component>
    ->src(https://yourapp.fr/public/media/audio.mp3)
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // set the component id
    ->containerClasses(['container', 'classes']) // override the default component container classes
    ->componentClasses(['component', 'classes']) // override the default component classes
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default component container html attributes
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default component html attributes
```

#### audio()


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
    ->containerClasses(['container', 'classes']) // override the default component container classes
    ->linkComponentClasses(['link', 'component', 'classes']) // override the default config link class list
    ->componentClasses(['component', 'classes']) // override the default component classes
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default component container html attributes
    ->linkHtmlAttributes(['link', 'component', 'classes']) // override the default config link html attributes list
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default component html attributes
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

#### video()

```php
audio()->src(https://yourapp.fr/public/media/video.avi)
    ->poster(https://yourapp.fr/public/media/poster.jpg)
    ->containerId('container-id') // set the container id
    ->componentId('component-id') // set the component id
    ->containerClasses(['container', 'classes']) // override the default component container classes
    ->componentClasses(['component', 'classes']) // override the default component classes
    ->containerHtmlAttributes(['container', 'html', 'attributes']) // override the default component container html attributes
    ->componentHtmlAttributes(['component', 'html', 'attributes']) // override the default component html attributes
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

* [Arthur LORENT](https://github.com/okipa)
* [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
