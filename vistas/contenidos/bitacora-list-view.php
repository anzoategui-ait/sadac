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
            <h3 class="animated fadeInLeft">Bitacora / Listar</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>bitacora-list/">Lista de bitacoras <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>bitacora-search/">Buscar bitacora <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->

<!-- Codigo para agregar el listado de clubs registrados en el sistema -->
<div class="container-fluid">
<?php
require_once "./controladores/bitacoraControlador.php";
$ins_bitacora = new bitacoraControlador();
echo $ins_bitacora->paginador_bitacora_controlador($pagina[1], 10, $_SESSION['privilegio_tor'], $pagina[0], "");
?>
</div>
<!-- Fin Codigo para agregar el listado de clubs registrados en el sistema -->
