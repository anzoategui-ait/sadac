<?php
if($_SESSION['privilegio_tor']<1 || $_SESSION['privilegio_tor']>2 || $_SESSION['tipo_tor']==3 || $_SESSION['tipo_tor']==4) {
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
            <h3 class="animated fadeInLeft">Parroquia / Editar</h3>
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
<!-- Inicio de Codigo para actualizar los datos del usuario -->
<div class="container-fluid">
    <?php
    require_once "./controladores/parroquiaControlador.php";
    $ins_parroquia = new parroquiaControlador();

    $datos_parroquia = $ins_parroquia->datos_parroquia_controlador("Unico", $pagina[1]);

    if($datos_parroquia->rowCount()==1){
        $campos = $datos_parroquia->fetch();
    ?>

    <form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/parroquiaAjax.php" method="POST" data-form="update" autocomplete="off">
        <input type="hidden" name="parroquia_id_up" value="<?php echo $pagina[1];?>">
        <fieldset>
            <legend><li class="fa-black-tie fa"></li> &nbsp; Información de la parroquia</legend>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">
                    <label for="parroquia_nombre">Nombre</label>
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}" class="form-text" name="parroquia_nombre_up" id="parroquia_nombre" value="<?php echo $campos['parroquia_nombre']; ?>" maxlength="150" required="">
                            <span class="bar"></span>

                        </div>
                    </div>

                   <!-- Seleccione una municipio -->
                    <div class="col-md-6">
                    <label for="parroquia_nombre">Direccion</label>
                       <div class="form-group form-animate-text" style="margin-top:30px !important;">
                            <select class="form-control btn-round" name="municipio_nombre_up" required="">


                                <?php
                                    if($municipioes->rowCount()>0){
                                        $municipioes = $municipioes->fetchAll();
                                        //con el id del club obtener el nombre del club
                                        $rs_municipio = $ins_municipio->datos_municipio_controlador("Unico", $ins_municipio->encryption($campos['municipio_id']));
                                        $rs_municipio = $rs_municipio->fetch();
                                        $nombre_municipio = $rs_municipio['municipio_nombre'];
                                        echo '<option value="'.$ins_municipio->encryption($campos['municipio_id']).'" selected="">'.$nombre_municipio.' (Actual)</option>';
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