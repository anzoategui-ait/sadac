<?php
if($_SESSION['privilegio_tor']<1 || $_SESSION['privilegio_tor']>4 || $_SESSION['tipo_tor']==3 || $_SESSION['tipo_tor']==4) {
  $lc->forzar_cierre_sesion_controlador();
  exit();
  } 
?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Municipio / agregar nuevo municipio</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a class="active" href="<?php echo SERVERURL; ?>municipio-new/">Nuevo Municipio <span class="fa-angle-right fa"></span></a> 
                <a href="<?php echo SERVERURL; ?>municipio-list/">Lista de Municipios <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>municipio-search/">Buscar Municipios <span class="fa-angle-right fa"></span></a>
              </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->

<div class="container-fluid">
    <form class="cmxform FormularioAjax" action="<?php echo SERVERURL; ?>ajax/municipioAjax.php" method="POST" data-form="save" autocomplete="off">
        <fieldset>
            <legend><i class="far fa-address-card"></i> &nbsp; Información Principal</legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}" class="form-text" name="municipio_nombre_reg" id="municipio_nombre" maxlength="150" required="">
                            <span class="bar"></span>
                            <label for="municipio_nombre">Nombre del Municipio</label>
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