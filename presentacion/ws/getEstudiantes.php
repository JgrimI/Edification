<?php

require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/persistencia/util/Conexion.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/negocio/ManejoEstudiante.php';

$obj = new Conexion();
$conexion = $obj->conectarBD();

ManejoEstudiante::setConexionBD($conexion);

if (isset($_POST['cambiar'])) {
    $estudiante = ManejoEstudiante::consultarEstudiante($_POST['id']);
    $estado = $estudiante->getEstado();
    if ($estado == 'A') {
        $estudiante->setEstado('I');
    } else {
        $estudiante->setEstado('A');
    }
    ManejoEstudiante::modificarEstudiante($estudiante);
}

$estudiantes = ManejoEstudiante::listarEstudiantes();

$json = [];
$response = [];

foreach ($estudiantes as $p) {

    $estado =  ($p->getEstado() == 'A') ? 'Activo' : 'Inactivo';
    $response[] = array(
        '<div class="row text-center">
            <div class="col-12">
                <p>' . ucfirst($p->getNombre()) . ' ' . ucfirst($p->getApellido()), '</p>
            </div>
        </div>
        <div class="row text-center">
        <div class="col-12">
            <p>' . $p->getEmail(), '</p>
            </div>
        </div>
        <div class="row text-center">
        <div class="col-12">
            <p>' . $p->getFechaCreacion(), '</p>
            </div>
        </div>
        <div class="row text-center">
        <div class="col-12">
            <p>' . $p->getFechaActualizacion(), '</p>
            </div>
        </div>
        <div class="row text-center">
        <div class="col-12">
            <p>' . $estado, '</p>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-12">
                <button style="border: 0px solid" type="button" onclick="cambiarEstado(' . $p->getId() . ');">Cambiar Estado</button>									
            </div>
            <div class="col-12">
                <button style="border: 0px solid" type="button" onclick="verDetalleEstudiante(' . $p->getId() . ');" >Editar Estudiante</button>									
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
