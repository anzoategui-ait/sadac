<?php
if($_SESSION['privilegio_tor']<1 || $_SESSION['privilegio_tor']>3/* || $_SESSION['tipo_tor'] == 3*/ ) {
  $lc->forzar_cierre_sesion_controlador();
  exit();
  }
  
//Obtener listado de todas las actividadControlador.php';
require_once './controladores/actividadControlador.php';
$ins_actividad = new actividadControlador();
//$actividades = $ins_actividad->datos_actividad_controlador("Todos", 0);
$actividades_list = $ins_actividad->datos_actividad_controlador("Todos", 0);

//Obtener listado de todos los usuarios, solo mostrarlo si es suervisor o administrador del sistema';
require_once './controladores/usuarioControlador.php';
$ins_usuario = new usuarioControlador();
$usuarios = $ins_usuario->datos_usuario_controlador("Todos", 0);
?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Solicitud / Crear Nueva</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a class="active" href="<?php echo SERVERURL; ?>solicitud-new/">Nueva solicitud <span class="fa-angle-right fa"></span></a>
                <?php if($_SESSION['tipo_tor']!=4 ) { ?>
                <a href="<?php echo SERVERURL; ?>solicitudes-list/">Solicitudes <span class="fa-angle-right fa"></span></a>
                <?php } ?><a href="<?php echo SERVERURL; ?>solicitud-list/">Lista de solicitudes <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>solicitud-search/">Buscar solicitud <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->

<div class="container-fluid">
    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/solicitudAjax.php" method="POST" data-form="save" autocomplete="off">
        <fieldset>
            <legend><i class="far fa-address-card"></i> &nbsp; Información de la solicitud</legend>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-8">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <textarea type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,500}" class="form-text" name="solicitud_descripcion_reg" id="solicitud_nombre" maxlength="500" required=""></textarea>
                            <span class="bar"></span>
                            <label for="solicitud_nombre">Coloque una breve descripcion</label>
                        </div>
                    </div>



            
             <!-- Seleccione un usuario -->
                    <div class="col-md-4">
                    <label for="cargo_nombre">Usuario</label>
                       <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <select class="form-control btn-round" name="solicitud_usuario_reg" required="">


                                <?php
                                
                                    //validar que sea supervisor o administrador
                                    if($_SESSION['tipo_tor']==1 || $_SESSION['tipo_tor']==2)
                                     {
                                    /// Inicio del If Usuarios
                                    if($usuarios->rowCount()>0){
                                        $usuarios = $usuarios->fetchAll();
                                        echo '<option value="" selected="">Seleccione un usuario</option>';
                                        //Ciclo para recorrer todos los equipos registrados en el sistema
                                        foreach ($usuarios as $rows){
                                            echo '<option value="'. $ins_usuario->encryption($rows['usuario_id']).'">'.$rows['usuario_nombre']. ', ' . $rows['usuario_apellido'].  '. ('. $rows['usuario_usuario'] .').</option>';
                                        }
                                    }
                                    //Fin del if usuario
                                     } else {
                                        echo '<option value="'. $ins_usuario->encryption($_SESSION['id_tor']).'" selected="">'. $_SESSION['nombre_tor']. ', ' . $_SESSION['apellido_tor'].'. (' . $_SESSION['usuario_tor'].').</option>';
                                     }
                                ?>

                            </select>
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


                    </div>
                    </div>
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
            <button type="reset" class="btn btn-3d btn-warning btn-sm"><i class="fa-refresh fa"></i> &nbsp; LIMPIAR</button>
            &nbsp; &nbsp;
            <button type="submit" class="btn btn-3d btn-info btn-sm"><i class="fa-save fa"></i> &nbsp; ENVIAR SOLICITUD</button>
        </p>
        
        </form>
     
</div>
            
