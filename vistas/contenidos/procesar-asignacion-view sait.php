<?php
if ($_SESSION['privilegio_tor'] < 1 || $_SESSION['privilegio_tor'] > 3 || $_SESSION['tipo_tor']==4) {
    $lc->forzar_cierre_sesion_controlador();
    exit();
}

//Obtener datos de la solicitud que sera procesada
require_once "./controladores/asignacionControlador.php";
$ins_asignacion = new asignacionControlador();
$asignacion = $ins_asignacion->datos_asignacion_controlador("Procesar", $pagina[1]);

$nombre_actividad = "";
$fecha_asignacion = "";
$asignacion_id = 0;
$actividad_id = 0;
$paso_id = 0;
$cont_filas = 0;
$max_registros = 0;
$solicitud_id = 0;
$sol_act_id = 0;

if ($asignacion->rowCount() > 0) {
    $asignacion = $asignacion->fetch();
    $nombre_actividad = $asignacion['actividad_nombre'];
    $fecha_asignacion = $asignacion['asignacion_fecha'];
    $asignacion_id = $asignacion['asignacion_id'];
    $actividad_id = $asignacion['actividad_id'];
    $solicitud_id = $asignacion['solicitud_id'];
    $sol_act_id = $asignacion['sol_act_id'];
}

//Obtener la solicitud y los datos del ciudadano que realizo la solicitud.
$solicitud = $ins_asignacion->datos_asignacion_controlador("SolicitudUsuario", $ins_asignacion->encryption($solicitud_id));
$descripcion_solicitud = "";
$usuario_nombre = "";
$usuario_telefono = "";
$usuario_correo = "";
$usuario_direccion = "";
$usuario_parroquia = "";
$usuario_municipio = "";

if ($solicitud->rowCount() > 0) {
    $solicitud = $solicitud->fetch();
    $descripcion_solicitud = $solicitud['solicitud_descripcion'];
    $usuario_nombre = $solicitud['usuario_nombre'];
    $usuario_telefono = $solicitud['usuario_telefono'];
    $usuario_correo = $solicitud['usuario_email'];
    $usuario_direccion = $solicitud['usuario_direccion'];
    $usuario_parroquia = $solicitud['parroquia_nombre'];
    $usuario_municipio = $solicitud['municipio_nombre'];
}

//Obtener los paso de la actividad
require_once './controladores/pasoControlador.php';
$ins_paso = new pasoControlador();
$paso = $ins_paso->datos_paso_controlador("Procesar-Pasos", $ins_paso->encryption($actividad_id));
$fecha_inicio = $ins_paso->obener_fecha_time_controlador();

//Obtener controlador procesar para asi verificar que el paso este ya procesado 
require_once './controladores/procesarControlador.php';
$ins_procesar = new procesarControlador();
?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Procesar / <?php echo $nombre_actividad . ' - ' . $fecha_asignacion; ?> /
            <?php echo "Solicitud: " . $descripcion_solicitud . " / Ciudadano: " . $usuario_nombre . " - Telefono: " . $usuario_telefono . " - Correo: ". $usuario_correo." - Municipio: ". $usuario_municipio. " - Parroquia: " . $usuario_parroquia. " - Sector: " . $usuario_direccion; ?>
            </h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a class="active" href="<?php echo SERVERURL; ?>procesar-new/">Procesar Asginacion <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>procesar-list/">Lista de procesamientos <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>procesar-search/">Buscar Proceso Realizado <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->

<div class="container-fluid">
    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/procesarAjax.php" method="POST" data-form="save" autocomplete="off">
        <fieldset>
            <legend><i class="far fa-address-card"></i> &nbsp; <?php
