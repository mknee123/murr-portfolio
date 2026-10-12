<?php

/**
 * Archive
 *
 * @author       MK
 * @since        1.0.1
 * @license      GPL-2.0+
 **/

get_template_part('partials/header');
?>
<main class="archive archive--container" role="main">
    <?php
    $cat = get_queried_object();
    if (have_posts()) :
    ?>
        <div class="archive__sidebar">
            <h1 class="h4 text--c-secondary text--uppercase"><?= sprintf(__('%d Result(s) for %s', 'ghint'), $wp_query->found_posts, $cat->name); ?></h1>
            <p class="text--font-size--huge"><?php _e('Checkout other categories', 'ghint'); ?></p>
            <?php
            $otherCategories = wp_list_categories(array(
                'orderby' => 'name',
                'exclude' => $cat->term_id,
                'title_li' => '',
            ));
            ?>
        </div>
        <div class="archive__posts">
            <?php
            while (have_posts()) : the_post();
                get_template_part(
                    'partials/molecules/card',
                    null,
                    [
                        'type' => 'archive',
                        'content' => [
                            'heading' => get_the_title(),
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
if ($block = renderReusableBlock('post-archive-bottom')) :
    echo $block;
endif;
get_template_part('partials/footer');
