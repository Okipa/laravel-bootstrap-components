<?php

return [

    'label' => [
        'validate' => 'Valider',
        'create'   => 'Créer',
        'update'   => 'Mettre à jour',
        'back'     => 'Retour',
        'cancel'   => 'Annuler',
        'file'     => 'Aucun fichier choisi.',
        'download' => 'Télécharger',
    ],

    'notification' => [
        'audio'      => 'Votre navigateur ne supporte pas le tag HTML5 « audio ».',
        'video'      => 'Votre navigateur ne supporte pas le tag HTML5 « video ».',
        'validation' => [
            'success' => 'Champ correctement renseigné.',
        ],
    ],

    'legend' => [
        'tel'      => 'Veuillez saisir le numéro de téléphone avec son indicatif pays (exemple : +33 pour la France).',
        'date'     => 'Format attendu : ' . config('bootstrap-components.form.date.format'),
        'datetime' => 'Format attendu : ' . config('bootstrap-components.form.datetime.format'),
    ],
];
