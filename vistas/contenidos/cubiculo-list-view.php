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
            <h3 class="animated fadeInLeft">Cubiculo / Listar</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>cubiculo-new/">Nuevo cubiculo <span class="fa-angle-right fa"></span></a>
                <a class="active" href="<?php echo SERVERURL; ?>cubiculo-list/">Lista de cubiculos <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>cubiculo-search/">Buscar cubiculo <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->

<!-- Codigo para agregar el listado de clubs registrados en el sistema -->
<div class="container-fluid">
<?php
require_once "./controladores/cubiculoControlador.php";
$ins_cubiculo = new cubiculoControlador();
echo $ins_cubiculo->paginador_cubiculo_controlador($pagina[1], 10, $_SESSION['privilegio_tor'], $pagina[0], "");
?>
</div>
<!-- Fin Codigo para agregar el listado de clubs registrados en el sistema -->
