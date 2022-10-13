<?php
if ($_SESSION['privilegio_tor'] < 1 || $_SESSION['privilegio_tor'] > 2) {
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
                <a href="<?php echo SERVERURL; ?>producto-new/">Nuevo producto <span class="fa-angle-right fa"></span></a> 
                <a href="<?php echo SERVERURL; ?>producto-list/">Lista de productos <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>producto-categoria/">Por categoria <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>producto-search/">Buscar producto <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>


<div class="container-fluid">
    <?php
    include "./vistas/inc/btn_back.php";
    require_once "./controladores/productoControlador.php";

    $ins_producto = new productoControlador();
    $datos_producto = $ins_producto->datos_producto_controlador("Unico", $pagina[1]);

    if ($datos_producto->rowCount() == 1) {
        $datos = $datos_producto->fetch();
        ?>

        

        <h2 class="title text-center roboto-medium"><?php echo $datos['producto_nombre']; ?></h2>

        <form action="<?php echo SERVERURL; ?>ajax/productoAjax.php" method="POST" class="form-neon FormularioAjax" autocomplete="off" >

            <input type="hidden" name="producto_id_up" value="<?php echo $pagina[1]; ?>" required >

            <div class="row">
                <div class="col-12 col-md-4"><div class="form-group">
                        <label>Código de barra</label>
                        <input class="form-control" type="text" name="producto_codigo_up" pattern="[a-zA-Z0-9- ]{1,70}" maxlength="70" required value="<?php echo $datos['producto_codigo']; ?>" >
                    </div>
                </div>
                <div class="col-12 col-md-8"><div class="form-group">
                        <label>Nombre</label>
                        <input class="form-control" type="text" name="producto_nombre_up" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}" maxlength="70" required value="<?php echo $datos['producto_nombre']; ?>" >
                    </div>
                </div>
               
            </div>
            <div class="row">
                <div class="col-12 col-md-3"><div class="form-group">
                        <label>Precio</label>
                        <input class="form-control" type="text" name="producto_precio_up" pattern="[0-9.]{1,30}" maxlength="30" required value="<?php echo $datos['producto_precio']; ?>" >
                    </div>
                </div>
                <div class="col-12 col-md-3"><div class="form-group">
                        <label>Stock</label>
                        <input class="form-control" type="text" name="producto_stock_up" pattern="[0-9.]{1,30}" maxlength="30" required value="<?php echo $datos['producto_stock']; ?>" >
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <label>Categoría</label>
                 
                        <select class="form-control" name="producto_kategoria_up" >
                            <?php
                            
                            if ($kategorias->rowCount() > 0) {
                                $kategorias = $kategorias->fetchAll();
                                foreach ($kategorias as $row) {
                                    if ($datos['kategoria_id'] == $row['kategoria_id']) {
                                        echo '<option value="' . $row['kategoria_id'] . '" selected="" >' . $row['kategoria_nombre'] . ' (Actual)</option>';
                                    } else {
                                        echo '<option value="' . $row['kategoria_id'] . '" >' . $row['kategoria_nombre'] . '</option>';
                                    }
                                }
                            }
                            $kategorias = null;
                            ?>
                        </select>
                    
                </div>
                
                 <div class="col-12 col-md-3">
		    	<div class="control">
					<label>Unidad de Medida</label>
				  	<input class="form-control" type="text" name="producto_unidad_up" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,50}" maxlength="50" required value="<?php echo $datos['producto_unidad']; ?>">
				</div>
		  	</div>
            </div>
            
            
            
            <p class="text-center" style="margin-top: 20px;">
                <button type="submit" class="btn btn-3d btn-info btn-sm"><i class="fa fa-save"></i>&nbsp;Actualizar</button>
            </p>
        </form>
        <?php
    } else {
        ?>
        <div class="notification is-danger is-light mb-6 mt-6">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            No podemos obtener la información solicitada
        </div>  <?php
    }
    $check_producto = null;
    ?>
</div>