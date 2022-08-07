<?php
session_start();
if (!isset($_SESSION['tipo_user']) || $_SESSION['tipo_user'] != 'profesor') {
    header('Location: index.php');
}

// require_once('/persistencia/util/Conexion.php');

// $obj = new Conexion();
// $conexion = $obj->conectarBD();

?>

<style type="text/css">
    .main-menu nav ul li.activeEstudiantes a {
        color: #fc9928;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() {
        getEstudiantes();
    });

    function verDetalleEstudiante(id) {
        id = btoa(id);
        window.location.href = "profesor.php?menu=detalle-estudiante&id=" + id;
    }

    function registrarEstudiante() {
        var nombre = $('#nombre').val().trim()
        var apellido = $('#apellido').val().trim()
        if (nombre != "" && apellido != "") {
            $.ajax({
                type: "POST",
                url: "ws/registrarEstudiante.php",
                data: {
                    nombre: $('#nombre').val(),
                    apellido: $('#apellido').val(),
                    email: $('#email').val()
                },
                success: function(data) {
                    //console.log(data);
                    data = JSON.parse(data);
                    if (data['response'] == 1) {
                        Swal.fire(
                            'Muy bien!',
                            'El estudiante se ha registrado exitosamente!',
                            'success'
                        )

                        $('#estudianteModal').modal('hide');
                        getEstudiantes();
                    } else {
                        Swal.fire(
                            'Error!',
                            'Error al registrar el estudiante!',
                            'error'
                        )
                        $('#estudianteModal').modal('hide');
                        getEstudiantes();
                    }

                },
                error: function(data) {
                    Swal.fire(
                        'Error!',
                        'Error al registrar el estudiante!',
                        'error'
                    )
                    $('#estudianteModal').modal('hide');
                    getEstudiantes();
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
            url: "ws/getEstudiantes.php",
            data: {
                id: id,
                cambiar: 1
            },
            beforeSend: function() {
                // checkSpinner();
            },
            complete: function() {
                // checkSpinner();
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
                                title: "Estudiante"
                            },
                            {
                                title: "Email"
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
                            info: "Mostrando estudiantes del _START_ al _END_ de un total de _TOTAL_ estudiantes",
                            infoEmpty: "Mostrando estudiantes 0 al 0 de un total de 0 estudiantes",
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

    function getEstudiantes() {
        if ($.fn.DataTable.isDataTable('#tablal')) {
            $('#tablal').DataTable().destroy();
        }

        $.ajax({
            type: "POST",
            url: "ws/getEstudiantes.php",
            data: {

            },
            beforeSend: function() {
                // checkSpinner();
            },
            complete: function() {
                // checkSpinner();
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
                                title: "Estudiante"
                            },
                            {
                                title: "Email"
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
                            info: "Mostrando estudiantes del _START_ al _END_ de un total de _TOTAL_ estudiantes",
                            infoEmpty: "Mostrando estudiantes 0 al 0 de un total de 0 estudiantes",
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

<!-- offset search area end -->
<!-- body overlay area start -->
<div class="body_overlay"></div>
<!-- body overlay area end -->
<!-- crumbs area start -->
<div class="crumbs-area">
    <div class="container">
        <div class="crumb-content">
            <h4 class="crumb-title"><span>Lista de </span>Estudiantes</h4>
        </div>
    </div>
</div>
<!-- crumbs area end -->


<!-- teacher area start -->
<div class="all-teachers  pt--120 pb--70">
    <div class="container">
        <button type="button" data-toggle="modal" data-target="#estudianteModal" class="btn btn-primary btn-round" style="margin-top: -10%;" class="btn btn-primary">Registrar Estudiante</button>
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
<!-- Button trigger modal -->
<div class="modal fade" id="estudianteModal" tabindex="-1" role="dialog" aria-labelledby="estudianteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content p-5">
            <div class="modal-header">
                <h5 class="modal-title" id="estudianteModalLabel">Registro Estudiante</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form1" action="javascript:void(0);" method="post" onsubmit="registrarEstudiante(); return false;">
                    <div class="form-group">

                        <label for="nombre" class="form-control-label">Nombre(s):</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingresa el nombre" required oninvalid="setCustomValidity('Ingresa un nombre')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">

                        <label for="apellido" class="form-control-label">Apellido(s):</label>
                        <input type="text" name="apellido" id="apellido" placeholder="Ingresa los apellidos" class="form-control" required oninvalid="setCustomValidity('Ingresa el apellido')" oninput="setCustomValidity('')">

                    </div>
                    <div class="form-group">
                        <label for="email" class="form-control-label">Email:</label>
                        <input type="email" name="email" id="email" placeholder="Ingresa el correo electronico" class="form-control" required oninvalid="setCustomValidity('Ingresa un email')" oninput="setCustomValidity('')">

                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>