<?php
if($_SESSION['privilegio_tor']!=1) {
  $lc->forzar_cierre_sesion_controlador();
  exit();
  } 
?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Usuario / Lista de usuarios</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>user-new/">Nuevo Usuario <span class="fa-angle-right fa"></span></a> 
                <a href="<?php echo SERVERURL; ?>user-list/">Lista de Usuarios<span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>user-search/">Buscar Usuario <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->

<!-- Codigo para agregar el listado de usuarios registrados en el sistema -->
<div class="container pb-6 pt-6">
<?php
require_once "./controladores/usuarioControlador.php";
$ins_usuario = new usuarioControlador();
echo $ins_usuario->paginador_usuario_controlador($pagina[1], 12, $_SESSION['privilegio_tor'], $_SESSION['id_tor'], $pagina[0], "");
?>
</div>
<!-- Fin Codigo para agregar el listado de usuarios registrados en el sistema -->