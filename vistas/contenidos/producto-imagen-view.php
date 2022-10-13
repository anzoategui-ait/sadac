<?php
if ($_SESSION['privilegio_tor'] < 1 || $_SESSION['privilegio_tor'] > 3) {
    $lc->forzar_cierre_sesion_controlador();
    exit();
}
if ($_SESSION['tipo_tor'] != 1 && $_SESSION['tipo_tor'] != 2 && $_SESSION['tipo_tor'] != 4) {
    $lc->redireccionar_pagina_controlador();
    exit();
}
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

        

        <div class="row">
            <div class="col-12 col-md-12">
            <div class="text-center">
                <?php if (is_file("./vistas/img/producto/" . $datos['producto_foto'])) { ?>
                    <figure class="image mb-6">
                        <img src="<?php echo SERVERURL;?>vistas/img/producto/<?php echo $datos['producto_foto']; ?>">
                    </figure>
                    <form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/productoAjax.php" method="POST" autocomplete="off" >

                        <input type="hidden" name="imagen_producto_id_del" value="<?php echo $pagina[1]; ?>">

                        <p class="text-center" style="margin-top: 20px;">
                            <button type="submit" class="btn btn-3d btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp; Eliminar imagen</button>
                        </p>
                    </form>
                <?php } else { ?>
                    <figure class="image mb-6">
                        <img src="<?php echo SERVERURL;?>vistas/img/producto.png">
                    </figure>
                <?php } ?>
            </div> </div>
            <div class="col-12 col-md-12">
                <form class="mb-6 text-center roboto-medium form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/productoAjax.php" method="POST" enctype="multipart/form-data" autocomplete="off" >

                    <h4 class="title is-4 mb-6"><?php echo $datos['producto_nombre']; ?></h4>

                    <label>Foto o imagen del producto</label><br>

                    <input type="hidden" name="imagen_id_up" value="<?php echo $pagina[1]; ?>">

                    <div class="file has-name is-horizontal is-justify-content-center mb-6">
                        <label class="file-label">
                            <input class="file-input" type="file" name="producto_foto" accept=".jpg, .png, .jpeg" >
                            <span class="file-cta">
                                <span class="file-label">Imagen</span>
                            </span>
                            <span class="file-name">JPG, JPEG, PNG. (MAX 3MB)</span>
                        </label>
                    </div>
                    <p class="text-center" style="margin-top: 20px;">
                        <button type="submit" class="btn btn-3d btn-info btn-sm"><i class="fa fa-save"></i>&nbsp; Actualizar</button>
                    </p>
                </form>
            </div>
        </div>
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