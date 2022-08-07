<?php
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/persistencia/util/Conexion.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/negocio/ManejoEstudiante.php';

if (isset($_POST['id'])) {
    $id = base64_decode($_POST["id"]);

    $obj = new Conexion();
    $conexion = $obj->conectarBD();

    ManejoEstudiante::setConexionBD($conexion);
    $date = date('Y-m-d H:i:s');
    $estudiante = ManejoEstudiante::consultarEstudiante($id);
    $estudiante->setFechaActualizacion($date);
    $estudiante->setEstado($_POST['estado']);
    $estudiante->setNombre($_POST['nombre']);
    $estudiante->setEmail($_POST['email']);
    $estudiante->setApellido($_POST['apellido']);
    ManejoEstudiante::modificarEstudiante($estudiante);
    echo '<script type="text/javascript"> Swal.fire(
        "Muy bien!",
        "El estudiante se ha actualizado exitosamente!",
        "success"
    ).then(function (result) {
        if (true) {
          window.location = "administrador.php?menu=estudiantes";
        }
      })
      </script>';
}
if (isset($_GET['id'])) {

    $id = base64_decode($_GET["id"]);

    $obj = new Conexion();
    $conexion = $obj->conectarBD();

    ManejoEstudiante::setConexionBD($conexion);

    $estudiante = ManejoEstudiante::consultarEstudiante($id);
} else {
    header('Location: administrador.php?menu=estudiantes');
}
?>

<!-- offset search area end -->
<!-- body overlay area start -->
<div class="body_overlay"></div>
<!-- body overlay area end -->
<!-- crumbs area start -->
<div class="crumbs-area">
    <div class="container">
        <div class="crumb-content">
            <h4 class="crumb-title"><span>Detalle </span> Estudiante</h4>
        </div>
    </div>
</div>
<!-- crumbs area end -->
<!-- teacher details area start -->
<div class="teacher-details pt--120 pb--60">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Editar Estudiante</strong><small> Gestión</small>
                    </div>

                    <div class="card-body card-block">
                        <form class="form" id="formRegistroGerente" method="POST">
                            <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>" />
                            <div class="form-group">
                                <label for="nombre" class="form-control-label">Nombre</label>
                                <input type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre" maxlength="80" required class="form-control" value="<?php echo $estudiante->getNombre(); ?>">
                            </div>
                            <div class="form-group">
                                <label for="apellido" class="form-control-label">Apellidos</label>
                                <input type="text" id="apellido" name="apellido" placeholder="Ingrese el apellido" maxlength="80" required class="form-control" value="<?php echo $estudiante->getApellido(); ?>">
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-control-label">E-mail</label>
                                <input type="text" id="email" name="email" placeholder="Ingrese el E-mail" maxlength="80" required class="form-control" value="<?php echo $estudiante->getEmail(); ?>">
                            </div>
                            <div class="form-group">
                                <label for="fcreacion" class="form-control-label">Fecha de Creacion</label>
                                <input class="form-control" type="text" name="fcreacion" value="<?php echo $estudiante->getFechaCreacion(); ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="estado" class="form-control-label">Estado</label>
                                <select name="estado" id="estado" class="form-control">
                                    <?php
                                    if ($estudiante->getEstado() == 'A')
                                        echo '<option value="A" selected="selected">Activo</option>
                                              <option value="I">Inactivo</option>';
                                    else
                                        echo '<option value="A">Activo</option>
                                              <option value="I" selected="selected">Inactivo</option>';
                                    echo '</select>';

                                    ?>
                            </div>
                            <center>
                                <button type="submit" style="width: auto;" class="btn btn-warning">Guardar Cambios</button>
                            </center>
                        </form>
                        <br>
                        <form name="menu" method="get">
                            <div>
                                <center>
                                    <input id="menu" name="menu" type="hidden" value="estudiantes">
                                    <button type="submit" style="width: auto;" class="btn btn-danger">Regresar</button>
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- teacher details area end -->