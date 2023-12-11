<?php

/**
 * Search
 *
 * @author       GH Advertising
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

get_template_part('partials/header');
?>
<main class="search search--container" role="main">
    <?php if (!have_posts()) : ?>
        <div class="search__no-results">
            <h1 class="h4 text--c-secondary text--uppercase text--c-tertiary"><?php _e('No Results', 'ghint'); ?>.</h1>
            <h2 class="h1 text--c-primary"><?php _e('Can we help you find something else?', 'ghint'); ?></h2>
            <?php get_template_part(
                'partials/organisms/form',
                'search',
                [
                    'style' => 'wide',
                    'id' => 'search_form_nav_search'
                ]
            ); ?>
        </div>
    <?php
    endif;

    if (have_posts()) : ?>
        <div class="search__sidebar">
            <h1 class="h4 text--c-secondary text--uppercase"><?= sprintf(__('%d Result(s) for %s', 'ghint'), $wp_query->found_posts, $_GET['s']); ?></h1>
        </div>
        <div class="search__posts">
            <?php
            while (have_posts()) : the_post();
                $image = get_the_post_thumbnail_url();
                $categories = get_the_category();
                $category_list = join(', ', wp_list_pluck($categories, 'name'));
                get_template_part(
                    'partials/molecules/card',
                    null,
                    [
                        'type' => 'archive',
                        'image' => $image,
                        'content' => [
                            'heading' => get_the_title(),
                            'subheading' => $category_list,
                            'excerpt' => get_the_excerpt(),
                            'link' => [
                                'url' => get_the_permalink(),
                                'text' => __('Visit Page', 'ghint'),
                            ]
                        ]
                    ]
                );
            endwhile; ?>
        </div>
    <?php endif; ?>
</main>
<?php
if ($block = renderReusableBlock('search-results-bottom')) :
    echo $block;
endif;

get_template_part('partials/footer');
