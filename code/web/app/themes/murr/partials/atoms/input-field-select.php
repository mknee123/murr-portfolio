<?php
$label = $args['label'] ?? '';
$defaultOption = $args['defaultOption'] ?? '';
$id = $args['id'] ?? 'input-field-select-' . uniqid();
$name = $args['name'] ?? $id;
$options = $args['options'] ?? [];
$useKeys = $args['keys'] ?? false;
$defaultOptionValue = $defaultOption ?: $label;
/*
Example Usage:
$options accepts either an array of strings or a multidimensional array.

If a single dimension array the data should be structured as such:
'options' => [
    'First Select Option item',
    'Second Select Option item',
]

To pass both the Select Option Label and Value as an array from post type (preferred):
$category = get_terms('job-categories');
'options' => $category;
*/
?>
<?php if ($options) : ?>
    <div class="a-input-field a-input-field--stacked">
        <div class="a-input-field--wide">
            <div class="a-input-field__container a-input-field__container--select">
                <?php if ($label) : ?>
                    <label class="a-input-field__placeholder-text" for="<?= $id ?>"><?= $label ?></label>
                <?php endif; ?>
                <select class="a-input-field__input" id="<?= $id ?>" name="<?= $name ?>">
                    <option class="a-input-field__text" value=""><?= $defaultOption ?></option>
                    <?php foreach ($options as $value => $option) : ?>
                        <option value="<?= $useKeys ? $value : $option ?>"><?= $option ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
<?php endif; ?>
