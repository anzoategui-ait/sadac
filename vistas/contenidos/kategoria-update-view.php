<?php
if ($_SESSION['privilegio_tor'] < 1 || $_SESSION['privilegio_tor'] > 2) {
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
                <a href="<?php echo SERVERURL; ?>kategoria-new/">Nueva categoria <span class="fa-angle-right fa"></span></a> 
                <a href="<?php echo SERVERURL; ?>kategoria-list/">Lista de categorias <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>kategoria-search/">Buscar categoria <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>

<div class="container-fluid">
    <?php
    include "./vistas/inc/btn_back.php";
    require_once "./controladores/kategoriaControlador.php";

    $ins_kategoria = new kategoriaControlador();
    $datos_kategoria = $ins_kategoria->datos_kategoria_controlador("Unico", $pagina[1]);

    if ($datos_kategoria->rowCount() == 1) {
        $campos = $datos_kategoria->fetch();
        ?>

        

        <form action="<?php echo SERVERURL; ?>ajax/kategoriaAjax.php" method="POST" class="form-neon FormularioAjax" autocomplete="off" >

            <input type="hidden" name="kategoria_id_up" value="<?php echo $pagina[1]; ?>" required >

            <div class="row">
                <div class="col-12 col-md-6"><div class="form-group">
                        <label>Nombre</label>
                        <input class="form-control" type="text" name="kategoria_nombre_up" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}" maxlength="50" required value="<?php echo $campos['kategoria_nombre']; ?>" >
                    </div>
                </div>
                <div class="col-12 col-md-6"><div class="form-group">
                        <label>Ubicación</label>
                        <input class="form-control" type="text" name="kategoria_ubicacion_up" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,150}" maxlength="150" value="<?php echo $campos['kategoria_ubicacion']; ?>" >
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
    $datos_kategoria = null;
    ?>
</div>