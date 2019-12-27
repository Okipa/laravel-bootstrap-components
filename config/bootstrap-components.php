<?php

return [

    /*
     * The fully qualified class name of the components.
     * Here you can override them. Make sure your custom component extends the overridden one.
     */
    'components' => [
        // form
        'text' => Okipa\LaravelBootstrapComponents\Components\Form\Text::class,
        'email' => Okipa\LaravelBootstrapComponents\Components\Form\Email::class,
        'password' => Okipa\LaravelBootstrapComponents\Components\Form\Password::class,
        'url' => Okipa\LaravelBootstrapComponents\Components\Form\Url::class,
        'tel' => Okipa\LaravelBootstrapComponents\Components\Form\Tel::class,
        'number' => Okipa\LaravelBootstrapComponents\Components\Form\Number::class,
        'color' => Okipa\LaravelBootstrapComponents\Components\Form\Color::class,
        'date' => Okipa\LaravelBootstrapComponents\Components\Form\Date::class,
        'time' => Okipa\LaravelBootstrapComponents\Components\Form\Time::class,
        'datetime' => Okipa\LaravelBootstrapComponents\Components\Form\Datetime::class,
        'file' => Okipa\LaravelBootstrapComponents\Components\Form\File::class,
        'checkbox' => Okipa\LaravelBootstrapComponents\Components\Form\Checkbox::class,
        'toggle' => Okipa\LaravelBootstrapComponents\Components\Form\Toggle::class,
        'radio' => Okipa\LaravelBootstrapComponents\Components\Form\Radio::class,
        'textarea' => Okipa\LaravelBootstrapComponents\Components\Form\Textarea::class,
        'select' => Okipa\LaravelBootstrapComponents\Components\Form\Select::class,
        // buttons
        'submit' => Okipa\LaravelBootstrapComponents\Components\Buttons\Submit::class,
        'create' => Okipa\LaravelBootstrapComponents\Components\Buttons\Create::class,
        'update' => Okipa\LaravelBootstrapComponents\Components\Buttons\Update::class,
        'validate' => Okipa\LaravelBootstrapComponents\Components\Buttons\Validate::class,
        'button' => Okipa\LaravelBootstrapComponents\Components\Buttons\Button::class,
        'link' => Okipa\LaravelBootstrapComponents\Components\Buttons\Link::class,
        'back' => Okipa\LaravelBootstrapComponents\Components\Buttons\Back::class,
        'cancel' => Okipa\LaravelBootstrapComponents\Components\Buttons\Cancel::class,
        // media
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
