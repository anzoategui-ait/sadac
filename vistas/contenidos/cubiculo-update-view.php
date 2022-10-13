<?php
if($_SESSION['privilegio_tor']<1 || $_SESSION['privilegio_tor']>2 || $_SESSION['tipo_tor']==3 || $_SESSION['tipo_tor']==4) {
  $lc->forzar_cierre_sesion_controlador();
  exit();
  }
  
  //Obtener listado de todas las usuarioes registradas en el sistema
require_once './controladores/usuarioControlador.php';
$ins_usuario = new usuarioControlador();
$usuarioes = $ins_usuario->datos_usuario_controlador("Todos", 0);


?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">cubiculo / Editar</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>cubiculo-new/">Nuevo cubiculo <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>cubiculo-list/">Lista de cubiculos <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>cubiculo-search/">Buscar cubiculo <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->
<!-- Inicio de Codigo para actualizar los datos del usuario -->
<div class="container-fluid">
    <?php
    require_once "./controladores/cubiculoControlador.php";
    $ins_cubiculo = new cubiculoControlador();

    $datos_cubiculo = $ins_cubiculo->datos_cubiculo_controlador("Unico", $pagina[1]);

    if($datos_cubiculo->rowCount()==1){
        $campos = $datos_cubiculo->fetch();
    ?>

    <form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/cubiculoAjax.php" method="POST" data-form="update" autocomplete="off">
        <input type="hidden" name="cubiculo_id_up" value="<?php echo $pagina[1];?>">
        <fieldset>
            <legend><li class="fa-black-tie fa"></li> &nbsp; Información de la cubiculo</legend>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">
                    <label for="cubiculo_nombre">Nombre</label>
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}" class="form-text" name="cubiculo_nombre_up" id="cubiculo_nombre" value="<?php echo $campos['cubiculo_nombre']; ?>" maxlength="150" required="">
                            <span class="bar"></span>

                        </div>
                    </div>

                   <!-- Seleccione una usuario -->
                    <div class="col-md-6">
                    <label for="cubiculo_nombre">usuario</label>
                       <div class="form-group form-animate-text" style="margin-top:30px !important;">
                            <select class="form-control btn-round" name="usuario_nombre_up" required="">


                                <?php
                                    if($usuarioes->rowCount()>0){
                                        $usuarioes = $usuarioes->fetchAll();
                                        //con el id del club obtener el nombre del club
                                        $rs_usuario = $ins_usuario->datos_usuario_controlador("Unico", $ins_usuario->encryption($campos['usuario_id']));
                                        $rs_usuario = $rs_usuario->fetch();
                                        $nombre_usuario = $rs_usuario['usuario_nombre'];
                                        echo '<option value="'.$ins_usuario->encryption($campos['usuario_id']).'" selected="">'.$nombre_usuario.' (Actual)</option>';
                                        //Ciclo para recorrer todos los equipos registrados en el sistema
                                        foreach ($usuarioes as $rows){
                                            echo '<option value="'. $ins_usuario->encryption($rows['usuario_id']).'">'.$rows['usuario_nombre'].'.</option>';
                                        }
                                    }

                                ?>

                            </select>
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
