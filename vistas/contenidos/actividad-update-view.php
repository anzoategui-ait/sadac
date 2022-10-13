<?php
if($_SESSION['privilegio_tor']<1 || $_SESSION['privilegio_tor']>2 || $_SESSION['tipo_tor']==3 || $_SESSION['tipo_tor']==4) {
  $lc->forzar_cierre_sesion_controlador();
  exit();
  }
  
//Obtener listado de todas las direcciones registradas en el sistema
require_once './controladores/categoriaControlador.php';
$ins_categoria = new categoriaControlador();
$categorias = $ins_categoria->datos_categoria_controlador("Todos", 0);

//Obtener listado con todos los indicadores registrados en el sistema
require_once './controladores/indicadorControlador.php';
$ins_indicador = new indicadorControlador();
$indicadores = $ins_indicador->datos_indicador_controlador("Todos", 0);

?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Actividad / Editar</h3>
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
<!-- Inicio de Codigo para actualizar los datos del usuario -->
<div class="container-fluid">
    <?php
    require_once "./controladores/actividadControlador.php";
    $ins_actividad = new actividadControlador();

    $datos_actividad = $ins_actividad->datos_actividad_controlador("Unico", $pagina[1]);

    if($datos_actividad->rowCount()==1){
        $campos = $datos_actividad->fetch();
    ?>

    <form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/actividadAjax.php" method="POST" data-form="update" autocomplete="off">
        <input type="hidden" name="actividad_id_up" value="<?php echo $pagina[1];?>">
        <fieldset>
            <legend><li class="fa-black-tie fa"></li> &nbsp; Información de la actividad</legend>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-4">

                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}" class="form-text" name="actividad_nombre_up" id="actividad_nombre" value="<?php echo $campos['actividad_nombre']; ?>" maxlength="150" required="">
                            <span class="bar"></span>
                               <label for="actividad_nombre">Nombre</label>
                        </div>
                    </div>
                    
                    <!-- Seleccione una direccion -->
                    <div class="col-md-4">
                    <label for="cargo_nombre">Categoria</label>
                       <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <select class="form-control btn-round" name="categoria_nombre_up" required="">


                                <?php
                                    if($categorias->rowCount()>0){
                                        $categorias = $categorias->fetchAll();
                                        //con el id del club obtener el nombre del club
                                        $rs_categoria = $ins_categoria->datos_categoria_controlador("Unico", $ins_categoria->encryption($campos['categoria_id']));
                                        $rs_categoria = $rs_categoria->fetch();
                                        $nombre_categoria = $rs_categoria['categoria_nombre'];
                                        echo '<option value="'.$ins_categoria->encryption($campos['categoria_id']).'" selected="">'.$nombre_categoria.' (Actual)</option>';
                                        //Ciclo para recorrer todos los equipos registrados en el sistema
                                        foreach ($categorias as $rows){
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
                            <select class="form-control btn-round" name="indicador_nombre_up" required="">


                                <?php
                                    if($indicadores->rowCount()>0){
                                        $indicadores = $indicadores->fetchAll();

                                         $rs_indicador = $ins_indicador->datos_indicador_controlador("Unico", $ins_indicador->encryption($campos['indicador_id']));
                                        $rs_indicador = $rs_indicador->fetch();
                                        $nombre_indicador = $rs_indicador['indicador_nombre'];
                                        echo '<option value="'.$ins_indicador->encryption($campos['indicador_id']).'" selected="">'.$nombre_indicador.' (Actual)</option>';


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
                            <textarea type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,500}" class="form-text" name="actividad_descripcion_up" id="actividad_descripcion" maxlength="500" required=""><?php echo $campos['actividad_descripcion']; ?></textarea>
                            <span class="bar"></span>
                            <label for="actividad_descripcion">Descripcion</label>
                        </div>
                    </div>
                    
                     <div class="col-md-6">
				  <label for="multimedia_archivo_perfil"><?php echo $campos['actividad_imagen'] . " (Actual) "?> Foto Perfil (286x180) Tipo Archivo: jpg, png.</label>
                        <div class="form-group form-animate-text" style="margin-top:5px !important;">

                            <input type="file" class="form-text btn-round" name="multimedia_perfil_up" id="multimedia_archivo_perfil">
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
