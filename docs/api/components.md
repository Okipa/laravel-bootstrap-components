# Components list

* [Form components](#form-components)
  * [Input text](#input-text)
  * [Input e-mail](#input-e-mail)
  * [Input password](#input-password)
  * [Input URL](#input-url)
  * [Input tel](#input-tel)
  * [Input number](#input-number)
  * [Input color](#input-color)
  * [Input date](#input-date)
  * [Input time](#input-time)
  * [Input datetime](#input-datetime)
  * [Input file](#input-file)
  * [Input checkbox](#input-checkbox)
  * [Input toggle](#input-toggle)
  * [Input radio](#input-radio)
  * [Textarea](#textarea)
  * [Select](#select)
* [Button components](#button-components)
  * [Submit](#submit)
  * [Submit validate](#submit-validate)
  * [Submit create](#submit-create)
  * [Submit update](#submit-update)
  * [Button](#button)
  * [Button link](#button-link)
  * [Button back](#button-back)
  * [Button cancel](#button-cancel)
* [Media components](#media-components)
  * [Audio](#audio)
  * [Image](#image)
  * [Video](#video)

# Form components

## Input text

**Type :** [FormAbstract](./types.md#formabstract)

**Helper :** `inputText()`

**Facade :** `InputText`

**Pre-configuration**

* Prepend : `<i class="fas fa-font"></i>`
* Label positioned above : `config('bootstrap-components.form.labelPositionedAbove')`
* Display success : `config('bootstrap-components.form.formValidation.displaySuccess')`
* Display failure : `config('bootstrap-components.form.formValidation.displayFailure')`

## Input e-mail

**Type :** [FormAbstract](./types.md#formabstract)

**Helper :** `inputEmail()`

**Facade :** `InputEmail`

**Pre-configuration**

* Prepend : `<i class="fas fa-at"></i>`
* Label positioned above : `config('bootstrap-components.form.labelPositionedAbove')`
* Display success : `config('bootstrap-components.form.formValidation.displaySuccess')`
* Display failure : `config('bootstrap-components.form.formValidation.displayFailure')`

## Input password

**Type :** [FormAbstract](./types.md#formabstract)

**Helper :** `inputPassword()`

**Facade :** `InputPassword`

**Pre-configuration**

* Prepend : `<i class="fas fa-user-secret"></i>`
* Label positioned above : `config('bootstrap-components.form.labelPositionedAbove')`
* Display success : `config('bootstrap-components.form.formValidation.displaySuccess')`
* Display failure : `config('bootstrap-components.form.formValidation.displayFailure')`

## Input URL

**Type :** [FormAbstract](./types.md#formabstract)

**Helper :** `inputUrl()`

**Facade :** `InputUrl`

**Pre-configuration**

* Prepend : `<i class="fas fa-link"></i>`
* Label positioned above : `config('bootstrap-components.form.labelPositionedAbove')`
* Display success : `config('bootstrap-components.form.formValidation.displaySuccess')`
* Display failure : `config('bootstrap-components.form.formValidation.displayFailure')`

## Input tel

**Type :** [FormAbstract](./types.md#formabstract)

**Helper :** `inputTel()`

**Facade :** `InputTel`

**Pre-configuration**

* Prepend : `<i class="fas fa-phone"></i>`
* Label positioned above : `config('bootstrap-components.form.labelPositionedAbove')`
* Display success : `config('bootstrap-components.form.formValidation.displaySuccess')`
* Display failure : `config('bootstrap-components.form.formValidation.displayFailure')`

## Input number

**Type :** [FormAbstract](./types.md#formabstract)

**Helper :** `inputNumber()`

**Facade :** `InputNumber`

**Pre-configuration**

* Prepend : `<i class="fas fa-euro-sign"></i>`
* Label positioned above : `config('bootstrap-components.form.labelPositionedAbove')`
* Display success : `config('bootstrap-components.form.formValidation.displaySuccess')`
* Display failure : `config('bootstrap-components.form.formValidation.displayFailure')`

## Input color

**Type :** [FormAbstract](./types.md#formabstract)

**Helper :** `inputColor()`

**Facade :** `InputColor`

**Pre-configuration**

* Prepend : `<i class="fas fa-palette"></i>`
* Label positioned above : `config('bootstrap-components.form.labelPositionedAbove')`
* Display success : `config('bootstrap-components.form.formValidation.displaySuccess')`
* Display failure : `config('bootstrap-components.form.formValidation.displayFailure')`

## Input date

**Type :** [TemporalAbstract](./types.md#temporalabstract)

**Helper :** `inputDate()`

**Facade :** `InputDate`

**Pre-configuration**

* Prepend : `<i class="fas fa-calendar-alt"></i>`
* Format : `Y-m-d`
* Label positioned above : `config('bootstrap-components.form.labelPositionedAbove')`
* Display success : `config('bootstrap-components.form.formValidation.displaySuccess')`
* Display failure : `config('bootstrap-components.form.formValidation.displayFailure')`

## Input time

**Type :** [TemporalAbstract](./types.md#temporalabstract)

**Helper :** `inputTime()`

**Facade :** `InputTime`

**Pre-configuration**

* Prepend : `<i class="fas fa-clock"></i>`
* Format : `H:i:s`
* Label positioned above : `config('bootstrap-components.form.labelPositionedAbove')`
* Display success : `config('bootstrap-components.form.formValidation.displaySuccess')`
* Display failure : `config('bootstrap-components.form.formValidation.displayFailure')`

## Input datetime

**Type :** [TemporalAbstract](./types.md#temporalabstract)

**Helper :** `inputDatetime()`

**Facade :** `InputDatetime`

**Pre-configuration**

* Prepend : `<i class="fas fa-calendar-alt"></i>`
* Format : `Y-m-d H:i:s`
* Label positioned above : `config('bootstrap-components.form.labelPositionedAbove')`
* Display success : `config('bootstrap-components.form.formValidation.displaySuccess')`
* Display failure : `config('bootstrap-components.form.formValidation.displayFailure')`

## Input file

**Type :** [UploadableAbstract](./types.md#uploadableabstract)

**Helper :** `inputFile()`

**Facade :** `InputFile`

**Pre-configuration**

* Prepend : `<i class="fas fa-upload"></i>`
* Label positioned above : `config('bootstrap-components.form.labelPositionedAbove')`
* Display success : `config('bootstrap-components.form.formValidation.displaySuccess')`
* Display failure : `config('bootstrap-components.form.formValidation.displayFailure')`

## Input checkbox

**Type :** [CheckableAbstract](./types.md#checkableabstract)

**Helper :** `inputCheckbox()`

**Facade :** `InputCheckbox`

**Pre-configuration**

* Display success : `config('bootstrap-components.form.formValidation.displaySuccess')`
* Display failure : `config('bootstrap-components.form.formValidation.displayFailure')`

## Input toggle

**Type :** [CheckableAbstract](./types.md#checkableabstract)

**Helper :** `inputToggle()`

**Facade :** `InputToggle`

**Notes**

* This component is an extra component not included in bootstrap and using it demands to [load the package styles](#styles).
* The following classes can be applied in the `containerClasses()` method in order to manage the input toggle size : `toggle-sm` , `toggle-lg`.

**Pre-configuration**

* Display success : `config('bootstrap-components.form.formValidation.displaySuccess')`
* Display failure : `config('bootstrap-components.form.formValidation.displayFailure')`

## input radio

**Type :** [CheckableAbstract](./types.md#checkableabstract)

**Helper :** `inputRadio()`

**Facade :** `InputCheckbox`

**Pre-configuration**

* Display success : `config('bootstrap-components.form.formValidation.displaySuccess')`
* Display failure : `config('bootstrap-components.form.formValidation.displayFailure')`

**Notes**

* Setting the value is mandatory for this component.

## Textarea

**Type :** [MultilingualAbstract](./types.md#multilingualabstract)

**Helper :** `textarea()`

**Facade :** `Textarea`

**Pre-configuration**

* Prepend : `<i class="fas fa-align-left"></i>`
* Label positioned above : `config('bootstrap-components.form.labelPositionedAbove')`
* Display success : `config('bootstrap-components.form.formValidation.displaySuccess')`
* Display failure : `config('bootstrap-components.form.formValidation.displayFailure')`

## Select

**Type :** [Selectable](./types.md#selectableabstract)

**Helper :** `select()`

**Facade :** `Select`

**Notes**
* in `single` mode, the selected() method second attribute only accept a string or an integer.
* in `multiple` mode, the selected() method second attribute only accept an array.

**Pre-configuration**

* Prepend : `<i class="fas fa-hand-pointer"></i>`
* Label positioned above : `config('bootstrap-components.form.labelPositionedAbove')`
* Display success : `config('bootstrap-components.form.formValidation.displaySuccess')`
* Display failure : `config('bootstrap-components.form.formValidation.displayFailure')`

# Button components

## Submit

**Type :** [SubmitAbstract](./types.md#submitabstract)

**Helper :** `submit()`

**Facade :** `Submit`

**Pre-configuration**

* Container classes : `btn-primary`

## Submit validate

**Type :** [SubmitAbstract](./types.md#submitabstract)

**Helper :** `submitValidate()`

**Facade :** `SubmitValidate`

**Pre-configuration**

* Prepend : `<i class="fas fa-check fa-fw"></i>`
* Label : `__('bootstrap-components::bootstrap-components.label.validate')`
* Container classes : `btn-primary`

## Submit create

**Type :** [SubmitAbstract](./types.md#submitabstract)

**Helper :** `submitCreate()`

**Facade :** `SubmitCreate`

**Pre-configuration**

* Prepend : `<i class="fas fa-plus-circle fa-fw"></i>`
* Label : `__('bootstrap-components::bootstrap-components.label.create')`
* Container classes : `btn-primary`

## Submit update

**Type :** [SubmitAbstract](./types.md#submitabstract)

**Helper :** `submitUpdate()`

**Facade :** `SubmitUpdate`

**Pre-configuration**

* Prepend : `<i class="fas fa-save fa-fw"></i>`
* Label : `__('bootstrap-components::bootstrap-components.label.update')`
* Container classes : `btn-primary`

## Button

**Type :** [ButtonAbstract](./types.md#buttonabstract)

**Helper :** `button()`

**Facade :** `Button`

**Pre-configuration**

* Container classes : `btn-primary`.

## Button link

**Type :** [ButtonAbstract](./types.md#buttonabstract)

**Helper :** `buttonLink()`

**Facade :** `ButtonLink`

**Pre-configuration**

* Container classes : `btn-primary btn-link`.

## Button back

**Type :** [ButtonAbstract](./types.md#buttonabstract)

**Helper :** `buttonBack()`

**Facade :** `ButtonBack`

**Pre-configuration**

* URL : `url()->previous()`
* Prepend : `<i class="fas fa-undo fa-fw"></i>`
* Label : `__('bootstrap-components::bootstrap-components.label.back')`
* Container classes : `btn-secondary`.

## Button cancel

**Type :** [ButtonAbstract](./types.md#buttonabstract)

**Helper :** `buttonCancel()`

**Facade :** `ButtonCancel`

**Pre-configuration**

* Url : `url()->previous()`
* Prepend : `<i class="fas fa-ban fa-fw"></i>`
* Label : `__('bootstrap-components::bootstrap-components.label.cancel')`
* Container classes : `btn-danger`.

# Media components

## Audio

**Type :** [MediaAbstract](./types.md#mediaabstract)

**Helper :** `audio()`

**Facade :** `Audio`

## Image

**Type :** [ImageAbstract](./types.md#imageabstract)

**Helper :** `image()`

**Facade :** `Image`

**Pre-configuration**

* Container HTML attributes : `controls preload="true"`.

## Video

**Type :** [VideoAbstract](./types.md#videoabstract)

**Helper :** `video()`

**Facade :** `Video`

**Pre-configuration**

* Container HTML attributes : `controls preload="true"`.
