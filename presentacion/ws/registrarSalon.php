<?php

require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/persistencia/util/Conexion.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/negocio/ManejoSalon.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/negocio/Salon.php';

$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
$idprofesor = isset($_POST['idprofesor']) ? $_POST['idprofesor'] : null;
$estudiantes = isset($_POST['estudiantes']) ? $_POST['estudiantes'] : null;
try {
    $obj = new Conexion();
    $conexion = $obj->conectarBD();

    ManejoSalon::setConexionBD($conexion);
    $date = date('Y-m-d H:i:s');

    $salon = new Salon();
    $salon->setNombre($nombre);
    $salon->setDescripcion($descripcion);
    $salon->setIdProfesor($idprofesor);
    $salon->setFechaCreacion($date);
    $salon->setFechaActualizacion($date);
    $salon->setEstado('A');
    $salon->setEstudiantes($estudiantes);

    ManejoSalon::crearSalon($salon);
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
