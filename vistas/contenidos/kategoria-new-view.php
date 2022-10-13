<?php
if ($_SESSION['privilegio_tor'] < 1 || $_SESSION['privilegio_tor'] > 3) {
    $lc->forzar_cierre_sesion_controlador();
    exit();
}
if ($_SESSION['tipo_tor'] != 1 && $_SESSION['tipo_tor'] != 2) {
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
                <a class="active" href="<?php echo SERVERURL; ?>kategoria-new/">Nueva categoria <span class="fa-angle-right fa"></span></a> 
                <a href="<?php echo SERVERURL; ?>kategoria-list/">Lista de categorias <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>kategoria-search/">Buscar categoria <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>


<div class="container-fluid">



    <form action="<?php echo SERVERURL; ?>ajax/kategoriaAjax.php" method="POST" class="form-neon form-neon FormularioAjax" autocomplete="off" >
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="kategoria_nombre_reg" class="bmd-label-floating" style="color: #1F618D;">Nombre de la Categoria</label>
                    <input class="form-control" type="text" name="kategoria_nombre_reg" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}" maxlength="50" required >
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="kategoria_ubicacion_reg" class="bmd-label-floating" style="color: #1F618D;">Ubicación</label>
                    <input class="form-control" type="text" name="kategoria_ubicacion_reg" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,150}" maxlength="150" >
                </div>
            </div>
        </div>
        <p class="text-center" style="margin-top: 20px;">
            <button type="reset" class="btn btn-3d btn-danger btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR</button>
            &nbsp; &nbsp;
            <button type="submit" class="btn btn-3d btn-info btn-sm"><i class="fa fa-save"></i> &nbsp; GUARDAR</button>
        </p>
    </form>
</div>