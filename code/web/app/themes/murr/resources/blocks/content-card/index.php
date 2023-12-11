<?php

/**
 * @var array $attributes
 * @var string $content
 * @var WP_Block $block
 * Content Card Block
 */
$class = 'o-content-card';
?>
<article class="<?= $class ?>">
    <div class="<?= $class ?>__inner">
        <?php
        $image = wp_get_attachment_image_src($attributes['image'], 'full');
        $imageSrc = $image[0] ?? '';
        get_template_part(
            "partials/molecules/card",
            null,
            [
                "type" => "content",
                "image" => $imageSrc,
                "content" => $content,
            ]
        );
        ?>
    </div>
</article>