if ($paso->rowCount() > 0) {
    $max_registros = $paso->rowCount();
    $paso = $paso->fetchAll();
    $cont = 1;
    foreach ($paso as $row) {

        //Consultar si este paso ya esta registrado en la tabla procesar
        //Si, Brincar al siguiente paso
        //No mostrar el paso actual
        $paso_id = $row['paso_id'];
        $procesado = $ins_procesar->verificar_paso_procesado_controlador($asignacion_id, $paso_id);
        if ($procesado->rowCount() > 0) {
            //No imprimir
        } else {
            //Si imprimir
            echo "Paso: " . $row['paso_nombre'] . ' - ' . $cont . ' / ' . $max_registros;
            //Cerrar ciclo
            break;
        }

        $cont++;
        $cont_filas = $cont;
    }
}
?></legend>
                <?php if ($cont_filas <= $max_registros) { ?>
                <div class="container-fluid">
                    <div class="row">

                        <!-- Coloco mis variables que van a ir ocultas -->
                        <input type="hidden" name="procesar_asignacion_id_reg" value="<?php echo $asignacion_id; ?>">
                        <input type="hidden" name="procesar_paso_id_reg" value="<?php echo $paso_id; ?>">
                        

                        <div class="col-md-12">
                            <div class="form-group form-animate-text" style="margin-top:20px !important;">
                                <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,500}" class="form-text" name="procesar_observacion_reg" id="categoria_descripcion" maxlength="500">
                                <span class="bar"></span>
                                <label for="procesar_descripcion">Observacion</label>
                            </div>
                        </div>

                        <!-- Agregar la fechaFECHA INICIO solo si es usuario con todos los permisos -->
                    <?php  if($_SESSION['privilegio_tor']==1) {?>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="fecha_inicio" class="bmd-label-floating" style="color:#1F618D;"><b>FECHA INICIO</b></label>
                            <input type="date"  class="form-control" name="procesar_fecha_inicio_reg" value="<?php echo date("Y-m-d"); ?>" id="fecha">
                        </div>
                    </div>   
                    <?php  } else { ?>   
                        <div class="form-group">          
                        <input type="hidden" name="procesar_fecha_inicio_reg" value="<?php echo date("Y-m-d"); ?>">
                        </div>
                        <?php  } ?> 
                       <!-- Fin agregar fecha manual --> 

                       <!-- Agregar la FECHA FIN solo si es usuario con todos los permisos -->
                    <?php  if($_SESSION['privilegio_tor']==1) {?>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="fecha_inicio" class="bmd-label-floating" style="color:#1F618D;"><b>FECHA FIN</b></label>
                            <input type="date"  class="form-control" name="procesar_fecha_fin_reg" value="<?php echo date("Y-m-d"); ?>" id="fecha">
                        </div>
                    </div>   
                    <?php  } else { ?>   
                        <div class="form-group">          
                        <input type="hidden" name="procesar_fecha_fin_reg" value="<?php echo date("Y-m-d"); ?>">
                        </div>
                        <?php  } ?> 
                       <!-- Fin agregar fecha manual --> 


                    </div>
                </div>

            <?php } ?>
        </fieldset>

        <?php if ($cont_filas <= $max_registros) { ?>
            <p class="text-center" style="margin-top: 20px;">
                <button type="reset" class="btn btn-3d btn-warning btn-sm"><i class="fa-refresh fa"></i> &nbsp; LIMPIAR</button>
                &nbsp; &nbsp;
                <button type="submit" class="btn btn-3d btn-info btn-sm"><i class="fa-save fa"></i> &nbsp; SIGUIENTE</button>
            </p>
        <?php } ?>

    </form>
</div>

