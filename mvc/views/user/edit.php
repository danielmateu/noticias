<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Edición Usuario</title>
    <link rel="stylesheet" href="/css/style.css">
    <?= (TEMPLATE)::getBootstrap() ?>
    <script src="/js/Preview.js"></script>
</head>

<body>

    <!-- Use de la funcion shorten para acortar la longitud del titulo -->
    <?= Template::getMenuBootstrap() ?>
    <?=
    Template::getHeaderAlt("Editando: $user->displayname")
    ?>
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main class="">

        <div class="align-items-start justify-content-center gap-4">
            <!-- Formulario para edicion de libro -->

            <form class="form" method="POST" action="/User/update" enctype="multipart/form-data">
                <!-- info -->
                <div class="d-flex align-items-start gap-4">
                    <div class="col-6">
                        <!-- Input oculto que contiene el ID del libro a actualizar -->
                        <input type="hidden" name="id" value="<?= $user->id ?>">
                        <!-- nombre -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="displayname" id="nombre" class="form-control" value="<?= $user->displayname ?>">
                        </div>
                        <!-- Telefono -->
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" name="phone" id="telefono" class="form-control" value="<?= $user->phone ?>">
                        </div>
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" name="email" id="email" class="form-control" value="<?= $user->email ?>">
                        </div>
                        <!-- Roles -->
                        <div class="mb-3">
                            <label for="roles" class="form-label">Roles</label>
                            <select name="roles" id="roles" class="form-select" required>
                                <!-- <option value="ROLE_USER">Usuario</option>
                    <option value="ROLE_ADMIN">Administrador</option> -->
                                <?php foreach (USER_ROLES as $roleName => $roleValue) : ?>
                                    <option name='roles' value="<?= $roleValue ?>"><?= $roleName ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>

                    <!-- Portada -->
                    <div class="card mt-4">

                        <div class="card ">
                            <!-- No se encuentra la imagen... -->
                            <img src="<?= USER_IMAGE_FOLDER . '/' . ($user->picture ?? DEFAULT_USER_IMAGE) ?> " alt="Foto del usuario" class="card-img-top" width="100px" id="preview-image">
                            <!-- No se encuentra la imagen... -->
                            <div class="card-body">
                                <p class="card-text">Previsualización</p>
                            </div>
                        </div>


                        <div class="p-2">
                            <label for="file-with-preview" class="form-label">Foto</label>
                            <input type="file" name="portada" id="file-with-preview" class="form-control" accept="image/*">

                            <input type="checkbox" name="eliminarportada" id="eliminarportada">
                            <label for="eliminarportada">Eliminar foto</label>
                        </div>
                    </div>
                </div>

                <input type="submit" value="Editar usuario" class="button" name="actualizar" value="Actualizar">

            </form>

        </div>


        <!-- Botón que nos redirija a la lista de libros -->

    </main>
    <div class="d-flex justify-content-center gap-2">
        <!-- Botones para volver, editar y borrar -->
        <a class="btn btn-primary" href="/User/home">Volver</a>

        <a class="btn btn-danger" href="/user/delete/<?= $user->id ?>">Borrar</a>
    </div>

    <?= Template::getAltFooter() ?>
</body>

</html>