<?php

return [

    'label' => [
        'validate' => 'Validate',
        'create'   => 'Create',
        'update'   => 'Update',
        'back'     => 'Back',
        'cancel'   => 'Cancel',
        'file'     => 'No file selected.',
        'download' => 'Download',
    ],

    'notification' => [
        'audio'      => 'Your browser does not support the « audio » HTML5 tag.',
        'video'      => 'Your browser does not support the « video » HTML5 tag.',
        'validation' => [
            'success' => 'Field correctly filled.',
        ],
    ],

    'legend' => [
        'tel'      => 'Please fill in the telephone number with its country code (e.g. +44 for UK).',
        'date'     => 'Awaited format : ' . config('bootstrap-components.form.date.format'),
        'datetime' => 'Awaited format : ' . config('bootstrap-components.form.datetime.format'),
    ],
];
