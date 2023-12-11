<?php
get_template_part('partials/header');
?>
<main class="container" role="main" id="main">
    <?php
    if (is_home()) :
        if ($block = renderReusableBlock('post-archive-top')) :
            echo $block;
        endif;
        get_template_part(
            'partials/organisms/card',
            'grid',
            [
                'title' => __('Browse News', 'ghint'),
                'pagination' => [
                    'id' => 'load-news',
                    'text' => __('Show More', 'ghint'),
                ],
            ]
        );
        if ($block = renderReusableBlock('post-archive-bottom')) :
            echo $block;
        endif;
    else :
        if (have_posts()) :
            while (have_posts()) : the_post();
                get_template_part('partials/organisms/content-body', get_post_type());
            endwhile;
        endif;
    endif;
    ?>

</main>
<?php
get_template_part('partials/footer');
?>
