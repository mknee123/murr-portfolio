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
    <svg id="mk" xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" viewBox="0 0 472.7 205.3">
        <path
            d="M260.7,119v86.3h-62.5v-75.5c0-18.8-6.9-26-16.9-26s-19.6,7.5-19.6,27.7v73.9h-62.5v-75.5c0-18.8-6.4-26-16.9-26s-19.6,7.5-19.6,27.7v73.9H0V54h59.5v14.1c11.3-11.3,26.3-16.9,42.9-16.9s36.8,7.2,47.3,23c12.2-14.7,29.9-23,50.6-23,34.3,0,60.3,20.2,60.3,67.8Z"
            fill="var(--mk-brand)" />
        <polygon points="360.3 158.8 350.3 169.6 350.3 205.3 287.8 205.3 287.8 0 350.3 0 350.3 98 393.8 54 467.7 54 405.1 119.5 472.7 205.3 397.1 205.3 360.3 158.8" fill="var(--mk-brand)" />
    </svg>
</a>
