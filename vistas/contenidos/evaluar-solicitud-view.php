<?php
if($_SESSION['privilegio_tor']<1 || $_SESSION['privilegio_tor']>3 || $_SESSION['tipo_tor']==3 ) {
  $lc->forzar_cierre_sesion_controlador();
  exit();
  }
  

?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Solicitud / Evaluar tiempo de respuesta y solucion dada.</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a class="active" href="<?php echo SERVERURL; ?>solicitud-new/">Nueva solicitud <span class="fa-angle-right fa"></span></a>
                <?php if($_SESSION['tipo_tor']!=4 ) { ?>
                <a href="<?php echo SERVERURL; ?>solicitudes-list/">Solicitudes <span class="fa-angle-right fa"></span></a>
                <?php } ?><a href="<?php echo SERVERURL; ?>solicitud-list/">Lista de solicitudes <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>solicitud-search/">Buscar solicitud <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->

<div class="container-fluid">
    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/solicitudAjax.php" method="POST" data-form="save" autocomplete="off">
        <input type="hidden" name="evaluar_solicitud_id_up" value="<?php echo $pagina[1]; ?>">
        <fieldset>
            <legend><i class="far fa-address-card"></i> &nbsp; Información de la evaluacion</legend>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <textarea type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,500}" class="form-text" name="evaluar_solicitud_descripcion_reg" id="solicitud_nombre" maxlength="500" required=""></textarea>
                            <span class="bar"></span>
                            <label for="solicitud_nombre">Breve descripcion de la evaluacion</label>
                        </div>
                    </div>

            
             <!-- Seleccione tiempo de respuesta -->
                    <div class="col-md-4">
                    <label for="cargo_nombre">Tiempo de Respuesta</label>
                       <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <select class="form-control btn-round" name="tiempo_respuesta_reg" required="">
                                <option value="" selected="">Seleccione como fue el tiempo de respuesta</option>
                                <option value="1">Malo</option>
                                <option value="2">Regular</option>
                                <option value="3">Normal</option>
                                <option value="4">Bueno</option>

                            </select>
                        </div>
                    </div>
             
             <!-- Seleccione tipo de solucion -->
                    <div class="col-md-4">
                    <label for="cargo_nombre">Tipo de Solucion</label>
                       <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <select class="form-control btn-round" name="tipo_solucion_reg" required="">

                                <option value="" selected="">Seleccione como fue el tipo de solucion</option>
                                <option value="1">Malo</option>
                                <option value="2">Regular</option>
                                <option value="3">Normal</option>
                                <option value="4">Bueno</option>

                            </select>
                        </div>
                    </div>
                    
                    </div>
                    </div>
        </fieldset>





     
      <p class="text-center" style="margin-top: 20px;">
            <button type="reset" class="btn btn-3d btn-warning btn-sm"><i class="fa-refresh fa"></i> &nbsp; LIMPIAR</button>
            &nbsp; &nbsp;
            <button type="submit" class="btn btn-3d btn-info btn-sm"><i class="fa-save fa"></i> &nbsp; ENVIAR EVALUACION</button>
        </p>
        
        </form>
     
</div>
