<?php
$disable = $args['disable'] ?? false;
$class = $disable ? ['a-logo', 'c-disabled'] : ['a-logo'];
$classes = $args['class'] ?? [];
$className = array_merge(
    $class,
    array_map(
        fn($name) => sprintf('a-logo--%s', $name),
        is_string($classes) ? explode(' ', $classes) : $classes
    )
);
$ariaLabel = $disable ? '' : __(' navigate to homepage', 'ghint');
$style = $args['style'] ?? '';
$id = $style ? $style . uniqid('-') : 'light' . uniqid('-');
?>
<a aria-label="<?= esc_attr(get_bloginfo('name')) . $ariaLabel ?>" href="<?= get_home_url(); ?>" rel="home" class="<?= implode(' ', $className) ?>" id="<?= esc_attr($id) ?>">
    <svg id="mk" xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" viewBox="0 0 416.2 187.2">
        <polygon points="0 0 0 187.2 32.2 187.2 32.2 178.6 10 178.6 10 8.6 32.2 8.6 32.2 0 0 0 0 0" fill="var(--secondary)" />
        <path d="M191.6,37c-15,0-27.8,6-36.6,16.6-7.6-11.4-22.2-16.6-34.2-16.6s-22.8,4-31,12.2v-10.2h-43v109.4h45.2v-53.4c0-14.6,6.6-20,14.2-20s12.2,5.2,12.2,18.8v54.6h45.2v-53.4c0-14.6,7-20,14.2-20s12.2,5.2,12.2,18.8v54.6h45.2v-62.4c0-34.4-18.8-49-43.6-49Z" fill="var(--mk-brand)" />
        <polygon points="376.8 39 323.4 39 292 70.8 292 0 246.8 0 246.8 148.4 292 148.4 292 122.6 299.2 114.8 325.8 148.4 380.4 148.4 331.6 86.4 376.8 39" fill="var(--mk-brand)" />
        <polygon points="384 0 384 8.6 406.2 8.6 406.2 178.6 384 178.6 384 187.2 416.2 187.2 416.2 0 384 0" fill="var(--secondary)" />
    </svg>
</a>
