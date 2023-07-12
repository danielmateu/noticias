<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Contacto</title>
    <!-- <link rel="stylesheet" href="/css/style.css"> -->
    <?= Template::getCss() ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>

    <?= Template::getMenuBootstrap() ?>
    <?= Template::getHeaderAlt("Contacto") ?>
    <?= Template::getSuccess() ?>
    <?= Template::getError() ?>

    <main class="d-flex flex-column flex-lg-row justify-content-center align-items-center gap-2">
        <!-- Formulario de contacto -->
        <form action="/Contacto/send" method="POST" class="col-4">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Introduce tu nombre" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" required>
            </div>
            <div class="mb-3">
                <label for="asunto" class="form-label">Asunto</label>
                <input type="text" class="form-control" id="asunto" name="asunto" placeholder="Asunto" required>
            </div>
            <div class="mb-3">
                <label for="mensaje" class="form-label">Mensaje</label>
                <textarea class="form-control" id="mensaje" name="mensaje" rows="3" placeholder="Tu Mensaje" required></textarea>
            </div>
            <input type="submit" class="btn btn-primary" name="enviar" value="Enviar">
        </form>

        <!-- Mostrar localización -->
        <div class="col-lg-6 d-flex p-4 card">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2992.032080748173!2d2.128648012876506!3d41.416822266790014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a4981b5fdca4b1%3A0x35e8d1d280af19bd!2sCIFO%20Barcelona%20-%20La%20Violeta!5e0!3m2!1ses!2ses!4v1689101888379!5m2!1ses!2ses" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

            <!-- Texto para la card -->


            <div class="card-body">
                <p class="card-text"><strong>CIFO La VIOLETA</strong></p>
                <p class="card-text"><strong>Dirección:</strong>C/ de la Violeta, 1, 08004 Barcelona</p>
                <p class="card-text"><strong>Teléfono:</strong>93 443 89 00</p>
            </div>
        </div>


    </main>

    <div class="d-flex justify-content-center gap-2">
        <!-- Botones para volver, editar y borrar -->
        <a class="btn btn-outline-primary" href="/">Volver</a>

    </div>

    <?= Template::getAltFooter() ?>
</body>

</html>