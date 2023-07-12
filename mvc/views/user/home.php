<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Portada - <?= APP_NAME ?></title>

    <!-- META -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portada en <?= APP_NAME ?>">
    <meta name="author" content="Robert Sallent">

    <!-- FAVICON -->
    <link rel="shortcut icon" href="favicon.ico" type="image/png">

    <!-- CSS -->
    <?= (TEMPLATE)::getCss() ?>
    <?= (TEMPLATE)::getBootstrap() ?>

</head>

<body>
    <?= (TEMPLATE)::getMenuBootstrap() ?>
    <?= (TEMPLATE)::getHeaderAlt('Portada') ?>
    <?= (TEMPLATE)::getFlashes() ?>

    <main>
        <h1><?= APP_NAME ?></h1>

        <h2>Home Usuario</h2>

    </main>
    <?= (TEMPLATE)::getAltFooter() ?>
</body>

</html>