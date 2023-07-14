<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Lista comentarios</title>
    <?= (TEMPLATE)::getCss() ?>
    <?= (TEMPLATE)::getBootstrap() ?>
</head>

<body>

    <?= (TEMPLATE)::getMenuBootstrap() ?>
    <?= (TEMPLATE)::getHeaderAlt("Comentarios") ?>
    <?= (TEMPLATE)::getSuccess() ?>
    <?= (TEMPLATE)::getError() ?>

    <main>
        <div class="d-flex align-items-center justify-content-between">

        </div>

        <table class="table table-dark  table-striped table-hover rounded-3">
            <tr>
                <th class="d-none d-md-table-cell">ID</th>
                <th>Comentario</th>
                <th class="d-none d-md-table-cell">Fecha Creación</th>
                <th class="d-none d-md-table-cell">Id Noticia</th>
                <th>Acciones</th>
            </tr>

            <?php foreach ($comentarios as $comentario) : ?>
                <tr>
                    <td class="d-none d-md-table-cell"><?= $comentario->id ?></td>
                    <td><?= $comentario->texto ?></td>
                    <td class="d-none d-md-table-cell"><?= $comentario->created_at ?></td>
                    <td class="d-none d-md-table-cell"><?= $comentario->idnoticia ?></td>
                    <td class="">
                        <!-- Botón que dirige al comentario -->
                        <button class="btn btn-secondary"><a class="list-group-item" href="/comentario/show/<?= $comentario->id ?>">🔎</a></button>
                        <!-- Solo permitimos editar y eliminar al creador del comentario -->
                        <?php if (Login::get() && Login::get()->id == $comentario->iduser) : ?>
                            <button class="btn btn-secondary"><a class="list-group-item" href="/comentario/edit/<?= $comentario->id ?>">✏️</a></button>
                            <button class="btn btn-secondary"><a class="list-group-item" href="/comentario/delete/<?= $comentario->id ?>">🗑️</a></button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>

    </main>

    <div class="d-flex justify-content-center gap-2">
        <!-- Botones para volver, editar y borrar -->
        <a class="btn btn-primary" href="/comentario">Volver</a>

    </div>

    <?= Template::getAltFooter() ?>
</body>

</html>