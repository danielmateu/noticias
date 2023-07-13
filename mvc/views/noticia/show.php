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

        <!-- Mostramos los la noticia -->
        <section>
            <div class="d-flex justify-content-between gap-4 align-items-start">
                <div class="col-6 d-flex flex-column p-3 bg-light shadow rounded">
                    <p><?= $noticia->texto ?></p>
                    <div class="bg-secondary rounded p-2 text-white d-flex flex-column  ">
                        <p class="m-0">Noticia creada por: <?= $autor->displayname ?></p>
                        <p class="m-0">Fecha de publicación: <?= $noticia->created_at ?></p>
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
                <?php if (Login::oneRole(['ROLE_USER'])) : ?>
                    <form method="POST" action="/comentario/store">
                        <input type="hidden" name="id_noticia" value="<?= $noticia->id ?>">
                        <div class="mb-3">
                            <label for="texto" class="form-label">Escribe tu comentario</label>
                            <textarea name="texto" id="texto" cols="20" rows="10" class="form-control" placeholder="Escribe tu comentario"></textarea>
                        </div>
                        <div class="d-flex justify-content-start gap-2">
                            <input type="submit" class="btn btn-outline-primary" value="Enviar" name="enviar">
                        </div>
                    </form>
                <?php endif; ?>

            </div>
        </section>

        <!-- Mostrar Comentarios -->

        <section>

        </section>


    </main>
    <!-- Botones para volver, editar y borrar -->
    <div class="d-flex justify-content-center gap-2">
        <a class="btn btn-primary" href="/noticia">Volver</a>

    </div>

    <?= Template::getAltFooter() ?>
</body>

</html>