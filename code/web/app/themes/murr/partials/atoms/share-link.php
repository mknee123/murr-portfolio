<?php

/**
 * @var array $args
 * @var ShareLink $link
 */

use murr\Theme\Post\ShareLink;

$link = $args['link'];
?>
<a href="<?= $link->getUrl(); ?>" target="<?= $link->getTarget(); ?>">
    <?= $link->getBody(); ?>
</a>
