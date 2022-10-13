<?php 
 if ($_SESSION['privilegio_tor'] < 1 || $_SESSION['privilegio_tor'] > 3 || $_SESSION['tipo_tor']==4) {
        echo $lc->forzar_cierre_sesion_controlador();
        exit();
    }
    
//Obtener los direcciones 
require_once './controladores/direccionControlador.php';
$ins_direccion = new direccionControlador();

?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes / Direcciones</h3>
            <p class="animated fadeInDown">
                Totalizacion de las solicitudes realizadas por las diferentes unidades administrativas, detro de un rango de tiempo especifico, el formato final es de tipo .pdf.
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->

<!-- Agregar logica para poder seleccionar una encuesta en especifico y seleccionar las fechas especificas -->
<div class="container-fluid">
    <form class="form-neon" action="<?php echo SERVERURL; ?>reporte/reportedireccionespdf.php" method="POST" data-form="save" autocomplete="off">

        <fieldset>
            <legend><i class="fa fa-check-square-o"></i> &nbsp; Información del reporte</legend>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="" class="bmd-label-floating" style="color:#1F618D;"><b>DIRECCIONES</b></label>
                            <select class="form-control" name="direccion_id" id="direccion_id" required="">
                                <option value="<?php echo $ins_direccion->encryption(0);?>" selected="">Todos</option>
                                <!-- Obtener todas las encuestas registradas en el sistema -->
                                <?php
                                                                
                                $direcciones = $ins_direccion->datos_direccion_controlador("Todos", 0);
                                if($direcciones->rowCount()>0){
                                    $direcciones = $direcciones->fetchAll();
                                    
                                    foreach($direcciones as $rows){
                                        echo '<option value="'.$ins_direccion->encryption($rows['direccion_id']).'">'.$rows['direccion_nombre'].'</option>';
                                    }
                                }
                                ?>
                                
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="fecha_inicio" class="bmd-label-floating" style="color:#1F618D;"><b>FECHA INICIAL</b></label>
                            <input type="date"  class="form-control" name="fecha_inicio" value="<?php echo date("Y-m-d"); ?>" id="fecha_inicio" required="">
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="fecha_final" class="bmd-label-floating" style="color:#1F618D;"><b>FECHA FINAL</b></label>
                            <input type="date"  class="form-control" name="fecha_final" value="<?php echo date("Y-m-d"); ?>" id="fecha_final" required="">
                        </div>
                    </div>

                </div>
            </div>
        </fieldset>
        <p class="text-center" style="margin-top: 40px;">
            <button type="reset" class="btn btn-round btn-warning btn-sm"><i class="fa fa-trash"></i> &nbsp; LIMPIAR</button>
            &nbsp; &nbsp;
            <button type="submit" class="btn btn-round btn-primary btn-sm"><i class="fa fa-save"></i> &nbsp; GENERAR REPORTE</button>
        </p>
    </form>
</div>