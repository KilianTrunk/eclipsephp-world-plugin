<?php

return [

    'nav_label' => 'Countries',
    'breadcrumb' => 'Countries',
    'plural' => 'Countries',

    'table' => [
        'id' => [
            'label' => 'ID',
        ],
        'name' => [
            'label' => 'Name',
        ],
        'flag' => [
            'label' => 'Flag',
        ],
        'alpha3_id' => [
            'label' => 'Alpha-3 Code',
        ],
        'num_code' => [
            'label' => 'Num. Code',
        ],
    ],

    'actions' => [
        'create' => [
            'label' => 'New country',
            'heading' => 'New Country',
        ],
        'edit' => [
            'label' => 'Edit',
            'heading' => 'Edit Country',
        ],
        'delete' => [
            'label' => 'Delete',
            'heading' => 'Delete Country',
        ],
        'restore' => [
            'label' => 'Restore',
            'heading' => 'Restore Country',
        ],
        'force_delete' => [
            'label' => 'Permanent delete',
            'heading' => 'Permanent Deletion of Country',
            'description' => 'Are you sure you want to delete the country :name? This action cannot be undone.',
        ],
    ],

    'form' => [
        'id' => [
            'label' => 'ID',
            'helper' => 'Two-letter code (ISO-3166 Alpha-2)',
        ],
        'name' => [
            'label' => 'Name',
        ],
        'flag' => [
            'label' => 'Flag',
        ],
        'alpha3_id' => [
            'label' => 'Alpha-3 code',
            'helper' => 'Three-letter code (ISO-3166 Alpha-3)',
        ],
        'num_code' => [
            'label' => 'Numeric code',
            'helper' => 'Numeric code (ISO-3166)',
        ],
    ],
];
