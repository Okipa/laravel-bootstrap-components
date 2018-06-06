<?php

$componentsDotPath = 'components.';
$translationsDotPath = 'components.';

return [

    // inputs **********************************************************************************************************
    'input'                 => [
        'view'       => $componentsDotPath . 'input',
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
        'view'       => $componentsDotPath . 'input',
        'icon'       => '<i class="fas fa-font"></i>',
        'class'      => [
            'container' => ['form-group'],
            'component' => [],
        ],
        'attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],
    'tel'                   => [
        'view'       => $componentsDotPath . 'input',
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
        'view'       => $componentsDotPath . 'input',
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
        'view'       => $componentsDotPath . 'input',
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
        'view'       => $componentsDotPath . 'file',
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
        'view'       => $componentsDotPath . 'toggle',
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
        'view'       => $componentsDotPath . 'library-file',
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
        'view'       => $componentsDotPath . 'button',
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
        'view'       => $componentsDotPath . 'button',
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
        'view'       => $componentsDotPath . 'button',
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
        'view'       => $componentsDotPath . 'button',
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
        'view'       => $componentsDotPath . 'button',
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
        'view'       => $componentsDotPath . 'button',
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
        'view'       => $componentsDotPath . 'video',
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
        'view'       => $componentsDotPath . 'image',
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
        'view'       => $componentsDotPath . 'video',
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
        'view'       => $componentsDotPath . 'library-audio',
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
        'view'       => $componentsDotPath . 'library-image',
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
        'view'       => $componentsDotPath . 'library-video',
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
        'view'       => $componentsDotPath . 'library-document',
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
        'view'       => $componentsDotPath . 'library-uploaded-file',
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
