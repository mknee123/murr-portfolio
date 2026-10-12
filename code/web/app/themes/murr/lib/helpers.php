<?php

/**
 * Name:               helpers.php
 * Version:            1.0.1
 * Author:             MK
 */

/**
 * Gets a URL of an asset
 *
 * @param string $path
 * @return string
 */
function asset(string $path): string {
    $path = ltrim($path, '/');
    return get_theme_file_uri($path);
}

/**
 * Gets a Path of an asset
 *
 * @param string $path
 * @return string
 */
function asset_path(string $path): string {
    $path = ltrim($path, '/');
    return get_theme_file_path($path);
}
/**
 * Generates an array of class names based on true/false values
 *
 * @param array $classes
 * @return Generator
 */
function generateClassNames(array $classes): Generator {
    foreach ($classes as $class => $predicate) {
        if ($predicate === true) {
            yield $class;
        }
    }
}

/**
 * Shortcut to retrieve a simple string from the classNames generator
 *
 * @param array $classes
 * @param bool $implode
 * @return string|array
 */
function classNames(array $classes, bool $implode = true): string|array {
    $classes = iterator_to_array(generateClassNames($classes));
    return $implode ? implode(' ', $classes) : $classes;
}

/**
 * Generate HTML Attributes from $key => $value pairs
 * False and null values are ignored
 *
 * @param array $atts
 * @return Generator
 */
function generateHtmlAttributes(array $atts): Generator {
    foreach ($atts as $att => $val) {
        if ($val !== false && !is_null($val)) {
            $fmt = is_bool($val) ? '%1$s' : '%s="%s"';
            yield $att => sprintf($fmt, $att, esc_attr($val));
        }
    }
}

/**
 * Shortcut to retrieve a simple string from the htmlAttributes Generator
 *
 * @param array $atts
 * @param bool $implode
 * @return string|array
 */
function htmlAttributes(array $atts, bool $implode = true): string|array {
    $attributes = iterator_to_array(generateHtmlAttributes($atts));
    return $implode ? implode(' ', $attributes) : $attributes;
}

/**
 * Renders the content of a reusable block by slug
 *
 * @param string $blockName
 * @return mixed|void
 */
function renderReusableBlock(string $blockName) {
    $blockPost = get_page_by_path($blockName, OBJECT, 'wp_block');
    if ($blockPost && property_exists($blockPost, 'post_content')) {
        return apply_filters('the_content', $blockPost->post_content);
    }
    return '';
}

/**
 * @param array $assets
 * @return Generator
 */
function generatePreloadAssets(array $assets): Generator {
    foreach ($assets as $asset => $doPreload) {
        if ($doPreload) {
            yield $asset;
        }
    }
}

/**
 * @param array $assets
 * @return array
 */
function getPreloadAssets(array $assets): array {
    return iterator_to_array(generatePreloadAssets($assets));
}

/**
 * Generates a post thumbnail at the requested size
 * Falls back to a default if it doesn't exist
 *
 * @param ?int $id
 * @param string $size
 * @param string|null $default
 * @return string
 */
function getThumbnailUrlWithFallback(?int $id, string $size = 'large', ?string $default = null): string {
    $default = asset($default ?? 'public/images/blog-thumbnail-default.svg');
    if (is_null($id)) {
        return $default;
    }
    $attachment = get_post_thumbnail_id($id);
    return wp_get_attachment_image_src($attachment, $size)[0] ?? $default;
}

/**
 * Returns a template part as a string
 *
 * @return string
 */
function return_template_part(): string {
    ob_start();
    get_template_part(...func_get_args());
    return ob_get_clean();
}
