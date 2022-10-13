<?php
if($_SESSION['privilegio_tor']<1 || $_SESSION['privilegio_tor']>3 || $_SESSION['tipo_tor']==3 || $_SESSION['tipo_tor']==4) {
  $lc->forzar_cierre_sesion_controlador();
  exit();
  }

//Obtener listado de todos los clubes registrados en el sistema
require_once './controladores/pasoControlador.php';
$ins_paso = new pasoControlador();
$pasoes = $ins_paso->datos_paso_controlador("Todos", 0);

?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Anexo / Agregar anexos / Nuevo</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a class="active" href="<?php echo SERVERURL; ?>anexo-new/">Nuevo anexo <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>anexo-list/">Lista de anexos <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>anexo-search/">Buscar anexo <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->

<div class="container-fluid">
    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/anexoAjax.php" method="POST" enctype="multipart/form-data" data-form="save" autocomplete="off">
        <fieldset>
            <legend><i class="far fa-address-card"></i> &nbsp; Información del anexo</legend>
            <div class="container-fluid">
                <div class="row">
                
                <!-- Nombre del anexo -->
                    <div class="col-md-12">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}" class="form-text" name="anexo_nombre_reg" id="anexo_descripcion" maxlength="150" required="">
                            <span class="bar"></span>
                            <label for="anexo_descripcion">Titulo del Anexo.</label>
                        </div>
                    </div>
                
                    <!-- Seleccionar un paso -->
                    <div class="col-md-6">
                    <label>Paso</label>
                       <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <select class="form-control btn-round" name="anexo_paso_reg" required="">


                                <?php
                                    if($pasoes->rowCount()>0){
                                        $pasoes = $pasoes->fetchAll();
                                        echo '<option value="" selected="">Seleccione un paso</option>';
                                        //Ciclo para recorrer todos los pasoes registrados en el sistema
                                        foreach ($pasoes as $rows){
                                            echo '<option value="'. $ins_paso->encryption($rows['paso_id']).'">'.$rows['paso_nombre'].'</option>';
                                        }
                                    }
                               ?>


                            </select>
                        </div>
                    </div>


                    <!-- Archivo de respaldo de la transferencia o anexo realizado -->
                   <div class="col-md-6">
                   <label for="anexo_archivo">Seleccione un Anexo</label>
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="file" class="form-text" name="anexo_archivo_reg" id="anexo_archivo" required="">
                            <span class="bar"></span>

                        </div>
                    </div>



                </div>
            </div>
        </fieldset>


        <p class="text-center" style="margin-top: 40px;">
            <button type="reset" class="btn btn-3d btn-warning btn-sm"><i class="fa-refresh fa"></i> &nbsp; LIMPIAR</button>
            &nbsp; &nbsp;
            <button type="submit" class="btn btn-3d btn-info btn-sm"><i class="fa-save fa"></i> &nbsp; GUARDAR</button>
        </p>
    </form>
</div>
