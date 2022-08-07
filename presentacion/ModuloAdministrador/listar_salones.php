<?php
session_start();
if (!isset($_SESSION['tipo_user']) || $_SESSION['tipo_user'] != 'admin') {
    header('Location: index.php');
}
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/persistencia/util/Conexion.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/negocio/ManejoProfesor.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/prueba/edification/negocio/ManejoEstudiante.php';

$obj = new Conexion();
$conexion = $obj->conectarBD();

ManejoProfesor::setConexionBD($conexion);

$profesores = ManejoProfesor::listarProfesores();

ManejoEstudiante::setConexionBD($conexion);

$estudiantes = ManejoEstudiante::listarEstudiantes();
?>

<style type="text/css">
    .main-menu nav ul li.activeSalones a {
        color: #fc9928;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() {
        getSalones();
        $('.select2-basic-multiple').select2({
            placeholder: {
                id: '-1', // the value of the option
                text: 'Selecciona los estudiantes para el salon'
            },
            allowClear: true
        });
    });

    function verDetalleSalon(id) {
        id = btoa(id);
        window.location.href = "administrador.php?menu=detalle-salon&id=" + id;
    }

    function registrarSalon() {
        var nombre = $('#nombre').val().trim()

        if (nombre != "") {
            $.ajax({
                type: "POST",
                url: "ws/registrarSalon.php",
                data: {
                    nombre: $('#nombre').val(),
                    descripcion: $('#descripcion').val(),
                    idprofesor: $('#profesor').val(),
                    estudiantes: $('#estudiantes').val()
                },
                success: function(data) {
                    //console.log(data);
                    data = JSON.parse(data);
                    if (data['response'] == 1) {
                        Swal.fire(
                            'Muy bien!',
                            'El salon se ha registrado exitosamente!',
                            'success'
                        )

                        $('#salonModal').modal('hide');
                        getSalones();
                    } else {
                        Swal.fire(
                            'Error!',
                            'Error al registrar el salon!',
                            'error'
                        )
                        $('#salonModal').modal('hide');
                        getSalones();
                    }

                },
                error: function(data) {
                    Swal.fire(
                        'Error!',
                        'Error al registrar el salon!',
                        'error'
                    )
                    $('#salonModal').modal('hide');
                    getSalones();
                },
            })

        } else {
            $('#message').html('Revisa los datos ingresados e intetalo de nuevo.').css('color', 'green');
            return false;
        }
    }

    function cambiarEstado(id) {
        if ($.fn.DataTable.isDataTable('#tablal')) {
            $('#tablal').DataTable().destroy();
        }

        $.ajax({
            type: "POST",
            url: "ws/getSalones.php",
            data: {
                id: id,
                cambiar: 1
            },
            success: function(data) {
                //console.log(data);
                data = JSON.parse(data);
                if (data["response"] == 1) {
                    Swal.fire(
                        'Excelente!',
                        'El estado se ha cambiado exitosamente!',
                        'success'
                    )
                    data = data["json"];
                    console.log(data);
                    $('#tablal').DataTable({
                        mark: true,
                        data: data,
                        columns: [{
                                title: "Salon"
                            },
                            {
                                title: "Profesor Asignado"
                            },
                            {
                                title: "Descripcion"
                            },
                            {
                                title: "Fecha de Creacion"
                            },
                            {
                                title: "Fecha de Actualizacion"
                            },
                            {
                                title: "Estado"
                            },
                            {
                                title: "Acciones"
                            },
                        ],
                        autoWidth: false,
                        columnDefs: [{
                                width: "10%!important",
                                "targets": 0
                            }, {
                                width: "10%!important",
                                "targets": 0
                            },
                            {
                                width: "20%!important",
                                "targets": 1
                            },
                            {
                                width: "10%!important",
                                "targets": 2
                            },
                            {
                                width: "10%!important",
                                "targets": 3
                            },
                            ///  {width: "10%!important", "targets": 4},
                            {
                                width: "10%!important",
                                "targets": 4
                            },
                            {
                                width: "10%!important",
                                "targets": 5
                            }
                        ],
                        language: {
                            processing: "Procesando...",
                            search: "",
                            searchPlaceholder: "Búsqueda Detallada",
                            lengthMenu: "Mostrar _MENU_ registros",
                            info: "Mostrando salones del _START_ al _END_ de un total de _TOTAL_ salones",
                            infoEmpty: "Mostrando salones del 0 al 0 de un total de 0 salones",
                            infoFiltered: "(filtrado de un total de _MAX_ registros)",
                            infoPostFix: "",
                            loadingRecords: "Cargando...",
                            zeroRecords: "No se encontraron resultados",
                            emptyTable: "Ningún dato disponible en esta tabla",
                            paginate: {
                                first: "Primero",
                                previous: "Anterior",
                                next: "Siguiente",
                                last: "Último"
                            },
                            aria: {
                                sortAscending: ": Activar para ordenar la columna de manera ascendente",
                                sortDescending: ": Activar para ordenar la columna de manera descendente"
                            }
                        },
                    });

                } else if (data["response"] == 2) {} else {}
            },
            error: function(data) {
                Swal.fire(
                    'Error!',
                    'Error al cambiar el estado del salon!',
                    'error'
                )
                console.log(data);
                // checkSpinner();
            },
        })
    }

    function getSalones() {
        if ($.fn.DataTable.isDataTable('#tablal')) {
            $('#tablal').DataTable().destroy();
        }

        $.ajax({
            type: "POST",
            url: "ws/getSalones.php",
            data: {

            },
            success: function(data) {
                //console.log(data);
                data = JSON.parse(data);
                if (data["response"] == 1) {
                    data = data["json"];
                    console.log(data);
                    $('#tablal').DataTable({
                        mark: true,
                        data: data,
                        columns: [{
                                title: "Salon"
                            }, {
                                title: "Profesor Asignado"
                            },
                            {
                                title: "Descripcion"
                            },
                            {
                                title: "Fecha de Creacion"
                            },
                            {
                                title: "Fecha de Actualizacion"
                            },
                            {
                                title: "Estado"
                            },
                            {
                                title: "Acciones"
                            },
                        ],
                        autoWidth: false,
                        columnDefs: [{
                                width: "10%!important",
                                "targets": 0
                            },
                            {
                                width: "20%!important",
                                "targets": 1
                            },
                            {
                                width: "10%!important",
                                "targets": 2
                            },
                            {
                                width: "10%!important",
                                "targets": 3
                            },
                            ///  {width: "10%!important", "targets": 4},
                            {
                                width: "10%!important",
                                "targets": 4
                            },
                            {
                                width: "10%!important",
                                "targets": 5
                            }
                        ],
                        language: {
                            processing: "Procesando...",
                            search: "",
                            searchPlaceholder: "Búsqueda Detallada",
                            lengthMenu: "Mostrar _MENU_ registros",
                            info: "Mostrando salones del _START_ al _END_ de un total de _TOTAL_ salones",
                            infoEmpty: "Mostrando salones del 0 al 0 de un total de 0 salones",
                            infoFiltered: "(filtrado de un total de _MAX_ registros)",
                            infoPostFix: "",
                            loadingRecords: "Cargando...",
                            zeroRecords: "No se encontraron resultados",
                            emptyTable: "Ningún dato disponible en esta tabla",
                            paginate: {
                                first: "Primero",
                                previous: "Anterior",
                                next: "Siguiente",
                                last: "Último"
                            },
                            aria: {
                                sortAscending: ": Activar para ordenar la columna de manera ascendente",
                                sortDescending: ": Activar para ordenar la columna de manera descendente"
                            }
                        },
                    });

                } else if (data["response"] == 2) {} else {}
            },
            error: function(data) {
                console.log(data);
                // checkSpinner();
            },
        })
    }
