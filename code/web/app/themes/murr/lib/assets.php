<?php

/**
 * Name:               assets.php
 * Version:            1.0.1
 * Author:             MK
 */

use GHInt\Assets\Bundle;
use GHInt\Assets\Locator;
use GHInt\Assets\Resources\Scripts\Script;
use Roots\WPConfig\Config;

/**
 * Only load block assets when their block appears on the page.
 * WordPress 6.8+ honours these filters and skips the blanket enqueue.
 */
add_filter('should_load_separate_core_block_assets', '__return_true');
add_filter('should_load_block_assets_on_demand', '__return_true');

// Load all Theme Assets
(new Bundle([
    // Styles
    Locator::styles(settings: [
        'styles/fontawesome' => [
            'preload' => true,
            'version' => filemtime(get_template_directory() . '/public/styles/fontawesome.css'),
            'enqueue' => false,
            'admin' => null,
        ],
        'styles/core' => [
            'dependencies' => ['styles/fontawesome'],
            'preload' => true,
            'version' => filemtime(get_template_directory() . '/public/styles/core.css'),
        ],
        'styles/editor' => [
            'admin' => true,
            'dependencies' => ['styles/fontawesome'],
            'version' => filemtime(get_template_directory() . '/public/styles/editor.css'),
        ],
    ]),

    // Scripts
    Locator::scripts(settings: [
        'scripts/fontawesome' => [
            'enqueue' => false,
        ],
        'scripts/core' => ['preload' => true, 'defer' => true, 'in_footer' => true, 'version' => filemtime(get_template_directory() . '/public/scripts/core.js'),],
        'scripts/posts' => ['preload' => true, 'defer' => true, 'in_footer' => true],
        'scripts/editor' => ['admin' => true, 'version' => filemtime(get_template_directory() . '/public/scripts/editor.js'),],
    ])->add(new Script(
        'jquery',
        'https://code.jquery.com/jquery-3.6.4.min.js',
        ver: '3.6.4',
        preload: true,
    ), 'jquery'),

    // Blocks
    Locator::blocks(),
]))->enable();

add_action('ghint/wp_head_priority', function () {
    if (is_admin()) {
        return;
    }

    $preload = function (string $path, string $as, bool $crossorigin = false) {
        static $printed = [];
        if (!$path || isset($printed[$path])) {
            return;
        }
        $printed[$path] = true;

        printf(
            '<link rel="preload" href="%1$s" as="%2$s"%3$s />' . PHP_EOL,
            esc_url(asset($path)),
            esc_attr($as),
            $crossorigin ? ' crossorigin="anonymous"' : ''
        );
    };
});

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
