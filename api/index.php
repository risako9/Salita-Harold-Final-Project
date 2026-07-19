<?php

$storagePath = '/tmp/storage';
$bootstrapCachePath = '/tmp/bootstrap/cache';

foreach ([
    $storagePath.'/app/private',
    $storagePath.'/app/public',
    $storagePath.'/framework/cache/data',
    $storagePath.'/framework/sessions',
    $storagePath.'/framework/views',
    $storagePath.'/logs',
    $bootstrapCachePath,
] as $directory) {
    if (! is_dir($directory)) {
        mkdir($directory, 0755, true);
    }
}

$runtimePaths = [
    'LARAVEL_STORAGE_PATH' => $storagePath,
    'APP_CONFIG_CACHE' => $bootstrapCachePath.'/config.php',
    'APP_EVENTS_CACHE' => $bootstrapCachePath.'/events.php',
    'APP_PACKAGES_CACHE' => $bootstrapCachePath.'/packages.php',
    'APP_ROUTES_CACHE' => $bootstrapCachePath.'/routes.php',
    'APP_SERVICES_CACHE' => $bootstrapCachePath.'/services.php',
    'VIEW_COMPILED_PATH' => $storagePath.'/framework/views',
];

foreach ($runtimePaths as $name => $value) {
    $_ENV[$name] = $value;
    $_SERVER[$name] = $value;
    putenv("{$name}={$value}");
}

require __DIR__.'/../public/index.php';
