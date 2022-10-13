<?php
if($_SESSION['privilegio_tor']<1 || $_SESSION['privilegio_tor']>3 || $_SESSION['tipo_tor']==3 || $_SESSION['tipo_tor']==4) {
  $lc->forzar_cierre_sesion_controlador();
  exit();
  }

//Obtener listado de todas las usuarioes registradas en el sistema
require_once './controladores/usuarioControlador.php';
$ins_usuario = new usuarioControlador();
$usuarioes = $ins_usuario->datos_usuario_controlador("Todos", 0);

?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">cubiculo / Crear Nuevo</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a class="active" href="<?php echo SERVERURL; ?>cubiculo-new/">Nuevo cubiculo <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>cubiculo-list/">Lista de cubiculos <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>cubiculo-search/">Buscar cubiculo <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->

<div class="container-fluid">
    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/cubiculoAjax.php" method="POST" data-form="save" autocomplete="off">
        <fieldset>
            <legend><i class="far fa-address-card"></i> &nbsp; Información del cubiculo</legend>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}" class="form-text" name="cubiculo_nombre_reg" id="cubiculo_nombre" maxlength="150" required="">
                            <span class="bar"></span>
                            <label for="cubiculo_nombre">Nombre</label>
                        </div>
                    </div>

                    <!-- Seleccione un usuario -->
                    <div class="col-md-6">
                    <label for="cubiculo_nombre">usuario</label>
                       <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <select class="form-control btn-round" name="usuario_nombre_reg" required="">


                                <?php
                                    if($usuarioes->rowCount()>0){
                                        $usuarioes = $usuarioes->fetchAll();
                                        echo '<option value="" selected="">Seleccione una usuario</option>';
                                        //Ciclo para recorrer todos los equipos registrados en el sistema
                                        foreach ($usuarioes as $rows){
                                            echo '<option value="'. $ins_usuario->encryption($rows['usuario_id']).'">'.$rows['usuario_nombre'].'.</option>';
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
