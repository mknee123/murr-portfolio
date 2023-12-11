<?php

/**
 * @var array $attributes
 * @var string $content
 * @var WP_Block $block
 */

$class = 'o-featured-posts';
$align = $attributes['align'] ? 'alignwide' : '';

$postsQuery = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => 3,
]);
?>
<div class="<?= $class ?> <?= $align ?>">
    <div class="<?= $class ?>__container">

        <div class="<?= $class ?>__introduction">
            <?= $content; ?>
        </div>

        <?php if ($postsQuery->have_posts()) : ?>
            <div class="<?= $class ?>__posts">
                <?php
                while ($postsQuery->have_posts()) {
                    $postsQuery->the_post();

                    $categories = array_map(fn ($c) => $c->name, get_the_category());

                    get_template_part(
                        'partials/molecules/card',
                        null,
                        [
                            'type' => 'post',
                            'image' => get_the_post_thumbnail_url(null, 'full') ?: getThumbnailUrlWithFallback(get_the_ID()),
                            'content' => [
                                'heading' => get_the_title(),
                                'subheading' => implode(', ', $categories),
                                'link' => [
                                    'url' => get_the_permalink(),
                                    'text' => __('Read more', 'ghint'),
                                ],
                            ],
                        ]
                    );
                }
                ?>
            </div>
        <?php endif; ?>
    </div>
</div>
