<?php
if($_SESSION['privilegio_tor']<1 || $_SESSION['privilegio_tor']>2 || $_SESSION['tipo_tor']==3 || $_SESSION['tipo_tor']==4) {
  $lc->forzar_cierre_sesion_controlador();
  exit();
  } 
?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Categoria / Editar</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a class="active" href="<?php echo SERVERURL; ?>categoria-new/">Nueva categoria <span class="fa-angle-right fa"></span></a> 
                <a href="<?php echo SERVERURL; ?>categoria-list/">Lista de categorias <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>categoria-search/">Buscar categoria <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->
<!-- Inicio de Codigo para actualizar los datos del usuario -->
<div class="container-fluid">
    <?php 
    require_once "./controladores/categoriaControlador.php";
    $ins_categoria = new categoriaControlador();
    
    $datos_categoria = $ins_categoria->datos_categoria_controlador("Unico", $pagina[1]);
    
    if($datos_categoria->rowCount()==1){
        $campos = $datos_categoria->fetch();
    ?>
    
    <form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/categoriaAjax.php" method="POST" data-form="update" autocomplete="off">
        <input type="hidden" name="categoria_id_up" value="<?php echo $pagina[1];?>">
        <fieldset> 
            <legend><li class="fa-black-tie fa"></li> &nbsp; Información de la Categoria</legend>
            <div class="container-fluid">
                <div class="row">
                    
                    <div class="col-md-6">
                    <label for="categoria_nombre">Nombre</label>
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}" class="form-text" name="categoria_nombre_up" id="categoria_nombre" value="<?php echo $campos['categoria_nombre']; ?>" maxlength="150" required="">
                            <span class="bar"></span>
                            
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                    <label for="categoria_descripcion">Descripcion</label>
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,300}" class="form-text" name="categoria_descripcion_up" id="categoria_descripcion" value="<?php echo $campos['categoria_descripcion']; ?>" maxlength="300" required="">
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
