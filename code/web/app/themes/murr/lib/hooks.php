<?php

/**
 * Name:               hooks.php
 * Version:            1.0.1
 * Author:             MK
 */

/**
 * Generate breadcrumbs
 * @author CodexWorld
 * @authorURL www.codexworld.com
 */
function get_breadcrumb($post_type) {
    $categories = get_the_category();
    $cat = $categories[0]->name;

    echo '<p class="text--font-size-small">';
    echo __('News', 'ghint');
    if ($cat) {
        echo ' <i class="text--c-secondary fa-regular fa-caret-right"></i> ';
        echo '<span class="text--uppercase">' . $cat . '</span>';
    }

    if (is_single()) {
        echo ' <i class="text--c-secondary fa-regular fa-regular fa-caret-right"></i> ';
        echo '<span class="post-title">' . get_the_title() . '</span>';
    }
    echo '</p>';
}

/**
 * Add a dropdown icon to top-level menu items.
 *
 * @param string $output Nav menu item start element.
 * @param object $item   Nav menu item.
 * @param int    $depth  Depth.
 * @param object $args   Nav menu args.
 * @return string Nav menu item start element.
 */
function gh_nav_add_dropdown_icons($output, $item, $depth, $args) {

    // only use on primary navigation menu
    if (!isset($args->theme_location) || 'primary' !== $args->theme_location) {
        return $output;
    }

    // only use if menu depth is greater than 1
    if (1 === $args->depth) {
        return $output;
    }

    // add submenu dropdown to elements that have children
    if (in_array('menu-item-has-children', $item->classes, true)) {
        $output = '<div class="o-header__dropdown-wrapper">' . $output . '<button class="o-header__dropdown" aria-label="Submenu Dropdown"></button></div>';
    }

    return $output;
}
add_filter('walker_nav_menu_start_el', 'gh_nav_add_dropdown_icons', 10, 4);

/**
 * Hook into dat REST API
 * Add fallback image for Posts
 */
add_action('rest_api_init', function () {
    register_rest_field(['post'], 'image_with_fallback', array(
        'get_callback' => function ($object) {
            $default = asset('public/images/blog-thumbnail-default.svg');
            $attachment = get_post_thumbnail_id($object['id']);
            return wp_get_attachment_image_src($attachment, 'large')[0] ?? $default;
        },
    ));
});
