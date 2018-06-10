<?php

$translationsDotPath = 'components.';

return [

    // inputs **********************************************************************************************************
    'input'                 => [
        'view'       => 'components.input',
        'icon'       => null,
        'legend'     => null,
        'class'      => [
            'container' => ['form-group'],
            'component' => [],
        ],
        'attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],
    'text'                  => [
        'view'       => 'components.input',
        'icon'       => '<i class="fas fa-font"></i>',
        'class'      => [
            'container' => ['form-group'],
            'component' => [],
        ],
        'attributes' => [
            'container' => [],
            'component' => [],
        ],
        'legend'     => null,
    ],
    'tel'                   => [
        'view'       => 'components.input',
        'icon'       => '<i class="fas fa-phone"></i>',
        'class'      => [
            'container' => ['form-group'],
            'component' => [],
        ],
        'attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],
    'email'                 => [
        'view'       => 'components.input',
        'icon'       => '<i class="fas fa-at"></i>',
        'class'      => [
            'container' => ['form-group'],
            'component' => [],
        ],
        'attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],
    'password'              => [
        'view'       => 'components.input',
        'icon'       => '<i class="fas fa-user-secret"></i>',
        'class'      => [
            'container' => ['form-group'],
            'component' => [],
        ],
        'attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],
    'file'                  => [
        'view'       => 'components.file',
        'icon'       => '<i class="fas fa-upload"></i>',
        'class'      => [
            'container' => ['form-group'],
            'component' => [],
        ],
        'attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],
    'toggle'                => [
        'view'       => 'components.toggle',
        'icon'       => '<i class="fas fa-power-off"></i>',
        'class'      => [
            'container' => ['form-group'],
            'component' => [],
        ],
        'attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],
    'library-file'          => [
        'view'       => 'components.library-file',
        'icon'       => '<i class="fas fa-upload"></i>',
        'class'      => [
            'container' => ['form-group'],
            'component' => [],
        ],
        'attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],

    // buttons *********************************************************************************************************
    'button'                => [
        'view'       => 'components.button',
        'class'      => [
            'container' => ['form-group'],
            'component' => ['btn'],
        ],
        'attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],
    'validate'              => [
        'view'       => 'components.button',
        'icon'       => '<i class="fas fa-fw fa-check"></i>',
        'label'      => $translationsDotPath . 'label.validate',
        'class'      => [
            'container' => ['form-group'],
            'component' => ['btn', 'btn-primary', 'spin-on-click'],
        ],
        'attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],
    'create'                => [
        'view'       => 'components.button',
        'icon'       => '<i class="fas fa-fw fa-plus-circle"></i>',
        'label'      => $translationsDotPath . 'label.create',
        'class'      => [
            'container' => ['form-group'],
            'component' => ['btn', 'btn-primary', 'spin-on-click'],
        ],
        'attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],
    'update'                => [
        'view'       => 'components.button',
        'icon'       => '<i class="fas fa-fw fa-save"></i>',
        'label'      => $translationsDotPath . 'label.update',
        'class'      => [
            'container' => ['form-group'],
            'component' => ['btn', 'btn-primary', 'spin-on-click'],
        ],
        'attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],
    'back'                  => [
        'view'       => 'components.button',
        'icon'       => '<i class="fas fa-fw fa-undo"></i>',
        'label'      => $translationsDotPath . 'label.back',
        'class'      => [
            'container' => ['form-group'],
            'component' => ['btn', 'btn-light', 'spin-on-click'],
        ],
        'attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],
    'cancel'                => [
        'view'       => 'components.button',
        'icon'       => '<i class="fas fa-fw fa-ban"></i>',
        'label'      => $translationsDotPath . 'label.cancel',
        'class'      => [
            'container' => ['form-group'],
            'component' => ['btn', 'btn-light', 'spin-on-click'],
        ],
        'attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],

    // files ***********************************************************************************************************
    'audio'                 => [
        'view'       => 'components.video',
        'class'      => [
            'container' => [],
            'component' => [],
        ],
        'attributes' => [
            'container' => [],
            'component' => ['controls', 'preload' => true],
        ],
    ],
    'image'                 => [
        'view'       => 'components.image',
        'class'      => [
            'container' => [],
            'link'      => [],
            'component' => [],
        ],
        'attributes' => [
            'container' => [],
            'link'      => [],
            'component' => [],
        ],
    ],
    'video'                 => [
        'view'       => 'components.video',
        'poster'     => null,
        'class'      => [
            'container' => [],
            'component' => [],
        ],
        'attributes' => [
            'container' => [],
            'component' => ['controls', 'preload' => true],
        ],
    ],
    'library-audio'         => [
        'view'       => 'components.library-audio',
        'class'      => [
            'container' => ['mw-100'],
            'component' => [],
        ],
        'attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],
    'library-image'         => [
        'view'       => 'components.library-image',
        'class'      => [
            'container' => ['mw-100'],
            'link'      => [],
            'component' => [],
        ],
        'attributes' => [
            'container' => [],
            'link'      => ['data-lity'],
            'component' => [],
        ],
    ],
    'library-video'         => [
        'view'       => 'components.library-video',
        'poster'     => 'https://truffle-assets.imgix.net/0d26ee59-813-lucyjuicycrunchburger-land1.jpg',
        'class'      => [
            'container' => ['mw-100'],
            'component' => [],
        ],
        'attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],
    'library-document'      => [
        'view'       => 'components.library-document',
        'class'      => [
            'container' => ['mw-100'],
            'link'      => [],
            'component' => ['new-window'],
        ],
        'attributes' => [
            'container' => [],
            'link'      => [],
            'component' => [],
        ],
    ],
    'library-uploaded-file' => [
        'view'       => 'components.library-uploaded-file',
        'class'      => [
            'container' => ['pb-2'],
            'component' => [],
        ],
        'attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],

];
