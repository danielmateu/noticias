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
            <!-- No se encuentra la imagen... -->
            <img src="<?= USER_IMAGE_FOLDER . '/' . ($user->picture ?? DEFAULT_USER_IMAGE) ?> " alt="Foto del usuario" class="card-img-top" width="100px">
            <!-- No se encuentra la imagen... -->
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

            </div>
        </div>

        <!-- Mostramos las noticias que ha creado el usuario -->
        <div class="card col-sm-6 p-4">
            <h3>Noticias creadas por <?= $user->displayname ?></h3>

            <?php if (empty($noticias)) : ?>
                <p>No hay noticias creadas por <?= $user->displayname ?></p>
            <?php else : ?>
                <p>
                    <?php foreach ($noticias as $noticia) : ?>
                        <a href="/noticia/show/<?= $noticia->id ?>"><?= $noticia->title ?></a>
                    <?php endforeach; ?>
                </p>
            <?php endif; ?>
        </div>





    </main>
    <?= (TEMPLATE)::getAltFooter() ?>
</body>

</html>