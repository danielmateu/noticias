<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Crear comentario</title>
    <link rel="stylesheet" href="/css/style.css">
    <?= (TEMPLATE)::getBootstrap() ?>
    <!-- Script para previsualización -->
    <!-- <script src="/js/Preview.js"></script> -->
</head>

<body>

    <?= Template::getMenuBootstrap() ?>
    <?= Template::getHeaderAlt("Crea una comentario") ?>
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main class="">

        <!-- Formulario para creación de comentario -->
        <form method="POST" action="/comentario/store" class="col-10">
            <input type="hidden" name="id_noticia" value="<?= $idnoticia ?>">
            <div class="mb-3">
                <label for="texto" class="form-label">Escribe tu comentario</label>
                <textarea name="texto" id="texto" cols="20" rows="10" class="form-control" placeholder="Escribe tu comentario"></textarea>
            </div>
            <div class="d-flex justify-content-start gap-2">
                <input type="submit" class="btn btn-outline-primary" value="Enviar" name="enviar">
            </div>
        </form>

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