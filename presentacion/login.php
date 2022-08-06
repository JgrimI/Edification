<!DOCTYPE html>
<html lang="es" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="../diseño/Funcionario/img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="codepixer">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>Inicio de Sesión </title>

	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
	<!--CSS------------------------------------------------------>
	<link rel="shortcut icon" href="diseño/images/logo.ico">
	<link rel="stylesheet" href="diseño/Funcionario/css/linearicons.css">
	<link rel="stylesheet" href="diseño/Funcionario/css/font-awesome.min.css">
	<link rel="stylesheet" href="diseño/Funcionario/css/bootstrap.css">
	<link rel="stylesheet" href="diseño/Funcionario/css/magnific-popup.css">
	<link rel="stylesheet" href="diseño/Funcionario/css/nice-select.css">
	<link rel="stylesheet" href="diseño/Funcionario/css/animate.min.css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="diseño/Funcionario/css/owl.carousel.css">
	<link rel="stylesheet" href="diseño/Funcionario/css/main.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body background="diseño/images/Fondos/1.jpg" style="background-color:#b2db71; background-size:60% 80%; background-repeat: no-repeat; background-position: center 0;">

	<!-- start banner Area -->
	<section class="relative" id="home">
		<div class="overlay overlay-bg"></div>
		<div class="container">
			<div class="row fullscreen d-flex align-items-center justify-content-center">
				<div class="banner-content col-lg-4 col-md-4 ">
					<center><img src="diseño/Funcionario/img/logos/img02.png" width="200" height="210" alt="" title="" />
					</center>
				</div>

				<div class="col-lg-5  col-md-3 header-right">
					<center>
						<h4 class="text-white pb-30">Iniciar Sesión</h4>
					</center>
					<form class="form" role="form" autocomplete="on" action="signin.php" method="POST">
						<div class="from-group">
							<input class="form-control txt-field" type="email" name="Correo" placeholder="Correo Electronico" required>
						</div>
						<div class="from-group">
							<input class="form-control txt-field" type="password" name="password" placeholder="Contraseña" required>
						</div>
						<center>
							<div class="form-group row">
								<div class="col-md-12">
									<div class="g-recaptcha " data-sitekey="6LctyvsUAAAAAMoZaJgkXL-8HQMCF4f4ccynGMaI"></div>
								</div>
							</div>
						</center>

						<div class="form-group row">
							<div class="col-md-12">
								<button type="submit" class="btn btn-default btn-lg btn-block text-center text-uppercase">Ingresar</button>
								<br>
								<center>
									<b>
										<a style="color:orange" href="recuperarContraseña.php">Olvidé mi contraseña</a>
									</b>
								</center>
								<br>
								<center>
									<b>
										<a style="color:orange" href="ModuloFuncionario/formularioCliente.php">¿Eres nuevo? <u> Registrate Aquí </u> </a>
									</b>
								</center>
							</div>

						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<!-- End banner Area -->


	<!-- start footer Area -->
	<footer class="footer-area section-gap">
		<div class="container">
			<div class="row">
				<p class="mt-50 mx-auto footer-text col-lg-12">
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					Copyright &copy;<script>
						document.write(new Date().getFullYear());
					</script> All rights reserved | Powered by <a href="#">SoftUp Enterprise</a>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				</p>
			</div>
		</div>
	</footer>
	<!-- End footer Area -->

	<script src='https://www.google.com/recaptcha/api.js'></script>

	<script src="diseño/Funcionario/js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="diseño/Funcionario/js/vendor/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="diseño/Funcionario/js/easing.min.js"></script>
	<script src="diseño/Funcionario/js/hoverIntent.js"></script>
	<script src="diseño/Funcionario/js/superfish.min.js"></script>
	<script src="diseño/Funcionario/js/jquery.ajaxchimp.min.js"></script>
	<script src="diseño/Funcionario/js/jquery.magnific-popup.min.js"></script>
	<script src="diseño/Funcionario/js/owl.carousel.min.js"></script>
	<script src="diseño/Funcionario/js/jquery.sticky.js"></script>
	<script src="diseño/Funcionario/js/jquery.nice-select.min.js"></script>
	<script src="diseño/Funcionario/js/waypoints.min.js"></script>
	<script src="diseño/Funcionario/js/jquery.counterup.min.js"></script>
	<script src="diseño/Funcionario/js/parallax.min.js"></script>
	<script src="diseño/Funcionario/js/mail-script.js"></script>
	<script src="diseño/Funcionario/js/main.js"></script>
</body>

</html>