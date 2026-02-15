<?php

/**
 * Name:     blocks.php
 * Version:  1.0.1
 * Author:   MK
 */

namespace GHInt\Blocks;

/**
 * add custom block category for ACF blocks
 * @link https://developer.wordpress.org/block-editor/developers/filters/block-filters/#managing-block-categories
 */

add_filter('block_categories_all', function ($categories, $context) {
    $exists = array_filter($categories, fn($cat) => ($cat['slug'] ?? null) === 'mk-blocks');
    if (empty($exists)) {
        $categories[] = [
            'slug' => 'mk-blocks',
            'title' => __('Murr Blocks', 'ghint'),
            'icon' => null,
        ];
    }

    return $categories;
}, 10, 2);

/**
 * Masthead Block Filters
 */
add_filter('ghint/block/masthead-image-backgrounds', fn(array $backgrounds, array $attributes) => [
    'src' => $backgrounds[0]['url'],
    'alt' => $backgrounds[0]['alt'],
    'lazy' => apply_filters(
        'ghint/block/masthead-image-backgrounds-lazy',
        false,
        $backgrounds[0]
    ),
    'style' => implode('; ', [
        sprintf('object-fit: %s', $attributes['objectSize'] ?? 'cover'),
        sprintf('object-position: %s', implode(' ', $attributes['objectPosition'] ?? ['center', 'center'])),
    ]),
], 10, 2);
add_filter('ghint/block/masthead-video-backgrounds', fn(array $backgrounds, array $attributes) => [
    'loop' => true,
    'autoPlay' => true,
    'muted' => true,
    'preload' => 'auto',
    'fetchpriority' => 'high',
    'poster' => $attributes['fallback']['sizes']['full']['url']
        ?? $attributes['fallback']['url']
        ?? null,
    'sources' => array_map(fn($bg) => [
        'type' => $bg['mime'],
        'src' => $bg['url'],
    ], $backgrounds),
    'style' => implode('; ', [
        sprintf('object-fit: %s', $attributes['objectSize'] ?? 'cover'),
        vsprintf('object-position: %s %s', $attributes['objectPosition'] ?? ['center', 'center']),
    ]),
], 10, 2);

add_filter('ghint/atoms/video-sources-sort', function (array $sources) {
    $order = ["video/webm", "video/mp4"];
    usort($sources, apply_filters(
        'ghint/atoms/video-sources-sort-override',
        fn($a, $b) => array_search($a['type'], $order) <=> array_search($b['type'], $order),
        $sources,
    ));
    return $sources;
});
