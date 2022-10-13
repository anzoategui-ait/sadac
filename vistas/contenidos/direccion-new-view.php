<?php
if($_SESSION['privilegio_tor']<1 || $_SESSION['privilegio_tor']>3 || $_SESSION['tipo_tor']==3 || $_SESSION['tipo_tor']==4) {
  $lc->forzar_cierre_sesion_controlador();
  exit();
  }
  
//Crear listado con todos los gabinetes
require_once './controladores/gabineteControlador.php';
$ins_gabinete = new gabineteControlador();
$gabinetes = $ins_gabinete->datos_gabinete_controlador("Todos",0);

?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Direccion / Crear Nuevo</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a class="active" href="<?php echo SERVERURL; ?>direccion-new/">Nueva direccion <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>direccion-list/">Lista de direcciones <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>direccion-search/">Buscar direccion <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->

<div class="container-fluid">
    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/direccionAjax.php" method="POST" data-form="save" autocomplete="off">
        <fieldset>
            <legend><i class="far fa-address-card"></i> &nbsp; Información para la direccion</legend>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-8">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,300}" class="form-text" name="direccion_nombre_reg" id="direccion_nombre" maxlength="300" required="">
                            <span class="bar"></span>
                            <label for="direccion_nombre">Nombre</label>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <!-- SELECCIONE UN GABINETE -->
                        <label for="gabinete">Gabinetes</label>
                       <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <select class="form-control btn-round" name="gabinete_nombre_reg" required="">


                                <?php
                                    if($gabinetes->rowCount()>0){
                                        $gabinetes = $gabinetes->fetchAll();
                                        echo '<option value="" selected="">Seleccione un gabinete</option>';
                                        //Ciclo para recorrer todos los equipos registrados en el sistema
                                        foreach ($gabinetes as $rows){
                                            echo '<option value="'. $ins_gabinete->encryption($rows['gabinete_id']).'">'.$rows['gabinete_nombre'].'.</option>';
                                        }
                                    }

                                ?>

                            </select>
                        </div>
                    </div>

                   	<!-- Foto de perfil de la direccion -->
				  <div class="col-md-12">
				  <label for="multimedia_archivo_perfil">Foto Direccion (286x180) Tipo Archivo: jpg, png.</label>
                        <div class="form-group form-animate-text" style="margin-top:5px !important;">

                            <input type="file" class="form-text btn-round" name="multimedia_perfil_reg" id="multimedia_archivo_perfil">
                            <span class="bar"></span>

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
