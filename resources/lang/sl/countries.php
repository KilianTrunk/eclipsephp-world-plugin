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
            'label' => 'Num. šifra',
        ],
    ],

    'actions' => [
        'create' => [
            'label' => 'Nova država',
            'heading' => 'Nova država',
        ],
        'edit' => [
            'label' => 'Uredi',
            'heading' => 'Urejanje države',
        ],
        'delete' => [
            'label' => 'Izbriši',
            'heading' => 'Brisanje države',
        ],
        'restore' => [
            'label' => 'Obnovi',
            'heading' => 'Obnovitev države',
        ],
        'force_delete' => [
            'label' => 'Trajno izbriši',
            'heading' => 'Trajen izbris države',
            'description' => 'Ste prepričani, da želite izbrisati državo :name? Zapisa ne bo možno več obnoviti.',
        ],
    ],

    'form' => [
        'id' => [
            'label' => 'ID',
            'helper' => 'Dvočrkovna šifra (ISO-3166 Alpha-2)',
        ],
        'name' => [
            'label' => 'Ime',
        ],
        'flag' => [
            'label' => 'Zastava',
        ],
        'alpha3_id' => [
            'label' => 'A3 šifra',
            'helper' => 'Tričrkovna šifra (ISO-3166 Alpha-3)',
        ],
        'num_code' => [
            'label' => 'Num. šifra',
            'helper' => 'Numerična šifra (ISO-3166)',
        ],
    ],

    'import' => [
        'action_label' => 'Uvozi države',
        'modal_heading' => 'Uvoz držav',
        'job_name' => 'Uvoz držav',
    ],

    'notifications' => [
        'queued' => [
            'title' => 'Uvoz držav postavljen v vrsto',
        ],
        'completed' => [
            'title' => 'Uvoz držav uspešno končan',
        ],
        'failed' => [
            'title' => 'Uvoz držav neuspešen',
        ],
    ],
];
