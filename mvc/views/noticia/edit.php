<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Edición noticia</title>
    <link rel="stylesheet" href="/css/style.css">
    <?= (TEMPLATE)::getBootstrap() ?>
    <script src="/js/Preview.js"></script>
</head>

<body>

    <!-- Use de la funcion shorten para acortar la longitud del titulo -->
    <?= Template::getMenuBootstrap() ?>
    <?=
    Template::getHeaderAlt("Editando: $noticia->titulo")
    ?>
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main class="">

        <div class="align-items-start justify-content-center gap-4">
            <!-- Formulario para edicion de noticia -->

            <form class="form" method="POST" action="/noticia/update" enctype="multipart/form-data">
                <div class="d-flex align-items-start gap-4">

                    <div class="col-6">
                        <!-- Input oculto que contiene el ID del noticia a actualizar -->
                        <input type="hidden" name="id" value="<?= $noticia->id ?>">

                        <!-- Titulo -->
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Introduce el nombre" value="<?= $noticia->titulo ?>" required>
                        </div>

                        <!-- Texto -->
                        <div class="mb-3">
                            <label for="texto" class="form-label">Texto</label>
                            <textarea name="texto" id="texto" class="form-control" placeholder="Introduce el texto" required><?= $noticia->texto ?></textarea>

                        </div>



                    </div>

                    <!-- Portada -->
                    <div class="card mt-4">

                        <div class="card ">
                            <!-- No se encuentra la imagen... -->
                            <img src="<?= NEWS_IMAGES_FOLDER . '/' . ($noticia->picture ?? DEFAULT_NEWS_IMAGE) ?> " alt="Portada del noticia" class="card-img-top" width="100px" id="preview-image">
                            <!-- No se encuentra la imagen... -->
                            <div class="card-body">
                                <p class="card-text">Imagen de la noticia <?= "$noticia->titulo" ?> </p>
                            </div>
                        </div>


                        <div class="p-2">
                            <label for="file-with-preview" class="form-label">Imagen</label>
                            <input type="file" name="portada" id="file-with-preview" class="form-control" accept="image/*">

                            <input type="checkbox" name="eliminarportada" id="eliminarportada">
                            <label for="eliminarportada">Eliminar Imagen</label>
                        </div>
                    </div>
                </div>

                <input type="submit" value="Editar Noticia" class="btn btn-outline-secondary" name="actualizar" value="Actualizar">

            </form>

        </div>


        <!-- Botón que nos redirija a la lista de noticias -->
        <div class="d-flex justify-content-center gap-2">
            <!-- Botones para volver, editar y borrar -->
            <a class="btn btn-primary" href="/noticia">Volver</a>

        </div>

    </main>

    <?= Template::getAltFooter() ?>
</body>

</html>