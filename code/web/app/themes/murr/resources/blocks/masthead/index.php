<?php

/**
 * @var array $attributes
 * @var string $content
 * @var WP_Block $block
 */

$className = 'o-masthead';
$format = $attributes['format'] ?? 'image';
$backgrounds = $attributes['backgrounds'] ?? [];
$overlay = $attributes['includeOverlay'] ?? true;
$opacity = $attributes['overlayOpacity'] ?? 40;
$embed = $attributes['embed'] ?? false;
$embedCode = $attributes['embedCode'] ?? '';
?>
<div class="<?= classNames([
                $className => true,
                $className . '--has-overlay' => $overlay,
                $className . '--embedded' => $embed,
                sprintf('%s--%s', $className, $format) => true,
            ]) ?>">
    <div class="<?= $className ?>__background">
        <?php if ($overlay) : ?>
            <div class="<?= $className ?>__overlay" style="opacity: <?= $opacity / 100 ?>"></div>
        <?php endif; ?>

        <?php if (!$embed && $backgrounds) {
            get_template_part(
                "partials/atoms/$format",
                null,
                apply_filters("ghint/block/masthead-$format-backgrounds", $backgrounds, $attributes, $block)
            );
        } else if ($embed && $embedCode) {
            echo $embedCode;
        } ?>
    </div>
    <div class="<?= $className ?>__content">
        <?= $content; ?>
    </div>
</div>
