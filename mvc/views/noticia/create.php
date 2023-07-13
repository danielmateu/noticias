<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Crear noticia</title>
    <link rel="stylesheet" href="/css/style.css">
    <?= (TEMPLATE)::getBootstrap() ?>
    <!-- Script para previsualización -->
    <script src="/js/Preview.js"></script>
</head>

<body>

    <?= Template::getMenuBootstrap() ?>
    <?= Template::getHeaderAlt("Crea una noticia") ?>
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main class="d-md-flex justify-content-between align-items-center gap-4">

        <!-- Formulario para creación de noticia -->
        <form class="form col-6" method="POST" action="/noticia/store" enctype="multipart/form-data">
            <!-- Titulo -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <!-- Texto -->
            <div class="mb-3">
                <label for="texto" class="form-label">Texto</label>
                <textarea class="form-control" id="texto" name="texto" rows="4" required></textarea>
            </div>

            <!-- Imagen -->
            <div class="mb-3">
                <label for="portada" class="form-label">Portada</label>
                <input type="file" name="portada" id="file-with-preview" class="form-control" placeholder="Elige la imagen" accept="image/*">
            </div>

            <input type="submit" value="Crear Noticia" class="btn btn-outline-secondary" name="Guardar">

        </form>

        <!-- Previsualización de la imagen -->
        <div class="card p-4">
            <h4>Imagen de previsualización</h4>
            <img id="preview-image" src="<?= NEWS_IMAGES_FOLDER . '/' . DEFAULT_NEWS_IMAGE ?>" alt="Imagen de previsualización" class="card-img-top img-fluid">
        </div>


    </main>
    <div class="d-flex justify-content-center gap-2">
        <!-- Botones para volver, editar y borrar -->
        <a class="btn btn-primary" href="/noticia">Volver</a>
        <!-- <a class="btn btn-secondary" href="/noticia/edit/<?= $noticia->id ?>">Editar</a>
        <a class="btn btn-danger" href="/noticia/delete/<?= $noticia->id ?>">Borrar</a> -->
    </div>

    <?= Template::getAltFooter() ?>



</body>

</html>