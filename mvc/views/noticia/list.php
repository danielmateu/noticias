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

        <div class="d-flex align-items-center justify-content-center">

            <!-- Filtro y Buscador -->
            <!-- Si hay un filtro aplicado -->
            <?php if (!empty($filtro)) { ?>

                <?= Template::removeFilterForm($filtro, '/noticia') ?>
            <?php } else {    ?>


                <?= Template::filterForm(
                    '/noticia',
                    [
                        'Título' => 'titulo',
                        'Texto' => 'texto',
                    ],
                    [
                        'Título' => 'titulo',
                        'Creación' => 'created_at',
                    ],
                    'ASC',
                    'DESC'
                ) ?>

            <?php } ?>

            <!-- FIN Filtro Buscador -->


            <!-- Mostramos las noticias -->

        </div>

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

        <table class="table table-dark table-striped table-hover rounded-3">
            <thead>
                <tr>
                    <th scope="col" class="">Imagen</th>
                    <th scope="col" class="">Título</th>
                    <th scope="col" class="d-none d-md-table-cell">Texto</th>
                    <!-- <th scope="col" class="d-none d-md-table-cell">Comentarios</th> -->
                    <th scope="col" class="">Acciones</th>
                </tr>
            </thead>

            <?php foreach ($noticias as $noticia) : ?>
                <tr>
                    <td><img src="<?= NEWS_IMAGES_FOLDER . '/' . ($noticia->imagen ?? DEFAULT_NEWS_IMAGE) ?> " alt="Imagen de la noticia" width="100px" class="cover-mini">
                    </td>
                    <td><?= $noticia->titulo ?></td>
                    <td class="d-none d-md-table-cell "><?= acortarTexto($noticia->texto) ?></td>
                    <!-- Cantidad de comentarios que tiene la noticia -->

                    <!-- <td class="d-none d-md-table-cell"><?= $noticia->iduser ?></td> -->
                    <td class="">
                        <!-- Si no está logueado o tiene role de lector -->
                        <?php if (Login::guest() || Login::oneRole(['ROLE_READER', 'ROLE_USER'])) : ?>
                            <button class="btn btn-secondary"><a class="list-group-item" href=" /noticia/show/<?= $noticia->id ?>">🔎</a></button>
                        <?php endif; ?>

                        <!-- Si es escritor -->
                        <?php if (Login::oneRole(['ROLE_WRITER'])) : ?>
                            <button class="btn btn-secondary"><a class="list-group-item" href=" /noticia/show/<?= $noticia->id ?>">🔎</a></button>
                            <button class="btn btn-secondary"><a class="list-group-item" href="/noticia/edit/<?= $noticia->id ?>">✏️</a></button>
                        <?php endif; ?>

                        <!-- Si es editor podrá ver  editar y borrar, no crear -->
                        <?php if (Login::oneRole(['ROLE_EDITOR'])) : ?>
                            <button class="btn btn-secondary"><a class="list-group-item" href="/noticia/edit/<?= $noticia->id ?>">✏️</a></button>
                            <button class="btn btn-secondary"><a class="list-group-item" href="/noticia/delete/<?= $noticia->id ?>">🗑️</a></button>
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