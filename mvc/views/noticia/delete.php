<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Eliminación noticia</title>
    <link rel="stylesheet" href="/css/style.css">
    <?= (TEMPLATE)::getBootstrap() ?>
</head>

<body>

    <?= Template::getMenuBootstrap() ?>
    <?=
    Template::getHeaderAlt("Eliminando: $noticia->titulo")
    ?>
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main class="">

        <h2>Quieres eliminar <?= $noticia->titulo ?>?</h2>

        <!-- Formulario para edicion denoticia -->
        <div class="card my-4 col-md-6 ">
            <img src="<?= NEWS_IMAGES_FOLDER . '/' . ($noticia->imagen ?? DEFAULT_NEWS_IMAGE) ?> " alt="Portada delnoticia" class="card-img-top p-4" width="100px">

        </div>

        <form class="form" method="POST" action="/noticia/destroy">
            <!-- <h2>Creación denoticias</h2> -->

            <!-- Input oculto que contiene el ID delnoticia a eliminar -->
            <input type="hidden" name="id" value="<?= $noticia->id ?>">

            <input type="submit" value="Eliminar noticia" class="btn btn-danger" name="borrar" value="Borrar">
        </form>


    </main>

    <div class="d-flex justify-content-center gap-2">
        <!-- Botones para volver, editar y borrar -->
        <a class="btn btn-primary" href="/noticia">Volver</a>
        <a class="btn btn-secondary" href="/noticia/edit/<?= $noticia->id ?>">Editar</a>
        <!-- <a class="btn btn-danger" href="/noticia/delete/<?= $noticia->id ?>">Borrar</a> -->
    </div>

    <?= Template::getAltFooter() ?>
</body>

</html>