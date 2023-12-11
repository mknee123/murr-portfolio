<?php
$label = $args['label'] ?? '';
$name = $args['name'] ?? '';
$placeholder = $args['placeholder'] ?? '';
$id = $args['id'] ?? 'input-field-search-' . uniqid();
?>
<div class="a-input-field a-input-field--wide a-input-field--search">
    <?php if ($label) : ?>
        <label class="a-input-field__placeholder-text" for="<?= $id ?>"><?= $label ?></label>
    <?php endif; ?>
    <input class="a-input-field__input" type="search" value="" aria-label="<?= $placeholder ?>" placeholder="<?= $placeholder ?>" name="<?= $name ?>" id="<?= $id ?>" autocomplete="off">

    <button type="submit" id="<?= $id ?>_button" aria-label="<?= $label ?>">
        <i class="fa-solid fa-magnifying-glass"></i>
    </button>
</div>
