<?php
$class = 'o-footer';
$footer_statement = $args['footer_statement'] ?? '';
$footer_address = $args['footer_address'] ?? '';
$linkable_address = $args['linkable_address'] ?? '';
$footer_phone = $args['footer_phone'] ?? '';
$callable_phone = $args['callable_phone'] ?? '';
$footer_email = $args['footer_email'] ?? '';
$copyright_text = $args['copyright_text'] ?? '';
?>
<footer class="<?= $class ?>">
    <div class="<?= $class ?>__inner <?= $class ?>__footer">
        <div class="<?= $class ?>__column">
            <div class="<?= $class ?>__logo">
                <?php get_template_part('partials/atoms/logo', '', ['style' => 'light']); ?>
            </div>
            <?php if ($footer_statement) : ?>
                <p class="<?= $class ?>__statement">
                    <?= $footer_statement ?>
                </p>
            <?php endif; ?>
            <div class="<?= $class ?>__contact">
                <?php if ($footer_address) : ?>
                    <div class="<?= $class ?>__address">
                        <a href="<?= $linkable_address ?>" target="_blank" rel="noopener noreferrer"><?= $footer_address ?></a>
                    </div>
                <?php endif; ?>
                <?php if ($footer_phone) : ?>
                    <div class="<?= $class ?>__phone">
                        <a href="tel:<?= $callable_phone ?>" target="_blank" rel="noopener noreferrer"><?= $footer_phone ?></a>
                    </div>
                <?php endif; ?>
                <?php if ($footer_email) : ?>
                    <div class="<?= $class ?>__email">
                        <a href="mailto:<?= $footer_email ?>" target="_blank" rel="noopener noreferrer"><?= $footer_email ?></a>
                    </div>
                <?php endif; ?>
                <div class="<?= $class ?>__social">
                    <a class="a-icon a-icon--linkedin" href="https://www.linkedin.com/in/mirandaknee/" title="Navigate to LinkedIn"></a>
                </div>
            </div>
        </div>
        <div class="<?= $class ?>__nav <?= $class ?>__nav--primary">
            <?php
            // footer-primary navigation menu
            if (has_nav_menu('footer-primary')) {
                wp_nav_menu(
                    [
                        'theme_location'  => 'footer-primary',
                        'menu_class'      => 'menu menu--footer',
                        'container'       => 'nav',
                        'container_class' => 'footer-menu-wrap',
                    ]
                );
            }
            ?>
        </div>
    </div>
    <div class="<?= $class ?>__copyright <?= $class ?>__inner">
        <?php if ($copyright_text) : ?>
            <p><?= '&copy; ' .  date('Y') . ' ' . $copyright_text ?></p>
        <?php
        endif;
        // footer-bottom navigation menu
        if (has_nav_menu('footer-bottom')) : ?>
            <div class="<?= $class ?>__nav <?= $class ?>__nav--legal">
                <?php
                wp_nav_menu(
                    [
                        'theme_location'  => 'footer-bottom',
                        'menu'            => __('Footer Legal Navigation Menu', 'ghint'),
                        'container'       => 'nav',
                    ]
                );
                ?>
            </div>
        <?php endif; ?>
    </div>
</footer>
