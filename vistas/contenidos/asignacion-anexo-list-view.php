<?php
if($_SESSION['privilegio_tor']<1 || $_SESSION['privilegio_tor']>3 || $_SESSION['tipo_tor']==4) {
  $lc->forzar_cierre_sesion_controlador();
  exit();
  }
?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Anexos de Asignaciones Procesadas</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a class="active" href="<?php echo SERVERURL; ?>procesar-new/">Procesar Asignacion <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>procesar-list/">Lista de procesamientos <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>asignacion-anexo-list/">Anexo de Asignaciones Procesadas<span class="fa-angle-right fa"></span></a>
                   
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->

<?php
if (!isset($_SESSION['busqueda_anexo_asignacion']) && empty($_SESSION['busqueda_anexo_asignacion'])) {
//el empty() para saber si esta vacia y el isset() para saber si esta definida
    ?>


        <form class="cmxform FormularioAjax" action="<?php echo SERVERURL; ?>ajax/buscadorAjax.php" method="POST" data-form="default" autocomplete="off">
            <input type="hidden" name="modulo" value="anexo_asignacion">
            <div class="container-fluid">

                    <div class="col-12 col-md-12">
                        <div class="form-group form-animate-text">
                            <input type="text" class="form-text" name="busqueda_inicial" id="inputSearch" maxlength="30">
                            <span class="bar"></span>
                            <label for="inputSearch" class="bmd-label-floating text-center">¿Qué solicitud estas buscando?</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <p class="text-center" style="margin-top: 40px;">
                            <button type="submit" class="btn btn-3d btn-info"><i class="fa-search fa"></i> &nbsp; BUSCAR</button>
                        </p>
                    </div>

            </div>
        </form>
                 <br><br><br>
        <!-- Codigo para agregar el listado de clubs registrados en el sistema -->
<div class="container-fluid">
<?php
require_once "./controladores/asignacionControlador.php";
$ins_asignacion = new asignacionControlador();
echo $ins_asignacion->paginador_asignacion_anexo_controlador($pagina[1], 10, $_SESSION['privilegio_tor'], $pagina[0], "");
?>
</div>


    <?php
} else {
    ?>

    <div class="container-fluid">
        <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/buscadorAjax.php" method="POST" data-form="search" autocomplete="off">
            <input type="hidden" name="modulo" value="anexo_asignacion">
            <input type="hidden" name="eliminar_busqueda" value="eliminar">
            <div class="container-fluid">

                    <div class="col-12 col-md-12">
                        <p class="text-center" style="font-size: 20px;">
                            Resultados de la busqueda <strong>"<?php echo $_SESSION['busqueda_anexo_asignacion']; ?>"</strong>
                        </p>
                    </div>
                    <div class="col-12">
                        <p class="text-center" style="margin-top: 20px;">
                            <button type="submit" class="btn btn-3d btn-danger"><i class="far fa-trash-alt"></i> &nbsp; ELIMINAR BÚSQUEDA</button>
                        </p>
                    </div>

            </div>
        </form>
    </div>


    <div class="container-fluid">
    <?php
require_once "./controladores/asignacionControlador.php";
$ins_asignacion = new asignacionControlador();
echo $ins_asignacion->paginador_asignacion_anexo_controlador($pagina[1], 10, $_SESSION['privilegio_tor'], $pagina[0], $_SESSION['busqueda_anexo_asignacion']);
?>
    </div>

    <?php
}
?>

<!-- Fin Codigo para buscar un club -->