<?php
if($_SESSION['privilegio_tor']<1 || $_SESSION['privilegio_tor']>2 || $_SESSION['tipo_tor']==3 || $_SESSION['tipo_tor']==4) {
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
            <h3 class="animated fadeInLeft">Direccion / Editar</h3>
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
<!-- Inicio de Codigo para actualizar los datos del usuario -->
<div class="container-fluid">
    <?php
    require_once "./controladores/direccionControlador.php";
    $ins_direccion = new direccionControlador();

    $datos_direccion = $ins_direccion->datos_direccion_controlador("Unico", $pagina[1]);

    if($datos_direccion->rowCount()==1){
        $campos = $datos_direccion->fetch();
    ?>

    <form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/direccionAjax.php" method="POST" data-form="update" autocomplete="off">
        <input type="hidden" name="direccion_id_up" value="<?php echo $pagina[1];?>">
        <fieldset>
            <legend><li class="fa-black-tie fa"></li> &nbsp; Información de la direccion</legend>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-8">
                    <label for="direccion_nombre">Nombre</label>
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}" class="form-text" name="direccion_nombre_up" id="direccion_nombre" value="<?php echo $campos['direccion_nombre']; ?>" maxlength="150" required="">
                            <span class="bar"></span>

                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <!-- SELECCIONE UN GABINETE -->
                        <label for="gabinete">Gabinetes</label>
                       <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <select class="form-control btn-round" name="gabinete_nombre_up" required="">


                                <?php
                                    if($gabinetes->rowCount()>0){
                                        $gabinetes = $gabinetes->fetchAll();
                                        //Obtener gabinete actual
                                        $obt_nombre = $ins_gabinete->datos_gabinete_controlador("Unico", $ins_gabinete->encryption($campos['gabinete_id']));
                                        
                                        $nombre_gabinete = "";
                                        
                                        if($obt_nombre->rowCount()>0){
                                            $obt_nombre=$obt_nombre->fetch();
                                            $nombre_gabinete = $obt_nombre['gabinete_nombre'];
                                        }
                                        echo '<option value="'.$ins_gabinete->encryption($campos['gabinete_id']).'" selected="">'.$nombre_gabinete.' (Actual)</option>';
                                        //Ciclo para recorrer todos los equipos registrados en el sistema
                                        foreach ($gabinetes as $rows){
                                            echo '<option value="'. $ins_gabinete->encryption($rows['gabinete_id']).'">'.$rows['gabinete_nombre'].'.</option>';
                                        }
                                    }

                                ?>

                            </select>
                        </div>
                    </div>

                   <div class="col-md-12">
				  <label for="multimedia_archivo_perfil"><?php echo $campos['direccion_imagen'] . " (Actual) "?> Foto Perfil (286x180) Tipo Archivo: jpg, png.</label>
                        <div class="form-group form-animate-text" style="margin-top:5px !important;">

                            <input type="file" class="form-text btn-round" name="multimedia_perfil_up" id="multimedia_archivo_perfil">
                            <span class="bar"></span>

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
