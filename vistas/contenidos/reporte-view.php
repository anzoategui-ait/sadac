<?php
if ($_SESSION['privilegio_tor'] < 1 || $_SESSION['privilegio_tor'] > 3 || $_SESSION['tipo_tor']==4) {
    echo $lc->forzar_cierre_sesion_controlador();
    exit();
}
?>
<div class="col-md-12">



    <div class="panel panel-default">
        <br>
        <h2>&nbsp;REPORTES QUE GENERA EL SISTEMA</h2>

        <div class="panel-body">

            <div class="row">

                 <!--  REPORTE TOTAL -->
                 <div class="col-md-6" style="padding-bottom: 30px;">
                    <div class="panel box-v2">
                        <div class="panel-heading padding-0">
                            <img src="<?php echo SERVERURL; ?>vistas/asset/img/bg18.jpg" class="box-v2-cover img-responsive"/>
                            <div class="box-v2-detail">
                                <img src="<?php echo SERVERURL; ?>vistas/asset/img/logo gobierno anz.png" class="img-responsive"/>
                                <h4>REPORTE DE GESTION</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            
                            <p>
                               Reporte de gestión en formato excel, dentro de un rango de tiempo especifico.
                            </p>
                            <a
                                href="<?php echo SERVERURL; ?>totalizacion-gestion/"
                                class="btn btn-round btn-success btn-sm" target="_blank">Ir a reporte</a>
                        </div>
                    </div>
                </div>


                <!-- Reporte Actividades Pdf -->
                <div class="col-md-6" style="padding-bottom: 30px;">
                    <div class="panel box-v2">
                        <div class="panel-heading padding-0">
                            <img src="<?php echo SERVERURL; ?>vistas/asset/img/bg12.jpg" class="box-v2-cover img-responsive"/>
                            <div class="box-v2-detail">
                                <img src="<?php echo SERVERURL; ?>vistas/asset/img/logo gobierno anz.png" class="img-responsive"/>
                                <h4>REPORTE ACTIVIDADES</h4>
                            </div>
                        </div>
                        <div class="panel-body">

                            <p>
                                Seleccione entre un rango las actividades que desea reportar.
                            </p>
                            <a href="<?php echo SERVERURL; ?>reporte-actividades-pdf/" class="btn btn-round btn-success btn-sm" target="_blank">Ir a reporte</a>
                        </div>
                    </div>
                </div>


                <!-- Segundo reporte listin de todos los jugadores registrados en el sistema -->	
                <div class="col-md-6" style="padding-bottom: 30px;">
                    <div class="panel box-v2">
                        <div class="panel-heading padding-0">
                            <img src="<?php echo SERVERURL; ?>vistas/asset/img/bg13.jpg" class="box-v2-cover img-responsive"/>
                            <div class="box-v2-detail">
                                <img src="<?php echo SERVERURL; ?>vistas/asset/img/logo gobierno anz.png" class="img-responsive"/>
                                 <h4>INDICADORES DE GESTION</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                           
                            <p>
                                Seleccione entre un rango los indicadores que desea reportar.
                            </p>
                            <a
                                href="<?php echo SERVERURL; ?>reporte-indicadores-pdf/"
                                class="btn btn-round btn-success btn-sm" target="_blank">Ir a reporte</a>
                        </div>
                    </div>
                </div>

                <!-- Tercer reporte mostrar el perfil para jugadores seleccionados en el sistema -->
                <div class="col-md-6" style="padding-bottom: 30px;">
                    <div class="panel box-v2">
                        <div class="panel-heading padding-0">
                            <img src="<?php echo SERVERURL; ?>vistas/asset/img/ag01.jpg" class="box-v2-cover img-responsive"/>
                            <div class="box-v2-detail">
                                <img src="<?php echo SERVERURL; ?>vistas/asset/img/logo gobierno anz.png" class="img-responsive"/>
                                <h4>GABINETES</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            
                            <p>
                               Porcentaje de solicitudes realizadas dentro de un rango especifico por gabinete.
                            </p>
                            <a
                                href="<?php echo SERVERURL; ?>reporte-gabinete/"
                                class="btn btn-round btn-success btn-sm" target="_blank">Ir a reporte</a>
                        </div>
                    </div>
                </div>
                
                <!--  Cuarto reporte DIRECCIONES -->
                <div class="col-md-6" style="padding-bottom: 30px;">
                    <div class="panel box-v2">
                        <div class="panel-heading padding-0">
                            <img src="<?php echo SERVERURL; ?>vistas/asset/img/bg18.jpg" class="box-v2-cover img-responsive"/>
                            <div class="box-v2-detail">
                                <img src="<?php echo SERVERURL; ?>vistas/asset/img/logo gobierno anz.png" class="img-responsive"/>
                                <h4>DIRECCIONES</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            
                            <p>
                               Porcentaje de solicitudes realizadas dentro de un rango especifico por direccion.
                            </p>
                            <a
                                href="<?php echo SERVERURL; ?>reporte-direccion/"
                                class="btn btn-round btn-success btn-sm" target="_blank">Ir a reporte</a>
                        </div>
                    </div>
                </div>

               <div class="col-md-6" style="padding-bottom: 30px;">
                    <div class="panel box-v2">
                        <div class="panel-heading padding-0">
                            <img src="<?php echo SERVERURL; ?>vistas/asset/img/ag02.jpg" class="box-v2-cover img-responsive"/>
                            <div class="box-v2-detail">
                                <img src="<?php echo SERVERURL; ?>vistas/asset/img/logo gobierno anz.png" class="img-responsive"/>
                               <h4>OPERADOR</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            
                            <p>
                                Porcentaje de solicitudes por operador, dentro de un rango de tiempo especifico.
                            </p>
                            <a href="<?php echo SERVERURL; ?>reporte-operadores-pdf/"
                                class="btn btn-round btn-success btn-sm" target="_blank">Reporte Operador</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6" style="padding-bottom: 30px;">
                    <div class="panel box-v2">
                        <div class="panel-heading padding-0">
                            <img src="<?php echo SERVERURL; ?>vistas/asset/img/ag03.jpg" class="box-v2-cover img-responsive"/>
                            <div class="box-v2-detail">
                                <img src="<?php echo SERVERURL; ?>vistas/asset/img/logo gobierno anz.png" class="img-responsive"/>
                               <h4>MUNICIPIO</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            
                            <p>
                                Porcentaje de solicitudes por municipio, dentro de un rango de tiempo especifico.
                            </p>
                            <a
                                href="<?php echo SERVERURL; ?>reporte-municipio-pdf/"
                                class="btn btn-round btn-success btn-sm" target="_blank">Ir a reporte</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6" style="padding-bottom: 30px;">
                    <div class="panel box-v2">
                        <div class="panel-heading padding-0">
                            <img src="<?php echo SERVERURL; ?>vistas/asset/img/004.jpg" class="box-v2-cover img-responsive"/>
                            <div class="box-v2-detail">
                                <img src="<?php echo SERVERURL; ?>vistas/asset/img/logo gobierno anz.png" class="img-responsive"/>
                               <h4>PARROQUIA</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                           
                            <p>
                                Porcentaje de solicitudes por parroquia, dentro de un rango de tiempo especifico.
                            </p>
                            <a
                                href="<?php echo SERVERURL; ?>reporte-parroquia-pdf/"
                                class="btn btn-round btn-success btn-sm" target="_blank">Ir a reporte</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6" style="padding-bottom: 30px;">
                    <div class="panel box-v2">
                        <div class="panel-heading padding-0">
                            <img src="<?php echo SERVERURL; ?>vistas/asset/img/bg14.jpg" class="box-v2-cover img-responsive"/>
                            <div class="box-v2-detail">
                                <img src="<?php echo SERVERURL; ?>vistas/asset/img/logo gobierno anz.png" class="img-responsive"/>
                            <h4>SECTOR</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <p>
                                Porcentaje de solicitudes por sector, dentro de un rango de tiempo especifico.
                            </p>
                            <a
                                href="<?php echo SERVERURL; ?>reporte-sector-pdf/"
                                class="btn btn-round btn-success btn-sm" target="_blank">Ir a reporte</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6" style="padding-bottom: 30px;">
                    <div class="panel box-v2">
                        <div class="panel-heading padding-0">
                            <img src="<?php echo SERVERURL; ?>vistas/asset/img/bg15.jpg" class="box-v2-cover img-responsive"/>
                            <div class="box-v2-detail">
                                <img src="<?php echo SERVERURL; ?>vistas/asset/img/logo gobierno anz.png" class="img-responsive"/>
                             <h4>GABINETE ACTIVIDAD</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                          
                            <p>
                                Solicitudes seleccionando un gabinete, dentro de un rango de tiempo especifico.
                            </p>
                            <a
                                href="<?php echo SERVERURL; ?>reporte-gabinete-actividad/"
                                class="btn btn-round btn-success btn-sm" target="_blank">Ir a reporte</a>
                        </div>
                    </div>
                </div>

                <!-- direccion de actividad -->
                <div class="col-md-6" style="padding-bottom: 30px;">
                    <div class="panel box-v2">
                        <div class="panel-heading padding-0">
                            <img src="<?php echo SERVERURL; ?>vistas/asset/img/bg12.jpg" class="box-v2-cover img-responsive"/>
                            <div class="box-v2-detail">
                                <img src="<?php echo SERVERURL; ?>vistas/asset/img/logo gobierno anz.png" class="img-responsive"/>
                             <h4>DIRECCION ACTIVIDAD</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                          
                            <p>
                                Solicitudes seleccionando una direccion, dentro de un rango de tiempo especifico.
                            </p>
                            <a
                                href="<?php echo SERVERURL; ?>reporte-direccion-actividad/"
                                class="btn btn-round btn-success btn-sm" target="_blank">Ir a reporte</a>
                        </div>
                    </div>
                </div>
                
                
                <div class="col-md-6" style="padding-bottom: 30px;">
                    <div class="panel box-v2">
                        <div class="panel-heading padding-0">
                            <img src="<?php echo SERVERURL; ?>vistas/asset/img/bg16.jpg" class="box-v2-cover img-responsive"/>
                            <div class="box-v2-detail">
                                <img src="<?php echo SERVERURL; ?>vistas/asset/img/logo gobierno anz.png" class="img-responsive"/>
                             <h4>MUNICIPIO & ACTIVIDAD</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            
                            <p>
                                Solicitudes atendidas por municipio, dentro de un rango de tiempo especifico.
                            </p>
                            <a
                                href="<?php echo SERVERURL; ?>reporte-municipio-actividad/"
                                class="btn btn-round btn-success btn-sm" target="_blank">Ir a reporte</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6" style="padding-bottom: 30px;">
                    <div class="panel box-v2">
                        <div class="panel-heading padding-0">
                            <img src="<?php echo SERVERURL; ?>vistas/asset/img/bg17.jpg" class="box-v2-cover img-responsive"/>
                            <div class="box-v2-detail">
                                <img src="<?php echo SERVERURL; ?>vistas/asset/img/logo gobierno anz.png" class="img-responsive"/>
                            <h4>PARROQUIA & ACTIVIDAD</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            
                            <p>
                                Solicitudes atendidas por parroquia, dentro de un rango de tiempo especifico.
                            </p>
                            <a
                                href="<?php echo SERVERURL; ?>reporte-parroquia-actividad/"
                                class="btn btn-round btn-success btn-sm" target="_blank">Ir a reporte</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6" style="padding-bottom: 30px;">
                    <div class="panel box-v2">
                        <div class="panel-heading padding-0">
                            <img src="<?php echo SERVERURL; ?>vistas/asset/img/bg18.jpg" class="box-v2-cover img-responsive"/>
                            <div class="box-v2-detail">
                                <img src="<?php echo SERVERURL; ?>vistas/asset/img/logo gobierno anz.png" class="img-responsive"/>
                            <h4>SECTOR & ACTIVIDAD</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            
                            <p>
                                Solicitudes atendidas por sector, dentro de un rango de tiempo especifico.
                            </p>
                            <a
                                href="<?php echo SERVERURL; ?>reporte-sector-actividad/"
                                class="btn btn-round btn-success btn-sm" target="_blank">Ir a reporte</a>
                        </div>
                    </div>
                </div>
                
                <!-- Segundo reporte de inventario y a que persona esta asignada -->	
                <div class="col-md-6" style="padding-bottom: 30px;">
                    <div class="panel box-v2">
                        <div class="panel-heading padding-0">
                            <img src="<?php echo SERVERURL; ?>vistas/asset/img/bg23.jpg" class="box-v2-cover img-responsive"/>
                            <div class="box-v2-detail">
                                <img src="<?php echo SERVERURL; ?>vistas/asset/img/logo gobierno anz.png" class="img-responsive"/>
                                 <h4>TURNOS</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                           
                            <p>
                                Para saber el total de ciudadanos que visitaron la oficina.
                            </p>
                            <a
                                 href="<?php echo SERVERURL; ?>reporte-turnos/"
                                class="btn btn-round btn-success btn-sm" target="_blank">Ir a reporte</a>
                        </div>
                    </div>
                </div>
                
                 <!-- Rreporte de inventario de equipos informaticos almacenados en el sistema 	
                <div class="col-md-6" style="padding-bottom: 30px;">
                    <div class="panel box-v2">
                        <div class="panel-heading padding-0">
                            <img src="<?php // echo SERVERURL; ?>vistas/asset/img/bg24.jpg" class="box-v2-cover img-responsive"/>
                            <div class="box-v2-detail">
                                <img src="<?php // echo SERVERURL; ?>vistas/asset/img/logo gobierno anz.png" class="img-responsive"/>
                                 <h4>CIUDADANOS</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                           
                            <p>
                                Listado de ciudadanos que han hecho solicitudes.
                            </p>
                            <a
                                 href="<?php // echo SERVERURL; ?>reporte-ciudadanos/"
                                class="btn btn-round btn-success btn-sm" target="_blank">Ir a reporte</a>
                        </div>
                    </div>
                </div>

                -->	
                 
                  <!-- Rreporte de mantenimiento de equipos informaticos -->	
                <div class="col-md-6" style="padding-bottom: 30px;">
                    <div class="panel box-v2">
                        <div class="panel-heading padding-0">
                            <img src="<?php echo SERVERURL; ?>vistas/asset/img/bg25.jpg" class="box-v2-cover img-responsive"/>
                            <div class="box-v2-detail">
                                <img src="<?php echo SERVERURL; ?>vistas/asset/img/logo gobierno anz.png" class="img-responsive"/>
                                 <h4>SOLICITUDES</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                           
                            <p>
                                Listado de Solicitudes, realizadas.
                            </p>
                            <a
                                 href="<?php echo SERVERURL; ?>reporte-solicitudes/"
                                class="btn btn-round btn-success btn-sm" target="_blank">Ir a reporte</a>
                        </div>
                    </div>
                </div>

                <!-- ciUDADANO de actividad -->
                <div class="col-md-6" style="padding-bottom: 30px;">
                    <div class="panel box-v2">
                        <div class="panel-heading padding-0">
                            <img src="<?php echo SERVERURL; ?>vistas/asset/img/bg12.jpg" class="box-v2-cover img-responsive"/>
                            <div class="box-v2-detail">
                                <img src="<?php echo SERVERURL; ?>vistas/asset/img/logo gobierno anz.png" class="img-responsive"/>
                             <h4>CIUDADANO ACTIVIDAD</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                          
                            <p>
                                Solicitudes seleccionando un ciudadano, dentro de un rango de tiempo especifico.
                            </p>
                            <a
                                href="<?php echo SERVERURL; ?>reporte-ciudadano-actividad/"
                                class="btn btn-round btn-success btn-sm" target="_blank">Ir a reporte</a>
                        </div>
                    </div>
                </div>
                  
                  <!-- OPINION DADA POR EL USUARIO FINAL SOBRE EL TIEMPO Y RESPUESTA DE LA SOLUCION DADA A SU SOLICITUD -->
                  <div class="col-md-6" style="padding-bottom: 30px;">
                    <div class="panel box-v2">
                        <div class="panel-heading padding-0">
                            <img src="<?php echo SERVERURL; ?>vistas/asset/img/ag02.jpg" class="box-v2-cover img-responsive"/>
                            <div class="box-v2-detail">
                                <img src="<?php echo SERVERURL; ?>vistas/asset/img/logo gobierno anz.png" class="img-responsive"/>
                                 <h4>EVALUACION</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                           
                            <p>
                                Perspectiva desde la opinion del usuario final.
                            </p>
                            <a
                                 href="<?php echo SERVERURL; ?>reporte-evaluacion"
                                class="btn btn-round btn-success btn-sm" target="_blank">Ir a reporte</a>
                        </div>
                    </div>
                </div>
                  
                  
            </div>


        </div>
    </div>
    <br>
</div>