<?php if ($cont_filas > $max_registros) { ?>
    <!-- Area para agregar imagenes al proceso que se esta realizando -->
    <div class="container-fluid">
        <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/imagenAjax.php" method="POST" enctype="multipart/form-data" data-form="save" autocomplete="off">
            <fieldset>
                <legend><i class="far fa-address-card"></i> &nbsp; Agregar Imagenes</legend>
                <div class="container-fluid">
                    <div class="row">

                        <!-- Coloco mis variables que van a ir ocultas -->
                        <input type="hidden" name="imagen_asignacion_id_reg" value="<?php echo $asignacion_id; ?>">

                        <div class="col-md-6">
                            <div class="form-group form-animate-text" style="margin-top:20px !important;">
                                <input type="file" class="form-text" name="imagen_nombre_reg" id="multimedia_archivo" required="">
                                <span class="bar"></span>
                                <label for="multimedia_archivo"></label>
                            </div>
                        </div> 

                        <div class="col-md-6">
                            <p class="text-center" style="margin-top: 20px;">

                                <button type="submit" class="btn btn-3d btn-info btn-sm"><i class="fa-save fa"></i> &nbsp; AGREGAR IMAGEN</button>
                            </p>
                        </div>



                    </div>
                </div>
            </fieldset>

        </form>
    </div>

    <!-- Area para agregar archivos pdf al proceso que se esta realizando -->
    <div class="container-fluid">
        <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/pdfAjax.php" method="POST" enctype="multipart/form-data" data-form="save" autocomplete="off">
            <fieldset>
                <legend><i class="far fa-address-card"></i> &nbsp; Agregar Archivo PDF de respaldo</legend>
                <div class="container-fluid">
                    <div class="row">

                        <!-- Coloco mis variables que van a ir ocultas -->
                        <input type="hidden" name="pdf_asignacion_id_reg" value="<?php echo $asignacion_id; ?>">

                        <!-- Archivo de respaldo en pdf de la asignacion realizado -->
                        <div class="col-md-6">
                            <div class="form-group form-animate-text" style="margin-top:20px !important;">
                                <input type="file" class="form-text" name="pdf_archivo_reg" id="pago_archivo" required="">
                                <span class="bar"></span>
                                <label for="pago_archivo"></label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <p class="text-center" style="margin-top: 20px;">

                                <button type="submit" class="btn btn-3d btn-info btn-sm"><i class="fa-save fa"></i> &nbsp; AGREGAR PDF</button>
                            </p>
                        </div>


                    </div>
                </div>
            </fieldset>



        </form>
    </div>
    
     <!-- Area para agregar el codigo del equipo a la actividad que se esta realizando -->
     <div class="container-fluid">
        <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/procesarAjax.php" method="POST" data-form="save" autocomplete="off">
            <fieldset>
                <legend><i class="far fa-address-card"></i> &nbsp; Vincular Equipo a dicha actividad</legend>
                <div class="container-fluid">
                    <div class="row">

                        <!-- Coloco mis variables que van a ir ocultas -->
                        <input type="hidden" name="sol_act_id_reg" value="<?php echo $sol_act_id; ?>">

                        <!-- Archivo de respaldo en pdf de la asignacion realizado -->
                        <div class="col-md-6">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-_ ]{2,150}" class="form-text" name="equipo_codigo_reg" id="equipo_codigo_reg" maxlength="150" required="">
                            <span class="bar"></span>
                            <label for="codigo_equipo">Codigo Equipo</label>
                        </div>
                    </div>

                        <div class="col-md-6">
                            <p class="text-center" style="margin-top: 20px;">

                                <button type="submit" class="btn btn-3d btn-info btn-sm"><i class="fa-save fa"></i> &nbsp; VINCULAR EQUIPO</button>
                            </p>
                        </div>


                    </div>
                </div>
            </fieldset>



        </form>
    </div>
     
     

    <!-- Area para adar por finalizada  la asignacion -->
    <div class="container-fluid">
        <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/procesarAjax.php" method="POST" data-form="save" autocomplete="off">
            <fieldset>
                <legend class="text-center"><i class="far fa-address-card"></i> &nbsp; FINALIZAR ASIGNACION</legend>
                <div class="container-fluid">
                    <div class="row">

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

                        <!-- Coloco mis variables que van a ir ocultas -->
                        <input type="hidden" name="finalizar_asignacion_id_reg" value="<?php echo $asignacion_id; ?>">

                        <p class="text-center" style="margin-top: 20px;">
                            <button type="submit" class="btn btn-3d btn-success btn-sm"><i class="fa-save fa"></i> &nbsp; FINALIZAR</button>
                        </p>

                    </div>
                </div>
            </fieldset>



        </form>
    </div>

<?php } ?>