</script>
<!-- offset search area start -->
<div class="offset-search">
    <form action="#">
        <input type="text" name="search" placeholder="Sarch here...">
        <button type="submit"><i class="fa fa-search"></i></button>
    </form>
</div>
<!-- offset search area end -->
<!-- body overlay area start -->
<div class="body_overlay"></div>
<!-- body overlay area end -->
<!-- crumbs area start -->
<div class="crumbs-area">
    <div class="container">
        <div class="crumb-content">
            <h4 class="crumb-title"><span>Lista de </span>Salones</h4>
        </div>
    </div>
</div>
<!-- crumbs area end -->
<!-- teacher area start -->
<div class="all-teachers  pt--120 pb--70">
    <div class="container">
        <button type="button" data-toggle="modal" data-target="#salonModal" class="btn btn-primary btn-round" style="margin-top: -10%;" class="btn btn-primary">Registrar Salon</button>
        <br />
        <br />
        <div class="row">
            <div class="col-12">
                <div class="card" style="box-shadow: none;">
                    <div class="card-body" style="width: 98%; margin-left: 0%;  padding: 0rem;">
                        <table id="tablal" class="table table-striped table-bordered text-center" style="border-collapse: collapse !important; border-spacing: 0; width: 101%!important; font-size: 12px">

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- teacher area end -->
<div class="modal fade" id="salonModal" tabindex="-1" role="dialog" aria-labelledby="salonModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content p-5">
            <div class="modal-header">
                <h5 class="modal-title" id="salonModalLabel">Registro Salon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form1" action="javascript:void(0);" method="post" onsubmit="registrarSalon(); return false;">
                    <div class="form-group">

                        <label for="nombre" class="form-control-label">Nombre del Salon:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingresa el nombre" oninvalid="setCustomValidity('Ingresa un nombre')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label for="descripcion" class="form-control-label">Descripcion (opcional):</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Ingresa la descripcion">
                    </div>
                    <div class="form-group">
                        <label for="profesor">Elije un profesor:</label>
                        <select name="profesor" class="form-control-select" id="profesor" class="form-control" required>
                            <?php
                            foreach ($profesores as $p) {
                                echo '<option value="' . $p->getId() . '">' . $p->getNombre() . ' ' . $p->getApellido() . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="estudiantes">
                            Estudiantes para el salon:
                            <select style="width:100%" class="select2-basic-multiple js-states form-control" id="estudiantes" multiple="multiple">
                                <?php
                                foreach ($estudiantes as $e) {
                                    echo '<option value="' . $e->getId() . '">' . $e->getNombre() . ' ' . $e->getApellido() . '</option>';
                                }
                                ?>
                            </select>
                        </label>
                    </div>
                    <br>
                    <br>
                    <br>
                    <button type="submit" class="btn btn-primary btn-sm">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>