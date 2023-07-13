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

			<form class="col-6" method="POST" autocomplete="off" action="/Forgotpassword/send">

				<h2>Recuperación de password</h2>
				<p>Introduce tus datos y se te enviará una
					nueva clave con la que podrás acceder a la aplicación.
					Recuerda que debes cambiarla lo antes posible.</p>

				<div class="mb-3">
					<label for="email" class="form-label">Email</label>
					<input required type="email" class="form-control" name="user" id="email" placeholder="Introduce tu @mail" aria-describedby="emailHelp" value="<?= old('user') ?>" required>
				</div>

				<div class="mb-3">
					<label for="phone">teléfono:</label>
					<input type="text" name="phone" id="phone" value="<?= old('phone') ?>" required>
				</div>

				<input type="submit" name="login" class="btn btn-outline-primary" value="LogIn">

			</form>

		</section>

	</main>

	<?= (TEMPLATE)::getAltFooter() ?>
</body>

</html>