<?php

use GHInt\Theme\Post\ShareLink;

/**
 * @var array $args
 * @var ShareLink[] $links
 */

if ($links = $args['links']) : ?>
    <div class="m-share-links <?= $args['modifier'] ?? '' ?>">
        <div class="m-share-links__inner">
            <ul class="m-share-links__list">
                <li class="m-share-links__heading h6 text--c-primary text--uppercase">
                    <?= $args['heading'] ?? __('Share', 'ghint') ?>
                </li>
                <?php foreach ($links as $id => $link) : ?>
                    <li class="m-share-links__link m-share-links__link--<?= $id; ?>">
                        <?php get_template_part('partials/atoms/share-link', null, ['link' => $link]) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<?php endif;
