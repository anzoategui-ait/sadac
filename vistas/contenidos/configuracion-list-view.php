<?php 
if ($_SESSION['privilegio_tor'] != 1) {
        $lc->forzar_cierre_sesion_controlador();
        exit();
    }
?>
<div class="container-fluid">
    <h1 class="mt-4">Listado de Configuracion</h1>
   
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

    <div class="col-md-12" style="margin-bottom:40px">
    <div class="panel box-v3">
                    <div class="panel-heading bg-white border-none">
                        <h4>LISTADO DE CONFIGURACIONES</h4>
                    </div>
                    <div class="panel-body">
            <?php
            require_once "./controladores/configuracionControlador.php";
            $ins_configuracion = new configuracionControlador();
            echo $ins_configuracion->paginador_configuracion_controlador($pagina[1], 10, $_SESSION['privilegio_tor'], $pagina[0], "");
            ?>
        </div>
    </div>

</div>