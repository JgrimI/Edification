<?php

require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/persistencia/util/Conexion.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/negocio/ManejoSalon.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/negocio/ManejoProfesor.php';

$obj = new Conexion();
$conexion = $obj->conectarBD();

ManejoSalon::setConexionBD($conexion);
ManejoProfesor::setConexionBD($conexion);

if (isset($_POST['cambiar'])) {
    $salon = ManejoSalon::consultarSalon($_POST['id']);
    $estado = $salon->getEstado();
    if ($estado == 'A') {
        $salon->setEstado('I');
    } else {
        $salon->setEstado('A');
    }
    ManejoSalon::modificarSalon($salon);
}
if (isset($_POST['profesor'])) {
    $salones = ManejoSalon::listarSalonesProfesor($_POST['profesor']);
} else {
    $salones = ManejoSalon::listarSalones();
}
$json = [];
$response = [];
foreach ($salones as $s) {

    $profesor = ManejoProfesor::consultarProfesor($s->getIdProfesor());

    $estado =  ($s->getEstado() == 'A') ? 'Activo' : 'Inactivo';
    $descripcion =  ($s->getDescripcion() == '') ? 'N/A' :  $s->getDescripcion();

    $response[] = array(
        '<div class="row text-center">
            <div class="col-12">
                <p>' . ucfirst($s->getNombre()), '</p>
            </div>
        </div>
        <div class="row text-center">
        <div class="col-12">
            <p>' . ucfirst($profesor->getNombre()) . ' ' . ucfirst($profesor->getApellido()), '</p>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-12">
                <p>' . ucfirst($descripcion), '</p>
            </div>
        </div>
        <div class="row text-center">
        <div class="col-12">
            <p>' . $s->getFechaCreacion(), '</p>
            </div>
        </div>
        <div class="row text-center">
        <div class="col-12">
            <p>' . $s->getFechaActualizacion(), '</p>
            </div>
        </div>
        <div class="row text-center">
        <div class="col-12">
            <p>' . $estado, '</p>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-12">
                <button style="border: 0px solid" type="button" onclick="cambiarEstado(' . $s->getId() . ');">Cambiar Estado</button>									
            </div>
            <div class="col-12">
            <button style="border: 0px solid" type="button" onclick="verDetalleSalon(' . $s->getId() . ');" >Editar Salon</button>									
        </div>
        </div>
        '
    );
}
if (count($response) == 0) {
    $json = array(
        "response" => 1
    );
} else {
    $json = array(
        "response" => 1,
        "json" => $response
    );
}
echo json_encode($json);
