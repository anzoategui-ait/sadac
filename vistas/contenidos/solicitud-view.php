<?php
//crear listado de municipios y listado de oficios 
require_once './controladores/solicitudControlador.php';
$ins_solicitud = new solicitudControlador();

//obtener todos los municipios
require_once './controladores/municipioControlador.php';
$ins_municipio = new municipioControlador();
$municipios = $ins_municipio->datos_municipio_controlador("Todos", 0);

//Obtener listado de todas las parroquiaes registradas en el sistema
require_once './controladores/parroquiaControlador.php';
$ins_parroquia = new parroquiaControlador();
$parroquias = $ins_parroquia->datos_parroquia_controlador("Todos", 0);
?>
<div class="container-fluid"> <!-- wrapper -->
    <div class="col-md-8">
        <div class="panel panel-default">

            <div class="panel-body">

                <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/solicitudAjax.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                  <!--  <h3 class="animated fadeInLeft text-center">1 x 10 del Buen Gobierno.</h3> -->
                    <div class="col-md-12">
                        <div class="form-group form-animate-text" style="margin-top:5px !important;">
                            <textarea  pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,440}" class="form-text" name="usuario_solicitud_reg" id="solicitud" maxlength="450" required=""></textarea>
                            <span class="bar"></span>
                            <label for="club">Solicitud del Ciudadano | 1 x 10 del Buen Gobierno.</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group form-animate-text" style="margin-top:0px !important;">
                            <input type="text" pattern="[a-zA-ZÃ¡Ã©Ã­Ã³ÃºÃ�Ã‰Ã�Ã“ÃšÃ±Ã‘ ]{2,150}" class="form-text" name="usuario_nombre_apellido_reg" id="usuario_nombre" maxlength="150" required="">
                            <span class="bar"></span>
                            <label for="usuario_nombre">Nombres y Apellidos</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-animate-text" style="margin-top:0px !important;">
                            <input type="text" pattern="[0-9-vVeE]{6,30}" class="form-text" name="usuario_cedula_reg" id="usuario_cedula" maxlength="30" required="">
                            <span class="bar"></span>
                            <label for="usuario_cedula">Cedula</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-animate-text" style="margin-top:0px !important;">
                            <input type="date" class="form-text" name="usuario_fecha_nacimiento_reg" id="usuario_fecha_nacimiento" value="<?php echo date("Y-m-d"); ?>" required="">
                            <span class="bar"></span>
                            <label for="usuario_cedula">Fecha Nacimiento</label>
                        </div>
                    </div>

                   

                    <div class="col-md-6">
                        <div class="form-group form-animate-text" style="margin-top:0px !important;">
                            <input type="email" class="form-text" name="usuario_correo_reg" id="correo" maxlength="150" required="">
                            <span class="bar"></span>
                            <label for="correo">Correo Electronico</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-animate-text" style="margin-top:0px !important;">
                            <input type="text" pattern="[0-9()+-]{6,20}" class="form-text" name="usuario_telefono_reg" id="usuario_telefono" maxlength="20" required="">
                            <span class="bar"></span>
                            <label for="usuario_telefono">Teléfono</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-animate-text" style="margin-top:0px !important;">
                            
                            <select class="form-control btn-round" name="usuario_genero_reg" id="usuario_genero_reg" required="">
                            <option value="" selected="">Genero</option>
                            <option value="FEMENINO">Femenino</option>
                            <option value="MASCULINO">Masculino</option>

                    </select>

                        </div>
                    </div>

                    <!-- Seleccione un municipio -->
                    <div class="col-md-6">
                        <div class="form-group form-animate-text" style="margin-top:0px !important;">
                        <!--    <select class="form-control btn-round" name="municipio_nombre_reg" id="municipio_nombre_reg" onchange="seleccionar_parroquia($('#municipio_nombre_reg').val());return false;" required=""> -->

                            <select class="form-control btn-round" name="municipio_nombre_reg" id="municipio_nombre_reg" onchange="seleccionar_parroquia($('#municipio_nombre_reg').val());return false;" required="">

                                <?php
                                if ($municipios->rowCount() > 0) {
                                    $municipios = $municipios->fetchAll();
                                    echo '<option value="" selected="">Seleccione un municipio</option>';
                                    //Ciclo para recorrer todos los equipos registrados en el sistema
                                    foreach ($municipios as $rows) {
                                        echo '<option value="' . $ins_municipio->encryption($rows['municipio_id']) . '">' . $rows['municipio_nombre'] . '.</option>';
                                    }
                                }
                                ?>

                            </select>
                        </div>
                    </div>

                    <!-- PARROQUIA RECARGAR PAGINA -->
                    <div class="col-md-6">

                        <div id="resultado_parroquia">
                            <select class="form-control btn-round" name="parroquia_nombre_reg" id="parroquia">
                                <option value="">Selecciona una parroquia</option>
                                <!-- INICIAR LISTAR CATEGORIA-->
                            </select>
                        </div>
                    </div>

                  

                    <div class="col-md-12">
                        <div class="form-group form-animate-text" style="margin-top:0px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,50}" class="form-text" name="sector_nombre_reg" id="sector_nombre" maxlength="50" required="">
                            <span class="bar"></span>
                            <label for="sector_nombre">Sector</label>
                        </div>
                    </div>




                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-round btn-info">
                            <i class="fa fa-send"></i> &nbsp;
                            <span class="state">Enviar Solicitud</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Boton para consultar solicitud -->
    <div class="col-md-4">

        <a href="<?php echo SERVERURL . 'consulta/'; ?>"  class="btn btn-round btn-info"><i class="fa fa-search"></i> &nbsp;Consultar mi Solicitud</a>

    </div>
    <!-- Fin de consultar -->
    <br><br>
    <!-- Boton para consultar requisitos -->
    <div class="col-md-4">

        <a href="<?php echo SERVERURL . 'requisitos/'; ?>"  class="btn btn-round btn-info"><i class="fa fa-search"></i> &nbsp;Consultar Requisitos</a>

    </div>
    <!-- Fin de consultar -->

</div>


<!-- AGREGAR SCRIPT PARA ACTUALIZAR PARROQUIA -->
<script>
    function seleccionar_parroquia(id) {
        var parametros = {
            "id": id,
        };
        $.ajax({
            data: parametros,
            url: '../controladores/seleccionar_parroquia.php',
            type: 'post',
            beforeSend: function () {
                $("#resultado_parroquia").html("Procesando, espere por favor...");
            },
            success: function (response) {
                $("#resultado_parroquia").html(response);
            }
        });
    }

</script>