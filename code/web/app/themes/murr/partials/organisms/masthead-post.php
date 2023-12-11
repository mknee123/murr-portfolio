<?php

/**
 * Masthead Post Block
 * Uses the masthead block styles
 */

$className = 'o-masthead-post';
$id = $args['id'] ?? get_the_ID();
$align = $args['align'] ?? '';
$category = $args['category'] ?? '';
$title = $args['title'] ?? '';
$excerpt = $args['excerpt'] ?? '';
$image = $args['image'] ?? '';
$cta = $args['cta'] ?? '';
$classModifier = $align ?: '';
?>

<div class="<?= classNames([
                $className => true,
                $classModifier => true,
            ]) ?>" data-id="<?= $id ?>">
    <div class="<?= $className ?>__inner">
        <div class="<?= $className ?>__content">
            <?php if ($category) : ?>
                <p class="<?= $className ?>__category text--c-secondary text--uppercase"><?= $category ?></p>
            <?php endif; ?>
            <?php if ($title) : ?>
                <h1 class="h1 text--c-primary"><?= $title ?></h1>
            <?php endif; ?>

            <?php if ($excerpt) : ?>
                <p><?= $excerpt ?></p>
            <?php endif; ?>

            <?php if ($cta) :
                get_template_part(
                    'partials/atoms/button',
                    '',
                    [
                        'url' => $cta,
                        'text' => __('Read More', 'ghint'),
                        'class' => 'micro'
                    ]
                );
            endif; ?>
        </div>

        <div class="<?= $className ?>__image">
            <?php if ($image) :
                echo $image;
            else :
                $image = getThumbnailUrlWithFallback($id);
                $alt = get_post_meta(get_post_thumbnail_id($id), '_wp_attachment_image_alt', true) ?: $title;

                get_template_part(
                    'partials/atoms/image',
                    '',
                    [
                        'src' => $image,
                        'alt' => $alt,
                        'width' => 700,
                    ]
                );
            endif; ?>
        </div>
    </div>
</div>
