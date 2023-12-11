<?php
$class = 'o-form';
$color = $args['color'] ?? '';
$style = $args['style'] ?? '';
$label = $args['label'] ?? '';
$placeholder = $args['placeholder'] ?? __('Search...', 'ghint');
$id = $args['id'] ?? '';
$modifier_color = $color ? $class . '--' . $color : '';
$modifier_style = $style ? $class . '--' . $style : '';
?>

<form action="<?= home_url('/') ?>" method="get" class="<?= $class ?> <?= $class ?>--search <?= $modifier_color ?> <?= $modifier_style ?>">
    <?php
    get_template_part(
        'partials/atoms/input-field',
        'search',
        [
            'label' => $label,
            'name' =>  's',
            'placeholder' => $placeholder,
            'id' => $id
        ]
    );
    ?>
</form>
