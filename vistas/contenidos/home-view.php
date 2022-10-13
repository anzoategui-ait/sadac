<?php
if ($_SESSION['privilegio_tor'] < 1 || $_SESSION['privilegio_tor'] > 3) {
    $lc->forzar_cierre_sesion_controlador();
    exit();
}

require_once './controladores/homeControlador.php';
$ins_home = new homeControlador();
//Obtener valores estadisticos para las primeras cuatro cajas
$solicitudes_online = $ins_home->datos_solicitud_controlador("Online", 0);
$total_solicitudes = $ins_home->datos_solicitud_controlador("Todos", 0);
$total_finalizados = $ins_home->datos_solicitud_controlador("Finalizados", 0);
$total_en_procesos = $ins_home->datos_solicitud_controlador("EnProceso", 0);
$total_sin_procesar = $ins_home->datos_solicitud_controlador("SinProcesar", 0);

//Obtener las cadenas para las graficas de las actividades solicitadas y de las solicitudes finalizadas
$cadenas_grafica = $ins_home->cadena_grafica_solicitudes_controlador();
$cad_total_solicitadas = $cadenas_grafica['Solicitadas'];
$cad_total_finalizadas = $cadenas_grafica['Finalizadas'];

//Obtener todas las actividades
$actividades = $ins_home->obtener_datos_home_actividad_controlador();

$indicadores = $ins_home->obtener_datos_home_indicador_controlador();

$gabinetes = $ins_home->obtener_datos_home_gabinete_controlador();

$direcciones = $ins_home->obtener_datos_home_direccion_controlador();

//Obtener Todos los Municipios
$municipios = $ins_home->obtener_datos_municipios_controlador();

$mapa = $ins_home->obtener_datos_mapa_controlador();

//Obtener todos los usuarios

$usuarios = $ins_home->obtener_datos_home_operador_controlador();

// obtener feedback
$datos_feedback = $ins_home->home_feedback_controlador();


?>

<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Resumen Estadistico</h3>
            <h5 class="animated fadeInLeft">Total Solicitudes Online: <?php echo $solicitudes_online->rowCount(); ?></h5>

        </div>
    </div>
</div>


<!-- Fin agregar encabezado para la vista -->

<!-- CONTENEDOR PRINCIPAL -->
<div class="container-fluid">
    <!-- RESUMEN DE SOLICITUDES -->
    <div class="row">
        <div class="col-md-3">
            <div class="panel box-v1">
                <div class="panel-heading bg-green border-none">

                </div>
                <div class="panel-body text-center">
                    <h1><?php echo $total_solicitudes->rowCount(); ?></h1>
                    <p>Actividades Solicitadas</p>
                    <hr/>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel box-v1">
                <div class="panel-heading bg-yellow border-none">

                </div>
                <div class="panel-body text-center">
                    <h1><?php echo $total_finalizados->rowCount(); ?></h1>
                    <p>Actividades Finalizadas</p>
                    <hr/>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel box-v1">
                <div class="panel-heading bg-danger border-none">

                </div>
                <div class="panel-body text-center">
                    <h1><?php echo $total_en_procesos->rowCount(); ?></h1>
                    <p>Actividades en procesos</p>
                    <hr/>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel box-v1">
                <div class="panel-heading bg-blue border-none">

                </div>
                <div class="panel-body text-center">
                    <h1><?php echo $total_sin_procesar->rowCount(); ?></h1>
                    <p>Actividades Pendientes</p>
                    <hr/>
                </div>
            </div>
        </div>

    </div>

    <div class="container-fluid">
