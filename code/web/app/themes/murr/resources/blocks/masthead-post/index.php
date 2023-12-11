<?php

/**
 * @var array $attributes
 * @var string $content
 * @var WP_Block $block
 * Masthead Post Block
 */

$block_align = 'align' . $block['align'];
//get acf field of selected post post
$recent_posts = wp_get_recent_posts(array(
    'numberposts' => 1,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'ASC'
));

$post = get_field('select_post') ?: $recent_posts[0]['ID'];
$categories = get_the_category($post);
$category_list = join(', ', wp_list_pluck($categories, 'name'));
$title = get_the_title($post);
$excerpt = get_the_excerpt($post);
$image = get_the_post_thumbnail($post);
$cta = get_the_permalink($post);

get_template_part('partials/organisms/masthead-post', null, ['id' => $post, 'align' => $block_align, 'category' => $category_list, 'title' => $title, 'excerpt' => $excerpt, 'image' => $image, 'cta' => $cta]);
