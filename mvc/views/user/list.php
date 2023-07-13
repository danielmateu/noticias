<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?= APP_NAME ?> - users</title>

    <!-- META -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="users en <?= APP_NAME ?>">
    <meta name="author" content="Robert Sallent">

    <!-- FAVICON -->
    <link rel="shortcut icon" href="favicon.ico" type="image/png">

    <!-- CSS -->
    <?= (TEMPLATE)::getCss() ?>
    <?= (TEMPLATE)::getBootstrap() ?>

</head>

<body>
    <?= (TEMPLATE)::getMenuBootstrap() ?>
    <?= (TEMPLATE)::getHeaderAlt('users') ?>
    <?= (TEMPLATE)::getFlashes() ?>

    <main>

        <div class="d-flex align-items-center justify-content-between">
            <!-- Filtro -->

            <!-- Solamente podrán publicar users los redactores y también podrán modificar sus propias users. No las podrán eliminar.
            -->
            <?php if (Login::role('ROLE_ADMIN')) : ?>
                <a href="/user/create" class="btn btn-outline-primary mb-2">Crear user</a>
            <?php endif; ?>

            <!-- Paginator -->
            <div>
                <?=
                $paginator->stats()
                ?>
            </div>

            <!-- Mostraos las users -->

        </div>

        <table class="table table-dark table-striped table-hover rounded-3">
            <thead>
                <tr>
                    <th scope="col" class="">Imagen</th>
                    <th scope="col" class="">Nombre</th>
                    <th scope="col" class="d-md-table-cell">Email</th>
                    <th scope="col" class="d-none d-md-table-cell">Teléfono</th>
                    <th scope="col" class="">Acciones</th>
                </tr>
            </thead>

            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><img src="<?= USER_IMAGE_FOLDER . '/' . ($user->picture ?? DEFAULT_USER_IMAGE) ?> " alt="Imagen de la user" width="100px" class="cover-mini">
                    </td>
                    <td><?= $user->displayname ?></td>
                    <td class="sd-md-table-cell "><?= $user->email ?></td>
                    <td class="d-none d-md-table-cell"><?= $user->phone ?></td>
                    <td class="">
                        <!-- Si no está logueado -->

                        <button class="btn btn-secondary"><a class="list-group-item" href=" /user/show/<?= $user->id ?>">🔎</a></button>
                        <button class="btn btn-secondary"><a class="list-group-item" href="/user/edit/<?= $user->id ?>">✏️</a></button>
                        <button class="btn btn-secondary"><a class="list-group-item" href="/user/delete/<?= $user->id ?>">🗑️</a></button>


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