<?php

/**
 * Name:      assets.php
 * Version:   1.0.1
 * Author:    MK
 */

/**
 * Only load block assets when their block appears on the page.
 * WordPress 6.8+ honours these filters and skips the blanket enqueue.
 */
add_filter('should_load_separate_core_block_assets', '__return_true');
add_filter('should_load_block_assets_on_demand', '__return_true');

/**
 * Helpers for versioned assets.
 */
function murr_asset_version(string $path): ?string {
    $full = get_theme_file_path(ltrim($path, '/'));
    return file_exists($full) ? (string)filemtime($full) : null;
}

/**
 * Load script dependencies/version from wp-scripts asset metadata.
 */
function murr_script_asset(string $path): array {
    $asset_path = preg_replace('/\.js$/', '.asset.php', $path);
    if ($asset_path) {
        $full_asset = get_theme_file_path(ltrim($asset_path, '/'));
        if (file_exists($full_asset)) {
            $asset = require $full_asset;
            return [
                'deps' => $asset['dependencies'] ?? [],
                'version' => $asset['version'] ?? murr_asset_version($path),
            ];
        }
    }

    return [
        'deps' => [],
        'version' => murr_asset_version($path),
    ];
}

/**
 * Front-end assets.
 */
add_action('wp_enqueue_scripts', function () {
    $fontawesome_css = 'public/styles/fontawesome.css';
    if (file_exists(get_theme_file_path($fontawesome_css))) {
        // wp_enqueue_style('murr-fontawesome', asset($fontawesome_css), [], murr_asset_version($fontawesome_css));
        wp_register_style('murr-fontawesome', asset($fontawesome_css), [], murr_asset_version($fontawesome_css));
    }

    $core_css = 'public/styles/core.css';
    if (file_exists(get_theme_file_path($core_css))) {
        $deps = wp_style_is('murr-fontawesome', 'registered') ? ['murr-fontawesome'] : [];
        wp_enqueue_style('murr-core', asset($core_css), $deps, murr_asset_version($core_css));
    }

    // $fontawesome_js = 'public/scripts/fontawesome.js';
    // if (file_exists(get_theme_file_path($fontawesome_js))) {
    //     $asset = murr_script_asset($fontawesome_js);
    //     wp_enqueue_script('murr-fontawesome', asset($fontawesome_js), $asset['deps'], $asset['version'], true);
    // }

    $core_js = 'public/scripts/core.js';
    if (file_exists(get_theme_file_path($core_js))) {
        $asset = murr_script_asset($core_js);
        wp_enqueue_script('murr-core', asset($core_js), $asset['deps'], $asset['version'], true);
    }

    $posts_js = 'public/scripts/posts.js';
    if (file_exists(get_theme_file_path($posts_js))) {
        $asset = murr_script_asset($posts_js);
        wp_enqueue_script('murr-posts', asset($posts_js), $asset['deps'], $asset['version'], true);
    }
});

/**
 * Editor assets.
 */
add_action('enqueue_block_editor_assets', function () {
    $editor_css = 'public/styles/editor.css';
    if (file_exists(get_theme_file_path($editor_css))) {
        wp_enqueue_style('murr-editor', asset($editor_css), [], murr_asset_version($editor_css));
    }

    $editor_js = 'public/scripts/editor.js';
    if (file_exists(get_theme_file_path($editor_js))) {
        $asset = murr_script_asset($editor_js);
        wp_enqueue_script('murr-editor', asset($editor_js), $asset['deps'], $asset['version'], true);
    }
});

/**
 * Register custom blocks from built assets if available.
 * Falls back to source metadata for local development.
 */
add_action('init', function () {
    $built = glob(get_theme_file_path('public/blocks/*/block.json')) ?: [];
    $source = glob(get_theme_file_path('resources/blocks/*/block.json')) ?: [];
    $paths = !empty($built) ? $built : $source;

    foreach ($paths as $block_json) {
        register_block_type(dirname($block_json));
    }
});

// add_action('ghint/wp_head_priority', function () {
//     if (is_admin()) {
//         return;
//     }

//     $preload = function (string $path, string $as, bool $crossorigin = false) {
//         static $printed = [];
//         if (!$path || isset($printed[$path])) {
//             return;
//         }
//         $printed[$path] = true;

//         printf(
//             '<link rel="preload" href="%1$s" as="%2$s"%3$s />' . PHP_EOL,
//             esc_url(asset($path)),
//             esc_attr($as),
//             $crossorigin ? ' crossorigin="anonymous"' : ''
//         );
//     };
// });

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
