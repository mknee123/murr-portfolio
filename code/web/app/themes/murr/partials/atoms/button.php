<?php
$btnId = $args['id'] ?? '';
$url = $args['url'] ?? '';
$text = $args['text'] ?? '';
$target = $args['target'] ?? '_self';
$disableBtn = $args['disabled'] ?? false;
$disabled = $disableBtn ? 'disabled' : '';

// available button classes: [micro]
$classes = $args['class'] ?? [];
$class = array_merge(
    ['a-button'],
    array_map(
        fn ($name) => sprintf('a-button--%s', $name),
        is_string($classes) ? explode(' ', $classes) : $classes
    )
);
?>
<?php if ($url) : ?>
    <a href="<?= $url ?>" class="<?= implode(' ', $class) ?>" target="<?= $target ?>" aria-label="<?= $text ?>" role="button"><span><?= $text ?></span></a>
<?php else : ?>
    <button class="<?= implode(' ', $class) ?>" id="<?= $btnId ?>" aria-label="<?= $text ?>" role="button" <?= $disabled ?>><span><?= $text ?></span></button>
<?php endif; ?>
