<?php
if($_SESSION['privilegio_tor']<1 || $_SESSION['privilegio_tor']>2 || $_SESSION['tipo_tor']==3 || $_SESSION['tipo_tor']==4) {
  $lc->forzar_cierre_sesion_controlador();
  exit();
  }

//Obtener listado de todas las actividades registradas en el sistema
require_once './controladores/actividadControlador.php';
$ins_actividad = new actividadControlador();
$actividads = $ins_actividad->datos_actividad_controlador("Todos", 0);

?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Paso / Editar</h3>
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
<!-- Inicio de Codigo para actualizar los datos del usuario -->
<div class="container-fluid">
    <?php
    require_once "./controladores/pasoControlador.php";
    $ins_paso = new pasoControlador();

    $datos_paso = $ins_paso->datos_paso_controlador("Unico", $pagina[1]);

    if($datos_paso->rowCount()==1){
        $campos = $datos_paso->fetch();
    ?>

    <form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/pasoAjax.php" method="POST" data-form="update" autocomplete="off">
        <input type="hidden" name="paso_id_up" value="<?php echo $pagina[1];?>">
        <fieldset>
            <legend><li class="fa-black-tie fa"></li> &nbsp; Información de la paso</legend>
            <div class="container-fluid">
                <div class="row">
                
                <!-- Area de text para colocar la descripcion -->
                    <div class="col-md-12">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <textarea type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,500}" class="form-text" name="paso_nombre_up" id="paso_nombre_up" maxlength="500" required=""><?php echo $campos['paso_nombre']; ?></textarea>
                            <span class="bar"></span>
                            <label for="paso_descripcion">Descripcion</label>
                        </div>
                    </div>
                    
                    <!-- Seleccione una actividad -->
                    <div class="col-md-8">
                    <label for="cargo_nombre">Actividad</label>
                       <div class="form-group form-animate-text" style="margin-top:30px !important;">
                            <select class="form-control btn-round" name="actividad_nombre_up" required="">


                                <?php
                                    if($actividads->rowCount()>0){
                                        $actividads = $actividads->fetchAll();
                                        //con el id del club obtener el nombre del club
                                        $rs_actividad = $ins_actividad->datos_actividad_controlador("Unico", $ins_actividad->encryption($campos['actividad_id']));
                                        $rs_actividad = $rs_actividad->fetch();
                                        $nombre_actividad = $rs_actividad['actividad_nombre'];
                                        echo '<option value="'.$ins_actividad->encryption($campos['actividad_id']).'" selected="">'.$nombre_actividad.' (Actual)</option>';
                                        //Ciclo para recorrer todos los equipos registrados en el sistema
                                        foreach ($actividads as $rows){
                                            echo '<option value="'. $ins_actividad->encryption($rows['actividad_id']).'">'.$rows['actividad_nombre'].'.</option>';
                                        }
                                    }

                                ?>

                            </select>
                        </div>
                    </div>

                <!-- Area para colocar la duracion de este paso -->
                <div class="col-md-4">
                    <label for="paso_duracion">Duracion</label>
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[0-9]{1,11}" class="form-text" name="paso_duracion_up" id="paso_duracion" value="<?php echo $campos['paso_duracion']; ?>" maxlength="11" required="">
                            <span class="bar"></span>
                               
                        </div>
                    </div>

                </div>
            </div>
        </fieldset>
        <br><br><br>


        <p class="text-center" style="margin-top: 20px;">
            <button type="submit" class="btn btn-3d btn-success btn-sm"><i class="fas fa-sync-alt"></i> &nbsp; ACTUALIZAR</button>
        </p>


    </form>

    <?php }else{?>
    <div class="alert alert-danger text-center" role="alert">
        <p><i class="fa fa-exclamation-triangle fa-5x"></i></p>
        <h4 class="alert-heading">Ha ocurrido un error inesperado!</h4>
        <p class="mb-0">Lo sentimos, no podemos mostrar la informaci�n solicitada debido a un error.</p>
    </div>

    <?php } ?>

<!-- Fin de Codigo para actualizar los datos del usuario -->
</div>
