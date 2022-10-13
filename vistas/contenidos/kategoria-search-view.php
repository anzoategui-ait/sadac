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
                <a href="<?php echo SERVERURL; ?>kategoria-list/">Lista de categorias <span class="fa-angle-right fa"></span></a>
                <a class="active" href="<?php echo SERVERURL; ?>kategoria-search/">Buscar categoria <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>

<!-- Codigo para buscar un kategoria -->
<div class="container-fluid">
    <?php
    if (!isset($_SESSION['busqueda_kategoria']) && empty($_SESSION['busqueda_kategoria'])) {
//el empty() para saber si esta vacia y el isset() para saber si esta definida
        ?>

        <div class="row">
            <div class="col-12 col-md-12">
                <form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/buscadorAjax.php"  method="POST" autocomplete="off" >
                    <input type="hidden" name="modulo" value="kategoria">   
                    <div class="row justify-content-md-center"><div class="col-12 col-md-12"><div class="form-group"><label for="inputSearch" class="bmd-label-floating">¿Qué estas buscando?</label><input type="text" class="form-control" name="busqueda_inicial" id="inputSearch" maxlength="30"></div></div>
                        
                    </div>
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
                    <input type="hidden" name="modulo" value="kategoria"> 
                    <input type="hidden" name="eliminar_busqueda" value="eliminar">
                    <p>Estas buscando <strong>“<?php echo $_SESSION['busqueda_kategoria']; ?>”</strong></p>
                    <br>
                    <button type="submit" class="btn btn-3d btn-danger"><i class="far fa-trash-alt"></i> &nbsp;Eliminar busqueda</button>
                </form>
            </div>
        </div>

        <div class="container-fluid"> 
            <div class="row">
                <?php
                require_once "./controladores/kategoriaControlador.php";
                $ins_kategoria = new kategoriaControlador();
                echo $ins_kategoria->paginador_kategoria_controlador($pagina[1], 7, $_SESSION['privilegio_tor'], $_SESSION['id_tor'], $pagina[0], $_SESSION['busqueda_kategoria']);
                ?>
            </div>
        </div>

        <?php
    }
    ?>

</div>
<!-- Fin Codigo para buscar un kategoria --> 