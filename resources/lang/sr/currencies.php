<?php

return [

    'nav_label' => 'Valute',
    'breadcrumb' => 'Valute',
    'plural' => 'Valute',

    'table' => [
        'id' => [
            'label' => 'Kod',
        ],
        'name' => [
            'label' => 'Naziv',
        ],
        'is_active' => [
            'label' => 'Aktivna',
        ],
    ],

    'actions' => [
        'create' => [
            'label' => 'Nova valuta',
            'heading' => 'Nova valuta',
        ],
        'edit' => [
            'label' => 'Uredi',
            'heading' => 'Uređivanje valute',
        ],
        'delete' => [
            'label' => 'Izbriši',
            'heading' => 'Brisanje valute',
        ],
        'restore' => [
            'label' => 'Obnovi',
            'heading' => 'Obnavljanje valute',
        ],
        'force_delete' => [
            'label' => 'Trajno izbriši',
            'heading' => 'Trajno brisanje valute',
            'description' => 'Da li ste sigurni da želite izbrisati valutu :name? Zapis više neće biti moguće obnoviti.',
        ],
    ],

    'form' => [
        'id' => [
            'label' => 'Kod',
            'helper' => 'Troslovni kod valute (ISO 4217)',
        ],
        'name' => [
            'label' => 'Naziv',
        ],
        'is_active' => [
            'label' => 'Aktivna',
        ],
    ],

    'import' => [
        'action_label' => 'Uvezi valute',
        'modal_heading' => 'Uvoz valuta',
        'job_name' => 'Uvezi valute',
    ],

    'notifications' => [
        'queued' => [
            'title' => 'Uvoz valuta je u redu čekanja',
        ],
        'completed' => [
            'title' => 'Uvoz valuta završen',
        ],
        'failed' => [
            'title' => 'Uvoz valuta neuspešan',
        ],
    ],
];
