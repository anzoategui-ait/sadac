<?php
if($_SESSION['privilegio_tor']<1 || $_SESSION['privilegio_tor']>3 || $_SESSION['tipo_tor']==3 || $_SESSION['tipo_tor']==4) {
  $lc->forzar_cierre_sesion_controlador();
  exit();
  }

//Obtener listado de todas las municipioes registradas en el sistema
require_once './controladores/municipioControlador.php';
$ins_municipio = new municipioControlador();
$municipioes = $ins_municipio->datos_municipio_controlador("Todos", 0);

?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Parroquia / Crear Nuevo</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a class="active" href="<?php echo SERVERURL; ?>parroquia-new/">Nueva parroquia <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>parroquia-list/">Lista de parroquias <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>parroquia-search/">Buscar parroquia <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->

<div class="container-fluid">
    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/parroquiaAjax.php" method="POST" data-form="save" autocomplete="off">
        <fieldset>
            <legend><i class="far fa-address-card"></i> &nbsp; Información de la parroquia</legend>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}" class="form-text" name="parroquia_nombre_reg" id="parroquia_nombre" maxlength="150" required="">
                            <span class="bar"></span>
                            <label for="parroquia_nombre">Nombre</label>
                        </div>
                    </div>

                    <!-- Seleccione un municipio -->
                    <div class="col-md-6">
                    <label for="parroquia_nombre">Municipio</label>
                       <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <select class="form-control btn-round" name="municipio_nombre_reg" required="">


                                <?php
                                    if($municipioes->rowCount()>0){
                                        $municipioes = $municipioes->fetchAll();
                                        echo '<option value="" selected="">Seleccione un municipio</option>';
                                        //Ciclo para recorrer todos los equipos registrados en el sistema
                                        foreach ($municipioes as $rows){
                                            echo '<option value="'. $ins_municipio->encryption($rows['municipio_id']).'">'.$rows['municipio_nombre'].'.</option>';
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
