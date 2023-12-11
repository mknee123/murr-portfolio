<?php
$class = 'm-filter';
$action = $args['action'] ?? '';
$method = $args['method'] ?? 'GET';
$title = $args['title'] ?? '';
$inputs = $args['inputs'] ?? '';
$style = $args['style'] ?? '';
?>
<form class="<?= $class ?> <?= $style ?>" action="<?= $action ?>" method="<?= $method ?>">
    <?php if ($title) : ?>
        <h1 class="<?= $class ?>__title"><?= $title ?></h1>
    <?php endif;
    if ($inputs) : ?>
        <div class="<?= $class ?>__inputs">
            <?php
            foreach ($args['inputs'] ?? [] as $key => $filter) {
                get_template_part('partials/atoms/input-field', $filter['type'], array_merge(
                    ['name' => $key],
                    $filter['options'],
                ));
            }
            ?>
        </div>
    <?php endif; ?>
</form>
