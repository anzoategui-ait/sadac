<?php
if ($_SESSION['privilegio_tor'] < 1 || $_SESSION['privilegio_tor'] > 2/* || $_SESSION['tipo_tor'] == 3*/ || $_SESSION['tipo_tor'] == 4) {
    $lc->forzar_cierre_sesion_controlador();
    exit();
}

//Obtener listado de todos los usuarios, solo mostrarlo si es suervisor o administrador del sistema';
require_once './controladores/usuarioControlador.php';
$ins_usuario = new usuarioControlador();
$usuarios = $ins_usuario->datos_usuario_controlador("Todos", 0);

//Obtener listado de todas las actividadControlador.php';
require_once './controladores/actividadControlador.php';
$ins_actividad = new actividadControlador();
//$actividades = $ins_actividad->datos_actividad_controlador("Todos", 0);
$actividades_list = $ins_actividad->datos_actividad_controlador("Todos", 0);

//Obtener el listado de todos los sectores
require_once './controladores/sectorControlador.php';
$ins_sector = new sectorControlador();


//Obtener todos los gabinetes
require_once './controladores/gabineteControlador.php';
$ins_gabinete = new gabineteControlador();
$gabinetes = $ins_gabinete->datos_gabinete_controlador("Todos", 0);

//Obtener listado de todas las direcciones registradas en el sistema
require_once './controladores/direccionControlador.php';
$ins_direccion = new direccionControlador();
$direcciones = $ins_direccion->datos_direccion_controlador("Todos", 0);
?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Solicitud / Editar</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>solicitudes-list/">Solicitudes <span class="fa-angle-right fa"></span></a>

                <a href="<?php echo SERVERURL; ?>solicitud-list/">Lista de solicitudes <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>solicitud-search/">Buscar solicitud <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->
