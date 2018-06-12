<?php

return [

    // form ************************************************************************************************************
    'input'           => [
        'view'            => 'bootstrap-components.input',
        'icon'            => null,
        'legend'          => null,
        'class'           => [
            'container' => ['form-group'],
            'component' => [],
        ],
        'html_attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],
    'input_text'      => [
        'view'            => 'bootstrap-components.input',
        'icon'            => '<i class="fas fa-font"></i>',
        'legend'          => null,
        'class'           => [
            'container' => ['form-group'],
            'component' => [],
        ],
        'html_attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],
    'input_tel'       => [
        'view'            => 'bootstrap-components.input',
        'icon'            => '<i class="fas fa-phone"></i>',
        'legend'          => null,
        'class'           => [
            'container' => ['form-group'],
            'component' => [],
        ],
        'html_attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],
    'input_email'     => [
        'view'            => 'bootstrap-components.input',
        'icon'            => '<i class="fas fa-at"></i>',
        'legend'          => null,
        'class'           => [
            'container' => ['form-group'],
            'component' => [],
        ],
        'html_attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],
    'input_password'  => [
        'view'            => 'bootstrap-components.input',
        'icon'            => '<i class="fas fa-user-secret"></i>',
        'legend'          => null,
        'class'           => [
            'container' => ['form-group'],
            'component' => [],
        ],
        'html_attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],
    'input_file'      => [
        'view'            => 'bootstrap-components.input-file',
        'icon'            => '<i class="fas fa-upload"></i>',
        'legend'          => null,
        'class'           => [
            'container' => ['form-group'],
            'component' => [],
        ],
        'html_attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],
    'input_toggle'    => [
        'view'            => 'bootstrap-components.input-toggle',
        'icon'            => '<i class="fas fa-power-off"></i>',
        'legend'          => null,
        'class'           => [
            'container' => ['form-group'],
            'component' => [],
        ],
        'html_attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],
    'input_textarea'  => [
        'view'            => 'bootstrap-components.input-textarea',
        'icon'            => '<i class="fas fa-power-off"></i>',
        'legend'          => null,
        'class'           => [
            'container' => ['form-group'],
            'component' => [],
        ],
        'html_attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],

    // buttons *********************************************************************************************************
    'button'          => [
        'view'            => 'bootstrap-components.button',
        'icon'            => null,
        'label'           => null,
        'class'           => [
            'container' => ['form-group'],
            'component' => ['btn'],
        ],
        'html_attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],
    'button_validate' => [
        'view'            => 'bootstrap-components.button',
        'icon'            => '<i class="fas fa-fw fa-check"></i>',
        'label'           => 'bootstrap-components.label.validate',
        'class'           => [
            'container' => ['form-group'],
            'component' => ['btn', 'btn-primary', 'spin-on-click'],
        ],
        'html_attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],
    'button_create'   => [
        'view'            => 'bootstrap-components.button',
        'icon'            => '<i class="fas fa-fw fa-plus-circle"></i>',
        'label'           => 'bootstrap-components.label.create',
        'class'           => [
            'container' => ['form-group'],
            'component' => ['btn', 'btn-primary', 'spin-on-click'],
        ],
        'html_attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],
    'button_update'   => [
        'view'            => 'bootstrap-components.button',
        'icon'            => '<i class="fas fa-fw fa-save"></i>',
        'label'           => 'bootstrap-components.label.update',
        'class'           => [
            'container' => ['form-group'],
            'component' => ['btn', 'btn-primary', 'spin-on-click'],
        ],
        'html_attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],
    'button_back'            => [
        'view'            => 'bootstrap-components.button',
        'icon'            => '<i class="fas fa-fw fa-undo"></i>',
        'label'           => 'bootstrap-components.label.back',
        'class'           => [
            'container' => ['form-group'],
            'component' => ['btn', 'btn-light', 'spin-on-click'],
        ],
        'html_attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],
    'button_cancel'          => [
        'view'            => 'bootstrap-components.button',
        'icon'            => '<i class="fas fa-fw fa-ban"></i>',
        'label'           => 'bootstrap-components.label.cancel',
        'class'           => [
            'container' => ['form-group'],
            'component' => ['btn', 'btn-light', 'spin-on-click'],
        ],
        'html_attributes' => [
            'container' => [],
            'component' => [],
        ],
    ],

    // files ***********************************************************************************************************
    'media_audio'     => [
        'view'            => 'bootstrap-components.video',
        'class'           => [
            'container' => [],
            'component' => [],
        ],
        'html_attributes' => [
            'container' => [],
            'component' => ['controls', 'preload' => true],
        ],
    ],
    'media_image'     => [
        'view'            => 'bootstrap-components.image',
        'class'           => [
            'container' => [],
            'link'      => [],
            'component' => [],
        ],
        'html_attributes' => [
            'container' => [],
            'link'      => [],
            'component' => [],
        ],
    ],
    'media_video'     => [
        'view'            => 'bootstrap-components.video',
        'poster'          => null,
        'class'           => [
            'container' => [],
            'component' => [],
        ],
        'html_attributes' => [
            'container' => [],
            'component' => ['controls', 'preload' => true],
        ],
    ],
];
