<?php

require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/persistencia/util/Conexion.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/negocio/ManejoProfesor.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/negocio/Profesor.php';

$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$apellido = isset($_POST['apellido']) ? $_POST['apellido'] : null;
$correo = isset($_POST['email']) ? $_POST['email'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

try {
    $obj = new Conexion();
    $conexion = $obj->conectarBD();

    ManejoProfesor::setConexionBD($conexion);
    $date = date('Y-m-d H:i:s');

    $profesor = new Profesor();
    $profesor->setNombre($nombre);
    $profesor->setApellido($apellido);
    $profesor->setEmail($correo);
    $profesor->setContrasena($password);
    $profesor->setEstado('A');
    $profesor->setFechaCreacion($date);
    $profesor->setFechaActualizacion($date);

    ManejoProfesor::crearProfesor($profesor);
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
