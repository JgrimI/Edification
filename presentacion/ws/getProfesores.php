<?php

require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/persistencia/util/Conexion.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/negocio/ManejoProfesor.php';

$obj = new Conexion();
$conexion = $obj->conectarBD();

ManejoProfesor::setConexionBD($conexion);

if (isset($_POST['cambiar'])) {
    $profesor = ManejoProfesor::consultarProfesor($_POST['id']);
    $estado = $profesor->getEstado();
    if ($estado == 'A') {
        $profesor->setEstado('I');
    } else {
        $profesor->setEstado('A');
    }
    ManejoProfesor::modificarProfesor($profesor);
}

$profesores = ManejoProfesor::listarProfesores();
// $totaprofesor = ManejoProfesor::totalProfesores();
$json = [];
$response = [];
// var_dump($profesores);
foreach ($profesores as $p) {

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
                <button style="border: 0px solid" type="button" onclick="cambiarEstado(' . $p->getId() . ');" >Cambiar Estado</button>									
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
