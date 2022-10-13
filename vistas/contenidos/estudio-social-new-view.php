<?php
if($_SESSION['privilegio_tor']<1 || $_SESSION['privilegio_tor']>3 || $_SESSION['tipo_tor']==4) {
  $lc->forzar_cierre_sesion_controlador();
  exit();
  }
?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Estudio Social / Crear Nuevo</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a class="active" href="<?php echo SERVERURL; ?>estudio-social-new/">Nuevo estudio social <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>estudio-social-list/">Lista de estudio sociales <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>estudio-social-search/">Buscar estudio social <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->

<div class="container-fluid">

<!-- FORMULARIO PARA AGREGAR FAMILIARES  -->
<form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/estudioAjax.php" method="POST" data-form="save" autocomplete="off">
     
     <!-- Area para agregar el grupo familiar  -->
     <fieldset>
         <legend><i class="far fa-address-card"></i> &nbsp; Grupo Familiar</legend>
         <div class="container-fluid">
             <div class="row">
                 <div class="col-md-3">
                     <div class="form-group form-animate-text" style="margin-top:20px !important;">
                         <input type="text" pattern="[0-9-]{5,30}" class="form-text" name="numero_cedula_solicitante_familiar_reg" id="solicitante_cedula_familiar" maxlength="30">
                         <span class="bar"></span>
                         <label for="estudio-social_nombre">Cédula Solicitante</label>
                     </div>
                 </div>

                 <div class="col-md-3">
                     <div class="form-group form-animate-text" style="margin-top:20px !important;">
                         <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}" class="form-text" name="nombre_familiar_reg" id="nombre_familiar" maxlength="150">
                         <span class="bar"></span>
                         <label for="estudio-social_nombre">Nombres y Apellidos Familiar</label>
                     </div>
                 </div>
                 <div class="col-md-3">
                     <div class="form-group form-animate-text" style="margin-top:20px !important;">
                         <input type="text" pattern="[0-9-]{5,30}" class="form-text" name="cedula_familiar_reg" id="cedula_familiar" maxlength="30">
                         <span class="bar"></span>
                         <label for="estudio-social_nombre">No. Cédula del Familiar</label>
                     </div>
                 </div>
                 <div class="col-md-3">
                     <div class="form-group form-animate-text" style="margin-top:20px !important;">
                         <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,200}" class="form-text" name="lugar_nacimiento_familiar_reg" id="lugar_nacimiento_familiar" maxlength="200">
                         <span class="bar"></span>
                         <label for="estudio-social_nombre">Lugar Nacimiento del Familiar</label>
                     </div>
                 </div>

                 <div class="col-md-3">
                     <div class="form-group form-animate-text" style="margin-top:20px !important;">
                         <input type="date" value="<?php echo date("Y-m-d"); ?>" class="form-text" name="fecha_nacimiento_familiar_reg" id="fecha_nacimiento_familiar" maxlength="150">
                         <span class="bar"></span>
                         <label for="estudio-social_nombre">Fecha Nacimiento</label>
                     </div>
                 </div>
                 <div class="col-md-3">
                     <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <select class="form-text" name="genero_familiar_reg">
                            <option value="MASCULINO" selected="">MASCULINO</option>
                            <option value="FEMENINO">FEMENINO</option>
                            </select>
                         <span class="bar"></span>
                         <label for="estudio-social_nombre">Genero</label>
                     </div>
                 </div>
                 <div class="col-md-3">
                     <div class="form-group form-animate-text" style="margin-top:20px !important;">
                         <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}" class="form-text" name="ocupacion_familiar_reg" id="ocupacion_familiar" maxlength="150">
                         <span class="bar"></span>
                         <label for="estudio-social_nombre">Ocupación</label>
                     </div>
                 </div>
                 <div class="col-md-3">
                     <div class="form-group form-animate-text" style="margin-top:20px !important;">
                         <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}" class="form-text" name="filiacion_reg" id="filiacion" maxlength="150">
                         <span class="bar"></span>
                         <label for="estudio-social_nombre">Filiación</label>
                     </div>
                 </div>

             </div>
         </div>
     </fieldset>
     
        <p class="text-left" style="margin-top: 20px;">
            <button type="reset" class="btn btn-3d btn-warning btn-sm"><i class="fa-refresh fa"></i> &nbsp; LIMPIAR</button>
            &nbsp; &nbsp;
            <button type="submit" class="btn btn-3d btn-success btn-sm"><i class="fa-plus fa"></i> &nbsp; AGREGAR FAMILIAR</button>
        </p>

