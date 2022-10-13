<?php
if($_SESSION['privilegio_tor']<1 || $_SESSION['privilegio_tor']>3 || $_SESSION['tipo_tor']==3 || $_SESSION['tipo_tor']==4) {
  $lc->forzar_cierre_sesion_controlador();
  exit();
  }

//Obtener listado de todas las direcciones registradas en el sistema
require_once './controladores/usuarioControlador.php';
$ins_usuario = new usuarioControlador();
$usuarios = $ins_usuario->datos_usuario_controlador("Todos", 0);
//Obtener listado de todas las direcciones registradas en el sistema
require_once './controladores/cargoControlador.php';
$ins_direccion = new cargoControlador();
$direcciones = $ins_direccion->datos_cargo_controlador("Todos", 0);

?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Usuario / Relacion Usuario Cargo</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>user-cargo/">Usuario Cargo <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>user-cargo-list/">Relacion usuario y cargo <span class="fa-angle-right fa"></span></a>
             </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->

<div class="container-fluid">
    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/usuarioAjax.php" method="POST" data-form="save" autocomplete="off">
        <fieldset>
            <legend><i class="far fa-address-card"></i> &nbsp; Información del usuario</legend>
            <div class="container-fluid">
                <div class="row">

                    
                    <!-- Seleccione un direccion -->
                    <div class="col-md-6">
                    <label for="relacion_usuario_id_reg">Usuario</label>
                       <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <select class="form-control btn-round" name="relacion_usuario_id_reg" required="">


                                <?php
                                    if($usuarios->rowCount()>0){
                                        $usuarios = $usuarios->fetchAll();
                                        echo '<option value="" selected="">Seleccione un usuario</option>';
                                        //Ciclo para recorrer todos los equipos registrados en el sistema
                                        foreach ($usuarios as $rows){
                                            echo '<option value="'. $ins_direccion->encryption($rows['usuario_id']).'">'.$rows['usuario_nombre']. ", ".$rows['usuario_apellido'].'.</option>';
                                        }
                                    }

                                ?>

                            </select>
                        </div>
                    </div>
                    
                    <!-- Seleccione un direccion -->
                    <div class="col-md-6">
                    <label for="relacion_cargo_id_reg">Cargo</label>
                       <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <select class="form-control btn-round" name="relacion_cargo_id_reg" required="">


                                <?php
                                    if($direcciones->rowCount()>0){
                                        $direcciones = $direcciones->fetchAll();
                                        echo '<option value="" selected="">Seleccione un cargo</option>';
                                        //Ciclo para recorrer todos los equipos registrados en el sistema
                                        foreach ($direcciones as $rows){
                                            echo '<option value="'. $ins_direccion->encryption($rows['cargo_id']).'">'.$rows['cargo_nombre']. " (".$rows['direccion_nombre'].')</option>';
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
