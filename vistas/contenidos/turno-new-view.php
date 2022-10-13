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
            <h3 class="animated fadeInLeft">Turno / Crear Nuevo</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a class="active" href="<?php echo SERVERURL; ?>turno-new/">Nuevo turno <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>turno-list/">Lista de turnos <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>turno-search/">Buscar turno <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->

<div class="container-fluid">
    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/turnoAjax.php" method="POST" data-form="save" autocomplete="off">
        <fieldset>
            <legend><i class="far fa-address-card"></i> &nbsp; Información del ciudadano en turno</legend>
            <div class="container-fluid">
                <div class="row">

                <div class="col-md-6">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,30}" class="form-text" name="turno_cedula_reg" id="turno_cedula" maxlength="30" required="">
                            <span class="bar"></span>
                            <label for="turno_cedula">Cedula</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}" class="form-text" name="turno_nombre_reg" id="turno_nombre" maxlength="150" required="">
                            <span class="bar"></span>
                            <label for="turno_nombre">Nombre</label>
                        </div>
                    </div>

                    <!-- Area de text para colocar la descripcion -->
                    <div class="col-md-6">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <textarea type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,500}" class="form-text" name="turno_descripcion_reg" id="turno_descripcion" maxlength="500" required=""></textarea>
                            <span class="bar"></span>
                            <label for="turno_descripcion">Descripcion</label>
                        </div>
                    </div>

                     <!-- Agregar la fecha solo si es usuario con todos los permisos -->
                     <?php  if($_SESSION['privilegio_tor']==1) {?>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="fecha_inicio" class="bmd-label-floating" style="color:#1F618D;"><b>FECHA</b></label>
                            <input type="date"  class="form-control" name="turno_fecha_reg" value="<?php echo date("Y-m-d"); ?>" id="fecha">
                        </div>
                    </div>   
                    <?php  } else { ?>   
                        <div class="form-group">          
                        <input type="hidden" name="turno_fecha_reg" value="<?php echo date("Y-m-d"); ?>">
                        </div>
                        <?php  } ?> 
                       <!-- Fin agregar fecha manual --> 


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
