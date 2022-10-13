<?php
if($_SESSION['privilegio_tor']<1 || $_SESSION['privilegio_tor']>3 || $_SESSION['tipo_tor']==3 || $_SESSION['tipo_tor']==4) {
  $lc->forzar_cierre_sesion_controlador();
  exit();
  }

//Obtener listado de todas las direcciones registradas en el sistema
require_once './controladores/categoriaControlador.php';
$ins_categoria = new categoriaControlador();
$categoriaes = $ins_categoria->datos_categoria_controlador("Todos", 0);

//Obtener listado con todos los indicadores registrados en el sistema
require_once './controladores/indicadorControlador.php';
$ins_indicador = new indicadorControlador();
$indicadores = $ins_indicador->datos_indicador_controlador("Todos", 0);

?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Actividad / Crear Nuevo</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a class="active" href="<?php echo SERVERURL; ?>actividad-new/">Nueva actividad <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>actividad-list/">Lista de actividades <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>actividad-search/">Buscar actividad <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->

<div class="container-fluid">
    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/actividadAjax.php" method="POST" data-form="save" autocomplete="off">
        <fieldset>
            <legend><i class="far fa-address-card"></i> &nbsp; Información del actividad</legend>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}" class="form-text" name="actividad_nombre_reg" id="actividad_nombre" maxlength="150" required="">
                            <span class="bar"></span>
                            <label for="actividad_nombre">Nombre</label>
                        </div>
                    </div>

                    <!-- Seleccione un categoria -->
                    <div class="col-md-4">
                    <label for="actividad_nombre">Categoria</label>
                       <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <select class="form-control btn-round" name="categoria_nombre_reg" required="">


                                <?php
                                    if($categoriaes->rowCount()>0){
                                        $categoriaes = $categoriaes->fetchAll();
                                        echo '<option value="" selected="">Seleccione una categoria</option>';
                                        //Ciclo para recorrer todos los equipos registrados en el sistema
                                        foreach ($categoriaes as $rows){
                                            echo '<option value="'. $ins_categoria->encryption($rows['categoria_id']).'">'.$rows['categoria_nombre'].'.</option>';
                                        }
                                    }

                                ?>

                            </select>
                        </div>
                    </div>
                    
                    <!-- Seleccione un indicador -->
                    <div class="col-md-4">
                    <label for="actividad_nombre">Indicador</label>
                       <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <select class="form-control btn-round" name="indicador_nombre_reg" required="">


                                <?php
                                    if($indicadores->rowCount()>0){
                                        $indicadores = $indicadores->fetchAll();
                                        echo '<option value="" selected="">Seleccione un indicador</option>';
                                        //Ciclo para recorrer todos los equipos registrados en el sistema
                                        foreach ($indicadores as $rows){
                                            echo '<option value="'. $ins_indicador->encryption($rows['indicador_id']).'">'.$rows['indicador_nombre'].'.</option>';
                                        }
                                    }
                                ?>

                            </select>
                        </div>
                    </div>
                    
                    <!-- Area de text para colocar la descripcion -->
                    <div class="col-md-6">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <textarea type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,500}" class="form-text" name="actividad_descripcion_reg" id="actividad_descripcion" maxlength="500" required=""></textarea>
                            <span class="bar"></span>
                            <label for="actividad_descripcion">Descripcion</label>
                        </div>
                    </div>
                    
                    	<!-- Foto de perfil de la direccion -->
				  <div class="col-md-6">
				  <label for="multimedia_archivo_perfil">Foto Actividad (286x180) Tipo Archivo: jpg, png.</label>
                        <div class="form-group form-animate-text" style="margin-top:5px !important;">

                            <input type="file" class="form-text btn-round" name="multimedia_perfil_reg" id="multimedia_archivo_perfil">
                            <span class="bar"></span>

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
