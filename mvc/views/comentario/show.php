<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Detalle comentario</title>
    <!-- <link rel="stylesheet" href="/css/style.css"> -->
    <?= Template::getCss() ?>
    <?= (TEMPLATE)::getBootstrap() ?>
</head>

<body>

    <?= Template::getMenuBootstrap() ?>
    <!-- <?= Template::getHeaderAlt("comentario: $comentario->comentario") ?> -->
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main>

        <div class="">
            <p><strong>Comentario: </strong><?= $comentario->texto ?></p>

        </div>

    </main>
    <!-- Botones para volver, editar y borrar -->
    <div class="d-flex justify-content-center gap-2">
        <a class="btn btn-primary" href="/comentario">Volver</a>
        <!-- TODO Si el usuario esta registrado y es el creador del comentario -->
        <?php if (Login::get('id') == $comentario->iduser) : ?>
            <a class="btn btn-warning" href="/comentario/edit/<?= $comentario->id ?>">Editar</a>
            <a class="btn btn-danger" href="/comentario/delete/<?= $comentario->id ?>">Borrar</a>
        <?php endif; ?>

    </div>

    <?= Template::getAltFooter() ?>
</body>

</html>