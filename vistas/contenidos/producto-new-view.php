<?php
if ($_SESSION['privilegio_tor'] < 1 || $_SESSION['privilegio_tor'] > 3) {
    $lc->forzar_cierre_sesion_controlador();
    exit();
}
if ($_SESSION['tipo_tor'] != 1 && $_SESSION['tipo_tor'] != 2) {
    $lc->redireccionar_pagina_controlador();
    exit();
}
require_once './controladores/kategoriaControlador.php';
$ins_kategoria = new kategoriaControlador();
$kategorias = $ins_kategoria->datos_kategoria_controlador("Todos", 0);
?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Categoria / Crear Nuevo</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a class="active" href="<?php echo SERVERURL; ?>producto-new/">Nuevo producto <span class="fa-angle-right fa"></span></a> 
                <a href="<?php echo SERVERURL; ?>producto-list/">Lista de productos <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>producto-categoria/">Por categoria <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>producto-search/">Buscar producto <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>

<div class="container-fluid">
	

	

	<form action="<?php echo SERVERURL; ?>ajax/productoAjax.php"  method="POST" class="form-neon FormularioAjax" autocomplete="off" enctype="multipart/form-data" >
		<div class="row">
		  	<div class="col-12 col-md-4">
		    	<div class="form-group">
					<label>Código de barra</label>
				  	<input class="form-control" type="text" name="producto_codigo_reg" pattern="[a-zA-Z0-9- ]{1,70}" maxlength="70" required >
				</div>
		  	</div>
		  	<div class="col-12 col-md-8">
		    	<div class="form-group">
					<label>Nombre</label>
				  	<input class="form-control" type="text" name="producto_nombre_reg" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}" maxlength="70" required >
				</div>
		  	</div>
		</div>
		<div class="row">
		  	<div class="col-12 col-md-4">
		    	<div class="form-group">
					<label>Precio</label>
				  	<input class="form-control" type="text" name="producto_precio_reg" pattern="[0-9.]{1,30}" maxlength="30" required >
				</div>
		  	</div>
		  	<div class="col-12 col-md-4">
		    	<div class="form-group">
					<label>Stock</label>
				  	<input class="form-control" type="text" name="producto_stock_reg" pattern="[0-9.]{1,30}" maxlength="30" required >
				</div>
		  	</div>
		  	<div class="col-12 col-md-4">
                            <div class="form-group">
				<label>Categoría</label>
		    	
				  	<select class="form-control"  name="producto_kategoria_reg" >
				    	<option value="" selected="" >Seleccione una opción</option>
				    	<?php
    						if($kategorias->rowCount()>0){
    							$kategorias=$kategorias->fetchAll();
    							foreach($kategorias as $row){
    								echo '<option value="'. $ins_kategoria->encryption($row['kategoria_id']) .'" >'.$row['kategoria_nombre'].'</option>';
				    			}
				   			}
				   			$kategorias=null;
				    	?>
				  	</select>
				
                            </div>
		  	</div>
		</div>
		<div class="row">
                    
                    <div class="col-12 col-md-4">
		    	<div class="form-group">
					<label>Unidad de Medida</label>
				  	<input class="form-control" type="text" name="producto_unidad_reg" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,50}" maxlength="50" required >
				</div>
		  	</div>
			<div class="col-12 col-md-8">
                            <div class="form-group">
				<label>Foto o imagen del producto</label><br>
				<div class="file is-small has-name">
				  	<label class="file-label">
				    	<input class="file-input" type="file" name="producto_foto_reg" accept=".jpg, .png, .jpeg" >
				    	<span class="file-cta">
				      		<span class="file-label">Imagen</span>
				    	</span>
				    	<span class="file-name">JPG, JPEG, PNG. (MAX 3MB)</span>
				  	</label>
				</div>
                            </div>
			</div>
		</div>
		<p class="text-center" style="margin-top: 20px;">
			<button type="submit" class="btn btn-3d btn-info btn-sm"><i class="fa fa-save"></i>&nbsp; Guardar</button>
		</p>
	</form>
</div>