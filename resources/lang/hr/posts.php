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
            'heading' => 'Stvaranje pošte',
        ],
        'edit' => [
            'label' => 'Uredi',
            'heading' => 'Uređivanje pošte',
        ],
        'delete' => [
            'label' => 'Izbriši',
            'heading' => 'Brisanje pošte',
        ],
        'restore' => [
            'label' => 'Obnovi',
            'heading' => 'Obnova pošte',
        ],
        'force_delete' => [
            'label' => 'Trajno izbriši',
            'heading' => 'Trajno brisanje pošte',
            'description' => 'Jeste li sigurni da želite izbrisati poštu :name? Zapis više neće biti moguće obnoviti.',
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
        'unique_country_code' => 'Pošta s ovom šifrom već postoji za odabranu državu.',
    ],

    'import' => [
        'action_label' => 'Uvezi pošte',
        'modal_heading' => 'Uvoz pošta',
        'country_label' => 'Odaberi državu',
        'country_helper' => 'Odaberi državu za koju želiš uvoziti poštanske podatke',
        'job_name' => 'Uvoz pošta',
    ],

    'notifications' => [
        'queued' => [
            'message' => 'Uvoz pošta za državu :country postavljen u vrstu.',
        ],
        'completed' => [
            'message' => 'Poštanski podaci za državu :country su uspješno uveženi.',
        ],
        'failed' => [
            'message' => 'Neuspješan uvoz poštanskih podataka za državu :country.',
        ],
    ],
];