<!-- Inicio de Codigo para actualizar los datos del usuario -->
<div class="container-fluid">
    <?php
    require_once "./controladores/solicitudControlador.php";
    $ins_solicitud = new solicitudControlador();

    $datos_solicitud = $ins_solicitud->datos_solicitud_controlador("Unico", $pagina[1]);

    if ($datos_solicitud->rowCount() == 1) {
        $campos = $datos_solicitud->fetch();

        $solicitud_id = $campos['solicitud_id'];
        $usuario_actual_id = $campos['usuario_id'];

        //obtener el usuario actual
        $rs_usuario = $ins_usuario->datos_usuario_controlador("Unico", $ins_usuario->encryption($usuario_actual_id));
        $rs_usuario = $rs_usuario->fetch();
        $usuario_direccion = $rs_usuario['usuario_direccion'];
        $usuario_nombre = $rs_usuario['usuario_nombre'];
        $usuario_apellido = $rs_usuario['usuario_apellido'];
        $usuario_cedula = $rs_usuario['usuario_dni'];
        $usuario_telefono = $rs_usuario['usuario_telefono'];
        $usuario_correo = $rs_usuario['usuario_email'];
        //obtener la parroquia que registro este usuario cuando envio la solicitud
        //obtener el usuario actual
        $rs_usuario_parroquia = $ins_usuario->datos_usuario_controlador("UsuarioParroquia", $ins_usuario->encryption($usuario_actual_id));
        $rs_usuario_parroquia = $rs_usuario_parroquia->fetch();
        $usuario_parroquia = $rs_usuario_parroquia['parroquia_nombre'];
        $parroquia_id_usuario = $rs_usuario_parroquia['parroquia_id'];
        
        //Sectores que dependen de la parroquia
        $sectores = $ins_sector->datos_sector_controlador("SectorParroquia", $ins_sector->encryption($parroquia_id_usuario));
        ?>

        <form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/solicitudAjax.php" method="POST" data-form="update" autocomplete="off">
            <input type="hidden" name="solicitud_id_up" value="<?php echo $pagina[1]; ?>">
            <input type="hidden" name="solicitud_usuario_up" value="<?php echo $ins_solicitud->encryption($usuario_actual_id); ?>">
            <fieldset>
                <legend><li class="fa-black-tie fa"></li> &nbsp; Información de la solicitud</legend>
                <div class="container-fluid">
                    <div class="row">
                        <!-- Datos del solicitante -->
                        <div class="col-md-12">
                            <label for="solicitud_nombre">Datos del Solicitante</label>
                            <div class="form-group form-animate-text" style="margin-top:20px !important;">
                                <textarea type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-: ]{2,440}" class="form-text" name="datos_solicitante" id="datos_solicitante" maxlength="500" required="" readonly=""><?php echo "Ciudadano: " . $usuario_nombre . ". Cedula de Identidad: " . $usuario_cedula . ". Telefono: " . $usuario_telefono . ". Correo Electronico: " . $usuario_correo . ". Parroquia: " . $usuario_parroquia . ". Sector: " . $usuario_direccion; ?></textarea>
                                <span class="bar"></span>

                            </div>
                        </div>

                        <!-- Actualizar descripcion -->
                        <div class="col-md-12">
                            <label for="solicitud_nombre">Descripcion de la solicitud</label>
                            <div class="form-group form-animate-text" style="margin-top:20px !important;">
                                <textarea type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-: ]{2,440}" class="form-text" name="solicitud_descripcion_up" id="solicitud_nombre" maxlength="500" required="" readonly=""><?php echo $campos['solicitud_descripcion']; ?></textarea>
                                <span class="bar"></span>

                            </div>
                        </div>

                        <!-- Seleccione un sector -->
                        <div class="col-md-4">
                            <label for="sector">Sector (<?php echo $usuario_direccion; ?>)</label>
                            <div class="form-group form-animate-text" style="margin-top:20px !important;">
                                <select class="form-control btn-round" name="sector_up" required="">


                                    <?php
                                    /// Inicio del If Usuarios
                                    if ($sectores->rowCount() > 0) {
                                        $sectores = $sectores->fetchAll();
                                        echo '<option value="" selected="">SELECCIONE UN SECTOR</option>';
                                        //Ciclo para recorrer todos los equipos registrados en el sistema
                                        foreach ($sectores as $rows) {
                                            echo '<option value="' . $ins_sector->encryption($rows['sector_id']) . '">' . $rows['sector_nombre'] . '. (' . $rows['parroquia_nombre'] . ').</option>';
                                        }
                                    }
                                    //Fin del if usuario
                                    ?>

                                </select>
                            </div>
                        </div>


                        <!-- SELECCIONE UN GABINETE-->
                        <div class="col-md-4">
                            <label for="sector">Gabinete al cual pertenece la solicitud</label>
                            <div class="form-group form-animate-text" style="margin-top:20px !important;">
                                <select class="form-control btn-round" name="gabinete_up" id="gabinete_up" onchange="seleccionar_direccion($('#gabinete_up').val());return false;" required="">


                                    <?php
                                    /// Inicio del If Usuarios
                                    if ($gabinetes->rowCount() > 0) {
                                        $gabinetes = $gabinetes->fetchAll();
                                        echo '<option value="" selected="">SELECCIONE UN GABINETE</option>';
                                        //Ciclo para recorrer todos los equipos registrados en el sistema
                                        foreach ($gabinetes as $rows) {
                                            echo '<option value="' . $ins_sector->encryption($rows['gabinete_id']) . '">' . $rows['gabinete_nombre'] . '</option>';
                                        }
                                    }
                                    //Fin del if usuario
                                    ?>

                                </select>
                            </div>
                        </div>
                        <!-- FIN GABINETE -->




                        <!-- Seleccione un direccion -->

                        <div class="col-md-4">
                            <label for="cargo_nombre">Direccion</label>
                            <div id="resultado_direccion" style="margin-top:20px !important;">
                                <select class="form-control btn-round" name="direccion_up" id="direccion">
                                    <option value="">Selecciona una direccion</option>
                                    <!-- INICIAR LISTAR CATEGORIA-->
                                </select>
                            </div>
                        </div>





                    </div>
                </div>
            </fieldset>

            <fieldset>
            <!-- Agregar la fecha solo si es usuario con todos los permisos -->
            <?php  if($_SESSION['privilegio_tor']==1) {?>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="fecha_inicio" class="bmd-label-floating" style="color:#1F618D;"><b>FECHA</b></label>
                            <input type="date"  class="form-control" name="fecha_reg" value="<?php echo date("Y-m-d"); ?>" id="fecha">
                        </div>
                    </div>   
                    <?php  } else { ?>   
                        <div class="form-group">          
                        <input type="hidden" name="fecha_reg" value="<?php echo date("Y-m-d"); ?>">
                        </div>
                        <?php  } ?> 
                       <!-- Fin agregar fecha manual --> 

            </fieldset>
            <!-- Agregar las diferentes actividades que puede ofrecer el departamento AIT -->

            <fieldset>

                <legend><i class="far fa-address-card"></i> &nbsp; Escoja una actividad</legend>
            
                <!-- Listado de actividades -->
                <div class="col-md-12">
                            <label for="sector">LISTADO DE ACTIVIDADES (presione ctrl en caso de querer seleccionar mas de una actividad a la vez)</label>
                            <div class="form-group form-animate-text" style="margin-top:20px !important;">
                                <select class="form-control btn-round" name="actividad[]" required="" multiple="multiple" size="10">


                                    <?php
                                    /// Inicio del If Usuarios
                                    if ($actividades_list->rowCount() > 0) {
                                        $actividades_list = $actividades_list->fetchAll();
                                        
                                        //Ciclo para recorrer todos los equipos registrados en el sistema
                                        foreach ($actividades_list as $rows) {
                                            echo '<option value="' . $ins_actividad->encryption($rows['actividad_id']) . '">' . $rows['actividad_nombre'] . '</option>';
                                        }
                                    }
                                    //Fin del if usuario
                                    ?>

                                </select>
                            </div>
                        </div>



                <!-- Lista de actividades registradas en el sistema -->
  


            </fieldset>


            <p class="text-center" style="margin-top: 20px;">
                <button type="submit" class="btn btn-3d btn-success btn-sm"><i class="fas fa-sync-alt"></i> &nbsp; ACTUALIZAR</button>
            </p>


        </form>

<?php } else { ?>
        <div class="alert alert-danger text-center" role="alert">
            <p><i class="fa fa-exclamation-triangle fa-5x"></i></p>
            <h4 class="alert-heading">Ha ocurrido un error inesperado!</h4>
            <p class="mb-0">Lo sentimos, no podemos mostrar la informaci�n solicitada debido a un error.</p>
        </div>

<?php } ?>

    <!-- Fin de Codigo para actualizar los datos del usuario -->
</div>

<!-- AGREGAR SCRIPT PARA ACTUALIZAR PARROQUIA -->
<script>
    function seleccionar_direccion(id) {
        var parametros = {
            "id": id,
        };
        $.ajax({
            data: parametros,
            url: '../../controladores/seleccionar_direccion.php',
            type: 'post',
            beforeSend: function () {
                $("#resultado_direccion").html("Procesando, espere por favor...");
            },
            success: function (response) {
                $("#resultado_direccion").html(response);
            }
        });
    }

</script>