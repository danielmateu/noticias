<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?= APP_NAME ?> - Noticias</title>

    <!-- META -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Noticias en <?= APP_NAME ?>">
    <meta name="author" content="Robert Sallent">

    <!-- FAVICON -->
    <link rel="shortcut icon" href="favicon.ico" type="image/png">

    <!-- CSS -->
    <?= (TEMPLATE)::getCss() ?>
    <?= (TEMPLATE)::getBootstrap() ?>

</head>

<body>
    <?= (TEMPLATE)::getMenuBootstrap() ?>
    <?= (TEMPLATE)::getHeaderAlt('Noticias') ?>
    <?= (TEMPLATE)::getFlashes() ?>

    <main>

        <div class="d-flex align-items-center justify-content-between">
            <!-- Filtro -->

            <!-- Solamente podrán publicar noticias los redactores y también podrán modificar sus propias noticias. No las podrán eliminar.
            -->
            <?php if (Login::role('ROLE_WRITER')) : ?>
                <a href="/noticia/create" class="btn btn-outline-primary mb-2">Crear Noticia</a>
            <?php endif; ?>

            <!-- Paginator -->
            <div>
                <?=
                $paginator->stats()
                ?>
            </div>

            <!-- Mostraos las noticias -->

        </div>

        <table class="table table-dark table-striped table-hover rounded-3">
            <thead>
                <tr>
                    <th scope="col" class="">Imagen</th>
                    <th scope="col" class="">Título</th>
                    <th scope="col" class="d-none d-md-table-cell">Texto</th>
                    <!-- <th scope="col" class="d-none d-md-table-cell">ID Creador</th> -->
                    <!-- <th scope="col" class="">ISBN</th> -->
                    <th scope="col" class="">Acciones</th>
                </tr>
            </thead>

            <?php foreach ($noticias as $noticia) : ?>
                <tr>
                    <td><img src="<?= NEWS_IMAGES_FOLDER . '/' . ($noticia->imagen ?? DEFAULT_NEWS_IMAGE) ?> " alt="Imagen de la noticia" width="100px" class="cover-mini">
                    </td>
                    <td><?= $noticia->titulo ?></td>
                    <td class="d-none d-md-table-cell "><?= $noticia->texto ?></td>
                    <!-- <td class="d-none d-md-table-cell"><?= $noticia->iduser ?></td> -->
                    <td class="">
                        <!-- Si no está logueado -->
                        <?php if (Login::guest()) : ?>
                            <button class="btn btn-secondary"><a class="list-group-item" href=" /noticia/show/<?= $noticia->id ?>">🔎</a></button>
                        <?php endif; ?>

                        <!-- Si es lector logueado-->
                        <?php if (Login::role('ROLE_READER')) : ?>
                            <button class="btn btn-secondary"><a class="list-group-item" href=" /noticia/show/<?= $noticia->id ?>">🔎</a></button>
                        <?php endif; ?>

                        <!-- Si es escritor -->
                        <?php if (Login::oneRole(['ROLE_USER', 'ROLE_WRITER'])) : ?>
                            <button class="btn btn-secondary"><a class="list-group-item" href=" /noticia/show/<?= $noticia->id ?>">🔎</a></button>
                            <button class="btn btn-secondary"><a class="list-group-item" href="/noticia/edit/<?= $noticia->id ?>">✏️</a></button>
                            <!-- <button class="btn btn-secondary"><a class="list-group-item" href="/noticia/delete/<?= $noticia->id ?>">🗑️</a></button> -->
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>
        <!-- Paginación -->
        <?= $paginator->links() ?>

    </main>
    <?= (TEMPLATE)::getAltFooter() ?>
</body>

</html>