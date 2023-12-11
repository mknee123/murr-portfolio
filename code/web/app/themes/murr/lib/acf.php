<?php

/**
 * Register options page
 *
 * @link https://www.advancedcustomfields.com/resources/options-page/
 */

namespace GHint\ACF;

/**
 * Add ACF Options Pages
 */
add_action('init', function () {

    if (function_exists('acf_add_options_page')) {

        acf_add_options_page(
            [
                'page_title'   => 'Theme Options',
                'menu_title'   => 'Theme Options',
                'menu_slug'    => 'theme-options',
                'capability'   => 'edit_posts',
                'position'     => '310',
                'icon_url'     => 'dashicons-admin-settings',
                'redirect'     => false,
            ]
        );
    }
});


/**
 * Restrict access to ACF from dashboard based on specific users
 */

add_filter('acf/settings/show_admin', function ($show) {

    // get current users
    $current_user = wp_get_current_user();

    // create array of approved users
    $approved_users = [
        'interactive@ghadv.com',
        'mknee@ghadv.com',
    ];

    // allow access to acf if current user is in approved users list
    return in_array($current_user->user_email, $approved_users);
});
