<?php

return [

    /*
     * The fully qualified class name of the components.
     * Here you can override them. Make sure your custom component extends the overridden one.
     */
    'components' => [
        // form
        'text' => Okipa\LaravelBootstrapComponents\Form\Components\Text::class,
        'email' => Okipa\LaravelBootstrapComponents\Form\Components\Email::class,
        'password' => Okipa\LaravelBootstrapComponents\Form\Components\Password::class,
        'url' => Okipa\LaravelBootstrapComponents\Form\Components\Url::class,
        'tel' => Okipa\LaravelBootstrapComponents\Form\Components\Tel::class,
        'number' => Okipa\LaravelBootstrapComponents\Form\Components\Number::class,
        'color' => Okipa\LaravelBootstrapComponents\Form\Components\Color::class,
        'date' => Okipa\LaravelBootstrapComponents\Form\Components\Date::class,
        'time' => Okipa\LaravelBootstrapComponents\Form\Components\Time::class,
        'datetime' => Okipa\LaravelBootstrapComponents\Form\Components\Datetime::class,
        'file' => Okipa\LaravelBootstrapComponents\Form\Components\File::class,
        'checkbox' => Okipa\LaravelBootstrapComponents\Form\Components\Checkbox::class,
        'toggle' => Okipa\LaravelBootstrapComponents\Form\Components\Toggle::class,
        'radio' => Okipa\LaravelBootstrapComponents\Form\Components\Radio::class,
        'textarea' => Okipa\LaravelBootstrapComponents\Form\Components\Textarea::class,
        'select' => Okipa\LaravelBootstrapComponents\Form\Components\Select::class,
        // buttons
        'submit' => Okipa\LaravelBootstrapComponents\Buttons\Components\Submit::class,
        'create' => Okipa\LaravelBootstrapComponents\Buttons\Components\Create::class,
        'update' => Okipa\LaravelBootstrapComponents\Buttons\Components\Update::class,
        'validate' => Okipa\LaravelBootstrapComponents\Buttons\Components\Validate::class,
        'button' => Okipa\LaravelBootstrapComponents\Buttons\Components\Button::class,
        'link' => Okipa\LaravelBootstrapComponents\Buttons\Components\Link::class,
        'back' => Okipa\LaravelBootstrapComponents\Buttons\Components\Back::class,
        'cancel' => Okipa\LaravelBootstrapComponents\Buttons\Components\Cancel::class,
        // media
        'image' => Okipa\LaravelBootstrapComponents\Media\Components\Image::class,
        'audio' => Okipa\LaravelBootstrapComponents\Media\Components\Audio::class,
        'video' => Okipa\LaravelBootstrapComponents\Media\Components\Video::class,
    ],

    /*
    * Form components specific configuration.
    */
    'form' => [
        /*
         * The fully qualified class name of the multilingual resolver.
         * You can override it. Make sure your custom resolver extends this one.
         */
        'multilingualResolver' => Okipa\LaravelBootstrapComponents\Form\Multilingual\Resolver::class,

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
