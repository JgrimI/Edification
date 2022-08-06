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

    $profesor = new Estudiante();
    $profesor->setNombre($nombre);
    $profesor->setApellido($apellido);
    $profesor->setEmail($correo);
    $profesor->setEstado('A');
    $profesor->setFechaCreacion($date);
    $profesor->setFechaActualizacion($date);

    ManejoEstudiante::crearEstudiante($profesor);
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
