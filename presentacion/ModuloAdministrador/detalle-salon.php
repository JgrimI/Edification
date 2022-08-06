<?php
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/persistencia/util/Conexion.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/negocio/ManejoSalon.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/negocio/ManejoProfesor.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/negocio/ManejoEstudiante.php';

if (isset($_POST['id'])) {
    $id = base64_decode($_POST["id"]);
    $nd = '';
    if (isset($_POST['estudiantesSelect'])) {
        $estudiantesSelect = $_POST['estudiantesSelect'];

        if (!is_array($estudiantesSelect)) {
            $estudiantesSelect = [$estudiantesSelect];
        }

        if (!empty($estudiantesAntiguos) && $estudiantesAntiguos != '') {
            $estudiantesAnt = explode(',', $_POST['estudiantesAntiguos']);
            foreach ($estudiantesAnt as $ea) {
                if (!in_array($ea, $estudiantesSelect)) {
                    $estudiantesRemover[] = $ea;
                }
            }
            foreach ($estudiantesSelect as $ea) {
                if (!in_array($ea, $estudiantesAnt)) {
                    $estudiantesAdd[] = $ea;
                }
            }
        } else {
            $estudiantesRemover = [];
            $estudiantesAdd = $estudiantesSelect;
        }


        $nd = implode(',', $estudiantesAdd) . '#' . implode(',', $estudiantesRemover);
    }
    $obj = new Conexion();
    $conexion = $obj->conectarBD();

    ManejoSalon::setConexionBD($conexion);
    $date = date('Y-m-d H:i:s');
    $salon = ManejoSalon::consultarSalon($id);
    $salon->setFechaActualizacion($date);
    $salon->setEstado($_POST['estado']);
    $salon->setNombre($_POST['nombre']);
    $salon->setIdProfesor($_POST['profesor']);
    $salon->setDescripcion($_POST['descripcion']);
    $salon->setEstudiantes($nd);

    ManejoSalon::modificarSalon($salon);
    // echo '<script type="text/javascript"> Swal.fire(
    //     "Muy bien!",
    //     "El salon se ha actualizado exitosamente!",
    //     "success"
    // ).then(function (result) {
    //     if (true) {
    //     window.location = "administrador.php?menu=salones";
    //     }
    // })
    // </script>';
}
if (isset($_GET['id'])) {

    $id = base64_decode($_GET["id"]);

    $obj = new Conexion();
    $conexion = $obj->conectarBD();

    ManejoSalon::setConexionBD($conexion);
    ManejoProfesor::setConexionBD($conexion);
    ManejoEstudiante::setConexionBD($conexion);

    $salon = ManejoSalon::consultarSalon($id);
    $profesor = ManejoProfesor::consultarProfesor($salon->getIdProfesor());
    $estudiantesAll = ManejoEstudiante::listarEstudiantes();
    $profesoresAll = ManejoProfesor::listarProfesores();
    $estudiantes = $salon->getEstudiantes();
} else {
    header('Location: administrador.php?menu=salones');
}
?>
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2-basic-multiple').select2({
            placeholder: {
                id: '-1', // the value of the option
                text: 'Selecciona los estudiantes para el salon'
            },
            allowClear: true
        });
    });
</script>
<!-- offset search area end -->
<!-- body overlay area start -->
<div class="body_overlay"></div>
<!-- body overlay area end -->
<!-- crumbs area start -->
<div class="crumbs-area">
    <div class="container">
        <div class="crumb-content">
            <h4 class="crumb-title"><span>Detalle </span> Salon</h4>
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
                        <strong>Editar Salon</strong><small> Gestión</small>
                    </div>

                    <div class="card-body card-block">
                        <form class="form" id="formRegistroGerente" method="POST">
                            <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>" />
                            <div class="form-group">
                                <label for="nombre" class="form-control-label">Nombre</label>
                                <input type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre" maxlength="80" required class="form-control" value="<?php echo $salon->getNombre(); ?>">
                            </div>
                            <div class="form-group">
                                <label for="profesor" class="form-control-label">Profesor</label>
                                <select style="width:100%" class="form-control" name="profesor" id="profesor">
                                    <?php
                                    $idprof = $salon->getIdProfesor();
                                    foreach ($profesoresAll as $p) {
                                        if ($p->getId() == $idprof)
                                            echo  '<option value="' . $p->getId() . '" selected="selected">' . $p->getNombre() . ' ' . $p->getApellido() . '</option>';
                                        else
                                            echo  '<option value="' . $p->getId() . '" >' . $p->getNombre() . ' ' . $p->getApellido() . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="descripcion" class="form-control-label">Descripcion</label>
                                <input type="text" id="descripcion" name="descripcion" placeholder="Ingrese la descripcion" class="form-control" value="<?php echo $salon->getDescripcion(); ?>">
                            </div>
                            <div class="form-group">
                                <label for="estudiantesSelect" class="form-control-label">Estudiantes</label>
                                <select style=" width:100%" class="select2-basic-multiple js-states" id="estudiantesSelect" name="estudiantesSelect[]" multiple="multiple">
                                    <?php
                                    $estudianteAntt = '';
                                    foreach ($estudiantes as $e) {
                                        $estudianteAntt = implode(",", $estudiantes);
                                        $estudiante = ManejoEstudiante::consultarEstudiante($e);
                                        echo '<option value="' . $estudiante->getId() . '" selected="selected">' . $estudiante->getNombre() . ' ' . $estudiante->getApellido() . '</option>';
                                    }
                                    foreach ($estudiantesAll as $e) {
                                        if (!in_array($e->getId(), $estudiantes))
                                            echo '<option value="' . $e->getId() . '" >' . $e->getNombre() . ' ' . $e->getApellido() . '</option>';
                                    }
                                    ?>
                                </select>
                                <input type="hidden" id="estudiantesAntiguos" name="estudiantesAntiguos" value="<?php echo $estudianteAntt; ?>">

                            </div>
                            <div class="form-group">
                                <label for="fcreacion" class="form-control-label">Fecha de Creacion</label>
                                <input class="form-control" type="text" name="fcreacion" value="<?php echo $salon->getFechaCreacion(); ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="estado" class="form-control-label">Estado</label>
                                <select name="estado" id="estado" class="form-control">
                                    <?php
                                    if ($salon->getEstado() == 'A')
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
                                    <input id="menu" name="menu" type="hidden" value="salones">
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