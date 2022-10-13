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
// $cad_total_solicitadas = $ins_home->solicitudes_anuales_controlador("Solicitadas");
// $cad_total_finalizadas = $ins_home->solicitudes_anuales_controlador("Finalizadas");

//Obtener todas las actividades
require_once './controladores/actividadControlador.php';
$ins_actividad = new actividadControlador();
$actividades = $ins_actividad->datos_actividad_controlador("Todos", 0);

//Obtener los indicadores 
require_once './controladores/indicadorControlador.php';
$ins_indicador = new indicadorControlador();
$indicadores = $ins_indicador->datos_indicador_controlador("Todos", 0);

//Obtener las direcciones
require_once './controladores/direccionControlador.php';
$ins_direccion = new direccionControlador();
$direcciones = $ins_direccion->datos_direccion_controlador("Todos", 0);

//Obtener Todos los Gabinetes
require_once './controladores/gabineteControlador.php';
$ins_gabinete = new gabineteControlador();
$gabinetes = $ins_gabinete->datos_gabinete_controlador("Todos", 0);

//Obtener Todos los Muicipios
require_once './controladores/municipioControlador.php';
$ins_municipio = new municipioControlador();
$municipios = $ins_municipio->datos_municipio_controlador("Todos", 0);

//Obtener todos los usuarios
require_once './controladores/usuarioControlador.php';
$ins_usuario = new usuarioControlador();
$usuarios = $ins_usuario->datos_usuario_controlador("Home", 0);
?>

