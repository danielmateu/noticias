<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Registro - <?= APP_NAME ?></title>

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
	<?= (TEMPLATE)::getHeaderAlt('Registros') ?>

	<!-- <?= (TEMPLATE)::getBreadCrumbs(["LogIn" => "/Login"]) ?> -->
	<?= (TEMPLATE)::getFlashes() ?>

	<main class="shadow">
		<section class="">

			<!-- Formulario de registro, pedimos nombre, email, password y password repetido -->

			<form class="col-6">
				<!-- Nombre -->
				<div class="mb-3">
					<label for="" class="form-label">Nombre</label>
					<input required type="text" class="form-control" id="" name="" placeholder="Introduce tu nombre">
				</div>
				<!-- Email -->
				<div class="mb-3">
					<label for="" class="form-label">Email</label>
					<input required type="email" class="form-control" id="" name='' placeholder="Introduce tu @mail" aria-describedby="emailHelp">
					<div id="emailHelp" class="form-text">Nunca compartiremos tus datos 😋</div>
				</div>
				<!-- Password -->
				<div class="mb-3">
					<label for="" class="form-label">Password</label>
					<input required type="password" class="form-control" id="" name="" placeholder="Introduce la contraseña">
				</div>
				<!-- Password repetido -->
				<div class="mb-3">
					<label for="" class="form-label">Repite el Password</label>
					<input required type="password" class="form-control" id="" name="" placeholder="Repite la contraseña">
				</div>
				<!-- <div class="mb-3 form-check">
					<input type="checkbox" class="form-check-input" id="exampleCheck1">
					<label class="form-check-label" for="exampleCheck1">Check me out</label>
				</div> -->
				<div class="d-flex justify-content-between">
					<input type="submit" name="submit" class="btn btn-outline-primary" value="Registro">

					<a href="/Login">Ya estás registrado?</a>
				</div>

			</form>


		</section>

	</main>

	<?= (TEMPLATE)::getAltFooter() ?>
</body>

</html>
<!-- <div class="flex1"> </div>
<form class="flex2" method="POST" autocomplete="off" id="loginForm" action="/Login/enter">

	<h2>Registro a la aplicación</h2>
	<p>Introduce tus datos en el formulario para registrarte.</p>

	<div class="mb-3">

		<label for="name">Nombre:</label>
		<input type="text" name="name" id="name" value="<?= old('name') ?>" required>

		<label for="email">email:</label>
		<input type="email" name="user" id="email" value="<?= old('user') ?>" required>
		<br>
		<label for="password">Password:</label>
		<input type="password" name="password" id="password" required>


		<label for="password">Repite Password:</label>
		<input type="password" name="password" id="password2" required>
	</div>

	<div class="centrado">
		<input type="submit" class="btn btn-outline-success" name="login" value="Registro">
	</div>
	<div class="derecha">
		<a href="/login">Ya estoy registrado</a>
	</div>

</form>
<div class="flex1"> </div> -->