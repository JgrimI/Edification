<?php
if (isset($_GET['menu'])) {
	if ($_GET['menu'] == 'inicio') {
		include_once('ModuloAdministrador/inicio.php');
	}
	if ($_GET['menu'] == 'profesores') {
		include_once('ModuloAdministrador/listar_profesores.php');
	}
	if ($_GET['menu'] == 'salones') {
		include_once('ModuloAdministrador/listar_salones.php');
	}
	if ($_GET['menu'] == 'estudiantes') {
		include_once('ModuloAdministrador/listar_estudiantes.php');
	}
	if ($_GET['menu'] == 'detalle-estudiante') {
		include_once('ModuloAdministrador/detalle-estudiante.php');
	}
	if ($_GET['menu'] == 'detalle-salon') {
		include_once('ModuloAdministrador/detalle-salon.php');
	}
} else {
	include_once('ModuloAdministrador/inicio.php');
}
