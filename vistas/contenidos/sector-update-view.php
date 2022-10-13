<?php
if($_SESSION['privilegio_tor']<1 || $_SESSION['privilegio_tor']>2 || $_SESSION['tipo_tor']==4) {
  $lc->forzar_cierre_sesion_controlador();
  exit();
  }
  
  //Obtener listado de todas las parroquiaes registradas en el sistema
require_once './controladores/parroquiaControlador.php';
$ins_parroquia = new parroquiaControlador();
$parroquiaes = $ins_parroquia->datos_parroquia_controlador("Todos", 0);


?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Sector / Editar</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a class="active" href="<?php echo SERVERURL; ?>sector-new/">Nuevo sector <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>sector-list/">Lista de sectores <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>sector-search/">Buscar sector <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->
<!-- Inicio de Codigo para actualizar los datos del usuario -->
<div class="container-fluid">
    <?php
    require_once "./controladores/sectorControlador.php";
    $ins_sector = new sectorControlador();

    $datos_sector = $ins_sector->datos_sector_controlador("Unico", $pagina[1]);

    if($datos_sector->rowCount()==1){
        $campos = $datos_sector->fetch();
    ?>

    <form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/sectorAjax.php" method="POST" data-form="update" autocomplete="off">
        <input type="hidden" name="sector_id_up" value="<?php echo $pagina[1];?>">
        <fieldset>
            <legend><li class="fa-black-tie fa"></li> &nbsp; Información de la sector</legend>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">
                    <label for="sector_nombre">Nombre</label>
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}" class="form-text" name="sector_nombre_up" id="sector_nombre" value="<?php echo $campos['sector_nombre']; ?>" maxlength="150" required="">
                            <span class="bar"></span>

                        </div>
                    </div>

                   <!-- Seleccione una parroquia -->
                    <div class="col-md-6">
                    <label for="sector_nombre">Parroquia</label>
                       <div class="form-group form-animate-text" style="margin-top:30px !important;">
                            <select class="form-control btn-round" name="parroquia_nombre_up" required="">


                                <?php
                                    if($parroquiaes->rowCount()>0){
                                        $parroquiaes = $parroquiaes->fetchAll();
                                        //con el id del club obtener el nombre del club
                                        $rs_parroquia = $ins_parroquia->datos_parroquia_controlador("Unico", $ins_parroquia->encryption($campos['parroquia_id']));
                                        $rs_parroquia = $rs_parroquia->fetch();
                                        $nombre_parroquia = $rs_parroquia['parroquia_nombre'];
                                        echo '<option value="'.$ins_parroquia->encryption($campos['parroquia_id']).'" selected="">'.$nombre_parroquia.' (Actual)</option>';
                                        //Ciclo para recorrer todos los equipos registrados en el sistema
                                        foreach ($parroquiaes as $rows){
                                            echo '<option value="'. $ins_parroquia->encryption($rows['parroquia_id']).'">'.$rows['parroquia_nombre']. ' ('. $rows['municipio_nombre']  .').</option>';
                                        }
                                    }

                                ?>

                            </select>
                        </div>
                    </div>

                </div>
            </div>
        </fieldset>
        <br><br><br>


        <p class="text-center" style="margin-top: 20px;">
            <button type="submit" class="btn btn-3d btn-success btn-sm"><i class="fas fa-sync-alt"></i> &nbsp; ACTUALIZAR</button>
        </p>


    </form>

    <?php }else{?>
    <div class="alert alert-danger text-center" role="alert">
        <p><i class="fa fa-exclamation-triangle fa-5x"></i></p>
        <h4 class="alert-heading">Ha ocurrido un error inesperado!</h4>
        <p class="mb-0">Lo sentimos, no podemos mostrar la informaci�n solicitada debido a un error.</p>
    </div>

    <?php } ?>

<!-- Fin de Codigo para actualizar los datos del usuario -->
</div>