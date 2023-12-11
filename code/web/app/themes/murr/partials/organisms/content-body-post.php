<?php

/**
 * Post Single
 *
 * @author       GH Advertising
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

$categories = get_the_category();
$category_list = join(', ', wp_list_pluck($categories, 'name'));
$title = get_the_title();
$excerpt = has_excerpt() ? get_the_excerpt() : '';
$image = get_the_post_thumbnail($post->ID);
?>

<article class="<?= esc_attr(join(' ', get_post_class())) ?>">
    <?php
    get_template_part('partials/organisms/masthead', 'post', ['category' => $category_list, 'title' => $title, 'excerpt' => $excerpt, 'image' => $image]);
    ?>
    <div class="post-container">
        <?php
        get_template_part('partials/molecules/share-links', null, [
            'links' => apply_filters('ghint/share-links', []),
        ]); ?>
        <div class="entry-content">
            <?php the_content(); ?>
        </div>

        <div class="post post--pagination">
            <?php if (get_previous_post_link()) : ?>
                <div class="post__button">
                    <?php previous_post_link('%link', '<i class="fas fa-chevron-double-left"></i> Prev'); ?>
                </div>
            <?php endif; ?>
            <div class="post__breadcrumbs">
                <?php get_breadcrumb('post'); ?>
            </div>
            <?php if (get_next_post()) : ?>
                <div class="post__button">
                    <?php next_post_link('%link', 'Next <i class="fas fa-chevron-double-right"></i>'); ?>
                </div>
            <?php endif; ?>
        </div>

    </div>


</article>

<?php
if ($block = renderReusableBlock('post-single-bottom')) :
    echo $block;
endif;
