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

        <h2><?= $noticia->titulo ?></h2>

        <!-- Mostramos la noticia -->
        <section>
            <div class="d-flex justify-content-between gap-4 align-items-start">
                <div class="col-6 d-flex flex-column p-3 bg-light shadow rounded">
                    <p><?= $noticia->texto ?></p>
                    <div class=" rounded px-1 d-flex flex-column  ">
                        <small class="m-0">Noticia creada por: <?= $autor->displayname ?></small>
                        <small class="m-0">Fecha de publicación: <?= $noticia->created_at ?></small>
                        <!-- Modificación -->
                        <small class="m-0">Última modificación: <?= $noticia->updated_at ?></small>

                    </div>

                </div>

                <div class="card shadow">

                    <img src="<?= NEWS_IMAGES_FOLDER . '/' . ($noticia->imagen ?? DEFAULT_NEWS_IMAGE) ?> " alt="Portada del libro" class="card-img-top" width="100px">

                    <div class="card-body">
                        <p class="card-text">Imagen de <?= "$noticia->titulo" ?> </p>
                    </div>
                </div>
            </div>

            <div>
                <!-- <h4>Comentarios de usuarios</h4> -->
                


                <!-- Si el usuario tiene role ROLE_USER -->
                <?php if (Login::oneRole(['ROLE_READER'])) : ?>
                    <!-- Enlace para crear comentario -->
                    <a class="btn btn-outline-primary" href="/comentario/create/<?= $noticia->id ?>">Crear comentario</a>
                <?php endif; ?>

            </div>
        </section>

        <!-- Mostrar Comentarios -->

    </main>
    <!-- Botones para volver, editar y borrar -->
    <div class="d-flex justify-content-center gap-2">
        <a class="btn btn-primary" href="/noticia">Volver</a>

    </div>

    <?= Template::getAltFooter() ?>
</body>

</html>