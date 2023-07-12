<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?= APP_NAME ?> - Noticias</title>

    <!-- META -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Noticias en <?= APP_NAME ?>">
    <meta name="author" content="Robert Sallent">

    <!-- FAVICON -->
    <link rel="shortcut icon" href="favicon.ico" type="image/png">

    <!-- CSS -->
    <?= (TEMPLATE)::getCss() ?>
    <?= (TEMPLATE)::getBootstrap() ?>

</head>

<body>
    <?= (TEMPLATE)::getMenuBootstrap() ?>
    <?= (TEMPLATE)::getHeaderAlt('Noticias') ?>
    <?= (TEMPLATE)::getFlashes() ?>

    <main>

        <div class="d-flex align-items-center justify-content-between">
            <!-- Solamente podrán publicar noticias los redactores y también podrán modificar sus propias noticias. No las podrán eliminar.
            -->
            <?php if (Login::role('ROLE_WRITER')) : ?>
                <a href="/noticia/create" class="btn btn-outline-primary mb-2">Crear Noticia</a>
            <?php endif; ?>

            <div>
                <?=
                $paginator->stats()
                ?>
            </div>
        </div>

        <!-- Paginación -->
        <?= $paginator->links() ?>

    </main>
    <?= (TEMPLATE)::getAltFooter() ?>
</body>

</html>