<?php

return [

    // form components *************************************************************************************************
    'form'   => [
        'text'     => [
            'view'           => 'bootstrap-components.form.input',
            'prepend'        => '<i class="fas fa-font"></i>',
            'append'         => null,
            'legend'         => null,
            'labelAfter'     => false,
            'class'          => [
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
        'number'   => [
            'view'              => 'bootstrap-components.form.input',
            'prepend'           => '<i class="fas fa-euro-sign"></i>',
            'append'            => null,
            'legend'            => null,
            'labelAfter'     => false,
            'class'             => [
                'container' => ['form-group'],
                'component' => [],
            ],
            'htmlAttributes'    => [
                'container' => [],
                'component' => [],
            ],
            'formValidation' => [
                'displaySuccess' => false,
                'displayFailure' => true,
            ],
        ],
        'tel'      => [
            'view'              => 'bootstrap-components.form.input',
            'prepend'           => '<i class="fas fa-phone"></i>',
            'append'            => null,
            'legend'            => 'bootstrap-components.legend.tel',
            'labelAfter'     => false,
            'class'             => [
                'container' => ['form-group'],
                'component' => [],
            ],
            'htmlAttributes'    => [
                'container' => [],
                'component' => [],
            ],
            'formValidation' => [
                'displaySuccess' => false,
                'displayFailure' => true,
            ],
        ],
        'datetime' => [
            'view'              => 'bootstrap-components.form.input',
            'prepend'           => '<i class="fas fa-calendar-alt"></i>',
            'append'            => null,
            'format'            => 'd/m/Y H:i',
            'legend'            => 'bootstrap-components.legend.datetime',
            'labelAfter'     => false,
            'class'             => [
                'container' => ['form-group'],
                'component' => [],
            ],
            'htmlAttributes'    => [
                'container' => [],
                'component' => [],
            ],
            'formValidation' => [
                'displaySuccess' => false,
                'displayFailure' => true,
            ],
        ],
        'date'     => [
            'view'              => 'bootstrap-components.form.input',
            'prepend'           => '<i class="fas fa-calendar-alt"></i>',
            'append'            => null,
            'format'            => 'd/m/Y',
            'legend'            => 'bootstrap-components.legend.date',
            'labelAfter'     => false,
            'class'             => [
                'container' => ['form-group'],
                'component' => [],
            ],
            'htmlAttributes'    => [
                'container' => [],
                'component' => [],
            ],
            'formValidation' => [
                'displaySuccess' => false,
                'displayFailure' => true,
            ],
        ],
        'time'     => [
            'view'              => 'bootstrap-components.form.input',
            'prepend'           => '<i class="fas fa-clock"></i>',
            'append'            => null,
            'format'            => 'H:i:s',
            'legend'            => 'bootstrap-components.legend.time',
            'labelAfter'     => false,
            'class'             => [
                'container' => ['form-group'],
                'component' => [],
            ],
            'htmlAttributes'    => [
                'container' => [],
                'component' => [],
            ],
            'formValidation' => [
                'displaySuccess' => false,
                'displayFailure' => true,
            ],
        ],
        'url'      => [
            'view'              => 'bootstrap-components.form.input',
            'prepend'           => '<i class="fas fa-link"></i>',
            'append'            => null,
            'legend'            => null,
            'labelAfter'     => false,
            'class'             => [
                'container' => ['form-group'],
                'component' => [],
            ],
            'htmlAttributes'    => [
                'container' => [],
                'component' => [],
            ],
            'formValidation' => [
                'displaySuccess' => false,
                'displayFailure' => true,
            ],
        ],
        'email'    => [
            'view'              => 'bootstrap-components.form.input',
            'prepend'           => '<i class="fas fa-at"></i>',
            'append'            => null,
            'legend'            => null,
            'labelAfter'     => false,
            'class'             => [
                'container' => ['form-group'],
                'component' => [],
            ],
            'htmlAttributes'    => [
                'container' => [],
                'component' => [],
            ],
            'formValidation' => [
                'displaySuccess' => false,
                'displayFailure' => true,
            ],
        ],
        'color'    => [
            'view'              => 'bootstrap-components.form.input',
            'prepend'           => '<i class="fas fa-palette"></i>',
            'append'            => null,
            'legend'            => null,
            'labelAfter'     => false,
            'class'             => [
                'container' => ['form-group'],
                'component' => [],
            ],
            'htmlAttributes'    => [
                'container' => [],
                'component' => [],
            ],
            'formValidation' => [
                'displaySuccess' => false,
                'displayFailure' => true,
            ],
        ],
        'password' => [
            'view'              => 'bootstrap-components.form.input',
            'prepend'           => '<i class="fas fa-user-secret"></i>',
            'append'            => null,
            'legend'            => null,
            'labelAfter'     => false,
            'class'             => [
                'container' => ['form-group'],
                'component' => [],
            ],
            'htmlAttributes'    => [
                'container' => [],
                'component' => [],
            ],
            'formValidation' => [
                'displaySuccess' => false,
                'displayFailure' => true,
            ],
        ],
        'file'     => [
            'view'                 => 'bootstrap-components.form.file',
            'prepend'              => '<i class="fas fa-upload"></i>',
            'append'               => null,
            'legend'               => null,
            'show_remove_checkbox' => true,
            'labelAfter'     => false,
            'class'                => [
                'container' => ['form-group'],
                'component' => [],
            ],
            'htmlAttributes'       => [
                'container' => [],
                'component' => [],
            ],
            'formValidation'    => [
                'displaySuccess' => false,
                'displayFailure' => true,
            ],
        ],
        'textarea' => [
            'view'              => 'bootstrap-components.form.textarea',
            'prepend'           => '<i class="fas fa-comment"></i>',
            'append'            => null,
            'legend'            => null,
            'labelAfter'     => false,
            'class'             => [
                'container' => ['form-group'],
                'component' => [],
            ],
            'htmlAttributes'    => [
                'container' => [],
                'component' => [],
            ],
            'formValidation' => [
                'displaySuccess' => false,
                'displayFailure' => true,
            ],
        ],
        'checkbox' => [
            'view'              => 'bootstrap-components.form.checkbox',
            'prepend'           => null,
            'append'            => null,
            'legend'            => null,
            'class'             => [
                'container' => ['form-group'],
                'component' => [],
            ],
            'htmlAttributes'    => [
                'container' => [],
                'component' => [],
            ],
            'formValidation' => [
                'displaySuccess' => false,
                'displayFailure' => true,
            ],
        ],
        'toggle'   => [
            'view'              => 'bootstrap-components.form.toggle',
            'prepend'           => null,
            'append'            => null,
            'legend'            => null,
            'class'             => [
                'container' => ['form-group'],
                'component' => [],
            ],
            'htmlAttributes'    => [
                'container' => [],
                'component' => [],
            ],
            'formValidation' => [
                'displaySuccess' => false,
                'displayFailure' => true,
            ],
        ],
        'radio'    => [
            'view'              => 'bootstrap-components.form.radio',
            'prepend'           => null,
            'append'            => null,
            'legend'            => null,
            'class'             => [
                'container' => ['form-group'],
                'component' => [],
            ],
            'htmlAttributes'    => [
                'container' => [],
                'component' => [],
            ],
            'formValidation' => [
                'displaySuccess' => false,
                'displayFailure' => true,
            ],
        ],
        'select'   => [
            'view'              => 'bootstrap-components.form.select',
            'prepend'           => '<i class="fas fa-hand-pointer"></i>',
            'append'            => null,
            'legend'            => null,
            'class'             => [
                'container' => ['form-group'],
                'component' => [],
            ],
            'htmlAttributes'    => [
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
            'view'           => 'bootstrap-components.buttons.button',
            'prepend'        => '<i class="fas fa-fw fa-check"></i>',
            'append'         => null,
            'label'          => 'bootstrap-components.label.validate',
            'class'          => [
                'container' => ['form-group'],
                'component' => ['btn', 'btn-primary'],
            ],
            'htmlAttributes' => [
                'container' => [],
                'component' => [],
            ],
        ],
        'create'   => [
            'view'           => 'bootstrap-components.buttons.button',
            'prepend'        => '<i class="fas fa-fw fa-plus-circle"></i>',
            'append'         => null,
            'label'          => 'bootstrap-components.label.create',
            'class'          => [
                'container' => ['form-group'],
                'component' => ['btn', 'btn-primary'],
            ],
            'htmlAttributes' => [
                'container' => [],
                'component' => [],
            ],
        ],
        'update'   => [
            'view'           => 'bootstrap-components.buttons.button',
            'prepend'        => '<i class="fas fa-fw fa-save"></i>',
            'append'         => null,
            'label'          => 'bootstrap-components.label.update',
            'class'          => [
                'container' => ['form-group'],
                'component' => ['btn', 'btn-primary'],
            ],
            'htmlAttributes' => [
                'container' => [],
                'component' => [],
            ],
        ],
        'back'     => [
            'view'           => 'bootstrap-components.buttons.button',
            'prepend'        => '<i class="fas fa-fw fa-undo"></i>',
            'append'         => null,
            'label'          => 'bootstrap-components.label.back',
            'class'          => [
                'container' => ['form-group'],
                'component' => ['btn', 'btn-light'],
            ],
            'htmlAttributes' => [
                'container' => [],
                'component' => [],
            ],
        ],
        'cancel'   => [
            'view'           => 'bootstrap-components.buttons.button',
            'prepend'        => '<i class="fas fa-fw fa-ban"></i>',
            'append'         => null,
            'label'          => 'bootstrap-components.label.cancel',
            'class'          => [
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
    'media'  => [

        'audio' => [
            'view'           => 'bootstrap-components.media.audio',
            'class'          => [
                'container' => [],
                'component' => [],
            ],
            'htmlAttributes' => [
                'container' => [],
                'component' => ['controls', 'preload' => true],
            ],
        ],
        'image' => [
            'view'           => 'bootstrap-components.media.image',
            'class'          => [
                'container' => [],
                'link'      => [],
                'component' => [],
            ],
            'htmlAttributes' => [
                'container' => [],
                'link'      => [],
                'component' => [],
            ],
        ],
        'video' => [
            'view'           => 'bootstrap-components.media.video',
            'poster'         => null,
            'class'          => [
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
