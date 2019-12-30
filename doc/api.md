# Components API documentation

* [Components](#components)
  * [Forms](#forms)
    * [Inputs](#inputs)
      * [inputEmail()](#inputemail)
      * [inputPassword()](#inputpassword)
      * [inputUrl()](#inputurl)
      * [inputTel()](#inputtel)
      * [inputNumber()](#inputnumber)
      * [inputColor()](#inputcolor)
    * [Multilinguals](#multilinguals)
      * [inputText()](#inputtext)
      * [textarea()](#textarea)
    * [Temporals](#temporals)
      * [inputDate()](#inputdate)
      * [inputTime()](#inputtime)
      * [inputDatetime()](#inputdatetime)
    * [Uploadables](#uploadables)
      * [inputFile()](#inputfile)
    * [Checkable](#checkables)
      * [inputCheckbox()](#inputcheckbox)
      * [inputToggle()](#inputtoggle)
      * [inputRadio()](#inputradio)
    * [Selectables](#selectable)
      * [select()](#select)
  * [Buttons](#buttons)
    * [Submits](#submits)
      * [submit()](#submit)
      * [submitValidate()](#submitvalidate)
      * [submitCreate()](#submitcreate)
      * [submitUpdate()](#submitupdate)
    * [Links](#links)
      * [button()](#button)
      * [buttonLink()](#buttonlink)
      * [buttonBack()](#buttonback)
      * [buttonCancel()](#buttoncancel)
  * [Media](#media)
    * [Image](#image)
    * [Audio](#audio)
    * [Video](#video)
      

# Components

**Methods available for all components**
  
| Signature | Required | Description |
|---|---|---|
| componentId(string $componentId): self | No | Set the component id. |
| containerId(string $containerId): self | No | Set the component container id. |
| componentClasses(array $componentClasses): self | No | Set the component classes. |
| containerClasses(array $containerClasses): self | No | Set the component container classes. |
| componentHtmlAttributes(array $componentHtmlAttributes): self | No | Set the component html attributes. |
| containerHtmlAttributes(array $containerHtmlAttributes): self | No | Set the component container html attributes. |

The component can be used as following :

```php
<component>
    ->containerId('container-id')
    ->componentId('component-id')
    ->containerClasses(['container', 'classes'])
    ->componentClasses(['component', 'classes'])
    ->containerHtmlAttributes(['container', 'html', 'attributes'])
    ->componentHtmlAttributes(['component', 'html', 'attributes']);
```

## Forms

**Methods available for all form components**

| Signature | Required | Description |
|---|---|---|
| name(string $name): self | Yes | Set the component input name tag. |
| model(Model $model): self | No | Set the component associated model. |
| value($value): self | No | Set the component input value. |
| prepend(?string $html): self | No | Prepend html to the component input group. Set false to hide it. |
| append(?string $html): self | No | Append html to the component input group. Set false to hide it. |
| label(?string $label): self | No | Set the component input label. Default value : `__('validation.attributes.[name]')`. |
| labelPositionedAbove(bool $positionedAbove = true): self | No | Set the label above-positioning status. If not positioned above, the label will be positioned under the input (may be useful for bootstrap 4 floating labels). |
| placeholder(?string $placeholder): self | No | Set the component input placeholder. Default value : `$label`. |
| legend(?string $legend): self | No | Set the component legend. |
| displaySuccess(?bool $displaySuccess = true): self | No | Set the component input validation success display status. |
| displayFailure(?bool $displayFailure = true): self | No | Set the component input validation failure display status. |

The form component inherits the component and can be used as following :

```php
<component>
    // all component methods available
    ->name('email')
    ->model($user)
    ->value('john.doe@domain.com')
    ->prepend('<i class="fas fa-hand-pointer"></i>')
    ->append('<i class="fas fa-hand-pointer"></i>')
    ->label('Email')
    ->labelPositionedAbove()
    ->placeholder('Set your e-mail')
    ->legend('Set your legend here.')
    ->displaySuccess(false)
    ->displayFailure(false);
```

The form component is shipped with the following pre-configuration :
* Label positioned above : `config('bootstrap-components.form.labelPositionedAbove')`
* Display success : `config('bootstrap-components.form.formValidation.displaySuccess')`
* Display failure : `config('bootstrap-components.form.formValidation.displayFailure')`

### Inputs

#### inputEmail()

This component inherits the input component and is shipped with the following pre-configuration :
* Prepend : `<i class="fas fa-at"></i>`

#### inputPassword()

This component inherits the input component and is shipped with the following pre-configuration :
* Prepend : `<i class="fas fa-user-secret"></i>`

#### inputUrl()

This component inherits the input component and is shipped with the following pre-configuration :
* Prepend : `<i class="fas fa-user-secret"></i>`

#### inputTel()

This component inherits the input component and is shipped with the following pre-configuration :
* Prepend : `<i class="fas fa-phone"></i>`

#### inputNumber()

This component inherits the input component and is shipped with the following pre-configuration :
* Prepend : `<i class="fas fa-euro-sign"></i>`

#### inputColor()

This component inherits the input component and is shipped with the following pre-configuration :
* Prepend : `<i class="fas fa-palette"></i>`

### Multilinguals

**:bulb: Additional/overridden methods :**

| Signature | Required | Description |
|---|---|---|
| locales(array $locales): self | No | Set the component input language locales to handle. |
| value(Closure $value): self | No | Set the component input value. The value has to be set from this closure result : `->value(function($locale){})`. |

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

The multilingual component inherits the input component and can be used as following :

```php
<multilingual>
    // all input component methods available
    ->locales(['fr', 'en']) 
    ->value(function($locale){ return $name[$locale]; });
```

#### inputText()

This component inherits the multilingual input component and is shipped with the following pre-configuration :
* Prepend : `<i class="fas fa-font"></i>`

#### textarea()

This component inherits the multilingual input component and is shipped with the following pre-configuration :
* Prepend : `<i class="fas fa-comment"></i>`

### Temporal

**:bulb: Additional methods :**

| Signature | Required | Description |
|---|---|---|
| format(string $format): self | Yes | Set the temporal format. |

The temporal component inherits the input component and can be used as following :

```php
<temporal>
    // all input component methods available
    ->format('Y-m-d H:i');
```

#### inputDate()

This component inherits the temporal component and is shipped with the following pre-configuration :
* Prepend : `<i class="fas fa-calendar-alt"></i>`
* Format : `Y-m-d`

#### inputTime()

This component inherits the temporal component and is shipped with the following pre-configuration :
* Prepend : `<i class="fas fa-clock"></i>`
* Format : `H:i:s`

#### inputDatetime()

This component inherits the temporal component and is shipped with the following pre-configuration :
* Prepend : `<i class="fas fa-calendar-alt"></i>`
* Format : `Y-m-d H:i:s`

### Uploadables

**:bulb: Additional methods :**

| Signature | Required | Description |
|---|---|---|
| uploadedFile(Closure $uploadedFile): self | No | Allows to set html or another component to render the uploaded file. |
| showRemoveCheckbox(bool $showRemoveCheckbox = true, string $removeCheckboxLabel = null): self | No | Show the file remove checkbox option (will appear only if an uploaded file is detected). Default value : `config('bootstrap-components.file.showRemoveCheckbox')`. The remove checkbox label can be precised with the second parameter, by default, it will take the following value : `__('bootstrap-components.label.remove') . ' ' . [name]` |

The uploadable component inherits the input component and can be used as following :

```php
<uploadable>
    // all input component methods available
    ->uploadedFile(function(){
        return '<div>Some HTML</div>';
    })
    ->showRemoveCheckbox(true, 'Remove this file');
```

#### inputFile()

This component inherits the uploadable component.

### Checkables

**:bulb: Additional methods :**

| Signature | Required | Description |
|---|---|---|
| checked(bool $checked = true): self | No | Set the component checked status. |

**:warning: Notes :**

* the `->labelPositionedAbove()` method has no effect in this component.

The checkable component inherits the input component and can be used as following :

```php
<checkable>
    // all input component methods available
    ->checked();
```

#### inputCheckbox()

This component inherits the checkable component.

#### inputToggle()

**:warning: Notes :**

* This component is an extra component not included in bootstrap and using it demands to [load the package styles](#styles).
* The following classes can be applied in the `containerClasses()` method in order to manage the input toggle size : `toggle-sm` , `toggle-lg`.

This component inherits the checkable component.

#### inputRadio()

**:warning: Notes :**

* Setting the value is mandatory for this component.
* Differently from other `Form` components, the value will not be set from the associated model. Associating a model will only detect the checked status for the radio button.

This component inherits the checkable component.

### Selectables

**:bulb: Additional methods :**

| Signature | Required | Description |
|---|---|---|
| options(iterable $optionsList, string $optionValueField, string $optionLabelField): self | No | Set the options list (array or models collection) and declare which fields should be used for the options values and labels. |
| selected(string $fieldToCompare, $valueToCompare): self | No | Choose which option should be selected, declaring the field and the value to compare with the declared options list. |
| multiple(bool $multiple = true): self | No | Set the select multiple mode. |

**:warning: Notes :**
* in `single` mode, the selected() method second attribute only accept a string or an integer.
* in `multiple` mode, the selected() method second attribute only accept an array.

The selectable component inherits the input component and can be used as following :

```php
<selectable>
    // all input component methods available
    ->options(collect([
        ['id' => 1, 'title' => 'Item 1'],
        ['id' => 2, 'title' => 'Item 2'],
    ]), 'id', 'title')
    ->selected('id', 1)
    ->multiple();
```

#### select()

This component inherits the selectable input component.

### Buttons

**Methods available for all buttons components**

| Signature | Required | Description |
|---|---|---|
| prepend(?string $html): self | No | Prepend html to the button component label. Set false to hide it. |
| append(?string $html): self | No | Append html to the button component label. Set false to hide it. |
| label(string $label): self | No | Set the button component label. |

The button component inherits the component and can be used as following :

```php
<button>
    // all component methods available
    ->label('Back to the users list')
    ->prepend('<i class="fas fa-hand-pointer"></i>')
    ->append('<i class="fas fa-hand-pointer"></i>');
```

### Submits

#### submit()

This component inherit the button component and is shipped with the following pre-configuration :
* Component container classes : `btn-primary`.

#### submitValidate()

This component inherit the button component and is shipped with the following pre-configuration :
* Prepend : `<i class="fas fa-check fa-fw"></i>`
* Label : `__('bootstrap-components::bootstrap-components.label.validate')`

#### submitCreate()

This component inherit the button component and is shipped with the following pre-configuration :
* Prepend : `<i class="fas fa-plus-circle fa-fw"></i>`
* Label : `__('bootstrap-components::bootstrap-components.label.create')`

#### submitUpdate()

This component inherit the button component and is shipped with the following pre-configuration :
* Prepend : `<i class="fas fa-save fa-fw"></i>`
* Label : `__('bootstrap-components::bootstrap-components.label.update')`

### Links

**:bulb: Additional methods :**

| Signature | Required | Description |
|---|---|---|
| url(string $url): self | No | Set the button component url. |
| route(string $route, array $params = []): self | No | Set the button component route. |

The link component inherits the button component and can be used as following :

```php
<link>
    // all button component methods available
    ->url('https://website.com/admin/users')
    ->route('users.index');
```

#### button()

This component inherit the link component.

##### buttonLink()

This component inherit the link component and is shipped with the following pre-configuration :
* Container classes : `btn-primary btn-link`.

##### buttonBack()

This component inherit the link component and is shipped with the following pre-configuration :
* Url : `url()->previous()`
* Prepend : `<i class="fas fa-undo fa-fw"></i>`
* Label : `__('bootstrap-components::bootstrap-components.label.back')`
* Container classes : `btn-secondary`.

##### buttonCancel()

This component inherit the link component and is shipped with the following pre-configuration :
* Url : `url()->previous()`
* Prepend : `<i class="fas fa-ban fa-fw"></i>`
* Label : `__('bootstrap-components::bootstrap-components.label.cancel')`
* Container classes : `btn-secondary`.

### Media
  
**Methods available for all media components**

| Signature | Required | Description |
|---|---|---|
| label(?string $label): self | No | Set the component label. |
| src(string $src): self | No | Set the component src attribute. |
| legend(?string $legend): self | No | Set the component legend. |

The media component inherits the component and can be used as following :

```php
<media>
    // all component methods available
    ->src('https://yourapp.fr/public/media/audio.mp3');
```

#### image()

**:bulb: Additional methods :**

| Signature | Required | Description |
|---|---|---|
| alt(string $alt): self | No | Define the image component alt html tag. |
| width(int $width): self | No | Define the component image html tag width. |
| height(int $height): self | No | Define the component image html tag height. |
| link(string $linkUrl, ?string $linkTitle = null): self | No | Set the image component link url and title. |
| linkId(string $linkId): self | No | Set the image component link id. |
| linkClasses(array $linkClasses): self | No | Set the image component link classes. Default value : `config('bootstrap-components.media.image.classes.link')`. |
| linkHtmlAttributes(array $linkHtmlAttributes): self | No | Set the image component link html attributes. Default value : `config('bootstrap-components.media.image.htmlAttributes.link')`. |

This component inherits the media component.

```php
image()
    // all media component methods available
    ->alt('Image')
    ->width(250)
    ->height(150)
    ->link('https://yourapp.fr/public/media/image-zoom.jpg', 'Preview this image')
    ->linkId('link-id')
    ->linkComponentClasses(['link', 'component', 'classes'])
    ->linkHtmlAttributes(['link', 'component', 'classes']);
```

#### audio()

This component inherits the media component.

#### video()

**:bulb: Additional methods :**

| Signature | Required | Description |
|---|---|---|
| poster(string $poster): self | No | Set the video component poster. |

This component inherits the media component.

```php
audio()
    // all media component methods available
    ->poster('https://yourapp.fr/public/media/poster.jpg');
```
