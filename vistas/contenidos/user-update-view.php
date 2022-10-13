<?php
if ($lc->encryption($_SESSION['id_tor']) != $pagina[1]) {
    if ($_SESSION['privilegio_tor'] != 1) {
        $lc->forzar_cierre_sesion_controlador();
        exit();
    }
}
?>

<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Usuario / Actualizar datos del usuario</h3>
          <?php if ($_SESSION['privilegio_tor'] == 1) { ?>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a class="active" href="<?php echo SERVERURL; ?>user-new/">Nuevo Usuario <span class="fa-angle-right fa"></span></a> 
                <a href="<?php echo SERVERURL; ?>user-list/">Lista de Usuarios <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>user-search/">Buscar Usuario <span class="fa-angle-right fa"></span></a>
            </p>
            <?php } ?>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->

<!-- Inicio de Codigo para actualizar los datos del usuario -->
<div class="container-fluid">
    <?php 
    require_once "./controladores/usuarioControlador.php";
    $ins_usuario = new usuarioControlador();
    
    $datos_usuario = $ins_usuario->datos_usuario_controlador("Unico", $pagina[1]);
    
    if($datos_usuario->rowCount()==1){
        $campos = $datos_usuario->fetch();
    ?>
    
    <form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/usuarioAjax.php" method="POST" data-form="update" autocomplete="off">
        <input type="hidden" name="usuario_id_up" value="<?php echo $pagina[1];?>">
        <fieldset> 
            <legend><li class="fa-black-tie fa"></li> &nbsp; Información personal</legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="usuario_dni" class="bmd-label-floating">DNI</label>
                            <input type="text" pattern="[0-9-]{1,20}" class="form-control" name="usuario_dni_up" value="<?php echo $campos['usuario_dni']; ?>" id="usuario_dni" maxlength="20">
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="usuario_nombre" class="bmd-label-floating">Nombres</label>
                            <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="usuario_nombre_up" value="<?php echo $campos['usuario_nombre']; ?>" id="usuario_nombre" maxlength="35" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="usuario_apellido" class="bmd-label-floating">Apellidos</label>
                            <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="usuario_apellido_up" value="<?php echo $campos['usuario_apellido']; ?>" id="usuario_apellido" maxlength="35" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="usuario_telefono" class="bmd-label-floating">Teléfono</label>
                            <input type="text" pattern="[0-9()+]{8,20}" class="form-control" name="usuario_telefono_up" id="usuario_telefono" value="<?php echo $campos['usuario_telefono']; ?>" maxlength="20">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="usuario_direccion" class="bmd-label-floating">Dirección</label>
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" class="form-control" name="usuario_direccion_up" id="usuario_direccion" value="<?php echo $campos['usuario_direccion']; ?>" maxlength="190">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-animate-text" style="margin-top:0px !important;">
                            <input type="date" class="form-text" name="usuario_fecha_nacimiento_up" id="usuario_fecha_nacimiento" value="<?php echo $campos['usuario_fecha_nacimiento']; ?>" required="">
                            <span class="bar"></span>
                            <label for="usuario_cedula">Fecha Nacimiento</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group form-animate-text" style="margin-top:0px !important;">
                            
                            <select class="form-control btn-round" name="usuario_genero_up" id="usuario_genero"  required="">
                            <option value="<?php echo $campos['usuario_genero']; ?>" selected=""><?php echo $campos['usuario_genero']; ?> (ACTUAL)</option>
                            <option value="FEMENINO">Femenino</option>
                            <option value="MASCULINO">Masculino</option>

                    </select>

                        </div>
                    </div>
                    
                    <!-- Foto de perfil del jugador -->
			<div class="col-md-6">
                            <label for="multimedia_archivo_perfil"><?php echo $campos['usuario_imagen'];?>. Foto Perfil (286x180) Tipo Archivo: jpg, png.</label>
                            <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="file" class="form-text" name="multimedia_perfil_up" id="multimedia_archivo_perfil">
                            <span class="bar"></span>
                            </div>
                    </div> 
                    
                </div>
            </div>
        </fieldset>
        <br><br><br>
        <fieldset>
            <legend><i class="fa-book fa"></i> &nbsp; Información de la cuenta</legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="usuario_usuario" class="bmd-label-floating">Nombre de usuario</label>
                            <input type="text" pattern="[a-zA-Z0-9]{1,35}" class="form-control" name="usuario_usuario_up" id="usuario_usuario" value="<?php echo $campos['usuario_usuario']; ?>" maxlength="35">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="usuario_email" class="bmd-label-floating">Email</label>
                            <input type="email" class="form-control" name="usuario_email_up" id="usuario_email" value="<?php echo $campos['usuario_email']; ?>" maxlength="70">
                        </div>
                    </div>
                    <?php if($_SESSION['privilegio_tor'] == 1 && $campos['usuario_id']!=1){?>
                    <div class="col-12">
                        <div class="form-group">
                            <span>Estado de la cuenta &nbsp; 
                                <?php if($campos['usuario_estado']=="Activa"){ echo '<span class="badge badge-info">Activa</span></span>';}else{ echo '<span class="badge badge-danger">Deshabilitada</span></span>'; } ?>
                               
                            <select class="form-control" name="usuario_estado_up">
                                
                                <option value="Activa" <?php if($campos['usuario_estado']=="Activa"){ echo 'selected=""';}?> >Activa</option>
                                <option value="Deshabilitada" <?php if($campos['usuario_estado']=="Deshabilitada"){ echo 'selected=""';}?>>Deshabilitada</option>
                            </select>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
        </fieldset>
        <br><br><br>
        <fieldset>
            <legend style="margin-top: 40px;"><i class="fa fa-lock"></i> &nbsp; Nueva contraseña</legend>
            <p>Para actualizar la contraseña de esta cuenta ingrese una nueva y vuelva a escribirla. En caso que no desee actualizarla debe dejar vacíos los dos campos de las contraseñas.</p>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="usuario_clave_nueva_1" class="bmd-label-floating">Contraseña</label>
                            <input type="password" class="form-control" name="usuario_clave_nueva_1" id="usuario_clave_nueva_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" >
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="usuario_clave_nueva_2" class="bmd-label-floating">Repetir contraseña</label>
                            <input type="password" class="form-control" name="usuario_clave_nueva_2" id="usuario_clave_nueva_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" >
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        
         <?php if($_SESSION['privilegio_tor'] == 1 && $campos['usuario_id']!=1){?>
                   
        <br><br><br>
        <fieldset>
            
            <legend><i class="fas fa-medal"></i> &nbsp; Nivel de privilegio</legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <p><span class="badge badge-info">Control total</span> Permisos para registrar, actualizar y eliminar</p>
                        <p><span class="badge badge-success">Edición</span> Permisos para registrar y actualizar</p>
                        <p><span class="badge badge-dark">Registrar</span> Solo permisos para registrar</p>
                        
                        <div class="form-group">
                            <select class="form-control" name="usuario_privilegio_up">
                                
                                
                                <option value="1" <?php if($campos['usuario_privilegio']==1){ echo 'selected=""'; }?> >Control total <?php if($campos['usuario_privilegio']==1){ echo '(Actual)'; }?></option>
                                
                                <option value="2" <?php if($campos['usuario_privilegio']==2){ echo 'selected=""'; }?> >Edición <?php if($campos['usuario_privilegio']==2){ echo '(Actual)'; }?></option>
                                
                                <option value="3" <?php if($campos['usuario_privilegio']==3){ echo 'selected=""'; }?> >Registrar <?php if($campos['usuario_privilegio']==3){ echo '(Actual)'; }?></option>
                                
                                
                                
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <p><span class="badge badge-info">Administrador y supervisor</span> Quien asigna y controla el sistema</p>
                        <p><span class="badge badge-success">Operador</span> Quien procesa los incidentes</p>
                        <p><span class="badge badge-dark">Usuario</span> Quien realiza solicitudes</p>

                        <div class="form-group">
                            <select class="form-control" name="usuario_tipo_up">


                                <option value="1" <?php if($campos['usuario_tipo']==1){ echo 'selected=""'; }?> >Administrador <?php if($campos['usuario_tipo']==1){ echo '(Actual)'; }?></option>

                                <option value="2" <?php if($campos['usuario_tipo']==2){ echo 'selected=""'; }?> >Supervisor <?php if($campos['usuario_tipo']==2){ echo '(Actual)'; }?></option>

                                <option value="3" <?php if($campos['usuario_tipo']==3){ echo 'selected=""'; }?> >Operador <?php if($campos['usuario_tipo']==3){ echo '(Actual)'; }?></option>

                                <option value="4" <?php if($campos['usuario_tipo']==4){ echo 'selected=""'; }?> >Usuario <?php if($campos['usuario_tipo']==4){ echo '(Actual)'; }?></option>



                            </select>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </fieldset>
         <?php } ?>
        
        <br><br><br>
        <fieldset>
            <p class="text-center">Para poder guardar los cambios en esta cuenta debe de ingresar su nombre de usuario y contraseña</p>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="usuario_admin" class="bmd-label-floating">Nombre de usuario</label>
                            <input type="text" pattern="[a-zA-Z0-9]{1,35}" class="form-control" name="usuario_admin" id="usuario_admin" maxlength="35" required="" >
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="clave_admin" class="bmd-label-floating">Contraseña</label>
                            <input type="password" class="form-control" name="clave_admin" id="clave_admin" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required="" >
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <!-- Comprobar si la cuenta es propia o no -->
        <?php if($lc->encryption($_SESSION['id_tor']) != $pagina[1]){ ?>
        <input type="hidden" name ="tipo_cuenta" value="Impropia">
        <?php }else{ ?>
        <input type="hidden" name ="tipo_cuenta" value="Propia">
        <?php } ?>
        <p class="text-center" style="margin-top: 40px;">
            <button type="submit" class="btn btn-3d btn-success btn-sm"><i class="fas fa-sync-alt"></i> &nbsp; ACTUALIZAR</button>
        </p>
        
        
    </form>

    <?php }else{?>
    <div class="alert alert-danger text-center" role="alert">
        <p><i class="fa fa-exclamation-triangle fa-5x"></i></p>
        <h4 class="alert-heading">¡Ocurrió un error inesperado!</h4>
        <p class="mb-0">Lo sentimos, no podemos mostrar la información solicitada debido a un error.</p>
    </div>  
    
    <?php } ?>

<!-- Fin de Codigo para actualizar los datos del usuario -->
</div>
