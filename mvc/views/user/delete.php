<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Eliminación user</title>
    <link rel="stylesheet" href="/css/style.css">
    <?= (TEMPLATE)::getBootstrap() ?>
</head>

<body>

    <?= Template::getMenuBootstrap() ?>
    <?=
    Template::getHeaderAlt("Eliminando: $user->displayname")
    ?>
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main class="">

        <h2>Quieres eliminar <?= $user->displayname ?>?</h2>

        <!-- Formulario para edicion de user -->
        <div class="card my-4 col-md-6 ">
            <img src="<?= USER_IMAGE_FOLDER . '/' . ($user->picture ?? DEFAULT_USER_IMAGE) ?> " alt="Imagen del user" class="card-img-top p-4" width="100px">

        </div>

        <form class="form" method="POST" action="/user/destroy">
            <!-- <h2>Creación de users</h2> -->

            <!-- Input oculto que contiene el ID del user a eliminar -->
            <input type="hidden" name="id" value="<?= $user->id ?>">

            <input type="submit" value="Eliminar user" class="btn btn-danger" name="borrar" value="Borrar">
        </form>


    </main>

    <div class="d-flex justify-content-center gap-2">
        <!-- Botones para volver, editar y borrar -->
        <a class="btn btn-primary" href="/user/list">Volver</a>
        <a class="btn btn-secondary" href="/user/edit/<?= $user->id ?>">Editar</a>
        <!-- <a class="btn btn-danger" href="/user/delete/<?= $user->id ?>">Borrar</a> -->
    </div>

    <?= Template::getAltFooter() ?>
</body>

</html>