<?php 
if ($_SESSION['privilegio_tor'] != 1) {
        $lc->forzar_cierre_sesion_controlador();
        exit();
    }
?>
<div class="container-fluid">
    <h1 class="mt-4">Nueva Configuracion</h1>
    
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
</div>


<div class="container-fluid">
	<form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/configuracionAjax.php" method="POST" data-form="save" autocomplete="off">
		
            <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-header">
                <legend><i class="fa fa-address-card"></i> &nbsp; Describir Configuracion</legend>
                </div>
                <div class="container-fluid">
                    <br>
				<div class="row">
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="configuracion_descripcion" class="bmd-label-floating">Descripción</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-_ ]{3,190}" class="form-control" name="configuracion_descripcion_reg" id="configuracion_descripcion" maxlength="190">
						</div>
					</div>
					
					
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="configuracion_valor" class="bmd-label-floating">Valor</label>
							<input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-_ ]{1,190}" class="form-control" name="configuracion_valor_reg" id="configuracion_valor" maxlength="190">
						</div>
					</div>
                                    
				</div>
			</div>
            </div>
        </div>
        
    </div>
           
   
		<p class="text-center" style="margin-top: 40px;">
			<button type="reset" class="btn btn-3d btn-warning btn-sm"><i class="fa fa-trash"></i> &nbsp; LIMPIAR</button>
			&nbsp; &nbsp;
			<button type="submit" class="btn btn-3d btn-info btn-sm"><i class="fa fa-save"></i> &nbsp; GUARDAR</button>
		</p>
	</form>
</div>