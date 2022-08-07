<?php
session_start();

require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/negocio/ManejoAdministrador.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/negocio/ManejoProfesor.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/persistencia/util/Conexion.php';

$con = new Conexion();
$conexion = $con->conectarBD();
$correo = $_POST["email"];
$password = $_POST["password"];
// $correo = 'jorgegrimaldos85@gmail.com';
// $password = 'A1234';
if ($conexion->connect_error) {
	die("Problema de conexión con la base de datos: " . $conexion->connect_error);
}
#==================================================================
#							Ingreso Usuarios
#==================================================================

ManejoAdministrador::setConexionBD($conexion);
$adminValidado = ManejoAdministrador::iniciarSesion($correo, $password);
if ($adminValidado !== false) {
	$admin = $adminValidado[0];
	$cambiarContra = $adminValidado[1];
	if (!empty($admin)) {
		$_SESSION['tipo_user'] = 'admin';
		$_SESSION['id_user'] = $admin->getId();
		$_SESSION['nom_user'] = $admin->getNombre();
		$_SESSION['ape_user'] = $admin->getApellido();
		$_SESSION['email_user'] = $correo;

		if ($cambiarContra == 1) {
			// header("location: /prueba/presentacion/cambiarContrasena.php");
		} else {
			header("location: /prueba/edification/presentacion/administrador.php");
		}
	}
}
ManejoProfesor::setConexionBD($conexion);
$profesorValidado = ManejoProfesor::iniciarSesion($correo, $password);
if ($profesorValidado !== false) {
	$profesor = $profesorValidado[0];
	$cambiarContra = $profesorValidado[1];
	if (!empty($profesor)) {
		$_SESSION['tipo_user'] = 'profesor';
		$_SESSION['id_user'] = $profesor->getId();
		$_SESSION['nom_user'] = $profesor->getNombre();
		$_SESSION['ape_user'] = $profesor->getApellido();
		$_SESSION['email_user'] = $correo;
		if ($cambiarContra == 1) {
			// header("location: /prueba/presentacion/cambiarContrasena.php");
		} else {
			header("location: /prueba/edification/presentacion/profesor.php");
		}
	}
} else {
	echo '<script language="javascript">alert("Este usuario no se encuentra registrado");
						window.location.href="login.php"
						</script>';
}
//  else {
// 	ManejoProfesor::setConexionBD($conexion);
// 	$profesorValidado = ManejoProfesor::iniciarSesion($correo, $password);

// 	$profesor = $profesorValidado[0];
// 	$cambiarContra = $profesorValidado[1];
// 	if (!empty($profesor)) {
// 		$_SESSION['tipoUsuario'] = 4;
// 		$_SESSION['identificacion_admin'] = $admin->getIdentificacion();
// 		$_SESSION['nom_admin'] = $admin->getNombre();
// 		$_SESSION['email'] = $correo;


// 		if ($cambiarContra == 1) {
// 			header("location: /prueba/presentacion/cambiarContrasena.php");
// 		} else {
// 			header("location: /prueba/presentacion/profesor.php");
// 		}
// 	} else {
// 		echo '<script language="javascript">alert("Este usuario no se encuentra registrado");
// 					window.location.href="login.php"
// 					</script>';
// 	}
// }


$conexion->close();
