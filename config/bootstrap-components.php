<?php

return [

    /*
     * The fully qualified class name of the components.
     * Here you can override them. Make sure your custom component extends the overridden one.
     */
    'components' => [
        // Form
        'text' => Okipa\LaravelBootstrapComponents\Components\Form\InputText::class,
        'email' => Okipa\LaravelBootstrapComponents\Components\Form\InputEmail::class,
        'password' => Okipa\LaravelBootstrapComponents\Components\Form\InputPassword::class,
        'url' => Okipa\LaravelBootstrapComponents\Components\Form\InputUrl::class,
        'tel' => Okipa\LaravelBootstrapComponents\Components\Form\InputTel::class,
        'number' => Okipa\LaravelBootstrapComponents\Components\Form\InputNumber::class,
        'color' => Okipa\LaravelBootstrapComponents\Components\Form\InputColor::class,
        'date' => Okipa\LaravelBootstrapComponents\Components\Form\InputDate::class,
        'time' => Okipa\LaravelBootstrapComponents\Components\Form\InputTime::class,
        'datetime' => Okipa\LaravelBootstrapComponents\Components\Form\InputDatetime::class,
        'file' => Okipa\LaravelBootstrapComponents\Components\Form\InputFile::class,
        'checkbox' => Okipa\LaravelBootstrapComponents\Components\Form\InputCheckbox::class,
        'switch' => Okipa\LaravelBootstrapComponents\Components\Form\InputSwitch::class,
        'radio' => Okipa\LaravelBootstrapComponents\Components\Form\InputRadio::class,
        'textarea' => Okipa\LaravelBootstrapComponents\Components\Form\Textarea::class,
        'select' => Okipa\LaravelBootstrapComponents\Components\Form\Select::class,
        // Buttons
        'submit' => Okipa\LaravelBootstrapComponents\Components\Buttons\Submit::class,
        'create' => Okipa\LaravelBootstrapComponents\Components\Buttons\SubmitCreate::class,
        'update' => Okipa\LaravelBootstrapComponents\Components\Buttons\SubmitUpdate::class,
        'validate' => Okipa\LaravelBootstrapComponents\Components\Buttons\SubmitValidate::class,
        'button' => Okipa\LaravelBootstrapComponents\Components\Buttons\Button::class,
        'link' => Okipa\LaravelBootstrapComponents\Components\Buttons\ButtonLink::class,
        'back' => Okipa\LaravelBootstrapComponents\Components\Buttons\ButtonBack::class,
        'cancel' => Okipa\LaravelBootstrapComponents\Components\Buttons\ButtonCancel::class,
        // Media
        'image' => Okipa\LaravelBootstrapComponents\Components\Media\Image::class,
        'audio' => Okipa\LaravelBootstrapComponents\Components\Media\Audio::class,
        'video' => Okipa\LaravelBootstrapComponents\Components\Media\Video::class,
    ],

    /*
    * Form components specific configuration.
    */
    'form' => [
        /*
         * The fully qualified class name of the multilingual resolver.
         * You can override it. Make sure your custom resolver extends this one.
         */
        'multilingualResolver' => Okipa\LaravelBootstrapComponents\Components\Form\Multilingual\Resolver::class,

        /*
         * Whether the form component label is positioned above the component itself.
         * If not positioned above, the label will be positioned under the input
         * (may be useful for bootstrap 4 floating labels).
         */
        'labelPositionedAbove' => true,

        /*
         * Whether the form component should display its success or failure status.
         */
        'formValidation' => [
            'displaySuccess' => false,
            'displayFailure' => true,
        ],
    ],

];
