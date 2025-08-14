<?php

return [

    'nav_label' => 'Valute',
    'breadcrumb' => 'Valute',
    'plural' => 'Valute',

    'table' => [
        'id' => [
            'label' => 'Koda',
        ],
        'name' => [
            'label' => 'Ime',
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
            'heading' => 'Uredi valuto',
        ],
        'delete' => [
            'label' => 'Izbriši',
            'heading' => 'Izbriši valuto',
        ],
        'restore' => [
            'label' => 'Obnovi',
            'heading' => 'Obnovi valuto',
        ],
        'force_delete' => [
            'label' => 'Trajno izbriši',
            'heading' => 'Trajno brisanje valute',
            'description' => 'Ali ste prepričani, da želite izbrisati valuto :name? Tega dejanja ni mogoče razveljaviti.',
        ],
    ],

    'form' => [
        'id' => [
            'label' => 'Koda',
            'helper' => 'Tritrkovna koda valute (ISO 4217)',
        ],
        'name' => [
            'label' => 'Ime',
        ],
        'is_active' => [
            'label' => 'Aktivna',
        ],
    ],

    'import' => [
        'action_label' => 'Uvozi valute',
        'modal_heading' => 'Uvozi valute',
        'job_name' => 'Uvozi valute',
    ],

    'notifications' => [
        'queued' => [
            'title' => 'Uvoz valut je v čakalni vrsti',
        ],
        'completed' => [
            'title' => 'Uvoz valut je končan',
        ],
        'failed' => [
            'title' => 'Uvoz valut ni uspel',
        ],
    ],
];
