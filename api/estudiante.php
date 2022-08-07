<?php
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/persistencia/util/Conexion.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/negocio/ManejoToken.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/negocio/ManejoEstudiante.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/negocio/Estudiante.php';
require_once 'clases/respuestas.php';

$_respuestas = new respuestas;

$obj = new Conexion();
$conexion = $obj->conectarBD();

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET["token"])) {
        $id = $_GET["token"];
        ManejoToken::setConexionBD($conexion);
        $date = date('Y-m-d H:i:s');
        $token = ManejoToken::consultarApiKey($id);
        if ($token !== false) {

            if (isset($_GET["listarTodo"])) {
                ManejoEstudiante::setConexionBD($conexion);
                $estudiantes = ManejoEstudiante::listarEstudiantes();
                $respuesta = $_respuestas->response;
                $respuesta['cantidad'] = count($estudiantes);
                $arr_aux = [];
                foreach ($estudiantes as $estudiante) {
                    $arr_aux[] = array(
                        'id' => $estudiante->getId(),
                        'nombre' => $estudiante->getNombre(),
                        'apellido' => $estudiante->getApellido(),
                        'fecha_creacion' => $estudiante->getFechaCreacion(),
                        'fecha_actualizacion' => $estudiante->getFechaActualizacion(),
                        'estado' => $estudiante->getEstado()
                    );
                }
                $respuesta['result'] = $arr_aux;
                header("Content-Type: application/json");
                echo json_encode($respuesta);
                http_response_code(200);
            } else if (isset($_GET['id'])) {
                $estudianteid = $_GET['id'];
                ManejoEstudiante::setConexionBD($conexion);
                $estudiante = ManejoEstudiante::consultarEstudiante($estudianteid);
                $respuesta = $_respuestas->response;
                if ($estudiante !== false) {
                    $respuesta['result'] = array(
                        'id' => $estudiante->getId(),
                        'nombre' => $estudiante->getNombre(),
                        'apellido' => $estudiante->getApellido(),
                        'fecha_creacion' => $estudiante->getFechaCreacion(),
                        'fecha_actualizacion' => $estudiante->getFechaActualizacion(),
                        'estado' => $estudiante->getEstado()
                    );
                } else {
                    $respuesta['result'] = 'estudiante not found';
                }
                header("Content-Type: application/json");
                echo json_encode($respuesta);
                http_response_code(200);
            }
        } else {
            header("Content-Type: application/json");
            echo json_encode($_respuestas->error_401("El Token que envio es invalido o ha caducado"));
            http_response_code(200);
        }
    } else {
        header("Content-Type: application/json");
        echo json_encode($_respuestas->error_401());
        http_response_code(200);
    }
} else if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //recibimos los datos enviados
    if (isset($_POST["token"])) {
        $id = $_POST["token"];
        ManejoToken::setConexionBD($conexion);
        $date = date('Y-m-d H:i:s');
        $token = ManejoToken::consultarApiKey($id);
        if ($token !== false) {
            try {
                if (!isset($_POST['nombre']) || !isset($_POST['apellido']) || !isset($_POST['email'])) {

                    header('Content-Type: application/json');
                    $respuesta = $_respuestas->error_400();
                    echo json_encode($respuesta);
                    if (isset($respuesta["result"]["error_id"])) {
                        $responseCode = $respuesta["result"]["error_id"];
                        http_response_code($responseCode);
                    } else {
                        http_response_code(200);
                    }
                } else {
                    $respuesta = $_respuestas->response;

                    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
                    $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : null;
                    $correo = isset($_POST['email']) ? $_POST['email'] : null;
                    ManejoEstudiante::setConexionBD($conexion);
                    $date = date('Y-m-d H:i:s');

                    $estudiante = new Estudiante();
                    $estudiante->setNombre($nombre);
                    $estudiante->setApellido($apellido);
                    $estudiante->setEmail($correo);
                    $estudiante->setEstado('A');
                    $estudiante->setFechaCreacion($date);
                    $estudiante->setFechaActualizacion($date);

                    $id_estudiante = ManejoEstudiante::crearEstudiante($estudiante);
                    $respuesta["result"] = array(
                        "id_estudiante" => $id_estudiante
                    );

                    header("Content-Type: application/json");
                    echo json_encode($respuesta);
                }
            } catch (\Exception $e) {
                header('Content-Type: application/json');
                $respuesta = $_respuestas->error_500($e->getMessage());
                if (isset($respuesta["result"]["error_id"])) {
                    $responseCode = $datosArray["result"]["error_id"];
                    http_response_code($responseCode);
                } else {
                    http_response_code(200);
                }
            }
        } else {
            header("Content-Type: application/json");
            echo json_encode($_respuestas->error_401("El Token que envio es invalido o ha caducado"));
            http_response_code(200);
        }
    } else {
        header("Content-Type: application/json");
        echo json_encode($_respuestas->error_401());
        http_response_code(200);
    }
} else if ($_SERVER['REQUEST_METHOD'] == "PUT") {
    //recibimos los datos enviados
    parse_str(file_get_contents('php://input'), $_PUT);

    if (isset($_PUT["token"])) {
        $id = $_PUT["token"];
        ManejoToken::setConexionBD($conexion);
        $date = date('Y-m-d H:i:s');
        $token = ManejoToken::consultarApiKey($id);
        if ($token !== false) {
            try {
                if (!isset($_PUT['id_estudiante'])) {
                    header('Content-Type: application/json');
                    $respuesta = $_respuestas->error_400();
                    echo json_encode($respuesta);
                    if (isset($respuesta["result"]["error_id"])) {
                        $responseCode = $respuesta["result"]["error_id"];
                        http_response_code($responseCode);
                    } else {
                        http_response_code(200);
                    }
                } else {
                    if (!isset($_PUT['nombre']) && !isset($_PUT['apellido']) && !isset($_PUT['email']) && !isset($_PUT['estado'])) {
                        header('Content-Type: application/json');
                        $respuesta = $_respuestas->error_400();
                        echo json_encode($respuesta);
                        if (isset($respuesta["result"]["error_id"])) {
                            $responseCode = $respuesta["result"]["error_id"];
                            http_response_code($responseCode);
                        } else {
                            http_response_code(200);
                        }
                    } else {
                        $respuesta = $_respuestas->response;

                        ManejoEstudiante::setConexionBD($conexion);
                        $date = date('Y-m-d H:i:s');

                        $estudiante = ManejoEstudiante::consultarEstudiante($_PUT['id_estudiante']);
                        $nombre = isset($_PUT['nombre']) ? $_PUT['nombre'] :  $estudiante->getNombre();
                        $apellido = isset($_PUT['apellido']) ? $_PUT['apellido'] :  $estudiante->getApellido();
                        $correo = isset($_PUT['email']) ? $_PUT['email'] :  $estudiante->getEmail();
                        $estado = isset($_PUT['estado']) ? $_PUT['estado'] :  $estudiante->getEstado();

                        $estudiante->setNombre($nombre);
                        $estudiante->setApellido($apellido);
                        $estudiante->setEmail($correo);
                        $estudiante->setEstado($estado);
                        $estudiante->setFechaActualizacion($date);

                        ManejoEstudiante::modificarEstudiante($estudiante);

                        header("Content-Type: application/json");
                        echo json_encode($respuesta);
                        http_response_code(200);
                    }
                }
            } catch (Exception $e) {
                header('Content-Type: application/json');
                $respuesta = $_respuestas->error_500($e->getMessage());
                if (isset($respuesta["result"]["error_id"])) {
                    $responseCode = $datosArray["result"]["error_id"];
                    http_response_code($responseCode);
                } else {
                    http_response_code(200);
                }
            }
        } else {
            header("Content-Type: application/json");
            echo json_encode($_respuestas->error_401("El Token que envio es invalido o ha caducado"));
            http_response_code(200);
        }
    } else {
        header("Content-Type: application/json");
        echo json_encode($_respuestas->error_401());
        http_response_code(200);
    }
} else if ($_SERVER['REQUEST_METHOD'] == "DELETE") {

    $headers = getallheaders();
    if (isset($headers["token"]) && isset($headers["id_estudiante"])) {
        //recibimos los datos enviados por el header
        ManejoToken::setConexionBD($conexion);
        $date = date('Y-m-d H:i:s');
        $token = ManejoToken::consultarApiKey($id);
        if ($token !== false) {

            $send = [
                "token" => $headers["token"],
                "id_estudiante" => $headers["id_estudiante"]
            ];
            $postBody = $send;
        } else {
            header("Content-Type: application/json");
            echo json_encode($_respuestas->error_401("El Token que envio es invalido o ha caducado"));
            http_response_code(200);
        }
    } else {
        //recibimos los datos enviados
        if (isset($_GET["token"])) {
            $id = $_GET["token"];
            ManejoToken::setConexionBD($conexion);
            $date = date('Y-m-d H:i:s');
            $token = ManejoToken::consultarApiKey($id);
            if ($token !== false) {
                if (!isset($_GET['id_estudiante'])) {
                    header('Content-Type: application/json');
                    $respuesta = $_respuestas->error_400();
                    echo json_encode($respuesta);
                    if (isset($respuesta["result"]["error_id"])) {
                        $responseCode = $respuesta["result"]["error_id"];
                        http_response_code($responseCode);
                    } else {
                        http_response_code(200);
                    }
                } else {
                    $postBody =  [
                        "token" => $_GET["token"],
                        "id_estudiante" => $_GET["id_estudiante"]
                    ];
                }
            } else {
                header("Content-Type: application/json");
                echo json_encode($_respuestas->error_401("El Token que envio es invalido o ha caducado"));
                http_response_code(200);
            }
        } else {
            header("Content-Type: application/json");
            echo json_encode($_respuestas->error_401());
            http_response_code(200);
        }
    }
    if (isset($postBody["id_estudiante"])) {
        $respuesta = $_respuestas->response;

        ManejoEstudiante::setConexionBD($conexion);
        $estudiante = ManejoEstudiante::consultarEstudiante($postBody['id_estudiante']);
        $estado = $estudiante->getEstado();
        if ($estado == 'A') {
            $estudiante->setEstado('I');
            $respuesta['result'] = array('estudiante' => 'Inactivo');
        } else {
            $estudiante->setEstado('A');
            $respuesta['result'] = array('estudiante' => 'Activo');
        }
        ManejoEstudiante::modificarEstudiante($estudiante);
        header("Content-Type: application/json");
        echo json_encode($respuesta);
        http_response_code(200);
    }
} else {
    header('Content-Type: application/json');
    $datosArray = $_respuestas->error_405();
    echo json_encode($datosArray);
}
