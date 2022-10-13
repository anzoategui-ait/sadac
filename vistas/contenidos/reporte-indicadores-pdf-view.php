<?php 
 if ($_SESSION['privilegio_tor'] < 1 || $_SESSION['privilegio_tor'] > 3 || $_SESSION['tipo_tor']==4) {
        echo $lc->forzar_cierre_sesion_controlador();
        exit();
    }
    
//Obtener los indicadores 
require_once './controladores/indicadorControlador.php';
$ins_indicador = new indicadorControlador();

?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes / Indicadores</h3>
            <p class="animated fadeInDown">
                Totalizacion de los indicadores dentro de un rango, todos o un indicador en especifico, el formato final es de tipo .pdf.
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->

<!-- Agregar logica para poder seleccionar una encuesta en especifico y seleccionar las fechas especificas -->
<div class="container-fluid">
    <form class="form-neon" action="<?php echo SERVERURL; ?>reporte/reporteindicadorespdf.php" method="POST" data-form="save" autocomplete="off">

        <fieldset>
            <legend><i class="fa fa-check-square-o"></i> &nbsp; Información del reporte</legend>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="" class="bmd-label-floating" style="color:#1F618D;"><b>INDICADORES</b></label>
                            <select class="form-control" name="indicador_id" id="indicador_id" required="">
                                <option value="<?php echo $ins_indicador->encryption(0);?>" selected="">Todos</option>
                                <!-- Obtener todas las encuestas registradas en el sistema -->
                                <?php
                                                                
                                $indicadores = $ins_indicador->datos_indicador_controlador("Todos", 0);
                                if($indicadores->rowCount()>0){
                                    $indicadores = $indicadores->fetchAll();
                                    
                                    foreach($indicadores as $rows){
                                        echo '<option value="'.$ins_indicador->encryption($rows['indicador_id']).'">'.$rows['indicador_nombre'].'</option>';
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