<?php


/**
 * @var array $args
 */

$lazy = $args['lazy'] ?? false;
$attributes = htmlAttributes([
    'class' => implode(' ', array_merge(['a-image'], $args['classes'] ?? [])),
    'width' => $args['width'] ?? '100%',
    'height' => $args['height'] ?? false,
    'src' => $args['src'],
    'alt' => $args['alt'] ?? '',
    'loading' => $lazy ? 'lazy' : 'eager',
    'style' => $args['style'] ?? false,
]);
$caption = $args['caption'] ?? '';

if ($caption) : ?>

    <figure class="<?= $class ?>">
        <img <?= $attributes ?>>
        <figcaption class="a-text a-text--mini"><?= $caption ?></figcaption>
    </figure>

<?php else : ?>

    <img <?= $attributes ?>>

<?php endif; ?>
