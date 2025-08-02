<?php

return [
    'nav_label' => 'Pošte',
    'breadcrumb' => 'Pošte',
    'plural' => 'Pošte',

    'table' => [
        'country' => [
            'label' => 'Država',
        ],
        'code' => [
            'label' => 'Šifra',
        ],
        'name' => [
            'label' => 'Ime',
        ],
    ],

    'actions' => [
        'create' => [
            'label' => 'Nova pošta',
            'heading' => 'Ustvarjanje pošte',
        ],
        'edit' => [
            'label' => 'Uredi',
            'heading' => 'Urejanje pošte',
        ],
        'delete' => [
            'label' => 'Izbriši',
            'heading' => 'Brisanje pošte',
        ],
        'restore' => [
            'label' => 'Obnovi',
            'heading' => 'Obnovitev pošte',
        ],
        'force_delete' => [
            'label' => 'Trajno izbriši',
            'heading' => 'Trajen izbris pošte',
            'description' => 'Ste prepričani, da želite izbrisati pošto :name? Zapisa ne bo možno več obnoviti.',
        ],
    ],

    'form' => [
        'country_id' => [
            'label' => 'Država',
        ],
        'code' => [
            'label' => 'Šifra',
        ],
        'name' => [
            'label' => 'Ime',
        ],
    ],

    'filter' => [
        'country' => [
            'label' => 'Država',
        ],
    ],

    'validation' => [
        'unique_country_code' => 'Pošta s to šifro že obstaja za izbrano državo.',
    ],

    'import' => [
        'action_label' => 'Uvozi pošte',
        'modal_heading' => 'Uvoz pošt',
        'country_label' => 'Izberi državo',
        'country_helper' => 'Izberi državo, za katero želiš uvoziti poštne podatke',
        'job_name' => 'Uvoz pošt',
    ],

    'notifications' => [
        'queued' => [
            'message' => 'Opravilo za uvoz pošt za državo :country je bilo dodana v vrsto.',
        ],
        'completed' => [
            'message' => 'Poštni podatki za državo :country so bili uspešno uvoženi.',
        ],
        'failed' => [
            'message' => 'Uvoz poštnih podatkov za državo :country ni uspel.',
        ],
    ],
];
