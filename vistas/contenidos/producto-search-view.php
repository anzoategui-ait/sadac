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
                <a class="active" href="<?php echo SERVERURL; ?>producto-search/">Buscar producto <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>

<!-- Codigo para buscar un producto -->
<div class="container-fluid">
    <?php
    if (!isset($_SESSION['busqueda_producto']) && empty($_SESSION['busqueda_producto'])) {
//el empty() para saber si esta vacia y el isset() para saber si esta definida
        ?>

        <div class="row">
            <div class="col-12 col-md-12">
                <form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/buscadorAjax.php"  method="POST" autocomplete="off" >
                    <input type="hidden" name="modulo" value="producto">   
                    <div class="row justify-content-md-center"><div class="col-12 col-md-12"><div class="form-group"><label for="inputSearch" class="bmd-label-floating">¿Qué estas buscando?</label><input type="text" class="form-control" name="busqueda_inicial" id="inputSearch" maxlength="30"></div></div></div>
               <div class="col-12"><p class="text-center" style="margin-top: 40px;"><button type="submit" class="btn btn-3d btn-info"><i class="fa fa-search"></i> &nbsp; BUSCAR</button></p></div>
                </form>
            </div>
        </div>


        <?php
    } else {
        ?>

        <div class="row">
            <div class="col-12 col-md-12">
                <form class="text-center roboto-medium mt-6 mb-6 form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/buscadorAjax.php" method="POST" autocomplete="off" >
                    <input type="hidden" name="modulo" value="producto"> 
                    <input type="hidden" name="eliminar_busqueda" value="eliminar">
                    <p>Estas buscando <strong>“<?php echo $_SESSION['busqueda_producto']; ?>”</strong></p>
                    <br>
                    <button type="submit" class="btn btn-3d btn-danger"><i class="far fa-trash-alt"></i> &nbsp;Eliminar busqueda</button>
                </form>
            </div>
        </div>

        <div class="container-fluid"> 
           
                <?php
                require_once "./controladores/productoControlador.php";
                $ins_producto = new productoControlador();
                echo $ins_producto->paginador_producto_controlador($pagina[1], 5, $_SESSION['privilegio_tor'], $_SESSION['id_tor'], $pagina[0], $_SESSION['busqueda_producto'],0);
                ?>
            
        </div>

        <?php
    }
    ?>

</div>
<!-- Fin Codigo para buscar un producto --> 