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
                <a href="<?php echo SERVERURL; ?>kategoria-new/">Nueva categoria <span class="fa-angle-right fa"></span></a> 
                <a class="active" href="<?php echo SERVERURL; ?>kategoria-list/">Lista de categorias <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>kategoria-search/">Buscar categoria <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>

<div class="container-fluid"> 
   
        <?php
        require_once "./controladores/kategoriaControlador.php";
        $ins_kategoria = new kategoriaControlador();
        echo $ins_kategoria->paginador_kategoria_controlador($pagina[1], 7, $_SESSION['privilegio_tor'], $_SESSION['id_tor'], $pagina[0], "");
        ?>
    
</div>