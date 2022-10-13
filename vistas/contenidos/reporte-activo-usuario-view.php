<?php 
 if ($_SESSION['privilegio_tor'] < 1 || $_SESSION['privilegio_tor'] > 3 || $_SESSION['tipo_tor']==4) {
        echo $lc->forzar_cierre_sesion_controlador();
        exit();
    }
    
    //Obtener Productos
    require_once "./controladores/productoControlador.php";
    $ins_producto = new productoControlador();
    
    //Obtener Usuarios
    require_once "./controladores/usuarioControlador.php";
    $ins_usuario = new usuarioControlador();
    
?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes / Activos vs Usuarios</h3>
            <p class="animated fadeInDown">
                Relación entre los activos vs usuarios, registrados en el sistema, el formato final es de tipo .pdf.
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->

<!-- Agregar logica para poder seleccionar una encuesta en especifico y seleccionar las fechas especificas -->
<div class="container-fluid">
    <form class="form-neon" action="<?php echo SERVERURL; ?>reporte/reporteusuarioproducto.php" method="POST" data-form="save" autocomplete="off">

        <fieldset>
            <legend><i class="fa fa-check-square-o"></i> &nbsp; Información del reporte</legend>
            <div class="container-fluid">
                <div class="row">

                    <!-- ACTIVOS -->
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="producto_estado" class="bmd-label-floating" style="color:#1F618D;"><b>USUARIOS</b></label>
                             <select class="form-control" name="usuario_id" id="usuario_id" required="">
                                <option value="<?php echo $ins_usuario->encryption(0);?>" selected="">Todos</option>
                                <!-- Obtener todas las encuestas registradas en el sistema -->
                                <?php
                                                                
                                $rs_usuario = $ins_usuario->datos_usuario_controlador("Todos", 0);
                                if($rs_usuario->rowCount()>0){
                                    $datos_usuarios = $rs_usuario->fetchAll();
                                    
                                    foreach($datos_usuarios as $rows){
                                        echo '<option value="'.$ins_usuario->encryption($rows['usuario_id']).'">'.$rows['usuario_nombre']. ', '. $rows['usuario_apellido']. '</option>';
                                    }
                                }
                                ?>
                                
                            </select>
                        </div>
                    </div>
                      
                    <!-- USUARIOS -->
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="" class="bmd-label-floating" style="color:#1F618D;"><b>ACTIVOS</b></label>
                            <select class="form-control" name="producto_id" id="producto_id" required="">
                                <option value="<?php echo $ins_producto->encryption(0);?>" selected="">Todos</option>
                                <!-- Obtener todas las encuestas registradas en el sistema -->
                                <?php
                                                                
                                $rs_producto = $ins_producto->datos_producto_controlador("Todos", 0);
                                if($rs_producto->rowCount()>0){
                                    $datos_producto = $rs_producto->fetchAll();
                                    
                                    foreach($datos_producto as $rows){
                                        echo '<option value="'.$ins_producto->encryption($rows['producto_id']).'">'.$rows['producto_nombre'].'</option>';
                                    }
                                }
                                ?>
                            </select>
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