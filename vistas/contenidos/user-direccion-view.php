<?php
if ($_SESSION['privilegio_tor'] < 1 || $_SESSION['privilegio_tor'] > 3 || $_SESSION['tipo_tor'] == 3 || $_SESSION['tipo_tor'] == 4) {
    $lc->forzar_cierre_sesion_controlador();
    exit();
}

//Obtener listado de todas las direcciones registradas en el sistema
require_once './controladores/usuarioControlador.php';
$ins_usuario = new usuarioControlador();
$usuarios = $ins_usuario->datos_usuario_controlador("Todos", 0);
//Obtener listado de todas las direcciones registradas en el sistema
//obtener todos los municipios
//obtener todos los municipios
require_once './controladores/municipioControlador.php';
$ins_municipio = new municipioControlador();
$municipios = $ins_municipio->datos_municipio_controlador("Todos", 0);

//Obtener listado de todas las parroquiaes registradas en el sistema
require_once './controladores/parroquiaControlador.php';
$ins_parroquia = new parroquiaControlador();
$parroquias = $ins_parroquia->datos_parroquia_controlador("Todos", 0);



?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Usuario / Direccion Usuario </h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>user-cargo/">Usuario Cargo <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>user-cargo-list/">Relacion usuario y cargo <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->

<div class="container-fluid">
    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/usuarioAjax.php" method="POST" data-form="save" autocomplete="off">
        <fieldset>
            <legend><i class="far fa-address-card"></i> &nbsp; Información de la Direccion del Usuario</legend>
            <div class="container-fluid">
                <div class="row">


                    <!-- Seleccione un usuario -->
                    <div class="col-md-3">
                        <label for="relacion_usuario_id_reg">Usuario</label>
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <select class="form-control btn-round" name="relacion_usuario_id_reg" required="">


                                <?php
                                if ($usuarios->rowCount() > 0) {
                                    $usuarios = $usuarios->fetchAll();
                                    echo '<option value="" selected="">Seleccione un usuario</option>';
                                    //Ciclo para recorrer todos los equipos registrados en el sistema
                                    foreach ($usuarios as $rows) {
                                        echo '<option value="' . $ins_usuario->encryption($rows['usuario_id']) . '">' . $rows['usuario_nombre'] . ", " . $rows['usuario_apellido'] . '.</option>';
                                    }
                                }
                                ?>

                            </select>
                        </div>
                    </div>

                 <!-- Seleccione un municipio -->
                    <div class="col-md-3">
                        <label for="relacion_municipio_id_reg">Municipio</label>
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                         <!--  <select class="form-control btn-round" name="municipio_nombre_reg" id="municipio_nombre_reg" onchange="seleccionar_parroquia($('#municipio_nombre_reg').val());return false;" required=""> -->

                            <select class="form-control btn-round" name="municipio_nombre_reg" id="municipio_nombre_reg" onchange="seleccionar_parroquia($('#municipio_nombre_reg').val());return false;" required=""> 

                                <?php
                                if ($municipios->rowCount() > 0) {
                                    $municipios = $municipios->fetchAll();
                                    echo '<option value="" selected="">Seleccione un municipio</option>';
                                    //Ciclo para recorrer todos los equipos registrados en el sistema
                                    foreach ($municipios as $rows) {
                                        echo '<option value="' . $ins_municipio->encryption($rows['municipio_id']) . '">' . $rows['municipio_nombre'] . '.</option>';
                                    }
                                }
                                ?>

                            </select>
                        </div>
                    </div>

                    <!-- PARROQUIA RECARGAR PAGINA -->
                    <div class="col-md-3">
                        <label for="relacion_parroquia_id_reg">Parroquia</label>
                        <div id="resultado_parroquia" style="margin-top:20px !important;">
                            <select class="form-control btn-round" name="parroquia_nombre_reg" id="parroquia_nombre_reg">
                                <option value="">Selecciona una parroquia</option>
                                <!-- INICIAR LISTAR CATEGORIA-->
                            </select>
                        </div>
                    </div>

                    <!-- Seleccione un sector -->
                    <div class="col-md-3">
                        <label for="relacion_sector_id_reg">Sector</label>
                        <div id="resultado_sector" style="margin-top:20px !important;">
                            <select class="form-control btn-round" name="sector_nombre_reg" id="sector_nombre_reg">
                                <option value="">Selecciona un sector</option>
                                <!-- INICIAR LISTAR CATEGORIA-->
                            </select>
                        </div>
                    </div>
               


                </div>
            </div>
        </fieldset>


        <p class="text-center" style="margin-top: 20px;">
            <button type="reset" class="btn btn-3d btn-warning btn-sm"><i class="fa-refresh fa"></i> &nbsp; LIMPIAR</button>
            &nbsp; &nbsp;
            <button type="submit" class="btn btn-3d btn-info btn-sm"><i class="fa-save fa"></i> &nbsp; GUARDAR</button>
        </p>
    </form>
</div>


<!-- AGREGAR SCRIPT PARA ACTUALIZAR PARROQUIA -->
<script>
    function seleccionar_parroquia(id) {
        var parametros = {
            "id": id,
        };
        $.ajax({
            data: parametros,
            url: '../controladores/seleccionar_parroquia.php',
            type: 'post',
            beforeSend: function () {
                $("#resultado_parroquia").html("Procesando, espere por favor...");
            },
            success: function (response) {
                $("#resultado_parroquia").html(response);
            }
        });
    }


    function seleccionar_sector(id) {
        var parametros = {
            "id": id,
        };
        $.ajax({
            data: parametros,
            url: '../controladores/seleccionar_sector.php',
            type: 'post',
            beforeSend: function () {
                $("#resultado_sector").html("Procesando, espere por favor...");
            },
            success: function (response) {
                $("#resultado_sector").html(response);
            }
        });
    }

</script>