<?php

/**
 * Theme includes
 *
 * The $includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 */
$library = [
    'lib/helpers.php', //Required 1st
    'lib/assets.php',
    'lib/blocks.php',
    'lib/hooks.php',
    'lib/theme.php',
];

foreach ($library as $lib) {
    require_once __DIR__ . "/{$lib}";
}
