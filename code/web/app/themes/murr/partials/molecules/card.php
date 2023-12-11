<?php
$class = 'm-card';
// available type options: [post, content, archive]
$type = $args['type'] ?? 'post';
$classes = [$class, $class . '--' . $type];
$heading = '';

if ($type === 'content') {
    $content = $args['content'] ?? '';
    $link = '';
} else {
    $heading = $args['content']['heading'] ?? '';
    $categories = $args['content']['subheading'] ?? '';
    $excerpt = $args['content']['excerpt'] ?? '';
    $link = $args['content']['link'] ?? '';
    $linkUrl = $link['url'] ?? '';
    $linkText = $link['text'] ?? '';
    $linkTarget = $link['target'] ?? '_self';
}

$image = $args['image'] ?? '';
$imageContainer = [
    'open' => $link ? '<%s href="%s" target="%s" class="m-card__image">' : '<%1$s       class="m-card__image">',
    'close' => '</%1$s>',
];
$imageContainerArgs = $link ? ['a', $linkUrl, $linkTarget] : ['div'];
?>
<article class="<?= implode(' ', $classes) ?>">
    <?php if ($image) : ?>
        <?php vprintf($imageContainer['open'], $imageContainerArgs); ?>
        <img src="<?= $image ?>" alt="<?= $heading ?>">
        <?php vprintf($imageContainer['close'], $imageContainerArgs); ?>
    <?php endif; ?>

    <div class="<?= $class ?>__content">
        <?php if ($type === 'content') : ?>
            <?= $content ?>
        <?php else : ?>
            <?php if ($categories) : ?>
                <p class="<?= $class ?>__categories text text--font-size--mini text--uppercase"><?= $categories ?></p>
            <?php endif; ?>
            <h2 class="<?= $class ?>__heading"><?= $heading ?></h2>
            <?php if ($excerpt) : ?>
                <p class="<?= $class ?>__excerpt text text--font-size--medium"><?= $excerpt ?></p>
            <?php endif; ?>
            <?php if ($link) : ?>
                <div class="<?= $class ?>__link">
                    <?php get_template_part(
                        'partials/atoms/button',
                        null,
                        [
                            'class' => 'micro',
                            'url' => $linkUrl,
                            'text' => $linkText,
                        ]
                    ); ?>
                </div>
            <?php endif; ?>

        <?php endif; ?>
    </div>
</article>
