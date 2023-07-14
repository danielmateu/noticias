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
                        <small class="m-0">Noticia creada por: <strong><?= $autor->displayname ?></strong></small>
                        <small class="m-0">Fecha de publicación: <strong><?= $noticia->created_at ?></strong> </small>
                        <!-- Modificación -->
                        <!-- Si la noticia se ha modificado -->
                        <?php if ($noticia->updated_at) : ?>
                            <small class="m-0">Última modificación: <strong><?= $noticia->updated_at ?></strong> </small>
                        <?php endif; ?>

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
                <!-- Si la noticia tiene comentarios los mostramos -->
                <?php if (empty($comentarios)) : ?>
                    <div class="alert alert-primary mt-4">
                        <p>Aun no hay comentarios en esta noticia 😋</p>
                    </div>
                <?php else : ?>
                    <h4>Comentarios de usuarios</h4>
                    <div class="d-flex flex-column gap-2 p-2">
                        <?php foreach ($comentarios as $comentario) : ?>
                            <a class="list-group-item list-group-item-primary p-2 rounded" href=" /comentario/show/<?= $comentario->id ?>"><?= $comentario->texto ?></a></li>
                        <?php endforeach; ?>
                        <!-- Si el comentario pertenece al usuario o tiene Role de Admin se le permite eliminar -->
                        <?php if (Login::isAdmin() || Login::get()->id == $comentario->iduser) : ?>
                            <!-- Input hidden para mandar por post el id del comentario -->
                            <input type="hidden" name="id" value="<?= $comentario->id ?>">
                            <a class="btn btn-outline-danger" href="/comentario/delete/<?= $comentario->id ?>">Eliminar comentario</a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- Si el usuario tiene role ROLE_USER -->
                <?php if (Login::oneRole(['ROLE_USER'])) : ?>
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