<?php

return [

    /*
     * Form components configuration.
     */
    'form' => [

        /*
         * The fully qualified class name of the form components.
         * Here you can override them. Make sure your custom component extends the overridden one.
         */
        'components' => [
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
        ],

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

        'textarea' => [
            'view' => 'bootstrap-components.form.textarea',
            'prepend' => '<i class="fas fa-comment"></i>',
            'append' => null,
            'labelPositionedAbove' => true,
            'legend' => null,
            'classes' => [
                'container' => ['form-group'],
                'component' => [],
            ],
            'htmlAttributes' => [
                'container' => [],
                'component' => [],
            ],
            'formValidation' => [
                'displaySuccess' => false,
                'displayFailure' => true,
            ],
        ],

        'select' => [
            'view' => 'bootstrap-components.form.select',
            'prepend' => '<i class="fas fa-hand-pointer"></i>',
            'append' => null,
            'labelPositionedAbove' => true,
            'legend' => null,
            'classes' => [
                'container' => ['form-group'],
                'component' => [],
            ],
            'htmlAttributes' => [
                'container' => [],
                'component' => [],
            ],
            'formValidation' => [
                'displaySuccess' => false,
                'displayFailure' => true,
            ],
        ],
    ],

    // buttons components **********************************************************************************************
    'button' => [

        'validate' => [
            'view' => 'bootstrap-components.buttons.button',
            'prepend' => '<i class="fas fa-fw fa-check"></i>',
            'append' => null,
            'label' => 'bootstrap-components.label.validate',
            'classes' => [
                'container' => ['form-group'],
                'component' => ['btn', 'btn-primary'],
            ],
            'htmlAttributes' => [
                'container' => [],
                'component' => [],
            ],
        ],

        'create' => [
            'view' => 'bootstrap-components.buttons.button',
            'prepend' => '<i class="fas fa-fw fa-plus-circle"></i>',
            'append' => null,
            'label' => 'bootstrap-components.label.create',
            'classes' => [
                'container' => ['form-group'],
                'component' => ['btn', 'btn-primary'],
            ],
            'htmlAttributes' => [
                'container' => [],
                'component' => [],
            ],
        ],

        'update' => [
            'view' => 'bootstrap-components.buttons.button',
            'prepend' => '<i class="fas fa-fw fa-save"></i>',
            'append' => null,
            'label' => 'bootstrap-components.label.update',
            'classes' => [
                'container' => ['form-group'],
                'component' => ['btn', 'btn-primary'],
            ],
            'htmlAttributes' => [
                'container' => [],
                'component' => [],
            ],
        ],

        'back' => [
            'view' => 'bootstrap-components.buttons.button',
            'prepend' => '<i class="fas fa-fw fa-undo"></i>',
            'append' => null,
            'label' => 'bootstrap-components.label.back',
            'classes' => [
                'container' => ['form-group'],
                'component' => ['btn', 'btn-light'],
            ],
            'htmlAttributes' => [
                'container' => [],
                'component' => [],
            ],
        ],

        'cancel' => [
            'view' => 'bootstrap-components.buttons.button',
            'prepend' => '<i class="fas fa-fw fa-ban"></i>',
            'append' => null,
            'label' => 'bootstrap-components.label.cancel',
            'classes' => [
                'container' => ['form-group'],
                'component' => ['btn', 'btn-danger'],
            ],
            'htmlAttributes' => [
                'container' => [],
                'component' => [],
            ],
        ],
    ],

    // media components ************************************************************************************************
    'media' => [

        'audio' => [
            'view' => 'bootstrap-components.media.audio',
            'classes' => [
                'container' => [],
                'component' => [],
            ],
            'htmlAttributes' => [
                'container' => [],
                'component' => ['controls', 'preload' => true],
            ],
        ],

        'image' => [
            'view' => 'bootstrap-components.media.image',
            'classes' => [
                'container' => [],
                'link' => [],
                'component' => [],
            ],
            'htmlAttributes' => [
                'container' => [],
                'link' => [],
                'component' => [],
            ],
        ],

        'video' => [
            'view' => 'bootstrap-components.media.video',
            'poster' => null,
            'classes' => [
                'container' => [],
                'component' => [],
            ],
            'htmlAttributes' => [
                'container' => [],
                'component' => ['controls', 'preload' => true],
            ],
        ],
    ],

];
