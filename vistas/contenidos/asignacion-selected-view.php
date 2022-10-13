<?php
if($_SESSION['privilegio_tor']<1 || $_SESSION['privilegio_tor']>3 || $_SESSION['tipo_tor']==4) {
  $lc->forzar_cierre_sesion_controlador();
  exit();
  }

//Obtener listado de todas las solicitudes registradas en el sistema
require_once './controladores/solicitudControlador.php';
$ins_solicitud = new solicitudControlador();
$solicitudes = $ins_solicitud->datos_solicitud_controlador("Solicitud", 0);

//Obtener listado de todos los usuarios, que son operadores;
require_once './controladores/usuarioControlador.php';
$ins_usuario = new usuarioControlador();
$usuarios = $ins_usuario->datos_usuario_controlador("Operador", 0);

?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Asignacion / Crear Nuevo</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a class="active" href="<?php echo SERVERURL; ?>asignacion-new/">Nueva asignacion <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>asignacion-list/">Lista de asignaciones <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>asignacion-search/">Buscar asignacion <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->

<div class="container-fluid">
    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/asignacionAjax.php" method="POST" data-form="save" autocomplete="off">
        <fieldset>
            <legend><i class="far fa-address-card"></i> &nbsp; Información de la asignacion</legend>
            <div class="container-fluid">
                <div class="row">
                    <input type="hidden" name="solicitud_actividad_reg" value="<?php echo $pagina[1];?>">

                    <!-- Escoger usuario operador a quien se le asignara la solicitud -->
                    <!-- Seleccione un operador -->
                    <div class="col-md-4">
                    <label for="cargo_nombre">Operador</label>
                       <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <select class="form-control btn-round" name="solicitud_operador_reg" required="">


                    <?php
                    if($usuarios->rowCount()>0){
                                        $usuarios = $usuarios->fetchAll();
                                        echo '<option value="" selected="">Seleccione un operador</option>';
                                        //Ciclo para recorrer todos los equipos registrados en el sistema
                                        foreach ($usuarios as $rows){
                                            echo '<option value="'. $ins_usuario->encryption($rows['usuario_id']).'">'.$rows['usuario_nombre']. ', ' . $rows['usuario_apellido'].  '. ('. $rows['usuario_usuario'] .').</option>';
                                        }
                                    }

                    ?>

                         </select>
                        </div>
                    </div>

                    <!-- Observacion de la asignaci�n -->
                     <div class="col-md-8">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <textarea type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,500}" class="form-text" name="asignacion_observacion_reg" id="solicitud_nombre" maxlength="500" required=""></textarea>
                            <span class="bar"></span>
                            <label for="solicitud_nombre">Coloque una breve descripcion</label>
                        </div>
                    </div>

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



                    <!-- Fin de formulario-->
                </div>
            </div>
        </fieldset>


        <p class="text-center" style="margin-top: 20px;">
            <button type="reset" class="btn btn-3d btn-warning btn-sm"><i class="fa-refresh fa"></i> &nbsp; LIMPIAR</button>
            &nbsp; &nbsp;
            <button type="submit" class="btn btn-3d btn-info btn-sm"><i class="fa-save fa"></i> &nbsp; ASIGNAR SOLICITUD</button>
        </p>
    </form>
</div>
