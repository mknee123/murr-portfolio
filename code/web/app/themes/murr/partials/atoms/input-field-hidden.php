<?php
$label = $args['label'] ?? false;
$id = $args['id'] ?? 'input-field-' . uniqid();
$name = $args['name'] ?? $id;
$value = $args['value'] ?? '';
?>
<div class="a-input-field a-input-field--hidden">
    <?php if ($label !== false) : ?>
        <label for="<?= $id ?>"><?= $label ?></label>
    <?php endif; ?>
    <input type="hidden" id="<?= $id ?>" name="<?= $name ?>" value="<?= $value ?>">
</div>
