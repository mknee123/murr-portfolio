<?php

/**
 * Name:               assets.php
 * Version:            1.0.0
 * Author:             GH Advertising
 */

use GHInt\Assets\Bundle;
use GHInt\Assets\Locator;
use GHInt\Assets\Resources\Scripts\Script;
use GHInt\Assets\Resources\Styles\Style;

// Load all Theme Assets
(new Bundle([
    // Styles
    Locator::styles(settings: [
        'styles/core' => ['preload' => true],
        'styles/editor' => ['admin' => true],
    ]),

    // Scripts
    Locator::scripts(settings: [
        'scripts/core' => ['preload' => true, 'defer' => true, 'in_footer' => true],
        'scripts/posts' => ['preload' => true, 'defer' => true, 'in_footer' => true],
        'scripts/editor' => ['admin' => true],
    ])->add(new Script(
        'jquery',
        'https://code.jquery.com/jquery-3.6.4.min.js',
        ver: '3.6.4',
        preload: true,
    ), 'jquery')->add(new Script(
        'font-awesome-kit',
        'https://kit.fontawesome.com/03b186b2f2.js', //TODO GH default kit, be sure to create and update with client kit
        inFooter: true,
        preload: true,
    ), 'font-awesome-kit'),

    // Blocks
    Locator::blocks(),
]))->enable();

/**
 * Core script overrides
 * Happens before the above
 */
add_action('wp_enqueue_scripts', function () {
    wp_dequeue_script('jquery');
    wp_deregister_script('jquery');
}, 1);

// Mime types - support .svg in media library
add_filter('upload_mimes', function ($mime_types) {
    $mime_types['svg'] = 'image/svg+xml';
    $mime_types['svgz'] = 'image/svg+xml';
    return $mime_types;
});

/**
 * Remove extra default WordPress inserts
 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links');
