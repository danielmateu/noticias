<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Detalle Libro</title>
    <!-- <link rel="stylesheet" href="/css/style.css"> -->
    <?= Template::getCss() ?>
    <?= (TEMPLATE)::getBootstrap() ?>
</head>

<body>

    <?= Template::getMenuBootstrap() ?>
    <?= Template::getHeaderAlt("Detalles de $noticia->titulo") ?>

    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main>

        <h2>
            <?= $noticia->titulo ?>
        </h2>



        <!-- Mostramos los la noticia -->
        <section>

        </section>


    </main>
    <!-- Botones para volver, editar y borrar -->
    <div class="d-flex justify-content-center gap-2">
        <a class="btn btn-primary" href="/noticia">Volver</a>
        <!-- <a class="btn btn-secondary" href="/noticia/edit/<?= $noticia->id ?>">Editar</a>
        <a class="btn btn-danger" href="/noticia/delete/<?= $noticia->id ?>">Borrar</a> -->
    </div>

    <?= Template::getAltFooter() ?>
</body>

</html>