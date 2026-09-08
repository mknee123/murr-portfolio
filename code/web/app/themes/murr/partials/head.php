<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title><?php wp_title("|", true, "right"); ?></title>
    <?php if (!has_site_icon()) : ?>
        <!-- Fallback icons when WP Site Icon is not configured -->
        <link rel="icon" type="image/png" href="<?= asset("public/images/favicon-96x96.png"); ?>" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="<?= asset("public/images/favicon.svg"); ?>" />

        <link rel="shortcut icon" href="<?= asset("favicon.ico"); ?>">


        <link rel="apple-touch-icon" sizes="180x180" href="<?= asset("public/images/apple-touch-icon.png"); ?>">
        <meta name="apple-mobile-web-app-title" content="MK Website" />

    <?php endif; ?>

    <link rel="manifest" href="<?= asset("site.webmanifest"); ?>">

    <?php wp_head(); ?>
</head>
