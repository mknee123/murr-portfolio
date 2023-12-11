<?php

/**
 * Organism - Card Grid
 */

$class = 'o-card-grid';
$title = $args['title'] ?? '';
$perPage = $args['per_page'] ?? 9;
$postsQuery = new WP_Query(['posts_per_page' => $perPage]);
$pagination = $args['pagination'] ?? [];
$category = get_terms('category', ['fields' => 'id=>name']);
$count = $postsQuery->found_posts;
?>
<div class="<?= $class ?> <?= $class ?>--wide">
    <div class="<?= $class ?>__filter">
        <?php
        get_template_part(
            'partials/molecules/filter',
            null,
            [
                'action' => rest_url('/wp/v2/posts'),
                'title' => $title,
                'inputs' => [
                    'categories' => [
                        'type' => 'select',
                        'options' => [
                            'label' => __('Category', 'ghint'),
                            'defaultOption' => __('Showing all', 'ghint'),
                            'id' => 'news-filter-by-category',
                            'options' => $args['filters']['category'] ?? $category,
                            'keys' => true,
                        ]
                    ],
                    'search' => [
                        'type' => 'search',
                        'options' => [
                            'label' => __('Search', 'ghint'),
                            'placeholder' => __('Search by keyword', 'ghint'),
                            'id' => 'news-filter-by-search',
                        ]
                    ],
                    'page' => [
                        'type' => 'hidden',
                        'options' => [
                            'type' => 'hidden',
                            'value' => 1,
                        ]
                    ],
                    'per_page' => [
                        'type' => 'hidden',
                        'options' => [
                            'type' => 'hidden',
                            'value' => $perPage,
                        ]
                    ],
                    '_embed' => [
                        'type' => 'hidden',
                        'options' => [
                            'type' => 'hidden',
                            'value' => 'true',
                        ]
                    ],
                    'exclude' => [
                        'type' => 'hidden',
                        'options' => [
                            'type' => 'hidden',
                            'value' => '',
                        ]
                    ],
                ],
            ]
        );
        ?>
    </div>
    <?php if ($postsQuery->have_posts()) : ?>
        <div class="<?= $class ?>__grid">
            <?php
            foreach ($postsQuery->posts as $post) :
                $image = get_the_post_thumbnail_url();
                $categories = get_the_category();
                $category_list = join(', ', wp_list_pluck($categories, 'name'));
                get_template_part(
                    'partials/molecules/card',
                    null,
                    [
                        'image' => $image,
                        'content' => [
                            'heading' => get_the_title(),
                            'subheading' => $category_list,
                            'link' => [
                                'url' => get_the_permalink(),
                                'text' => __('Read More', 'ghint'),
                            ]
                        ]
                    ]
                );
            endforeach;
            wp_reset_postdata();
            ?>
        </div>
    <?php endif; ?>

    <?php if ($perPage < $count) : ?>
        <div class="<?= $class ?>__button">
            <?php
            get_template_part('partials/atoms/button', null, [
                'id' => $pagination['id'],
                'text' => $pagination['text'],
            ]);
            ?>
        </div>
    <?php endif; ?>
</div>
