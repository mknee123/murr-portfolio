<?php

/**
 * @var array $attributes
 * @var string $content
 * @var WP_Block $block
 */

$class = 'm-collapse';
$blockClass = classNames([
    $class => true,
    "$class--open" => $attributes['open'] ?? false,
    "$class--toggled" => $attributes['open'] ?? false,
]);
$heading = sprintf('h%d', $attributes['level'] ?? 2);
$headingClass = implode(' ', [
    "{$class}__heading",
]);
?>
<div class="<?= $blockClass ?>">
    <button class="<?= $headingClass ?>" role="button">
        <span class="<?= $heading ?>"><?= $attributes['heading'] ?></span>
    </button>
    <div class="<?= $class ?>__content">
        <?= $content; ?>
    </div>
</div>