<?php
require_once "./controladores/turnoControlador.php";
$ins_turno = new turnoControlador();
echo $ins_turno->paginador_turno_controlador($pagina[1], 7, $_SESSION['privilegio_tor'], $pagina[0], "");
?>
</div>

    <!-- Resumen del tipo de respuestas -->
    <div class="row">
        <div class="col-md-3">
            <div class="panel box-v1">
                <div class="panel-heading bg-danger border-none">

                </div>
                <div class="panel-body text-center">
                    <p>Tiempo de Respuesta: Malo</p>
                    <h1><?php echo $datos_feedback['porc_tiempo_malo']; ?> %</h1>
                    <p>Tipo de Solucion: Malo</p>
                    <h1><?php echo $datos_feedback['porc_sol_malo']; ?> %</h1>
                    <hr/>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel box-v1">
                <div class="panel-heading bg-yellow border-none">

                </div>
                <div class="panel-body text-center">
                    <p>Tiempo de Respuesta: Regular</p>
                    <h1><?php echo $datos_feedback['porc_tiempo_regular']; ?> %</h1>
                    <p>Tipo de Solucion: Regular</p>
                    <h1><?php echo $datos_feedback['porc_sol_regular']; ?> %</h1>
                    <hr/>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel box-v1">
                <div class="panel-heading bg-green border-none">

                </div>
                <div class="panel-body text-center">
                    <p>Tiempo de Respuesta: Normal</p>
                     <h1><?php echo $datos_feedback['porc_tiempo_normal']; ?> %</h1>
                    <p>Tipo de Solucion: Normal</p>
                    <h1><?php echo $datos_feedback['porc_sol_normal']; ?> %</h1>
                    <hr/>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel box-v1">
                <div class="panel-heading bg-blue border-none">

                </div>
                <div class="panel-body text-center">
                    <p>Tiempo de Respuesta: Bueno</p>
                     <h1><?php echo $datos_feedback['porc_tiempo_bueno']; ?> %</h1>
                    <p>Tipo de Solucion: Bueno</p>
                     <h1><?php echo $datos_feedback['porc_sol_bueno']; ?> %</h1>
                    
                    <hr/>
                </div>
            </div>
        </div>

    </div>



    <!-- Grafica Solicitudes realizadas y solicitudes finalizadas -->
    <div class="row">

        <!-- Area Estadisticas de solicitudes realizadas anualmente -->
        <div class="col-md-12">
            <div class="panel">
                <!-- Card Header - Dropdown -->
                <div class="panel-heading bg-white border-none">
                    <h4>Solicitudes Anuales</h4>
                    <input type="hidden" id="solicitudes_anuales" value="<?PHP echo "" . $cad_total_solicitadas; ?>">
                    <input type="hidden" id="solicitudes_finalizadas" value="<?PHP echo "" . $cad_total_finalizadas; ?>">

                </div>
                <!-- Card Body -->
                <div class="panel-body">
                    <div class="chart-area">
                        <canvas id="areaSolicitudes"></canvas>
                    </div>
                    <hr>
                    Solicitudes realizadas vs solicitudes finalizadas.
                </div>
            </div> 
        </div>

    </div>

    <!-- Tabla con solicitudes pendientes -->
    <!-- Codigo para agregar el listado de clubs registrados en el sistema -->
    <div class="row">

        <div class="container-fluid">
            <?php
            require_once "./controladores/solicitudControlador.php";
            $ins_solicitud = new solicitudControlador();
            echo $ins_solicitud->paginador_solicitud_ciudadano_home_controlador($pagina[1], 10, $_SESSION['privilegio_tor'], $pagina[0], "sin procesar");
            ?>

        </div>
    </div>

    <!-- MAPA COLOCANDO LAS SOLICITUDES POR MUNICIPIOS -->
    <div class="row">
        <!-- VARIABLES OCULTAS QUE ALIMENTARAN EL MAPA -->
        <?php
        if ($mapa->rowCount() > 0) {
            $mapa = $mapa->fetchAll();

            foreach ($mapa as $rows) {
                ?>
                <input type="hidden" id="municipio_<?PHP echo $rows['municipio_nombre']; ?>" value="<?PHP echo '<h2>Municipio ' . $rows['municipio_nombre'] . '</h2><p>Cantidad de Solicitudes: ' . $rows['mapa_cantidad'] . ', Representa: ' . number_format($rows['mapa_porcentaje'], 2, ",", ".") . '%</p>'; ?>"> 
                <?php
            }
        }
        ?>
        <div class="col-md-12">

            <div class="panel box-v3">

                <div class="panel-body table-responsive">
                    <div id="mi-mapa"></div>
                    <!-- para el mapa -->
                    <script src="<?php echo SERVERURL; ?>leaflet/js/visorMapa.js"></script>
                </div>
            </div>

        </div>

    </div>

    <!-- INICIO MUNICIPIOS -->
    <div class="row">


        <!-- MNUNICIPIO -->
        <div class="col-md-6">
            <div class="panel box-v3">
                <div class="panel-heading bg-white border-none">
                    <h4>MUNICIPIOS</h4>

                </div>
                <div class="panel-body">

                    <?php
                    if ($municipios->rowCount() > 0) {

                        $municipios = $municipios->fetchAll();

                        foreach ($municipios as $rows) {
                            //ICONO PARA CADA ACTIVIDAD
                            $icono = rand(1, 5);
                            $fondo_icono = "";
                            $fondo_barra = "";
                            if ($icono == 1) {
                                $fondo_icono = "icon-folder";
                                $fondo_barra = "progress-bar";
                            }
                            if ($icono == 2) {
                                $fondo_icono = "icon-pie-chart";
                                $fondo_barra = "progress-bar progress-bar-success";
                            }
                            if ($icono == 3) {
                                $fondo_icono = "icon-energy";
                                $fondo_barra = "progress-bar progress-bar-info";
                            }
                            if ($icono == 4) {
                                $fondo_icono = "icon-user";
                                $fondo_barra = "progress-bar progress-bar-warning";
                            }
                            if ($icono == 5) {
                                $fondo_icono = "icon-fire";
                                $fondo_barra = "progress-bar progress-bar-danger";
                            }
                            //OBTENER EL VALOR TOTAL DE LAS RECURRENCIAS DE DIRECCION EN ESPECIFICO

                            if ($rows['mapa_porcentaje'] != 0) {
                                ?>
                                <div class="media">


                                    <div class="media-left">
                                        <span class="<?php echo $fondo_icono; ?> icons" style="font-size:2em;"></span>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="media-heading"><?php echo $rows['municipio_nombre'] . " (" . number_format($rows['mapa_porcentaje'], 2, ",", ".") . "%)"; ?></h5>
                                        <div class="progress progress-mini">
                                            <div class="<?php echo $fondo_barra; ?>" role="progressbar" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $rows['mapa_porcentaje']; ?>%;">
                                                <span class="sr-only"><?php echo number_format($rows['mapa_porcentaje'], 2, ",", "."); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }
                        }
                    }
                    ?>
                </div>
                <div class="panel-footer bg-white border-none">
                    <center>
                        <a href="<?php echo SERVERURL; ?>reporte-municipio-pdf/" class="btn btn-primary box-shadow-none">descargar como pdf</a>
                    </center>
                </div>
            </div>
        </div>

        <!-- FIN MUNICIPIO -->

          <!-- INDICADOR -->
          <div class="col-md-6">
            <div class="panel box-v3">
                <div class="panel-heading bg-white border-none">
                    <h4>INDICADORES</h4>
                </div>
                <div class="panel-body">

                    <?php
                    if ($indicadores->rowCount() > 0) {

                        $indicadores = $indicadores->fetchAll();

                        foreach ($indicadores as $rows) {
                            //ICONO PARA CADA ACTIVIDAD
                            $icono = rand(1, 5);
                            $fondo_icono = "";
                            $fondo_barra = "";
                            if ($icono == 1) {
                                $fondo_icono = "icon-folder";
                                $fondo_barra = "progress-bar";
                            }
                            if ($icono == 2) {
                                $fondo_icono = "icon-pie-chart";
                                $fondo_barra = "progress-bar progress-bar-success";
                            }
                            if ($icono == 3) {
                                $fondo_icono = "icon-energy";
                                $fondo_barra = "progress-bar progress-bar-info";
                            }
                            if ($icono == 4) {
                                $fondo_icono = "icon-user";
                                $fondo_barra = "progress-bar progress-bar-warning";
                            }
                            if ($icono == 5) {
                                $fondo_icono = "icon-fire";
                                $fondo_barra = "progress-bar progress-bar-danger";
                            }

                            if ($rows['home_indicador_porcentaje'] != 0) {
                                ?>
                                <div class="media">
                                    <div class="media-left">
                                        <span class="<?php echo $fondo_icono; ?> icons" style="font-size:2em;"></span>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="media-heading"><?php echo $rows['indicador_nombre'] . " (" . number_format($rows['home_indicador_porcentaje'], 2, ",", ".") . "%)"; ?></h5>
                                        <div class="progress progress-mini">
                                            <div class="<?php echo $fondo_barra; ?>" role="progressbar" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $rows['home_indicador_porcentaje']; ?>%;">
                                                <span class="sr-only"><?php echo number_format($rows['home_indicador_porcentaje'], 2, ",", "."); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }
                        }
                    }
                    ?>
                </div>
                <div class="panel-footer bg-white border-none">
                    <center>
                        <a
                            href="<?php echo SERVERURL; ?>reporte-indicadores-pdf/"
                            class="btn btn-primary box-shadow-none">descargar como pdf</a>
                    </center>
                </div>
            </div>
        </div>



        <!--  FIN INDICADOR -->


    </div>

    <!-- Fila para colocar las actividades y las direcciones registradas -->
    <div class="row">



        <!-- GABINETE -->
        <div class="col-md-4">
            <div class="panel box-v3">
                <div class="panel-heading bg-white border-none">
                    <h4>GABINETES</h4>
                </div>
                <div class="panel-body">

                    <?php
                    if ($gabinetes->rowCount() > 0) {

                        $gabinetes = $gabinetes->fetchAll();

                        foreach ($gabinetes as $rows) {
                            //ICONO PARA CADA ACTIVIDAD
                            $icono = rand(1, 5);
                            $fondo_icono = "";
                            $fondo_barra = "";
                            if ($icono == 1) {
                                $fondo_icono = "icon-folder";
                                $fondo_barra = "progress-bar";
                            }
                            if ($icono == 2) {
                                $fondo_icono = "icon-pie-chart";
                                $fondo_barra = "progress-bar progress-bar-success";
                            }
                            if ($icono == 3) {
                                $fondo_icono = "icon-energy";
                                $fondo_barra = "progress-bar progress-bar-info";
                            }
                            if ($icono == 4) {
                                $fondo_icono = "icon-user";
                                $fondo_barra = "progress-bar progress-bar-warning";
                            }
                            if ($icono == 5) {
                                $fondo_icono = "icon-fire";
                                $fondo_barra = "progress-bar progress-bar-danger";
                            }

                            if ($rows['home_gabinete_porcentaje'] != 0) {
                                ?>
                                <div class="media">
                                    <div class="media-left">
                                        <span class="<?php echo $fondo_icono; ?> icons" style="font-size:2em;"></span>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="media-heading"><?php echo $rows['gabinete_nombre'] . " (" . number_format($rows['home_gabinete_porcentaje'], 2, ",", ".") . "%)"; ?></h5>
                                        <div class="progress progress-mini">
                                            <div class="<?php echo $fondo_barra; ?>" role="progressbar" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $rows['home_gabinete_porcentaje']; ?>%;">
                                                <span class="sr-only"><?php echo number_format($rows['home_gabinete_porcentaje'], 2, ",", "."); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }
                        }
                    }
                    ?>
                </div>
                <div class="panel-footer bg-white border-none">
                    <center>
                        <a
                            href="<?php echo SERVERURL; ?>reporte-gabinete/"
                            class="btn btn-primary box-shadow-none">descargar como pdf</a>
                    </center>
                </div>
            </div>
        </div>
        <!--  FIN GABINETE -->

        <!-- DIRECCION -->
        <div class="col-md-4">
            <div class="panel box-v3">
                <div class="panel-heading bg-white border-none">
                    <h4>DIRECCIONES</h4>
                </div>
                <div class="panel-body">

                    <?php
                    if ($direcciones->rowCount() > 0) {

                        $direcciones = $direcciones->fetchAll();

                        foreach ($direcciones as $rows) {
                            //ICONO PARA CADA ACTIVIDAD
                            $icono = rand(1, 5);
                            $fondo_icono = "";
                            $fondo_barra = "";
                            if ($icono == 1) {
                                $fondo_icono = "icon-folder";
                                $fondo_barra = "progress-bar";
                            }
                            if ($icono == 2) {
                                $fondo_icono = "icon-pie-chart";
                                $fondo_barra = "progress-bar progress-bar-success";
                            }
                            if ($icono == 3) {
                                $fondo_icono = "icon-energy";
                                $fondo_barra = "progress-bar progress-bar-info";
                            }
                            if ($icono == 4) {
                                $fondo_icono = "icon-user";
                                $fondo_barra = "progress-bar progress-bar-warning";
                            }
                            if ($icono == 5) {
                                $fondo_icono = "icon-fire";
                                $fondo_barra = "progress-bar progress-bar-danger";
                            }

                            if ($rows['home_direccion_porcentaje'] != 0) {
                                ?>
                                <div class="media">
                                    <div class="media-left">
                                        <span class="<?php echo $fondo_icono; ?> icons" style="font-size:2em;"></span>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="media-heading"><?php echo $rows['direccion_nombre'] . " (" . number_format($rows['home_direccion_porcentaje'], 2, ",", ".") . "%)"; ?></h5>
                                        <div class="progress progress-mini">
                                            <div class="<?php echo $fondo_barra; ?>" role="progressbar" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $rows['home_direccion_porcentaje']; ?>%;">
                                                <span class="sr-only"><?php echo number_format($rows['home_direccion_porcentaje'], 2, ",", "."); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }
                        }
                    }
                    ?>
                </div>
                <div class="panel-footer bg-white border-none">
                    <center>
                        <a
                            href="<?php echo SERVERURL; ?>reporte-direccion/"
                            class="btn btn-primary box-shadow-none">descargar como pdf</a>
                    </center>
                </div>
            </div>
        </div>
        <!--  FIN DIRECCION -->



        <!-- ACTIVIDADES -->
        <div class="col-md-4">
            <div class="panel box-v3">
                <div class="panel-heading bg-white border-none">
                    <h4>ACTIVIDADES</h4>
                </div>
                <div class="panel-body">

                    <?php
                    if ($actividades->rowCount() > 0) {

                        $actividades = $actividades->fetchAll();

                        foreach ($actividades as $rows) {
                            //ICONO PARA CADA ACTIVIDAD
                            $icono = rand(1, 5);
                            $fondo_icono = "";
                            $fondo_barra = "";
                            if ($icono == 1) {
                                $fondo_icono = "icon-folder";
                                $fondo_barra = "progress-bar";
                            }
                            if ($icono == 2) {
                                $fondo_icono = "icon-pie-chart";
                                $fondo_barra = "progress-bar progress-bar-success";
                            }
                            if ($icono == 3) {
                                $fondo_icono = "icon-energy";
                                $fondo_barra = "progress-bar progress-bar-info";
                            }
                            if ($icono == 4) {
                                $fondo_icono = "icon-user";
                                $fondo_barra = "progress-bar progress-bar-warning";
                            }
                            if ($icono == 5) {
                                $fondo_icono = "icon-fire";
                                $fondo_barra = "progress-bar progress-bar-danger";
                            }
                            //FIN ICONO PARA CADA ACTIVIDAD

                            if ($rows['home_actividad_porcentaje'] != 0) {
                                ?>
                                <div class="media">
                                    <div class="media-left">
                                        <span class="<?php echo $fondo_icono; ?> icons" style="font-size:2em;"></span>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="media-heading"><?php echo $rows['actividad_nombre'] . " (" . number_format($rows['home_actividad_porcentaje'], 2, ",", ".") . "%)"; ?></h5>
                                        <div class="progress progress-mini">
                                            <div class="<?php echo $fondo_barra; ?>" role="progressbar" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $rows['home_actividad_porcentaje']; ?>%;">
                                                <span class="sr-only"><?php echo number_format($rows['home_actividad_porcentaje'], 2, ",", "."); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }
                        }
                    }
                    ?>
                </div>
                <div class="panel-footer bg-white border-none">
                    <center>
                        <a href="<?php echo SERVERURL; ?>reporte-actividades-pdf/" class="btn btn-primary box-shadow-none">descargar como pdf</a>

                    </center>
                </div>
            </div>
        </div>

        <!-- FIN ACTIVIDADES -->

    </div>

    <?php if ($_SESSION['tipo_tor'] != 4) { ?>
        <!-- Operadores -->
        <div class="row">

            <?php
            if ($usuarios->rowCount() > 0) {
                $usuarios = $usuarios->fetchAll();
                foreach ($usuarios as $rows) {

                    //Cambiar la imagen de fondo de cada usuario
                    $background = rand(1, 11);
                    ?>

                    <div class="col-md-3">
                        <div class="col-md-12 padding-0">
                            <div class="panel box-v2">
                                <div class="panel-heading padding-0">
                                    <img src="<?php echo SERVERURL; ?>vistas/asset/img/bg<?php echo $background; ?>.jpg" class="box-v2-cover img-responsive"/>
                                    <div class="box-v2-detail">
                                        <img src="<?php echo SERVERURL; ?>multimedia/<?php echo $rows['usuario_imagen']; ?>" class="img-responsive"/>
                                        <h4><?php echo $rows['usuario_nombre']; ?></h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-12 text-center">
                                        <div class="col-md-4 col-sm-4 col-xs-6 padding-0">
                                            <h3><?php echo $rows['home_operador_cantidad_diario']; ?></h3>
                                            <p><?php echo '(' . number_format($rows['home_operador_porcentaje_diario'], 2, ",", ".") . '%) '; ?></p>
                                            <p><br></p>
                                            <p>DIARIO</p>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-6 padding-0">
                                            <h3><?php echo $rows['home_operador_cantidad_mensual']; ?></h3>
                                            <p><?php echo '(' . number_format($rows['home_operador_porcentaje_mensual'], 2, ",", ".") . '%) '; ?></p>
                                            <p><br></p>
                                            <p>MENSUAL</p>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12 padding-0">
                                            <h3><?php echo $rows['home_operador_cantidad_anual']; ?></h3>
                                            <p><?php echo '(' . number_format($rows['home_operador_porcentaje_anual'], 2, ",", ".") . '%) '; ?></p>
                                            <p><br></p>
                                            <p>ANUAL</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                }
            }
            ?>





        </div>
        <!--   fin operador -->

    <?php } ?>

</div>


<!-- Page level plugins -->
<script src="<?php echo SERVERURL; ?>vistas/asset/js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?php echo SERVERURL; ?>vistas/asset/js/solicitudes.js"></script>

<!-- Recargar la pagina de home  cada 3 minutos -->
<script src="<?php echo SERVERURL; ?>vistas/asset/js/recargarpagina.js"></script>