<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Resumen Estadistico</h3>
            <h5 class="animated fadeInLeft">Total Solicitudes Online: <?php echo $solicitudes_online->rowCount();?></h5>

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

    <!-- Grafica Solicitudes realizadas y solicitudes finalizadas -->
    <div class="row">
        <!--
        <!-- Area Estadisticas de solicitudes realizadas anualmente -->
        <div class="col-md-12">
            <div class="panel">
                <!-- Card Header - Dropdown 
                <div class="panel-heading bg-white border-none">
                    <h4>Solicitudes Anuales</h4>
                    <input type="hidden" id="solicitudes_anuales" value="<?PHP // echo "" . $cad_total_solicitadas; ?>">
                    <input type="hidden" id="solicitudes_finalizadas" value="<?PHP //echo "" . $cad_total_finalizadas; ?>">

                </div>
                <!-- Card Body 
                <div class="panel-body">
                    <div class="chart-area">
                        <canvas id="areaSolicitudes"></canvas>
                    </div>
                    <hr>
                    Solicitudes realizadas vs solicitudes finalizadas.
                </div>
            </div> -->
        </div>
         
    </div>


    <!-- MAPA COLOCANDO LAS SOLICITUDES POR MUNICIPIOS -->
    <div class="row">
        <!-- VARIABLES OCULTAS QUE ALIMENTARAN EL MAPA 
        <?php /*
        //Municipio
        $anaco = $ins_home->obtener_recurrencia_controlador("Municipio", 1);
        $porcentante_anaco = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $anaco->rowCount());
        $aragua = $ins_home->obtener_recurrencia_controlador("Municipio", 2);
        $porcentante_aragua = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $aragua->rowCount());
        $bolivar = $ins_home->obtener_recurrencia_controlador("Municipio", 4);
        $porcentante_bolivar = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $bolivar->rowCount());
        $bruzual = $ins_home->obtener_recurrencia_controlador("Municipio", 5);
        $porcentante_bruzual = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $bruzual->rowCount());
        $cajigal = $ins_home->obtener_recurrencia_controlador("Municipio", 6);
        $porcentante_cajigal = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $cajigal->rowCount());
        $carvajal = $ins_home->obtener_recurrencia_controlador("Municipio", 7);
        $porcentante_carvajal = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $carvajal->rowCount());
        $urbaneja= $ins_home->obtener_recurrencia_controlador("Municipio", 8);
        $porcentante_urbaneja = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $urbaneja->rowCount());
        $freite = $ins_home->obtener_recurrencia_controlador("Municipio", 9);
        $porcentante_freite = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $freite->rowCount());
        $guanipa = $ins_home->obtener_recurrencia_controlador("Municipio", 10);
        $porcentante_guanipa = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $guanipa->rowCount());
        $guanta= $ins_home->obtener_recurrencia_controlador("Municipio", 11);
        $porcentante_guanta = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $guanta->rowCount());
        $independencia= $ins_home->obtener_recurrencia_controlador("Municipio", 12);
        $porcentante_independencia = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $independencia->rowCount());
        $libertad = $ins_home->obtener_recurrencia_controlador("Municipio", 13);
        $porcentante_libertad = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $libertad->rowCount());
        $mcgregor = $ins_home->obtener_recurrencia_controlador("Municipio", 14);
        $porcentante_mcgregor = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $mcgregor->rowCount());
        $miranda= $ins_home->obtener_recurrencia_controlador("Municipio", 15);
        $porcentante_miranda = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $miranda->rowCount());
        $monagas = $ins_home->obtener_recurrencia_controlador("Municipio", 16);
        $porcentante_monagas = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $monagas->rowCount());
        $penalver = $ins_home->obtener_recurrencia_controlador("Municipio", 17);
        $porcentante_penalver = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $penalver->rowCount());
        $piritu = $ins_home->obtener_recurrencia_controlador("Municipio", 18);
        $porcentante_piritu = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $piritu->rowCount());
        $capistrano = $ins_home->obtener_recurrencia_controlador("Municipio", 19);
        $porcentante_capistrano = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $capistrano->rowCount());
        
        $santaana = $ins_home->obtener_recurrencia_controlador("Municipio", 20);
        $porcentante_santaana = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $santaana->rowCount());
        $simonrodriguez = $ins_home->obtener_recurrencia_controlador("Municipio", 21);
        $porcentante_simonrodriguez = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $simonrodriguez->rowCount());
        $sotillo = $ins_home->obtener_recurrencia_controlador("Municipio",3);
        $porcentante_sotillo = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $sotillo->rowCount());
       */
        
        ?>
        <input type="hidden" id="municipio_Anaco" value="<?PHP /* echo '<h2>Municipio Anaco</h2><p>Cantidad de Solicitudes: '.$anaco->rowCount().', Representa: '.number_format($porcentante_anaco, 2, ",", ".").'%</p>'; ?>">
        <input type="hidden" id="municipio_Aragua" value="<?PHP echo '<h2>Municipio Aragua</h2><p>Cantidad de Solicitudes: '.$aragua->rowCount().', Representa: '.number_format($porcentante_aragua, 2, ",", ".").'%</p>'; ?>">
        <input type="hidden" id="municipio_Bolivar" value="<?PHP echo '<h2>Municipio Bolivar</h2><p>Cantidad de Solicitudes: '.$bolivar->rowCount().', Representa: '.number_format($porcentante_bolivar, 2, ",", ".").'%</p>'; ?>">
        <input type="hidden" id="municipio_Bruzual" value="<?PHP echo '<h2>Municipio Bruzual</h2><p>Cantidad de Solicitudes: '.$bruzual->rowCount().', Representa: '.number_format($porcentante_bruzual, 2, ",", ".").'%</p>'; ?>">
        <input type="hidden" id="municipio_Cajigal" value="<?PHP echo '<h2>Municipio Cajigal</h2><p>Cantidad de Solicitudes: '.$cajigal->rowCount().', Representa: '.number_format($porcentante_cajigal, 2, ",", ".").'%</p>'; ?>">
        <input type="hidden" id="municipio_Carvajal" value="<?PHP echo '<h2>Municipio Carvajal</h2><p>Cantidad de Solicitudes: '.$carvajal->rowCount().', Representa: '.number_format($porcentante_carvajal, 2, ",", ".").'%</p>'; ?>">
        <input type="hidden" id="municipio_Urbaneja" value="<?PHP echo '<h2>Municipio Urbaneja</h2><p>Cantidad de Solicitudes: '.$urbaneja->rowCount().', Representa: '.number_format($porcentante_urbaneja, 2, ",", ".").'%</p>'; ?>">
        <input type="hidden" id="municipio_Freites" value="<?PHP echo '<h2>Municipio Freites</h2><p>Cantidad de Solicitudes: '.$freite->rowCount().', Representa: '.number_format($porcentante_freite, 2, ",", ".").'%</p>'; ?>">
        <input type="hidden" id="municipio_Guanipa" value="<?PHP echo '<h2>Municipio Guanipa</h2><p>Cantidad de Solicitudes: '.$guanipa->rowCount().', Representa: '.number_format($porcentante_guanipa, 2, ",", ".").'%</p>'; ?>">
        <input type="hidden" id="municipio_Guanta" value="<?PHP echo '<h2>Municipio Guanta</h2><p>Cantidad de Solicitudes: '.$guanta->rowCount().', Representa: '.number_format($porcentante_guanta, 2, ",", ".").'%</p>'; ?>">
        <input type="hidden" id="municipio_Independencia" value="<?PHP echo '<h2>Municipio Independencia</h2><p>Cantidad de Solicitudes: '.$independencia->rowCount().', Representa: '.number_format($porcentante_independencia, 2, ",", ".").'%</p>'; ?>">
        <input type="hidden" id="municipio_Libertad" value="<?PHP echo '<h2>Municipio Libertad</h2><p>Cantidad de Solicitudes: '.$libertad->rowCount().', Representa: '.number_format($porcentante_libertad, 2, ",", ".").'%</p>'; ?>">
        <input type="hidden" id="municipio_Mcgregor" value="<?PHP echo '<h2>Municipio McGregor</h2><p>Cantidad de Solicitudes: '.$mcgregor->rowCount().', Representa: '.number_format($porcentante_mcgregor, 2, ",", ".").'%</p>'; ?>">
        <input type="hidden" id="municipio_Miranda" value="<?PHP echo '<h2>Municipio Miranda</h2><p>Cantidad de Solicitudes: '.$miranda->rowCount().', Representa: '.number_format($porcentante_miranda, 2, ",", ".").'%</p>'; ?>">
        <input type="hidden" id="municipio_Monagas" value="<?PHP echo '<h2>Municipio Monagas</h2><p>Cantidad de Solicitudes: '.$monagas->rowCount().', Representa: '.number_format($porcentante_monagas, 2, ",", ".").'%</p>'; ?>">
        <input type="hidden" id="municipio_Penalver" value="<?PHP echo '<h2>Municipio Peñalver</h2><p>Cantidad de Solicitudes: '.$penalver->rowCount().', Representa: '.number_format($porcentante_penalver, 2, ",", ".").'%</p>'; ?>">
        <input type="hidden" id="municipio_Piritu" value="<?PHP echo '<h2>Municipio Piritu</h2><p>Cantidad de Solicitudes: '.$piritu->rowCount().', Representa: '.number_format($porcentante_piritu, 2, ",", ".").'%</p>'; ?>">
        <input type="hidden" id="municipio_Capistrano" value="<?PHP echo '<h2>Municipio San Juan de Capistrano</h2><p>Cantidad de Solicitudes: '.$capistrano->rowCount().', Representa: '.number_format($porcentante_capistrano, 2, ",", ".").'%</p>'; ?>">
        <input type="hidden" id="municipio_Santa_Ana" value="<?PHP echo '<h2>Municipio Santa Ana</h2><p>Cantidad de Solicitudes: '.$santaana->rowCount().', Representa: '.number_format($porcentante_santaana, 2, ",", ".").'%</p>'; ?>">
        <input type="hidden" id="municipio_Simon_Rodriguez" value="<?PHP echo '<h2>Municipio Simon Rodriguez</h2><p>Cantidad de Solicitudes: '.$simonrodriguez->rowCount().', Representa: '.number_format($porcentante_simonrodriguez, 2, ",", ".").'%</p>'; ?>">
        <input type="hidden" id="municipio_Sotillo" value="<?PHP echo '<h2>Municipio Sotillo</h2><p>Cantidad de Solicitudes: '.$sotillo->rowCount().', Representa: '.number_format($porcentante_sotillo, 2, ",", ".").'%</p>'; */?>">
        
        -->
        
        
           <!-- MNUNICIPIO -->
            <div class="col-md-4">
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
                                $recurrencia_municipio = $ins_home->obtener_recurrencia_controlador("Municipio", $rows['municipio_id']);
                                $porcentante_recurrencia_municipio = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $recurrencia_municipio->rowCount());

                                if ($porcentante_recurrencia_municipio != 0) {
                                    ?>
                                    <div class="media">
                                        
                                        
                                        <div class="media-left">
                                            <span class="<?php echo $fondo_icono; ?> icons" style="font-size:2em;"></span>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="media-heading"><?php echo $rows['municipio_nombre'] . " (" . number_format($porcentante_recurrencia_municipio, 2, ",", ".") . "%)"; ?></h5>
                                            <div class="progress progress-mini">
                                                <div class="<?php echo $fondo_barra; ?>" role="progressbar" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $porcentante_recurrencia_municipio; ?>%;">
                                                    <span class="sr-only"><?php echo number_format($porcentante_recurrencia_municipio, 2, ",", "."); ?></span>
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
           
            <div class="col-md-8">
                <!--
            <div class="panel box-v3">
                
                <div class="panel-body">
                    <div id="mi-mapa"></div>
                    <!-- para el mapa 
                    <script src="<?php//echo SERVERURL; ?>leaflet/js/visorMapa.js"></script>
                </div>
            </div>
            -->
            </div>

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
                                //OBTENER EL VALOR TOTAL DE LAS RECURRENCIAS DE DIRECCION EN ESPECIFICO
                                $recurrencia_direccion = $ins_home->obtener_recurrencia_controlador("Gabinete", $rows['gabinete_id']);
                                $porcentante_recurrencia_direccion = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $recurrencia_direccion->rowCount());

                                if ($porcentante_recurrencia_direccion != 0) {
                                    ?>
                                    <div class="media">
                                        <div class="media-left">
                                            <span class="<?php echo $fondo_icono; ?> icons" style="font-size:2em;"></span>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="media-heading"><?php echo $rows['gabinete_nombre'] . " (" . number_format($porcentante_recurrencia_direccion, 2, ",", ".") . "%)"; ?></h5>
                                            <div class="progress progress-mini">
                                                <div class="<?php echo $fondo_barra; ?>" role="progressbar" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $porcentante_recurrencia_direccion; ?>%;">
                                                    <span class="sr-only"><?php echo number_format($porcentante_recurrencia_direccion, 2, ",", "."); ?></span>
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
                                //OBTENER EL VALOR TOTAL DE LAS RECURRENCIAS DE ACTIVIDAD EN ESPECIFICO
                                $recurrencia = $ins_home->obtener_recurrencia_controlador("Actividades", $rows['actividad_id']);
                                $porcentante_recurrencia = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $recurrencia->rowCount());

                                if ($porcentante_recurrencia != 0) {
                                    ?>
                                    <div class="media">
                                        <div class="media-left">
                                            <span class="<?php echo $fondo_icono; ?> icons" style="font-size:2em;"></span>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="media-heading"><?php echo $rows['actividad_nombre'] . " (" . number_format($porcentante_recurrencia, 2, ",", ".") . "%)"; ?></h5>
                                            <div class="progress progress-mini">
                                                <div class="<?php echo $fondo_barra; ?>" role="progressbar" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $porcentante_recurrencia; ?>%;">
                                                    <span class="sr-only"><?php echo number_format($porcentante_recurrencia, 2, ",", "."); ?></span>
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

            <!-- INDICADOR -->
            <div class="col-md-4">
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
                                //FIN ICONO PARA CADA ACTIVIDAD
                                //OBTENER EL VALOR TOTAL DE LAS RECURRENCIAS DE ACTIVIDAD EN ESPECIFICO
                                $recurrencia_indicador = $ins_home->obtener_recurrencia_controlador("Indicadores", $rows['indicador_id']);
                                $porcentante_recurrencia_indicador = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $recurrencia_indicador->rowCount());

                                if ($porcentante_recurrencia_indicador != 0) {
                                    ?>
                                    <div class="media">
                                        <div class="media-left">
                                            <span class="<?php echo $fondo_icono; ?> icons" style="font-size:2em;"></span>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="media-heading"><?php echo $rows['indicador_nombre'] . " (" . number_format($porcentante_recurrencia_indicador, 2, ",", ".") . "%)"; ?></h5>
                                            <div class="progress progress-mini">
                                                <div class="<?php echo $fondo_barra; ?>" role="progressbar" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $porcentante_recurrencia_indicador; ?>%;">
                                                    <span class="sr-only"><?php echo number_format($porcentante_recurrencia_indicador, 2, ",", "."); ?></span>
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



            <!-- FI IINDICADOR -->


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

                        //Obtener el Total Año
                        $recurrencia_usuario_anual = $ins_home->obtener_recurrencia_controlador("Usuario_Anual", $rows['usuario_id']);
                        $porcentante_usuario_anual = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $recurrencia_usuario_anual->rowCount());
                        //Total mes
                        $recurrencia_usuario_mes = $ins_home->obtener_recurrencia_controlador("recurrencia-mensual", $rows['usuario_id']);
                        $porcentante_usuario_mes = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $recurrencia_usuario_mes->rowCount());
                        //Total diario
                        $recurrencia_usuario_dia = $ins_home->obtener_recurrencia_controlador("recurrencia-dia", $rows['usuario_id']);
                        $porcentante_usuario_dia = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $recurrencia_usuario_dia->rowCount());
                        ?>

                        <div class="col-md-3">
                            <div class="col-md-12 padding-0">
                                <div class="panel box-v2">
                                    <div class="panel-heading padding-0">
                                        <img src="<?php echo SERVERURL; ?>vistas/asset/img/bg<?php echo $background; ?>.jpg" class="box-v2-cover img-responsive"/>
                                        <div class="box-v2-detail">
                                            <img src="<?php echo SERVERURL; ?>multimedia/<?php echo $rows['usuario_imagen'];?>" class="img-responsive"/>
                                            <h4><?php echo $rows['usuario_nombre'] . ', ' . $rows['usuario_apellido']; ?></h4>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-12 padding-0 text-center">
                                            <div class="col-md-4 col-sm-4 col-xs-6 padding-0">
                                                <h3><?php echo $recurrencia_usuario_dia->rowCount(); ?></h3>
                                                <p><?php echo '(' . number_format($porcentante_usuario_dia, 2, ",", ".") . '%) '; ?></p>
                                                <p><br></p>
                                                <p>DIARIO</p>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-6 padding-0">
                                                <h3><?php echo $recurrencia_usuario_mes->rowCount(); ?></h3>
                                                <p><?php echo '(' . number_format($porcentante_usuario_mes, 2, ",", ".") . '%) '; ?></p>
                                                <p><br></p>
                                                <p>MENSUAL</p>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12 padding-0">
                                                <h3><?php echo $recurrencia_usuario_anual->rowCount(); ?></h3>
                                                <p><?php echo '(' . number_format($porcentante_usuario_anual, 2, ",", ".") . '%) '; ?></p>
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

<?php } ?>

    </div>


    <!-- Page level plugins -->
    <script src="<?php echo SERVERURL; ?>vistas/asset/js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo SERVERURL; ?>vistas/asset/js/solicitudes.js"></script>

    <!-- Recargar la pagina de home  cada 15 minutos -->
     <script src="<?php echo SERVERURL; ?>vistas/asset/js/recargarpagina.js"></script>
