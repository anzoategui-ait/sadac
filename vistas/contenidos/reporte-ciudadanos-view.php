<?php 
 if ($_SESSION['privilegio_tor'] < 1 || $_SESSION['privilegio_tor'] > 3 || $_SESSION['tipo_tor']==4) {
        echo $lc->forzar_cierre_sesion_controlador();
        exit();
    }
    
    //Obtener parroquiaes
    require_once "./controladores/municipioControlador.php";
    $ins_municipio = new municipioControlador();
    
    //Obtener Operadores
    require_once "./controladores/parroquiaControlador.php";
    $ins_parroquia = new parroquiaControlador();

     //Obtener Operadores
     require_once "./controladores/sectorControlador.php";
     $ins_sector = new sectorControlador();
    
?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes / CIUDADANOS</h3>
            <p class="animated fadeInDown">
                Ciudadanos beneficiados en la direccion de Atencion al Ciudadano, el formato final es de tipo .pdf.
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->

<!-- Agregar logica para poder seleccionar una encuesta en especifico y seleccionar las fechas especificas -->
<div class="container-fluid">
    <form class="form-neon" action="<?php echo SERVERURL; ?>reporte/reporteciudadanos.php" method="POST" data-form="save" autocomplete="off">

        <fieldset>
            <legend><i class="fa fa-check-square-o"></i> &nbsp; Información del reporte</legend>
            <div class="container-fluid">
                <div class="row">

                    <!-- parroquias -->
                      <!-- Municipio -->
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="parroquia_estado" class="bmd-label-floating" style="color:#1F618D;"><b>MUNICIPIOS</b></label>
                             <select class="form-control" name="municipio_id" id="municipio_id">
                                <option value="0" selected="">Todos</option>
                                <!-- Obtener todas las encuestas registradas en el sistema -->
                                <?php
                                                                
                                $rs_municipios = $ins_municipio->datos_municipio_controlador("Todos", 0);
                                if($rs_municipios->rowCount()>0){
                                    $datos_municipios = $rs_municipios->fetchAll();
                                    
                                    foreach($datos_municipios as $rows){
                                        echo '<option value="'. $rows['municipio_id'] .'">'.$rows['municipio_nombre'].'</option>';
                                    }
                                }
                                ?>
                                
                            </select>
                        </div>
                    </div>
                      
                    <!-- PARROQUIAS -->
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="" class="bmd-label-floating" style="color:#1F618D;"><b>PARROQUIAS</b></label>
                            <select class="form-control" name="parroquia_id" id="parroquia_id">
                                <option value="0" selected="">Todas</option>
                                <!-- Obtener todas las encuestas registradas en el sistema -->
                                <?php
                                                                
                                $rs_parroquia = $ins_parroquia->datos_parroquia_controlador("Todos", 0);
                                if($rs_parroquia->rowCount()>0){
                                    $datos_parroquia = $rs_parroquia->fetchAll();
                                    
                                    foreach($datos_parroquia as $rows){
                                        echo '<option value="'. $rows['parroquia_id'] .'">'.$rows['parroquia_nombre'].'</option>';
                                    }
                                }
                                ?>
                                
                            </select>
                        </div>
                    </div>

                     <!-- SECTOR -->
                     <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="" class="bmd-label-floating" style="color:#1F618D;"><b>SECTOR</b></label>
                            <select class="form-control" name="sector_id" id="sector_id">
                                <option value="0" selected="">Todos</option>
                                <!-- Obtener todas las encuestas registradas en el sistema -->
                                <?php
                                                                
                                $rs_sector = $ins_sector->datos_sector_controlador("Todos", 0);
                                if($rs_sector->rowCount()>0){
                                    $datos_sector = $rs_sector->fetchAll();
                                    
                                    foreach($datos_sector as $rows){
                                        echo '<option value="'. $rows['sector_id'] .'">'.$rows['sector_nombre'].'</option>';
                                    }
                                }
                                ?>
                                
                            </select>
                        </div>
                    </div>
                    
                  
                    <!-- genero -->
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="" class="bmd-label-floating" style="color:#1F618D;"><b>GENERO</b></label>
                            <select class="form-control" name="genero_id" id="genero_id">
                                <option value="0" selected="">TODOS</option>
                                <option value="FEMENINO">Femenino</option>
                                <option value="MASCULINO">Masculino</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="fecha_inicio" class="bmd-label-floating" style="color:#1F618D;"><b>FECHA INICIAL</b></label>
                            <input type="date"  class="form-control" name="fecha_inicio" value="<?php echo date("Y-m-d"); ?>" id="fecha_inicio">
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="fecha_final" class="bmd-label-floating" style="color:#1F618D;"><b>FECHA FINAL</b></label>
                            <input type="date"  class="form-control" name="fecha_final" value="<?php echo date("Y-m-d"); ?>" id="fecha_final">
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