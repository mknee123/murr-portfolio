<?php
$radioButtons = $args['radioButtons'] ?? '';
?>
<?php if ($radioButtons) : ?>
    <div class="a-input-field">
        <?php foreach ($radioButtons as $radioButton) : ?>
            <?php
            $label = $radioButton['label'] ?? '';
            $id = $radioButton['id'] ?? 'input-field-radio-' . uniqid();
            ?>
            <div class="a-input-field__container a-input-field__container--radio-button">
                <input type="radio" id="<?= $id ?>">
                <label for="<?= $id ?>"><?= $label ?></label>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
