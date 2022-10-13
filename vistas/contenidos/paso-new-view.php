<?php
if($_SESSION['privilegio_tor']<1 || $_SESSION['privilegio_tor']>3 || $_SESSION['tipo_tor']==3 || $_SESSION['tipo_tor']==4) {
  $lc->forzar_cierre_sesion_controlador();
  exit();
  }

//Obtener listado de todas las direcciones registradas en el sistema
require_once './controladores/actividadControlador.php';
$ins_actividad = new actividadControlador();
$actividades = $ins_actividad->datos_actividad_controlador("Todos", 0);

?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Paso / Crear Nuevo</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a class="active" href="<?php echo SERVERURL; ?>paso-new/">Nuevo paso <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>paso-list/">Lista de pasos <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>paso-search/">Buscar paso <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->

<div class="container-fluid">
    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/pasoAjax.php" method="POST" data-form="save" autocomplete="off">
        <fieldset>
            <legend><i class="far fa-address-card"></i> &nbsp; Información del paso</legend>
            <div class="container-fluid">
                <div class="row">

                <!-- Area de text para colocar la descripcion -->
                    <div class="col-md-12">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <textarea type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,500}" class="form-text" name="paso_nombre_reg" id="paso_nombre_reg" maxlength="500" required=""></textarea>
                            <span class="bar"></span>
                            <label for="paso_descripcion">Descripcion</label>
                        </div>
                    </div>

                    <!-- Seleccione un actividad -->
                    <div class="col-md-8">
                    <label for="paso_nombre">Actividad</label>
                       <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <select class="form-control btn-round" name="actividad_nombre_reg" required="">


                                <?php
                                    if($actividades->rowCount()>0){
                                        $actividades = $actividades->fetchAll();
                                        echo '<option value="" selected="">Seleccione una actividad</option>';
                                        //Ciclo para recorrer todos los equipos registrados en el sistema
                                        foreach ($actividades as $rows){
                                            echo '<option value="'. $ins_actividad->encryption($rows['actividad_id']).'">'.$rows['actividad_nombre'].'.</option>';
                                        }
                                    }

                                ?>

                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[0-9]{1,11}" class="form-text" name="paso_duracion_reg" id="paso_duracion_reg" maxlength="11" required="">
                            <span class="bar"></span>
                            <label for="paso_nombre">Duracion en minutos</label>
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
