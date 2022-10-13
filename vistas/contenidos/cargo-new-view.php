<?php
if($_SESSION['privilegio_tor']<1 || $_SESSION['privilegio_tor']>3 || $_SESSION['tipo_tor']==3 || $_SESSION['tipo_tor']==4) {
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
            <h3 class="animated fadeInLeft">Cargo / Crear Nuevo</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a class="active" href="<?php echo SERVERURL; ?>cargo-new/">Nuevo cargo <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>cargo-list/">Lista de cargos <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>cargo-search/">Buscar cargo <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->

<div class="container-fluid">
    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/cargoAjax.php" method="POST" data-form="save" autocomplete="off">
        <fieldset>
            <legend><i class="far fa-address-card"></i> &nbsp; Información del cargo</legend>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}" class="form-text" name="cargo_nombre_reg" id="cargo_nombre" maxlength="150" required="">
                            <span class="bar"></span>
                            <label for="cargo_nombre">Nombre</label>
                        </div>
                    </div>

                    <!-- Seleccione un direccion -->
                    <div class="col-md-6">
                    <label for="cargo_nombre">Direccion</label>
                       <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <select class="form-control btn-round" name="direccion_nombre_reg" required="">


                                <?php
                                    if($direcciones->rowCount()>0){
                                        $direcciones = $direcciones->fetchAll();
                                        echo '<option value="" selected="">Seleccione una direccion</option>';
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


        <p class="text-center" style="margin-top: 20px;">
            <button type="reset" class="btn btn-3d btn-warning btn-sm"><i class="fa-refresh fa"></i> &nbsp; LIMPIAR</button>
            &nbsp; &nbsp;
            <button type="submit" class="btn btn-3d btn-info btn-sm"><i class="fa-save fa"></i> &nbsp; GUARDAR</button>
        </p>
    </form>
</div>
