<?php

return [
    /*
     * Each settings class used in your application must be registered, you can
     * put them in the following array.
     */
    'settings' => [
        //
    ],

    /*
     * The path where the settings classes will be created.
     */
    'setting_class_path' => app_path('Settings'),

    /*
     * In production, the settings are cached to speed up performance. If you
     * want to add extra flags these can be set in the following array.
     */
    'cache_path' => storage_path('app/laravel-settings'),

    /*
     * Here you can specify which settings should be encrypted when stored.
     */
    'encrypted' => [
        // 'some_secret_setting',
    ],

    /*
     * Drivers can be used to store settings in different ways. Each driver
     * has its own configuration.
     */
    'drivers' => [
        'database' => [
            'driver' => Spatie\LaravelSettings\SettingsRepositories\DatabaseSettingsRepository::class,
            'table' => 'settings',
            'connection' => null,
        ],
        'redis' => [
            'driver' => Spatie\LaravelSettings\SettingsRepositories\RedisSettingsRepository::class,
            'connection' => null,
            'prefix' => null,
        ],
    ],

    /*
     * The default driver to use when no driver has been specified.
     */
    'default' => 'database',

    /*
     * If you're using the database driver, you can specify here if the
     * migrations should be published.
     */
    'migrations' => [
        'settings_table' => true,
    ],

    /*
     * Global casts will be applied to all settings properties.
     */
    'global_casts' => [
        DateTimeInterface::class => Spatie\LaravelSettings\SettingsCasts\DateTimeInterfaceCast::class,
        DateTimeImmutable::class => Spatie\LaravelSettings\SettingsCasts\DateTimeWrapperCast::class . ':' . DateTimeImmutable::class,
        DateTime::class => Spatie\LaravelSettings\SettingsCasts\DateTimeWrapperCast::class . ':' . DateTime::class,
        // Illuminate\Support\Collection::class => Spatie\LaravelSettings\SettingsCasts\CollectionCast::class,
    ],

    /*
     * The lock store is used to ensure that in concurrent applications, settings
     * are stored in a safe way.
     */
    'lock_store' => 'default',

    /*
     * Milliseconds to wait in case the store is locked.
     */
    'lock_timeout' => 5000,

    /*
     * The cache store is used to cache settings. This speeds up the retrieval
     * of settings. By default the default cache store is used.
     */
    'cache_store' => 'default',
];