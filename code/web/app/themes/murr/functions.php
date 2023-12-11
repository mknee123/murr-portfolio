<?php

/**
 * Theme includes
 *
 * The $includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 */
$library = [
    // 'vendor/autoload.php', //Required 1st
    'lib/helpers.php', //Required 2nd
    'lib/assets.php',
    'lib/blocks.php',
    'lib/hooks.php',
    'lib/shareLink.php',
    'lib/theme.php',
];

foreach ($library as $lib) {
    require_once __DIR__ . "/{$lib}";
}
