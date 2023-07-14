<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - eliminar comentario</title>
    <link rel="stylesheet" href="/css/style.css">
    <?= (TEMPLATE)::getBootstrap() ?>
</head>

<body>

    <?= Template::getMenuBootstrap() ?>
    <?= Template::getHeaderAlt("Eliminando comentario") ?>
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main class="">

        <h2>Quieres eliminar <?= "$comentario->texto" ?>?</h2>

        <!-- Formulario para eliminacion de comentario -->
        <form class="form" method="POST" action="/comentario/destroy">

            <!-- Input oculto que contiene el ID del comentario a eliminar -->
            <input type="hidden" name="id" value="<?= $comentario->id ?>">

            <input type="submit" value="Eliminar comentario" class="btn btn-danger" name="borrar" value="Borrar">
        </form>


    </main>
    <div class="d-flex justify-content-center gap-2">
        <!-- Botones para volver, editar y borrar -->
        <a class="btn btn-primary" href="/comentario">Volver</a>
        <a class="btn btn-secondary" href="/comentario/edit/<?= $comentario->id ?>">Editar</a>
        <!-- <a class="btn btn-danger" href="/comentario/delete/<?= $comentario->id ?>">Borrar</a> -->
    </div>

    <?= Template::getAltFooter() ?>
</body>

</html>