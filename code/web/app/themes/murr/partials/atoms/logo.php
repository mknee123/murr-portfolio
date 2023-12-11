<?php
// TODO: Client Logo to replace GH logo
// Expected styles that can be passed = ['light','dark']
$style = $args['style'] ?? '';
$id = $style ? $style . uniqid('-') : 'light' . uniqid('-');
?>
<a aria-label="logo navigate to homepage" href="<?= get_home_url(); ?>" rel="home" class="a-logo" style="max-width:6rem;">
    <svg xmlns="http://www.w3.org/2000/svg" width="236.277" height="107.604" viewBox="0 0 236.277 107.604">
        <path class="gh" id="Path_1" data-name="Path 1" d="M126.537,0H98.932V-72.049L78.986-25.293H59.836L39.891-72.049V0H13.73V-107.6h32.23L70.17-53.621,94.307-107.6h32.23Zm123.47,0H215.97L183.812-43.07l-6.5,7.877V0h-27.75V-107.6h27.75V-58.9L215.753-107.6h32.158L205.853-57.812Z" transform="translate(-13.73 107.604)" fill="#0f7a7e" />
    </svg>
</a>
