<?php
if (isset($_GET['menu'])) {
	if ($_GET['menu'] == 'inicio') {
		include_once('ModuloProfesor/inicio.php');
	}
	if ($_GET['menu'] == 'salones') {
		include_once('ModuloProfesor/listar_salones.php');
	}
	if ($_GET['menu'] == 'estudiantes') {
		include_once('ModuloProfesor/listar_estudiantes.php');
	}
	if ($_GET['menu'] == 'detalle-estudiante') {
		include_once('ModuloProfesor/detalle-estudiante.php');
	}
	if ($_GET['menu'] == 'detalle-salon') {
		include_once('ModuloProfesor/detalle-salon.php');
	}
} else {
	include_once('ModuloProfesor/inicio.php');
}
