<?php
//Comento el siguiente codigo para poder registrar mi primer usuario que sera el administrador
if($_SESSION['privilegio_tor']!=1) {
  $lc->forzar_cierre_sesion_controlador();
  exit();
  }
?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Usuario / Agregar nuevo usuario</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a class="active" href="<?php echo SERVERURL; ?>user-new/">Nuevo Usuario <span class="fa-angle-right fa"></span></a> 
                <a href="<?php echo SERVERURL; ?>user-list/">Lista de Usuarios <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>user-search/">Buscar Usuario <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->

<div class="container-fluid">
    <form class="cmxform FormularioAjax" action="<?php echo SERVERURL; ?>ajax/usuarioAjax.php" method="POST" data-form="save" autocomplete="off">
        <fieldset>
            <legend><i class="far fa-address-card"></i> &nbsp; Información personal</legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[0-9-]{6,20}" class="form-text" name="usuario_dni_reg" id="usuario_dni" maxlength="20" required="">
                            <span class="bar"></span>
                            <label for="usuario_dni">Cedula</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-ZÃ¡Ã©Ã­Ã³ÃºÃ�Ã‰Ã�Ã“ÃšÃ±Ã‘ ]{4,50}" class="form-text" name="usuario_nombre_reg" id="usuario_nombre" maxlength="35" required="">
                            <span class="bar"></span>
                            <label for="usuario_nombre">Nombres</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-ZÃ¡Ã©Ã­Ã³ÃºÃ�Ã‰Ã�Ã“ÃšÃ±Ã‘ ]{4,50}" class="form-text" name="usuario_apellido_reg" id="usuario_apellido" maxlength="35" required="">
                            <span class="bar"></span>
                            <label for="usuario_apellido">Apellidos</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-animate-text" style="margin-top:10px !important;">
                            <input type="text" pattern="[0-9()+]{8,20}" class="form-text" name="usuario_telefono_reg" id="usuario_telefono" maxlength="20">
                            <span class="bar"></span>
                            <label for="usuario_telefono">Teléfono</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-animate-text" style="margin-top:10px !important;">
                            <input type="text" pattern="[a-zA-Z0-9Ã¡Ã©Ã­Ã³ÃºÃ�Ã‰Ã�Ã“ÃšÃ±Ã‘().,#\- ]{4,200}" class="form-text" name="usuario_direccion_reg" id="usuario_direccion" maxlength="190">
                            <span class="bar"></span>
                            <label for="usuario_direccion">Dirección</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-animate-text" style="margin-top:0px !important;">
                            <input type="date" class="form-text" name="usuario_fecha_nacimiento_reg" id="usuario_fecha_nacimiento" value="<?php echo date("Y-m-d"); ?>" required="">
                            <span class="bar"></span>
                            <label for="usuario_cedula">Fecha Nacimiento</label>
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
                    
                    <!-- Foto de perfil del jugador -->
		    <div class="col-md-6">
                        <label for="multimedia_archivo_perfil">Foto Perfil (286x180) Tipo Archivo: jpg, png.</label>
                       
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="file" class="form-text" name="multimedia_perfil_reg" id="multimedia_archivo_perfil" required="">
                            <span class="bar"></span>
                             </div>
                    </div> 
                    
                </div>
            </div>
        </fieldset>
        <br>
        <fieldset>
            <legend><i class="fas fa-user-lock"></i> &nbsp; Información de la cuenta</legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                         <input type="text" pattern="[a-zA-Z0-9]{4,50}" class="form-text" name="usuario_usuario_reg" id="usuario_usuario" maxlength="35" required="">
                        <span class="bar"></span>
                        <label for="usuario_usuario">Nombre de usuario</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                         <input type="email" class="form-text" name="usuario_email_reg" id="usuario_email" maxlength="70">
                        <span class="bar"></span>
                        <label for="usuario_email">Email</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group form-animate-text" style="margin-top:10px !important;">
                         <input type="password" class="form-text" name="usuario_clave_1_reg" id="usuario_clave_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required="" >
                        <span class="bar"></span>
                        <label for="usuario_clave_1">Contraseña</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group form-animate-text" style="margin-top:10px !important;">
                          <input type="password" class="form-text" name="usuario_clave_2_reg" id="usuario_clave_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required="" >
                        <span class="bar"></span>
                        <label for="usuario_clave_2">Repetir contraseña</label>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <br>
        <fieldset>
            <legend><i class="fas fa-medal"></i> &nbsp; Nivel de privilegio y tipo de usuario</legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <p><span class="badge badge-info">Control total</span> Permisos para registrar, actualizar y eliminar</p>
                        <p><span class="badge badge-success">Edición</span> Permisos para registrar y actualizar</p>
                        <p><span class="badge badge-dark">Registrar</span> Solo permisos para registrar</p>
                        <div class="form-group">
                            <select class="form-control" name="usuario_privilegio_reg">
                                <option value="" selected="" disabled="">Seleccione un privilegio</option>
                                <option value="1">Control total</option>
                                <option value="2">Edición</option>
                                <option value="3">Registrar</option>
                            </select>
                        </div>
                        </div>
                        
                        <div class="col-md-6">
                        <p><span class="badge badge-info">Administrador y supervisor</span> Quien asigna y controla el sistema</p>
                        <p><span class="badge badge-success">Operador</span> Quien procesa los incidentes</p>
                        <p><span class="badge badge-dark">Usuario</span> Quien realiza solicitudes</p>
                        <div class="form-group">
                            <select class="form-control" name="usuario_tipo_reg">
                                <option value="" selected="" disabled="">Seleccione un tipo</option>
                                <option value="1">Administrador</option>
                                <option value="2">Supervisor</option>
                                <option value="3">Operador</option>
                                <option value="4">Usuario</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <p class="text-center" style="margin-top: 40px;">
            <button type="reset" class="btn btn-3d btn-warning btn-sm"><i class="fa-refresh fa"></i> &nbsp; LIMPIAR</button>
            &nbsp; &nbsp;
            <button type="submit" class="btn btn-3d btn-info btn-sm"><i class="fa-save fa"></i> &nbsp; GUARDAR</button>
        </p>
    </form>
</div>
