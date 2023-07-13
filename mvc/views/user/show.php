<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Detalle user</title>
    <!-- <link rel="stylesheet" href="/css/style.css"> -->
    <?= Template::getCss() ?>
    <?= (TEMPLATE)::getBootstrap() ?>
</head>

<body>

    <?= Template::getMenuBootstrap() ?>
    <?= Template::getHeaderAlt("Detalles de $user->displayname") ?>

    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main>
        <h2>
            <?= $user->displayname ?>
        </h2>

        <div class="d-flex justify-content-md-center">
            <div class="card col-md-6 p-2">
                <!-- No se encuentra la imagen... -->
                <img src="<?= USER_IMAGE_FOLDER . '/' . ($user->picture ?? DEFAULT_USER_IMAGE) ?> " alt="Foto del user" class="card-img-top" width="100px">
                <!-- No se encuentra la imagen... -->
                <div class="card-body">

                    <p class="col-6">
                        <strong>user:</strong>
                        <?= $user->displayname ?>
                        <br>
                        <strong>Email:</strong>
                        <?= $user->email ?>
                        <br>
                        <strong>Teléfono:</strong>
                        <?= $user->phone ?>
                        <br>
                    </p>
                </div>
            </div>
        </div>

    </main>

    <div class="d-flex justify-content-center gap-2">
        <a class="btn btn-primary" href="/">Volver</a>
        <a class="btn btn-secondary" href="/user/edit/<?= $user->id ?>">Editar</a>
        <a class="btn btn-danger" href="/user/delete/<?= $user->id ?>">Borrar</a>
    </div>

    <?= Template::getAltFooter() ?>
</body>

</html>