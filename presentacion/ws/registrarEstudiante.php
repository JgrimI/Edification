<?php

require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/persistencia/util/Conexion.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/negocio/ManejoEstudiante.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/negocio/Estudiante.php';

$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$apellido = isset($_POST['apellido']) ? $_POST['apellido'] : null;
$correo = isset($_POST['email']) ? $_POST['email'] : null;

try {
    $obj = new Conexion();
    $conexion = $obj->conectarBD();

    ManejoEstudiante::setConexionBD($conexion);
    $date = date('Y-m-d H:i:s');

    $estudiante = new Estudiante();
    $estudiante->setNombre($nombre);
    $estudiante->setApellido($apellido);
    $estudiante->setEmail($correo);
    $estudiante->setEstado('A');
    $estudiante->setFechaCreacion($date);
    $estudiante->setFechaActualizacion($date);

    ManejoEstudiante::crearEstudiante($estudiante);
    $json = array(
        "response" => 1
    );
} catch (\Exception $e) {
    $json = array(
        "response" => 2,
        "error" => $e->getMessage()
    );
}
echo json_encode($json);
