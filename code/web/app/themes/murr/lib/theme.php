<?php

/**
 * Name:               theme.php
 * Version:            1.0.1
 * Author:             MK
 */

/**
 * Adds basic low-level functionality
 */
add_action('after_setup_theme', function () {

    // Enqueue editor styles
    // This helps our custom styles overwrite WP styles
    // add_theme_support('editor-styles');
    // add_editor_style('public/styles/editor.css');

    /**
     * Register nav menus
     */
    register_nav_menus(
        [
            'primary'           => esc_html__('Primary Navigation Menu', 'ghint'),
            'footer-primary'    => esc_html__('Footer Primary Navigation Menu', 'ghint'),
            'footer-bottom'     => esc_html__('Footer Bottom Navigation Menu', 'ghint'),
        ]
    );

    /**
     * Add support for title-tag to assist
     * with SEO
     */
    add_theme_support('title-tag');

    /**
     * Register custom thumbnail sizes &
     * support feature image
     */
    add_theme_support('post-thumbnails', ['page', 'post']);
    add_image_size('masthead-thumbnail', 1920, 1280, true);

    /**
     * Add excerpt control for pages
     */
    add_post_type_support('page', 'excerpt');

    /**
     * Load theme translations
     */
    load_theme_textdomain('ghint', get_template_directory() . '/languages');
});

/**
 * Reusable Blocks accessible in backend
 */
add_action('admin_menu', function () {
    add_menu_page('Reusable Blocks', 'Reusable Blocks', 'edit_posts', 'edit.php?post_type=wp_block', '', 'dashicons-editor-table', 22);
});

/**
 * Disable Comments
 */
add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $page;
    if ($page === 'edit-comments.php') {
        wp_safe_redirect(admin_url());
        exit;
    }
    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});

/**
 * Close Comments on the front-end
 * & hide existing comments (if any)
 */
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);
add_filter('comments_array', '__return_empty_array', 10, 2);

/**
 * Remove Comments page in menu
 */
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});

/**
 * Remove comment links from admin bar (if any)
 */
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});

/**
 * Ensure PHP is greater than 8.0
 */
if (version_compare(PHP_VERSION, '8.0', '<')) {
    exit(sprintf(
        'This theme requires PHP 8.1 or higher. Your WordPress site is using PHP %s.',
        PHP_VERSION
    ));
}
