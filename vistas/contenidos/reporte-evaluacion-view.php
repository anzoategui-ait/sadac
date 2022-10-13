<?php 
 if ($_SESSION['privilegio_tor'] < 1 || $_SESSION['privilegio_tor'] > 3 || $_SESSION['tipo_tor']==4) {
        echo $lc->forzar_cierre_sesion_controlador();
        exit();
    }
    
    //Obtener Actividades
    require_once "./controladores/actividadControlador.php";
    $ins_actividad = new actividadControlador();
    
    //Obtener Operadores
    require_once "./controladores/productoControlador.php";
    $ins_producto = new productoControlador();
    
?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes / Evaluacion Final</h3>
            <p class="animated fadeInDown">
                Reporte par mostrar la percepcion final de la solucion dada a una solicitud, tanto en el tiempo de respuesta como en el tipo de solucion, el formato final es de tipo .pdf.
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->

<!-- Agregar logica para poder seleccionar una encuesta en especifico y seleccionar las fechas especificas -->
<div class="container-fluid">
    <form class="form-neon" action="<?php echo SERVERURL; ?>reporte/reporteevaluacion.php" method="POST" data-form="save" autocomplete="off">

        <fieldset>
            <legend><i class="fa fa-check-square-o"></i> &nbsp; Información del reporte</legend>
            <div class="container-fluid">
                <div class="row">

                    <!-- Usuarios -->
                      <!-- Municipio -->
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="actividad_estado" class="bmd-label-floating" style="color:#1F618D;"><b>TIEMPO DE RESPUESTA</b></label>
                             <select class="form-control" name="tiempo_id" id="tiempo_id" required="">
                                <option value="<?php echo $ins_producto->encryption(0);?>" selected="">Todos los valores</option>
                                <option value="<?php echo $ins_producto->encryption(1);?>" >Malo</option>
                                <option value="<?php echo $ins_producto->encryption(2);?>" >Regular</option>
                                <option value="<?php echo $ins_producto->encryption(3);?>" >Normal</option>
                                <option value="<?php echo $ins_producto->encryption(4);?>" >Bueno</option>
                             
                            </select>
                        </div>
                    </div>
                      
                    <!-- ACTIVIDADES -->
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="" class="bmd-label-floating" style="color:#1F618D;"><b>TIPO DE SOLUCION</b></label>
                            <select class="form-control" name="solucion_id" id="solucion_id" required="">
                                <option value="<?php echo $ins_producto->encryption(0);?>" selected="">Todos los valores</option>
                                <option value="<?php echo $ins_producto->encryption(1);?>" >Malo</option>
                                <option value="<?php echo $ins_producto->encryption(2);?>" >Regular</option>
                                <option value="<?php echo $ins_producto->encryption(3);?>" >Normal</option>
                                <option value="<?php echo $ins_producto->encryption(4);?>" >Bueno</option>
                                
                            </select>
                        </div>
                    </div>
                    
                  

                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="fecha_inicio" class="bmd-label-floating" style="color:#1F618D;"><b>FECHA INICIAL</b></label>
                            <input type="date"  class="form-control" name="fecha_inicio" value="<?php echo date("Y-m-d"); ?>" id="fecha_inicio" required="">
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
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