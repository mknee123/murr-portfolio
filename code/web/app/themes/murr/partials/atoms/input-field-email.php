<?php
$label = $args['label'] ?? '';
$placeholder = $args['placeholder'] ?? '';
$id = $args['id'] ?? 'input-field-email-' . uniqid();
// available input classes: [wide, stacked, email]
$classes = $args['class'] ?? [];
$class = array_merge(
    ['a-input-field'],
    array_map(
        fn ($name) => sprintf('a-input-field--%s', $name),
        is_string($classes) ? explode(' ', $classes) : $classes
    )
);
?>
<div class="<?= implode(' ', $class) ?>">
    <?php if ($label) : ?>
        <label class="a-input-field__placeholder-text" for="<?= $id ?>"><?= $label ?>
        </label>
    <?php endif; ?>
    <input class="a-input-field__input" type="email" value="" aria-labelledby="<?= $placeholder ?>" id="<?= $id ?>" autocomplete="off">
</div>
