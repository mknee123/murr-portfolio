<?php
    $checkboxes = $args['checkboxes'] ?? '';
?>
<?php if ($checkboxes): ?>
    <div class="a-input-field">
        <?php foreach($checkboxes as $checkbox): ?>
            <?php
                $label = $checkbox['label'] ?? '';
                $id = $checkbox['id'] ?? 'input-field-radio-' . uniqid();
            ?>
            <div class="a-input-field__container a-input-field__container--checkbox">
                <input type="checkbox" id="<?= $id ?>">
                <label for="<?= $id ?>"><?= $label ?></label>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>