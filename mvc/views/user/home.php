<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Portada - <?= APP_NAME ?></title>

    <!-- META -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portada en <?= APP_NAME ?>">
    <meta name="author" content="Robert Sallent">

    <!-- FAVICON -->
    <link rel="shortcut icon" href="favicon.ico" type="image/png">

    <!-- CSS -->
    <?= (TEMPLATE)::getCss() ?>
    <?= (TEMPLATE)::getBootstrap() ?>

</head>

<body>
    <?= (TEMPLATE)::getMenuBootstrap() ?>
    <?= (TEMPLATE)::getHeaderAlt('Portada') ?>
    <?= (TEMPLATE)::getFlashes() ?>

    <h2><?= "Hello $user->displayname! Welcome to your Dashboard" ?></h2>
    <main class="d-flex flex-column flex-sm-row align-items-start gap-2">

        <!-- Mostramos foto del usuario -->
        <div class="card col-sm-6">
            <img src="<?= USER_IMAGE_FOLDER . '/' . ($user->picture ?? DEFAULT_USER_IMAGE) ?> " alt="Foto del usuario" class="card-img-top" width="100px">

            <div class="card-body">
                <!-- MOstramos la info del User -->
                <p class="card-text"><strong>Nombre:</strong> <?= " $user->displayname" ?> </p>
                <p class="card-text"><strong>Email:</strong> <?= " $user->email" ?> </p>
                <p class="card-text"><strong>Teléfono:</strong> <?= " $user->phone" ?> </p>
                <!-- Rol -->
                <p class="card-text"><strong>Role:</strong> <?= implode(',', $user->roles) ?> </p>

                <!-- Si es admin, mostrar el link a la gestión de usuarios -->
                <?php if (Login::oneRole(['ROLE_ADMIN'])) : ?>
                    <a class="btn btn-secondary" href="/User/list/">Ver usuarios</a>
                <?php endif; ?>

                <!-- Si el usuario ha realizado comentarios -->

                <!-- Botón que nos lleva a los comentarios del usuario -->
                <!-- <a class="btn btn-secondary" href="/comentario/list/<?= $user->id ?>">Ver comentarios realizados</a> -->

            </div>
        </div>

        <!-- Si es un usuario logueado y ha realizado comentarios, los mostramos -->
        <!-- <?php if (Login::role('ROLE_USER') && !empty($comentarios)) : ?>
            <div class="card col-sm-6 p-4">
                <h3>Comentarios de <?= $user->displayname ?></h3>

                <?php if (empty($comentarios)) : ?>
                    <p>No hay comentarios de <?= $user->displayname ?></p>
                <?php else : ?>
                    <ul>
                        <?php foreach ($comentarios as $comentario) : ?>
                            <li><a href="/comentario/show/<?= $comentario->id ?>"><?= $comentario->texto ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        <?php endif; ?> -->





    </main>
    <?= (TEMPLATE)::getAltFooter() ?>
</body>

</html>