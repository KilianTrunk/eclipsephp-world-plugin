<?php

return [

    'nav_label' => 'Države',
    'breadcrumb' => 'Države',
    'plural' => 'Države',

    'table' => [
        'id' => [
            'label' => 'ID',
        ],
        'name' => [
            'label' => 'Ime',
        ],
        'flag' => [
            'label' => 'Zastava',
        ],
        'alpha3_id' => [
            'label' => 'A3 šifra',
        ],
        'num_code' => [
            'label' => 'Brojčana šifra',
        ],
    ],

    'actions' => [
        'create' => [
            'label' => 'Nova država',
            'heading' => 'Nova država',
        ],
        'edit' => [
            'label' => 'Uredi',
            'heading' => 'Uređivanje države',
        ],
        'delete' => [
            'label' => 'Izbriši',
            'heading' => 'Brisanje države',
        ],
        'restore' => [
            'label' => 'Obnovi',
            'heading' => 'Obnavljanje države',
        ],
        'force_delete' => [
            'label' => 'Trajno izbriši',
            'heading' => 'Trajno brisanje države',
            'description' => 'Da li ste sigurni da želite izbrisati državu :name? Zapis više neće biti moguće obnoviti.',
        ],
    ],

    'form' => [
        'id' => [
            'label' => 'ID',
            'helper' => 'Dvoslovna oznaka (ISO-3166 Alpha-2)',
        ],
        'name' => [
            'label' => 'Ime',
        ],
        'flag' => [
            'label' => 'Zastava',
        ],
        'alpha3_id' => [
            'label' => 'A3 šifra',
            'helper' => 'Troslovna oznaka (ISO-3166 Alpha-3)',
        ],
        'num_code' => [
            'label' => 'Brojčana šifra',
            'helper' => 'Numerička oznaka (ISO-3166)',
        ],
    ],

    'import' => [
        'action_label' => 'Uvezi države',
        'modal_heading' => 'Uvoz država',
        'job_name' => 'Uvoz država',
    ],

    'notifications' => [
        'queued' => [
            'title' => 'Uvoz država postavljen u vrstu',
        ],
        'completed' => [
            'title' => 'Uvoz država završen',
        ],
        'failed' => [
            'title' => 'Uvoz država neuspešan',
        ],
    ],
];
