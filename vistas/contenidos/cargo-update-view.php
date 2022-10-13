<?php
if($_SESSION['privilegio_tor']<1 || $_SESSION['privilegio_tor']>2 || $_SESSION['tipo_tor']==3 || $_SESSION['tipo_tor']==4) {
  $lc->forzar_cierre_sesion_controlador();
  exit();
  }
  
  //Obtener listado de todas las direcciones registradas en el sistema
require_once './controladores/direccionControlador.php';
$ins_direccion = new direccionControlador();
$direcciones = $ins_direccion->datos_direccion_controlador("Todos", 0);


?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Cargo / Editar</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>cargo-new/">Nuevo cargo <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>cargo-list/">Lista de cargos <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>cargo-search/">Buscar cargo <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->
<!-- Inicio de Codigo para actualizar los datos del usuario -->
<div class="container-fluid">
    <?php
    require_once "./controladores/cargoControlador.php";
    $ins_cargo = new cargoControlador();

    $datos_cargo = $ins_cargo->datos_cargo_controlador("Unico", $pagina[1]);

    if($datos_cargo->rowCount()==1){
        $campos = $datos_cargo->fetch();
    ?>

    <form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/cargoAjax.php" method="POST" data-form="update" autocomplete="off">
        <input type="hidden" name="cargo_id_up" value="<?php echo $pagina[1];?>">
        <fieldset>
            <legend><li class="fa-black-tie fa"></li> &nbsp; Información de la cargo</legend>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">
                    <label for="cargo_nombre">Nombre</label>
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}" class="form-text" name="cargo_nombre_up" id="cargo_nombre" value="<?php echo $campos['cargo_nombre']; ?>" maxlength="150" required="">
                            <span class="bar"></span>

                        </div>
                    </div>

                   <!-- Seleccione una direccion -->
                    <div class="col-md-6">
                    <label for="cargo_nombre">Direccion</label>
                       <div class="form-group form-animate-text" style="margin-top:30px !important;">
                            <select class="form-control btn-round" name="direccion_nombre_up" required="">


                                <?php
                                    if($direcciones->rowCount()>0){
                                        $direcciones = $direcciones->fetchAll();
                                        //con el id del club obtener el nombre del club
                                        $rs_direccion = $ins_direccion->datos_direccion_controlador("Unico", $ins_direccion->encryption($campos['direccion_id']));
                                        $rs_direccion = $rs_direccion->fetch();
                                        $nombre_direccion = $rs_direccion['direccion_nombre'];
                                        echo '<option value="'.$ins_direccion->encryption($campos['direccion_id']).'" selected="">'.$nombre_direccion.' (Actual)</option>';
                                        //Ciclo para recorrer todos los equipos registrados en el sistema
                                        foreach ($direcciones as $rows){
                                            echo '<option value="'. $ins_direccion->encryption($rows['direccion_id']).'">'.$rows['direccion_nombre'].'.</option>';
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
