<?php 
if ($_SESSION['privilegio_tor'] != 1) {
        $lc->forzar_cierre_sesion_controlador();
        exit();
    }
?>
<div class="container-fluid">
    <h1 class="mt-4">Actualizar Configuracion</h1>
   
    <?php if ($_SESSION['privilegio_tor'] == 1) { ?>
    <div class="row">
        
        <div class="col-md-4" style="margin-bottom:40px">
            <div class="panel box-v3">
                    <div class="panel-body">
                    <a class="text-primary stretched-link" href="<?php echo SERVERURL; ?>configuracion-new/">
                        AGREGAR NUEVA CONFIGURACION
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="margin-bottom:40px">
            <div class="panel box-v3">
                    <div class="panel-body">
                    <a class="text-info stretched-link" href="<?php echo SERVERURL; ?>configuracion-list/">
                        <b> LISTADO DE CONFIGURACIONES</b> <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="margin-bottom:40px">
            <div class="panel box-v3">
                    <div class="panel-body">
                <a class="text-success stretched-link" href="<?php echo SERVERURL; ?>configuracion-search/">BUSCAR CONFIGURACION
                 <i class="fa fa-angle-right"></i>
                </a>
                </div>
            </div>
        </div>
        
    </div>
    <?php } ?>
</div>




<div class="container-fluid">
    
    
    
    
    <?php
    require_once "./controladores/configuracionControlador.php";
    $ins_configuracion = new configuracionControlador();

    $datos_configuracion = $ins_configuracion->datos_configuracion_controlador($pagina[1]);

    if ($datos_configuracion->rowCount() == 1) {
        $campos = $datos_configuracion->fetch();
        ?>

        <form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/configuracionAjax.php" method="POST" data-form="update" autocomplete="off">
           
            <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-header">
                <legend><i class="far fa-address-card"></i> &nbsp; Información de la Configuracion</legend>
                </div>
                
            
            <input type="hidden" name="configuracion_id_up" value="<?php echo $pagina[1]; ?>">
            <fieldset>
                <br>
                <div class="container-fluid">
                    <div class="row">
                          
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="configuracion_descripcion" class="bmd-label-floating">Descripcion</label>
                                <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-_ ]{3,190}" class="form-control" name="configuracion_descripcion_up" id="configuracion_descripcion" value="<?php echo $campos['configuracion_descripcion']; ?>" maxlength="190">
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="configuracion_valor" class="bmd-label-floating">Valor</label>
                                <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-_ ]{1,190}" class="form-control" name="configuracion_valor_up" id="configuracion_valor" value="<?php echo $campos['configuracion_valor']; ?>" maxlength="190">
                            </div>
                        </div>
                        
                    </div>
                </div>
            </fieldset>
            
            
            </div>
            </div>
                </div>
            
            <br>
            
           
            
            <p class="text-center" style="margin-top: 20px;">
                <button type="submit" class="btn btn-3d btn-success btn-sm"><i class="fa fa-refresh"></i> &nbsp; ACTUALIZAR</button>
            </p>


        </form>

    <?php } else { ?>
        <div class="alert alert-danger text-center" role="alert">
            <p><i class="fa fa-exclamation-triangle fa-5x"></i></p>
            <h4 class="alert-heading">¡Ocurrió un error inesperado!</h4>
            <p class="mb-0">Lo sentimos, no podemos mostrar la información solicitada debido a un error.</p>
        </div>  

    <?php } ?>
</div>