<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>LogIn - <?= APP_NAME ?></title>

	<!-- META -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="LogIn en <?= APP_NAME ?>">
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

	<!-- <?= (TEMPLATE)::getBreadCrumbs(["LogIn" => "/Login"]) ?> -->
	<?= (TEMPLATE)::getFlashes() ?>

	<main class="shadow">
		<section class="">
			<form class="col-6 ">
				<h2>Acceso a la aplicación</h2>
				<p>Introduce tus datos en el formulario para identificarte.</p>
				<!-- Email -->
				<div class="mb-3">
					<label for="email" class="form-label">Email</label>
					<input required type="email" class="form-control" name="user" id="email" placeholder="Introduce tu @mail" aria-describedby="emailHelp" value="<?= old('user') ?>" required>

				</div>
				<!-- Password -->
				<div class="mb-3">
					<label for="" class="form-label">Password</label>
					<input type="password" name="password" id="password" required class="form-control" placeholder="Introduce la contraseña">
				</div>

				<div class="d-flex justify-content-between">
					<input type="submit" name="login" class="btn btn-outline-primary" value="LogIn">
				</div>
				<div class="d-flex flex-column align-items-end">
					<a href="/Register">No estás registrado?</a>
					<a href="/ForgotPassword">Has olvidado la contraseña?</a>
				</div>

			</form>
		</section>

	</main>

	<?= (TEMPLATE)::getAltFooter() ?>
</body>

</html>