</form> <br><br><br>

<div class="container-fluid">
<?php
require_once "./controladores/estudioControlador.php";
$ins_familiar = new estudioControlador();
echo $ins_familiar->paginador_familiar_controlador($pagina[1], 10, $pagina[0]);
?>
</div>

<br><br><br>

</div>
<div class="container-fluid">

     <!-- AREA PRINCIPAL DEL INFORME SOCIAL -->
    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/estudioAjax.php" method="POST" data-form="save" autocomplete="off">
        <!-- Area para agregar los datos personales -->
        <fieldset>
            <legend><i class="far fa-address-card"></i> &nbsp; Datos Personales</legend>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}" class="form-text" name="nombres_apellidos_solicitante_reg" id="nombres_apellidos_solicitante" maxlength="150" required="">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Nombres y Apellidos</label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <select class="form-text" name="tipo_cedula_solicitante_reg" required="">
                            <option value="V-" selected="">V-</option>
                            <option value="E-">E-</option>
                            </select>
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Tipo de Documento</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[0-9-]{5,30}" class="form-text" name="numero_cedula_solicitante_reg" id="numerocedula_solicitante" maxlength="30" required="">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">No. Cédula</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,50}" class="form-text" name="nacionalidad_solicitante_reg" id="nacionalidad_solicitante" maxlength="50">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Nacionalidad</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,20}" class="form-text" name="estado_civil_reg" id="estadocivil_solicitante" maxlength="20">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Estado Civil</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,40}" class="form-text" name="telefono_fax_celular_reg" id="telefono_solicitante" maxlength="40">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Telefono / Fax / Celular</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,200}" class="form-text" name="lugar_nacimiento_solicitante_reg" id="lugarnacimiento_solicitante" maxlength="200">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Lugar de Nacimiento</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,50}" class="form-text" name="estado_nacimiento_reg" id="estadonacimiento_solicitante" maxlength="50">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Estado</label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="date" value="<?php echo date("Y-m-d"); ?>" class="form-text" name="fecha_nacimiento_reg" id="fechanacimiento_solicitante">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Fecha de Nacimiento</label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <select class="form-text" name="genero_reg">
                            <option value="MASCULINO" selected="">MASCULINO</option>
                            <option value="FEMENINO">FEMENINO</option>
                            </select>
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Genero</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,200}" class="form-text" name="direccion_permanente_reg" id="direccion_solicitante" maxlength="200">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Direccion Permanente</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,30}" class="form-text" name="municipio_reg" id="municipio_solicitante" maxlength="30">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Municipio</label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,50}" class="form-text" name="parroquia_reg" id="parroquia_solicitante" maxlength="50">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Parroquia</label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,50}" class="form-text" name="estado_reg" id="estado_solicitante" maxlength="50">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Estado</label>
                        </div>
                    </div>


                </div>
            </div>
        </fieldset>

        <!-- Area para agregar  el grado de instruccion  -->
        <fieldset>
            <legend><i class="far fa-address-card"></i> &nbsp; Grado de Instrucción</legend>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <select class="form-text" name="grado_instruccion_reg">
                            <option value="NO POSEE" selected="">NO POSEE</option>
                            <option value="PRIMARIA">PRIMARIA</option>
                            <option value="SECUNDARIA">SECUNDARIA</option>
                            <option value="TECNICA">TECNICA</option>
                            <option value="UNIVERSITARIA">UNIVERSITARIA</option>
                            </select>
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Seleccionar</label>
                        </div>
                    </div>

                </div>
            </div>
        </fieldset>

        <!-- Area para agregar  la situacion socio economica  -->
        <fieldset>
            <legend><i class="far fa-address-card"></i> &nbsp; Situación Socioeconómica</legend>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <select class="form-text" name="trabaja_reg">
                            <option value="NO" selected="">NO</option>
                            <option value="SI">SI</option>
                            </select>
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Trabaja</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,60}" class="form-text" name="profesion_reg" id="profesion" maxlength="60">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Profesión</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,120}" class="form-text" name="institucion_reg" id="institucion" maxlength="120">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Institución o Empresa</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,120}" class="form-text" name="ocupacion_reg" id="ocupacion" maxlength="120">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Ocupación</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,40}" class="form-text" name="telefono_trabajo_reg" id="telefono_trabajo" maxlength="40">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Teléfono</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,200}" class="form-text" name="direccion_trabajo_reg" id="direccion_trabajo" maxlength="200">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Dirección Laboral</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[0-9.]{1,25}" class="form-text" name="ingreso_familiar_reg" id="ingreso_familiar" maxlength="25">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Ingreso Familiar</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,200}" class="form-text" name="observaciones_reg" id="observaciones" maxlength="200">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Observaciones</label>
                        </div>
                    </div>


                </div>
            </div>
        </fieldset>
        
         <!-- Area para indicar el tipo de vivienda y la tenencia  -->
         <fieldset>
            <legend><i class="far fa-address-card"></i> &nbsp; Tipo de Vivienda y Tenencia</legend>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                        <select class="form-text" name="tipo_vivienda_reg">
                            
                            <option value="APARTAMENTO">APARTAMENTO</option>
                            <option value="QUINTA">QUINTA</option>
                            <option value="RANCHO">RANCHO</option>
                            <option value="CASA" selected="">CASA</option>
                            <option value="OTRO">OTRO</option>
                            </select>
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">TIPO DE VIVIENDA</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                        <select class="form-text" name="tenencia_vivienda_reg">
                            
                            <option value="PROPIA" selected="">PROPIA</option>
                            <option value="ALQUILADA">ALQUILADA</option>
                            <option value="ALOJADA">ALOJADA</option>
                            <option value="COMPARTIDA">COMPARTIDA</option>
                            <option value="OTRO">OTRO</option>
                            </select> <span class="bar"></span>
                            <label for="estudio-social_nombre">TENENCIA</label>
                        </div>
                    </div>

                </div>
            </div>
        </fieldset>

        <!-- Area para indicar el tipo de ayuda requerida  -->
        <fieldset>
            <legend><i class="far fa-address-card"></i> &nbsp; Indique el tipo de ayuda requerida</legend>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,1200}" class="form-text" name="tipo_ayuda_reg" id="tipo_ayuda" maxlength="1200">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Coloque una breve descripción</label>
                        </div>
                    </div>

                </div>
            </div>
        </fieldset>

        <!-- Area para agregar el resumen del caso  -->
        <fieldset>
            <legend><i class="far fa-address-card"></i> &nbsp; Sintesis del caso</legend>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,1200}" class="form-text" name="sintesis_caso_reg" id="sintesis_caso" maxlength="1200">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Coloque una breve descripción</label>
                        </div>
                    </div>

                </div>
            </div>
        </fieldset>

        <!-- Area para agregar el area socio económica  -->
        <fieldset>
            <legend><i class="far fa-address-card"></i> &nbsp; Área Socioeconómica</legend>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,1200}" class="form-text" name="area_socioeconomica_reg" id="area_socioeconomica" maxlength="1200">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Coloque una breve descripción</label>
                        </div>
                    </div>

                </div>
            </div>
        </fieldset>

        <!-- Area para agregar conclusión y recomendación  -->
        <fieldset>
            <legend><i class="far fa-address-card"></i> &nbsp; Conclusión y Recomendación</legend>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,1200}" class="form-text" name="conclusion_reg" id="conclusion" maxlength="1200">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Coloque una breve descripción</label>
                        </div>
                    </div>

                </div>
            </div>
        </fieldset>

        <!-- Area para agregar los documentos anexos  -->
        <fieldset>
            <legend><i class="far fa-address-card"></i> &nbsp; Documentos Anexos</legend>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            
                            <select class="form-text" name="planilla_solicitud_reg">
                            <option value="NO" selected="">NO</option>
                            <option value="SI">SI</option>
                            </select>

                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Planilla Solicitud</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            
                            <select class="form-text" name="copia_cedula_reg">
                            <option value="NO" selected="">NO</option>
                            <option value="SI">SI</option>
                            </select>
                            
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Copia Cedula Identidad</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <select class="form-text" name="informe_medico_reg">
                            <option value="NO" selected="">NO</option>
                            <option value="SI">SI</option>
                            </select>
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Informe Medico</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <select class="form-text" name="rif_reg">
                            <option value="NO" selected="">NO</option>
                            <option value="SI">SI</option>
                            </select>
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">RIF</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <select class="form-text" name="presupuesto_reg">
                            <option value="NO" selected="">NO</option>
                            <option value="SI">SI</option>
                            </select>
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Presupuesto</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <select class="form-text" name="orden_medica_reg">
                            <option value="NO" selected="">NO</option>
                            <option value="SI">SI</option>
                            </select>
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Orden Medica</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <select class="form-text" name="carta_reg">
                            <option value="NO" selected="">NO</option>
                            <option value="SI">SI</option>
                            </select>
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Carta Dirigida al Gobernador</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                             <select class="form-text" name="acta_nacimiento_reg">
                            <option value="NO" selected="">NO</option>
                            <option value="SI">SI</option>
                            </select>
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Acta de Nacimiento.(de ser necesaria)</label>
                        </div>
                    </div>

                </div>
            </div>
        </fieldset>

        <!-- Area para agregar las firmar del estudio social  -->
        <fieldset>
            <legend><i class="far fa-address-card"></i> &nbsp; Firmas del Estudio Social</legend>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}" class="form-text" name="elaborado_por_reg" id="elaborado" maxlength="150">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Elaborado por:</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}" class="form-text" name="nombre_apellido_elaborado_reg" id="nombre_apellido_elaborado" maxlength="150">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Nombre y Apellido</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}" class="form-text" name="cedula_elaborado_reg" id="cedula_elaborado" maxlength="150">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Cédula identidad</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}" class="form-text" name="supervisado_por_reg" id="supervisado" maxlength="150">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Supervisado por:</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}" class="form-text" name="nombre_apellido_supervisado_reg" id="nombre_apellido_supervisado" maxlength="150">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Nombre y Apellido</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}" class="form-text" name="cedula_supervisado_reg" id="cedula_supervisado" maxlength="150">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Cédula identidad</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}" class="form-text" name="aprobado_por_reg" id="aprobado" maxlength="150">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Aprobado por:</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}" class="form-text" name="nombre_apellido_aprobado_reg" id="nombre_apellido_aprobado" maxlength="150">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Nombre y Apellido</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}" class="form-text" name="cedula_aprobado_reg" id="cedula_aprobado" maxlength="150">
                            <span class="bar"></span>
                            <label for="estudio-social_nombre">Cédula identidad</label>
                        </div>
                    </div>
                   

                    
                    
                    
                    

                </div>
            </div>
        </fieldset>


        <p class="text-center" style="margin-top: 20px;">
            <button type="reset" class="btn btn-3d btn-warning btn-sm"><i class="fa-refresh fa"></i> &nbsp; LIMPIAR</button>
            &nbsp; &nbsp;
            <button type="submit" class="btn btn-3d btn-info btn-sm"><i class="fa-save fa"></i> &nbsp; GUARDAR INFORME</button>
        </p>
    </form>

 

</div>