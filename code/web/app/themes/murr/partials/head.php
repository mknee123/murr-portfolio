<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title><?php wp_title("|", true, "right"); ?></title>

    <link rel="apple-touch-icon" sizes="180x180" href="<?= asset("public/images/apple-touch-icon.png"); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= asset("public/images/favicon-32x32.png"); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= asset("public/images/favicon-16x16.png"); ?>">
    <link rel="manifest" href="<?= asset("site.webmanifest") ?>">
    <link rel="mask-icon" href="<?= asset("public/images/safari-pinned-tab.svg") ?>" color="#1c2333">
    <meta name="msapplication-TileColor" content="#ebeeed">
    <meta name="theme-color" content="#ebeeed">
    <?php wp_head(); ?>
</head>
