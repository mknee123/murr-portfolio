<?php

/**
 * @var array $attributes
 * @var string $content
 * @var WP_Block $block
 * Testimonial Block
 */

$className = 'o-testimonial';
$align = $attributes['align'] ? true : false;
$bgColor = $attributes['backgroundColor'] ? true : false;
$image = $attributes['image'] ?? '';
$imageUrl = $attributes['imageUrl'] ?? '';
$imageAlt = $attributes['imageAlt'] ?? '';
$credit = [];
$cite = $attributes['citation'] ?? '';
$title = $attributes['title'] ?? '';

if (!empty($cite)) :
    $credit[] = $cite;
endif;
if (!empty($title)) :
    $credit[] = $title;
endif;
?>
<figure class="<?= classNames([
                    $className => true,
                    'alignwide' => $align,
                    'has-' . $attributes['backgroundColor'] . '-background-color' => $bgColor
                ]) ?>">
    <blockquote class="<?= $className ?>__content">
        <?= $content; ?>
    </blockquote>
    <?php if ($image || $cite || $title) : ?>
        <div class="<?= $className ?>__citation">
            <?php if ($image) : ?>
                <div class="<?= $className ?>__img">
                    <img src="<?= $imageUrl ?>" alt="<?= $imageAlt ?>" />
                </div>
            <?php endif; ?>
            <?php if ($cite || $title) : ?>
                <figcaption class="<?= $className ?>__cite">
                    <?= implode(', ', $credit); ?>
                </figcaption>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</figure>
