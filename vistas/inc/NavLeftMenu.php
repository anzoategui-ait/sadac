<!-- start:Left Menu -->
<div id="left-menu">
    <div class="sub-left-menu scroll">
        <ul class="nav nav-list">
            <!-- <li><div class="left-bg"></div></li> -->
            <li class="time">
                <h1 class="animated fadeInLeft">21:00</h1>
                <p class="animated fadeInRight">Sat,October 1st 2029</p>
            </li>
            <li class="ripple"><a href="<?php echo SERVERURL; ?>home/"><span
                        class="fa-bar-chart-o fa"></span> Resumen <span
                        class="fa-angle-right fa right-arrow text-right"></span> </a></li>

                        <!-- Area para agregar el estudio social --> 
                        <li class="ripple"><a href="<?php echo SERVERURL; ?>estudio-social-new/"><span
                        class="fa-bar-chart-o fa"></span> Estudio Social <span
                        class="fa-angle-right fa right-arrow text-right"></span> </a></li>

            <!-- Area para el usuario Operador -->  
            <?php
            if ($_SESSION['tipo_tor'] == 3) {
                ?>

                <!-- Gestionar Procesar Solicitudes de Actividades asignadas -->

              <!-- Vincular una actividad a una solicitud -->
              <!-- SOLICITUDES -->
              <li class="ripple"><a class="tree-toggle nav-header"> <span
                            class="fa-bell-o fa"></span> Solicitud <span
                            class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                    <ul class="nav nav-list tree">
                        
                         <li><a href="<?php echo SERVERURL; ?>solicitudes-list/">Solicitudes</a></li>
                        <li><a href="<?php echo SERVERURL; ?>solicitud-list/">Lista de
                                solicitudes</a></li>
                        <li><a href="<?php echo SERVERURL; ?>solicitud-search/">Buscar
                                solicitud</a></li>
                    </ul></li>
                    
                    <!-- Asignar actividad -->
                    <!-- Gestionar Asignciones -->
                <li class="ripple"><a class="tree-toggle nav-header"> <span
                            class="fa-check-square-o fa"></span> Asignacion <span
                            class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                    <ul class="nav nav-list tree">
                        <li><a href="<?php echo SERVERURL; ?>asignacion-new/">Nueva
                                asignacion</a></li>
                        <li><a href="<?php echo SERVERURL; ?>asignacion-list/">Lista de
                                asignaciones</a></li>
                        <li><a href="<?php echo SERVERURL; ?>asignacion-search/">Buscar
                                asignacion</a></li>
                    </ul></li>

                <li class="ripple"><a class="tree-toggle nav-header"> <span
                            class="fa-sort-amount-asc fa"></span> Procesar <span
                            class="fa-angle-right fa right-arrow text-right"></span>
                    </a>

                    

                    <ul class="nav nav-list tree">

                        <li><a href="<?php echo SERVERURL; ?>procesar-new/">Procesar Asignacion</a></li>
                        <li><a href="<?php echo SERVERURL; ?>procesar-list/">Lista de
                                Procesamientos</a></li>
                        <li><a href="<?php echo SERVERURL; ?>asignacion-anexo-list/">Anexo de Asignaciones</a></li>
                        <li><a href="<?php echo SERVERURL; ?>reporte-operadores-pdf/" target="_blank">Reporte Operador</a></li>
                   
                        <li><a href="<?php echo SERVERURL; ?>reporte-turnos/" target="_blank">Reporte Turnos</a></li>

                    </ul>

                  </li>

                   <!-- Crear un nuevo sector -->
                    <!-- SECTOR -->
                    <li class="ripple">
                            <a class="sub-tree-toggle nav-header">
                                <span class="fa fa-picture-o"></span> Sector
                                <span class="fa-angle-right fa right-arrow text-right"></span>
                            </a>
                            <ul class="nav nav-list sub-tree">
                                <li><a href="<?php echo SERVERURL; ?>sector-new/">Agregar Sector</a></li>
                                <li><a href="<?php echo SERVERURL; ?>sector-list/">Lista de Sectores</a></li>
                                <li><a href="<?php echo SERVERURL; ?>sector-search/">Buscar Sector</a></li>
                            </ul>
                        </li>

                    <!-- TURNOS -->
                    <li class="ripple"><a class="tree-toggle nav-header"> <span
                    class="fa-bell-o fa"></span> Turno <span
                    class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                    <ul class="nav nav-list tree">
                        <li><a href="<?php echo SERVERURL; ?>turno-new/">Nuevo
                                Turno</a></li> 
                        <li><a href="<?php echo SERVERURL; ?>turno-list/">Lista de
                                Turnos</a></li>
                        <li><a href="<?php echo SERVERURL; ?>turno-search/">Buscar
                                turno</a></li>

                                <li><a href="<?php echo SERVERURL; ?>cubiculo-new/">Nuevo
                                cubiculo</a></li> 
                        <li><a href="<?php echo SERVERURL; ?>cubiculo-list/">Lista de
                        cubiculos</a></li>
                        <li><a href="<?php echo SERVERURL; ?>cubiculo-search/">Buscar
                        cubiculo</a></li>
                        
                    </ul></li>

                 <!-- REPORTES -->
                 <li><a href="<?php echo SERVERURL; ?>reporte/"><span class="fa fa-print"></span>Reportes</a></li>


                <?php
            }
            ?>

            <!-- Area para el usuario supervisor -->
            <?php
            if ($_SESSION['tipo_tor'] == 2) {
                ?>
            <!-- SOLICITUDES -->
                <li class="ripple"><a class="tree-toggle nav-header"> <span
                            class="fa-bell-o fa"></span> Solicitud <span
                            class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                    <ul class="nav nav-list tree">
                     <!--   <li><a href="<?php // echo SERVERURL; ?>solicitud-new/">Nueva
                                solicitud</a></li>  -->
                         <li><a href="<?php echo SERVERURL; ?>solicitudes-list/">Solicitudes</a></li>
                        <li><a href="<?php echo SERVERURL; ?>solicitud-list/">Lista de
                                solicitudes</a></li>
                        <li><a href="<?php echo SERVERURL; ?>solicitud-search/">Buscar
                                solicitud</a></li>
                    </ul></li>

               

                    
                <!-- Gestionar Asignciones -->
                <li class="ripple"><a class="tree-toggle nav-header"> <span
                            class="fa-check-square-o fa"></span> Asignacion <span
                            class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                    <ul class="nav nav-list tree">
                        <li><a href="<?php echo SERVERURL; ?>asignacion-new/">Nueva
                                asignacion</a></li>
                        <li><a href="<?php echo SERVERURL; ?>asignacion-list/">Lista de
                                asignaciones</a></li>
                        <li><a href="<?php echo SERVERURL; ?>asignacion-search/">Buscar
                                asignacion</a></li>
                    </ul></li>

                <li class="ripple"><a href="<?php echo SERVERURL; ?>reporte/"><span
                            class="fa-print fa"></span> Reporte <span
                            class="fa-angle-right fa right-arrow text-right"></span> </a></li>

                <!-- TURNOS -->
                <li class="ripple"><a class="tree-toggle nav-header"> <span
                            class="fa-bell-o fa"></span> Turno <span
                            class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                    <ul class="nav nav-list tree">
                        <li><a href="<?php echo SERVERURL; ?>turno-new/">Nuevo
                                Turno</a></li> 
                        <li><a href="<?php echo SERVERURL; ?>turno-list/">Lista de
                                Turnos</a></li>
                        <li><a href="<?php echo SERVERURL; ?>turno-search/">Buscar
                                turno</a></li>

                                <li><a href="<?php echo SERVERURL; ?>cubiculo-new/">Nuevo
                                cubiculo</a></li> 
                        <li><a href="<?php echo SERVERURL; ?>cubiculo-list/">Lista de
                        cubiculos</a></li>
                        <li><a href="<?php echo SERVERURL; ?>cubiculo-search/">Buscar
                        cubiculo</a></li>
                        
                    </ul></li>

                    <!-- INICIO ACTIVIDAD -->
                    <li class="ripple"><a class="tree-toggle nav-header"><span class="fa-tasks fa"></span> Actividad  <span class="fa-angle-right fa right-arrow text-right"></span> </a>
                      <ul class="nav nav-list tree">
                      
                      <!-- SECTOR -->
                      <li class="ripple">
                            <a class="sub-tree-toggle nav-header">
                                <span class="fa fa-picture-o"></span> Sector
                                <span class="fa-angle-right fa right-arrow text-right"></span>
                            </a>
                            <ul class="nav nav-list sub-tree">
                                <li><a href="<?php echo SERVERURL; ?>sector-new/">Agregar Sector</a></li>
                                <li><a href="<?php echo SERVERURL; ?>sector-list/">Lista de Sectores</a></li>
                                <li><a href="<?php echo SERVERURL; ?>sector-search/">Buscar Sector</a></li>
                            </ul>
                        </li>

                        <!-- ACTIVIDAD -->
                        <li class="ripple">
                          <a class="sub-tree-toggle nav-header">
                            <span class="fa fa-newspaper-o"></span> Actividad
                            <span class="fa-angle-right fa right-arrow text-right"></span>
                          </a>
                          <ul class="nav nav-list sub-tree">
                            <li><a href="<?php echo SERVERURL; ?>actividad-new/">Nueva actividad</a></li>
                        <li><a href="<?php echo SERVERURL; ?>actividad-list/">Lista de actividades</a></li>
                        <li><a href="<?php echo SERVERURL; ?>actividad-search/">Buscar actividad</a></li>
                          </ul>
                        </li>
                        
                        <!-- PASOS -->
                        <li class="ripple">
                          <a class="sub-tree-toggle nav-header">
                            <span class="fa fa-road"></span> Pasos
                            <span class="fa-angle-right fa right-arrow text-right"></span>
                          </a>
                          <ul class="nav nav-list sub-tree">
                            <li><a href="<?php echo SERVERURL; ?>paso-new/">Nuevo paso</a></li>
                        <li><a href="<?php echo SERVERURL; ?>paso-list/">Lista de pasos</a></li>
                        <li><a href="<?php echo SERVERURL; ?>paso-search/">Buscar paso</a></li>
                          </ul>
                        </li>
                        
                        <!-- ANEXOS -->
                        <li class="ripple">
                          <a class="sub-tree-toggle nav-header">
                            <span class="fa fa-file-pdf-o"></span> Anexos
                            <span class="fa-angle-right fa right-arrow text-right"></span>
                          </a>
                          <ul class="nav nav-list sub-tree">
                            <li><a href="<?php echo SERVERURL; ?>anexo-new/">Nuevo anexo</a></li>
                        <li><a href="<?php echo SERVERURL; ?>anexo-list/">Lista de anexos</a></li>
                        <li><a href="<?php echo SERVERURL; ?>anexo-search/">Buscar anexo</a></li>
                          </ul>
                        </li>
                        
                        <!-- CATEGORIA -->
                        <li class="ripple">
                          <a class="sub-tree-toggle nav-header">
                            <span class="fa fa-filter"></span> Categoria
                            <span class="fa-angle-right fa right-arrow text-right"></span>
                          </a>
                          <ul class="nav nav-list sub-tree">
                            <li><a href="<?php echo SERVERURL; ?>categoria-new/">Nueva categoria</a></li>
                        <li><a href="<?php echo SERVERURL; ?>categoria-list/">Lista de categorias</a></li>
                        <li><a href="<?php echo SERVERURL; ?>categoria-search/">Buscar categoria</a></li>
                          </ul>
                        </li>
                        
                        <!-- INDICADOR -->
                        <li class="ripple">
                          <a class="sub-tree-toggle nav-header">
                            <span class="fa fa-area-chart"></span> Indicador
                            <span class="fa-angle-right fa right-arrow text-right"></span>
                          </a>
                          <ul class="nav nav-list sub-tree">
                            <li><a href="<?php echo SERVERURL; ?>indicador-new/">Nuevo indicador</a></li>
                        <li><a href="<?php echo SERVERURL; ?>indicador-list/">Lista de indicadores</a></li>
                        <li><a href="<?php echo SERVERURL; ?>indicador-search/">Buscar indicador</a></li>
                          </ul>
                        </li>
                        
                        
                        
                        
                      </ul>
                    </li>
                <!-- FIN ACTIVIDAD -->
                
                <?php
            }
            ?>




            <!-- area de menu para el usuario que solo va cargar solicitudes -->  

            <?php
            if ($_SESSION['tipo_tor'] == 4) {
                ?>
                <!-- Gestionar Solicitudes -->
                <li class="ripple"><a class="tree-toggle nav-header"> <span
                            class="fa-bell-o fa"></span> Solicitud <span
                            class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                    <ul class="nav nav-list tree">
                   <!--    <li><a href="<?php // echo SERVERURL; ?>solicitud-new/">Nueva
                                solicitud</a></li>
                      -->
                        <li><a href="<?php echo SERVERURL; ?>solicitud-list/">Lista de
                                solicitudes</a></li>
                        <li><a href="<?php echo SERVERURL; ?>solicitud-search/">Buscar
                                solicitud</a></li>
                    </ul></li>


                <?php
            }
            ?>

            <!-- Area Administracion, Actividades, Categorias, Direccion, Pasos, Anexos, Cargos -->
            <?php
            if ($_SESSION['privilegio_tor'] == 1 && $_SESSION['tipo_tor'] == 1) {
                ?>

             <!-- SOLICITUDES -->
                <li class="ripple"><a class="tree-toggle nav-header"> <span
                            class="fa-bell-o fa"></span> Solicitud <span
                            class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                    <ul class="nav nav-list tree">
                   <!--     <li><a href="<?php // echo SERVERURL; ?>solicitud-new/">Nueva
                                solicitud</a></li>   -->
                         <li><a href="<?php echo SERVERURL; ?>solicitudes-list/">Solicitudes</a></li>
                        <li><a href="<?php echo SERVERURL; ?>solicitud-list/">Lista de
                                solicitudes</a></li>
                        <li><a href="<?php echo SERVERURL; ?>solicitud-search/">Buscar
                                solicitud</a></li>
                    </ul></li>

                               <!-- TURNOS -->
                <li class="ripple"><a class="tree-toggle nav-header"> <span
                            class="fa-bell-o fa"></span> Turno <span
                            class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                    <ul class="nav nav-list tree">
                        <li><a href="<?php echo SERVERURL; ?>turno-new/">Nuevo
                                Turno</a></li> 
                        <li><a href="<?php echo SERVERURL; ?>turno-list/">Lista de
                                Turnos</a></li>
                        <li><a href="<?php echo SERVERURL; ?>turno-search/">Buscar
                                turno</a></li>

                                <li><a href="<?php echo SERVERURL; ?>cubiculo-new/">Nuevo
                                cubiculo</a></li> 
                        <li><a href="<?php echo SERVERURL; ?>cubiculo-list/">Lista de
                        cubiculos</a></li>
                        <li><a href="<?php echo SERVERURL; ?>cubiculo-search/">Buscar
                        cubiculo</a></li>
                        
                    </ul></li>
                    
                    
                <!-- ASIGNACIONES -->
                <li class="ripple"><a class="tree-toggle nav-header"> <span
                            class="fa-check-square-o fa"></span> Asignacion <span
                            class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                    <ul class="nav nav-list tree">
                        <li><a href="<?php echo SERVERURL; ?>asignacion-new/">Nueva
                                asignacion</a></li>
                        <li><a href="<?php echo SERVERURL; ?>asignacion-list/">Lista de
                                asignaciones</a></li>
                        <li><a href="<?php echo SERVERURL; ?>asignacion-search/">Buscar
                                asignacion</a></li>
                    </ul></li>
                    
                <!-- PROCESAR -->
                <li class="ripple"><a class="tree-toggle nav-header"> <span
                            class="fa-sort-amount-asc fa"></span> Procesar <span
                            class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                    <ul class="nav nav-list tree">
                        <li><a href="<?php echo SERVERURL; ?>procesar-new/">Procesar Asignacion</a></li>
                        <li><a href="<?php echo SERVERURL; ?>procesar-list/">Lista de
                                Procesamientos</a></li>
                        <li><a href="<?php echo SERVERURL; ?>asignacion-anexo-list/">Anexo de Asignaciones</a></li>
                    </ul></li>   
                    
                <!-- INICIO ACTIVIDAD -->
                <li class="ripple"><a class="tree-toggle nav-header"><span class="fa-tasks fa"></span> Actividad  <span class="fa-angle-right fa right-arrow text-right"></span> </a>
                      <ul class="nav nav-list tree">
                      
                        <!-- ACTIVIDAD -->
                        <li class="ripple">
                          <a class="sub-tree-toggle nav-header">
                            <span class="fa fa-newspaper-o"></span> Actividad
                            <span class="fa-angle-right fa right-arrow text-right"></span>
                          </a>
                          <ul class="nav nav-list sub-tree">
                            <li><a href="<?php echo SERVERURL; ?>actividad-new/">Nueva actividad</a></li>
                        <li><a href="<?php echo SERVERURL; ?>actividad-list/">Lista de actividades</a></li>
                        <li><a href="<?php echo SERVERURL; ?>actividad-search/">Buscar actividad</a></li>
                          </ul>
                        </li>
                        
                        <!-- PASOS -->
                        <li class="ripple">
                          <a class="sub-tree-toggle nav-header">
                            <span class="fa fa-road"></span> Pasos
                            <span class="fa-angle-right fa right-arrow text-right"></span>
                          </a>
                          <ul class="nav nav-list sub-tree">
                            <li><a href="<?php echo SERVERURL; ?>paso-new/">Nuevo paso</a></li>
                        <li><a href="<?php echo SERVERURL; ?>paso-list/">Lista de pasos</a></li>
                        <li><a href="<?php echo SERVERURL; ?>paso-search/">Buscar paso</a></li>
                          </ul>
                        </li>
                        
                        <!-- ANEXOS -->
                        <li class="ripple">
                          <a class="sub-tree-toggle nav-header">
                            <span class="fa fa-file-pdf-o"></span> Anexos
                            <span class="fa-angle-right fa right-arrow text-right"></span>
                          </a>
                          <ul class="nav nav-list sub-tree">
                            <li><a href="<?php echo SERVERURL; ?>anexo-new/">Nuevo anexo</a></li>
                        <li><a href="<?php echo SERVERURL; ?>anexo-list/">Lista de anexos</a></li>
                        <li><a href="<?php echo SERVERURL; ?>anexo-search/">Buscar anexo</a></li>
                          </ul>
                        </li>
                        
                        <!-- CATEGORIA -->
                        <li class="ripple">
                          <a class="sub-tree-toggle nav-header">
                            <span class="fa fa-filter"></span> Categoria
                            <span class="fa-angle-right fa right-arrow text-right"></span>
                          </a>
                          <ul class="nav nav-list sub-tree">
                            <li><a href="<?php echo SERVERURL; ?>categoria-new/">Nueva categoria</a></li>
                        <li><a href="<?php echo SERVERURL; ?>categoria-list/">Lista de categorias</a></li>
                        <li><a href="<?php echo SERVERURL; ?>categoria-search/">Buscar categoria</a></li>
                          </ul>
                        </li>
                        
                        <!-- INDICADOR -->
                        <li class="ripple">
                          <a class="sub-tree-toggle nav-header">
                            <span class="fa fa-area-chart"></span> Indicador
                            <span class="fa-angle-right fa right-arrow text-right"></span>
                          </a>
                          <ul class="nav nav-list sub-tree">
                            <li><a href="<?php echo SERVERURL; ?>indicador-new/">Nuevo indicador</a></li>
                        <li><a href="<?php echo SERVERURL; ?>indicador-list/">Lista de indicadores</a></li>
                        <li><a href="<?php echo SERVERURL; ?>indicador-search/">Buscar indicador</a></li>
                          </ul>
                        </li>
                        
                        
                        
                        
                      </ul>
                    </li>
                <!-- FIN ACTIVIDAD -->
                    
                <!-- AREA PARA COLOCAR LA CONFIGURACION: USUARIO, CARGO, DIRECCION, CONFIGURACION, BITACORA, REPORTE -->

                <li class="ripple"><a class="tree-toggle nav-header"><span class="fa-cogs fa"></span> Administracion <span class="fa-angle-right fa right-arrow text-right"></span> </a>
                    <ul class="nav nav-list tree">
                        
                        <!-- ACTIVOS -->
                      <!--
                        <li class="ripple">
                            <a class="sub-tree-toggle nav-header">
                                <span class="fa fa-newspaper-o"></span> Activos
                                <span class="fa-angle-right fa right-arrow text-right"></span>
                            </a>
                            <ul class="nav nav-list sub-tree">
                                <li><a href="<?php // echo SERVERURL; ?>producto-new/">Agregar Activo</a></li>
                                <li><a href="<?php //echo SERVERURL; ?>producto-list/">Lista de Activos</a></li>
                                <li><a href="<?php //echo SERVERURL; ?>producto-search/">Buscar Activo</a></li>
                                <li><a href="<?php //echo SERVERURL; ?>producto-categoria/">Por Categoria</a></li>
                                <li><a href="<?php //echo SERVERURL; ?>kategoria-new/">Nueva Categoria</a></li>
                                <li><a href="<?php //echo SERVERURL; ?>kategoria-list/">Lista Categorias</a></li>
                                <li><a href="<?php //echo SERVERURL; ?>kategoria-search/">Buscar Categoria</a></li>
                                <li><a href="<?php //echo SERVERURL; ?>activo-usuario/">Activos vs Usuarios</a></li>
                            </ul>
                        </li>
                        -->
                       
                        <!-- USUARIO -->
                        <li class="ripple">
                            <a class="sub-tree-toggle nav-header">
                                <span class="fa fa-users"></span> Usuario
                                <span class="fa-angle-right fa right-arrow text-right"></span>
                            </a>
                            <ul class="nav nav-list sub-tree">
                                <li><a href="<?php echo SERVERURL; ?>user-new/">Agregar Usuario</a></li>
                                <li><a href="<?php echo SERVERURL; ?>user-list/">Lista de Usuarios</a></li>
                                <li><a href="<?php echo SERVERURL; ?>user-search/">Buscar Usuario</a></li>
                                <li><a href="<?php echo SERVERURL; ?>user-cargo/">Usuario Cargo</a></li>
                                <li><a href="<?php echo SERVERURL; ?>user-direccion/">Usuario Direccion</a></li>
                            </ul>
                        </li>

                        <!-- DIRECCION -->
                        <li class="ripple">
                            <a class="sub-tree-toggle nav-header">
                                <span class="fa fa-university"></span> Direccion
                                <span class="fa-angle-right fa right-arrow text-right"></span>
                            </a>
                            <ul class="nav nav-list sub-tree">
                                <li><a href="<?php echo SERVERURL; ?>direccion-new/">Nueva direccion</a></li>
                                <li><a href="<?php echo SERVERURL; ?>direccion-list/">Lista de direcciones</a></li>
                                <li><a href="<?php echo SERVERURL; ?>direccion-search/">Buscar direccion</a></li>
                            </ul>
                        </li>

                        <!-- CARGO -->
                        <li class="ripple">
                            <a class="sub-tree-toggle nav-header">
                                <span class="fa fa-star"></span> Cargo
                                <span class="fa-angle-right fa right-arrow text-right"></span>
                            </a>
                            <ul class="nav nav-list sub-tree">
                                <li><a href="<?php echo SERVERURL; ?>cargo-new/">Nuevo cargo</a></li>
                                <li><a href="<?php echo SERVERURL; ?>cargo-list/">Lista de cargos</a></li>
                                <li><a href="<?php echo SERVERURL; ?>cargo-search/">Buscar cargo</a></li>
                            </ul>
                        </li>
                        
                        <!-- GABINETE -->
                        <li class="ripple">
                            <a class="sub-tree-toggle nav-header">
                                <span class="fa fa-building"></span> Gabinete
                                <span class="fa-angle-right fa right-arrow text-right"></span>
                            </a>
                            <ul class="nav nav-list sub-tree">
                                <li><a href="<?php echo SERVERURL; ?>gabinete-new/">Agregar Gabinete</a></li>
                                <li><a href="<?php echo SERVERURL; ?>gabinete-list/">Lista de Gabinetes</a></li>
                                <li><a href="<?php echo SERVERURL; ?>gabinete-search/">Buscar Gabinete</a></li>
                            </ul>
                        </li>
                        
                        <!-- MUNICIPIO -->
                        <li class="ripple">
                            <a class="sub-tree-toggle nav-header">
                                <span class="fa fa-map-marker"></span> Municipio
                                <span class="fa-angle-right fa right-arrow text-right"></span>
                            </a>
                            <ul class="nav nav-list sub-tree">
                                <li><a href="<?php echo SERVERURL; ?>municipio-new/">Agregar Municipio</a></li>
                                <li><a href="<?php echo SERVERURL; ?>municipio-list/">Lista de Municipios</a></li>
                                <li><a href="<?php echo SERVERURL; ?>municipio-search/">Buscar Municipio</a></li>
                            </ul>
                        </li>
                        
                        <!-- PARROQUIA -->
                        <li class="ripple">
                            <a class="sub-tree-toggle nav-header">
                                <span class="fa fa-industry"></span> Parroquia
                                <span class="fa-angle-right fa right-arrow text-right"></span>
                            </a>
                            <ul class="nav nav-list sub-tree">
                                <li><a href="<?php echo SERVERURL; ?>parroquia-new/">Agregar Parroquia</a></li>
                                <li><a href="<?php echo SERVERURL; ?>parroquia-list/">Lista de Parroquias</a></li>
                                <li><a href="<?php echo SERVERURL; ?>parroquia-search/">Buscar Parroquia</a></li>
                            </ul>
                        </li>
                        
                        <!-- SECTOR -->
                        <li class="ripple">
                            <a class="sub-tree-toggle nav-header">
                                <span class="fa fa-picture-o"></span> Sector
                                <span class="fa-angle-right fa right-arrow text-right"></span>
                            </a>
                            <ul class="nav nav-list sub-tree">
                                <li><a href="<?php echo SERVERURL; ?>sector-new/">Agregar Sector</a></li>
                                <li><a href="<?php echo SERVERURL; ?>sector-list/">Lista de Sectores</a></li>
                                <li><a href="<?php echo SERVERURL; ?>sector-search/">Buscar Sector</a></li>
                            </ul>
                        </li>
                        
                        <!-- CONFIGURACION -->
                        <li><a href="<?php echo SERVERURL; ?>configuracion-list/"><span class="fa fa-cog"></span>Configuracion</a></li>
                        
                        <!-- REPORTES -->
                        <li><a href="<?php echo SERVERURL; ?>reporte/"><span class="fa fa-print"></span>Reportes</a></li>

                        <!-- FEEDBACK -->
                        <li class="ripple">
                            <a class="sub-tree-toggle nav-header">
                                <span class="fa fa-picture-o"></span> Evaluacion
                                <span class="fa-angle-right fa right-arrow text-right"></span>
                            </a>
                            <ul class="nav nav-list sub-tree">
                                <li><a href="<?php echo SERVERURL; ?>evaluacion-list/">Lista de Evaluaciones</a></li>
                                <li><a href="<?php echo SERVERURL; ?>evaluacion-search/">Buscar Evaluacion</a></li>
                            </ul>
                        </li>
                        
                        <!-- BITACORA -->
                        <li class="ripple">
                            <a class="sub-tree-toggle nav-header">
                                <span class="fa fa-bars"></span> Bitacora
                                <span class="fa-angle-right fa right-arrow text-right"></span>
                            </a>
                            <ul class="nav nav-list sub-tree">
                                <li><a href="<?php echo SERVERURL; ?>bitacora-list/">Bitacora</a></li>
                        <li><a href="<?php echo SERVERURL; ?>bitacora-search/">Buscar bitacora</a></li>
                            </ul>
                        </li>
                        
                        
                    </ul>
                </li>

                
                
                <!-- FIN CONFIGURACION  -->
                

                <?php
            }
            ?>
        </ul>
    </div>
</div>
<!-- end: Left Menu -->
