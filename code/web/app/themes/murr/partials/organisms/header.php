<?php
$class = 'o-header';
$showNav = (wp_nav_menu(['theme_location' => 'primary', 'echo' => false]) !== false && has_nav_menu('primary')) ?: false;
$modifier = $showNav ? '' : 'o-header__logo--center';
?>
<header class="<?= $class ?>">
    <div class="<?= $class ?>__columns">
        <div class="<?= $class ?>__column <?= $class ?>__column--controls">
            <div class="<?= $class ?>__logo <?= $modifier ?>">
                <?php get_template_part('partials/atoms/logo', '', ['style' => 'light']); ?>
            </div>
            <?php if ($showNav) : ?>
                <button class="<?= $class ?>__nav-control">
                    <span class="screen-reader-only"><?= __('Menu', 'ghint') ?></span>
                </button>
            <?php endif; ?>
        </div>

        <div class="<?= $class ?>__column <?= $class ?>__column--nav">
            <div class="<?= $class ?>__nav-container">
                <?php
                // primary navigation menu
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container' => 'nav',
                    'container_class' => $class . '__nav-menu',
                    'menu' => __('Header Navigation Menu', 'ghint'),
                    'menu_class' => '',
                ]);
                ?>
            </div>
        </div>
    </div>
</header>
