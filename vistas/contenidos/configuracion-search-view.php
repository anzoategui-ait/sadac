<?php 
if ($_SESSION['privilegio_tor'] != 1) {
        $lc->forzar_cierre_sesion_controlador();
        exit();
    }
?>
<div class="container-fluid">
    <h1 class="mt-4">Buscar Configuracion</h1>
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


<?php
if (!isset($_SESSION['busqueda_configuracion']) && empty($_SESSION['busqueda_configuracion'])) {
//el empty() para saber si esta vacia y el isset() para saber si esta definida
    ?>

    <div class="container-fluid">
        <form class="cmxform FormularioAjax" action="<?php echo SERVERURL; ?>ajax/buscadorAjax.php" method="POST" data-form="default" autocomplete="off">
            <input type="hidden" name="modulo" value="configuracion">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group form-animate-text">
                           <input type="text" class="form-text" name="busqueda_inicial" id="inputSearch" maxlength="30">
                        <span class="bar"></span>
                            <label for="busqueda_inicial">¿Qué configuracion estas buscando?</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <p class="text-left" style="margin-top: 40px;">
                            <button type="submit" class="btn btn-3d btn-info"><i class="fa fa-search"></i> &nbsp; BUSCAR</button>
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <?php
} else {
    ?>

    <div class="container-fluid">
        <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/buscadorAjax.php" method="POST" data-form="search" autocomplete="off">
            <input type="hidden" name="modulo" value="configuracion">
            <input type="hidden" name="eliminar_busqueda" value="eliminar">
            <div class="container-fluid">
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-12">
                        <p class="text-center" style="font-size: 20px;">
                            Resultados de la busqueda <strong>"<?php echo $_SESSION['busqueda_configuracion']; ?>"</strong>
                        </p>
                    </div>
                    <div class="col-12">
                        <p class="text-center" style="margin-top: 5px;">
                            <button type="submit" class="btn btn-round btn-danger"><i class="far fa-trash-alt"></i> &nbsp; ELIMINAR BÚSQUEDA</button>
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <div class="container-fluid">
        <?php
        require_once "./controladores/configuracionControlador.php";
        $ins_configuracion = new configuracionControlador();
        echo $ins_configuracion->paginador_configuracion_controlador($pagina[1], 10, $_SESSION['privilegio_tor'], $pagina[0], $_SESSION['busqueda_configuracion']);
        ?>
    </div>

    <?php
}
?>