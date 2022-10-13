<?php
if($_SESSION['privilegio_tor']<1 || $_SESSION['privilegio_tor']>4 || $_SESSION['tipo_tor']==3 || $_SESSION['tipo_tor']==4) {
  $lc->forzar_cierre_sesion_controlador();
  exit();
  } 
?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Municipio / buscar un municipio</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a class="active" href="<?php echo SERVERURL; ?>municipio-new/">Nuevo Municipio <span class="fa-angle-right fa"></span></a> 
                <a href="<?php echo SERVERURL; ?>municipio-list/">Lista de Municipios <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>municipio-search/">Buscar Municipios <span class="fa-angle-right fa"></span></a>
              </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->


<!-- Inicio de Codigo para actualizar los datos del usuario -->
<div class="container-fluid">
    <?php 
    require_once "./controladores/municipioControlador.php";
    $ins_municipio = new municipioControlador();
    
    $datos_municipio = $ins_municipio->datos_municipio_controlador("Unico", $pagina[1]);
    
    if($datos_municipio->rowCount()==1){
        $campos = $datos_municipio->fetch();
    ?>
    
    <form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/municipioAjax.php" method="POST" data-form="update" autocomplete="off">
        <input type="hidden" name="municipio_id_up" value="<?php echo $pagina[1];?>">
        <fieldset> 
            <legend><li class="fa-black-tie fa"></li> &nbsp; Información Principal</legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}" class="form-text" name="municipio_nombre_up" id="municipio_nombre" value="<?php echo $campos['municipio_nombre']; ?>" maxlength="150" required="">
                            <span class="bar"></span>
                            <label for="municipio_nombre">Titulo de la Afinidad</label>
                        </div>
                    </div>
                    
                </div>
            </div>
        </fieldset>
        <br><br><br>
        
        
        <p class="text-center" style="margin-top: 40px;">
            <button type="submit" class="btn btn-3d btn-success btn-sm"><i class="fas fa-sync-alt"></i> &nbsp; ACTUALIZAR</button>
        </p>
        
        
    </form>

    <?php }else{?>
    <div class="alert alert-danger text-center" role="alert">
        <p><i class="fa fa-exclamation-triangle fa-5x"></i></p>
        <h4 class="alert-heading">¡Ocurrió un error inesperado!</h4>
        <p class="mb-0">Lo sentimos, no podemos mostrar la información solicitada debido a un error.</p>
    </div>  
    
    <?php } ?>

<!-- Fin de Codigo para actualizar los datos del usuario -->
</div>
