<?php
if($_SESSION['privilegio_tor']<1 || $_SESSION['privilegio_tor']>3 || $_SESSION['tipo_tor']==3 || $_SESSION['tipo_tor']==4) {
  $lc->forzar_cierre_sesion_controlador();
  exit();
  }
?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Cargo / Listar</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>cargo-new/">Nuevo cargo <span class="fa-angle-right fa"></span></a>
                <a class="active" href="<?php echo SERVERURL; ?>cargo-list/">Lista de cargos <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>cargo-search/">Buscar cargo <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->

<!-- Codigo para agregar el listado de clubs registrados en el sistema -->
<div class="container-fluid">
<?php
require_once "./controladores/cargoControlador.php";
$ins_cargo = new cargoControlador();
echo $ins_cargo->paginador_cargo_controlador($pagina[1], 10, $_SESSION['privilegio_tor'], $pagina[0], "");
?>
</div>
<!-- Fin Codigo para agregar el listado de clubs registrados en el sistema -->
