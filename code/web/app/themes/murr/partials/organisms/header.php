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
                <div class="<?= $class ?>__nav-search">
                    <?php get_template_part(
                        'partials/organisms/form',
                        'search',
                        [
                            'color' => 'reversed',
                            'style' => 'wide',
                            'id' => 'search_form_nav_mobile'
                        ]
                    );
                    ?>
                </div>
                <button id="search-icon" class="<?= $class ?>__nav-search-icon" aria-label="<?= __('Search site', 'ghint') ?>"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>

        </div>
    </div>
</header>
<div class="o-search-overlay" id="search-overlay">
    <button class="o-search-overlay__trigger">
        <span class="screen-reader-only"><?= __('Close the search overlay.', 'ghint') ?></span>
    </button>
    <div class="o-search-overlay__inner">
        <?php
        get_template_part(
            'partials/organisms/form',
            'search',
            [
                'label' => __('Search the website.', 'ghint'),
                'placeholder' => __('What are you looking for?', 'ghint'),
                'color' => 'reversed',
                'style' => 'wide',
                'id' => 'search_form_overlay'
            ]
        );
        ?>
    </div>
</div>
