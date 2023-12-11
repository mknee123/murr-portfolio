<?php
/**
 * @var array $args
 */

$sources = apply_filters('ghint/atoms/video-sources-sort', $args['sources'] ?? []);
$attributes = htmlAttributes([
    'class' => implode(' ', array_merge(['a-video'], $args['classes'] ?? [])),
    'width' => $args['width'] ?? '100%',
    'height' => $args['height'] ?? '100%',
    'preload' => $args['preload'] ?? 'metadata',
    'loop' => $args['loop'] ?? false,
    'autoPlay' => $args['autoPlay'] ?? false,
    'playsInline' => $args['autoPlay'] ?? false,
    'muted' => $args['muted'] ?? false,
    'controls' => $args['controls'] ?? false,
    'style' => $args['style'] ?? false,
]);
$fallback = $args['fallback'] ?? __('Your browser does not support the video tag.', 'ghint');
?>
<video <?= $attributes ?>>
    <?php foreach ($sources as $src) : ?>
        <source src="<?= $src['src'] ?>" type="<?= $src['type'] ?>"/>
    <?php endforeach; ?>
    <?= $fallback ?>
</video>
