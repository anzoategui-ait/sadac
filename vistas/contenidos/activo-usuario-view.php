<?php
if($_SESSION['privilegio_tor']<1 || $_SESSION['privilegio_tor']>3 || $_SESSION['tipo_tor']==3 || $_SESSION['tipo_tor']==4) {
  $lc->forzar_cierre_sesion_controlador();
  exit();
  } 
?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Activo vs Usuario / Relacionar</h3>
            <p class="animated fadeInDown">
                <a href="<?php echo SERVERURL; ?>home/">Resumen <span class="fa-angle-right fa"></span></a>
                <a class="active" href="<?php echo SERVERURL; ?>activo-usuario/">Activo vs Usuario <span class="fa-angle-right fa"></span></a> 
                <a href="<?php echo SERVERURL; ?>activo-usuario-list/">Relacion activos vs usuarios <span class="fa-angle-right fa"></span></a>
                <a href="<?php echo SERVERURL; ?>activo-usuario-search/">Buscar relacion <span class="fa-angle-right fa"></span></a>
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->

<div class="container-fluid">
    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/activoUsuarioAjax.php" method="POST" data-form="save" autocomplete="off">
        <fieldset>
            <legend><i class="far fa-address-card"></i> &nbsp; Información para la Asignacion o Desincorporacion de un Activo a un Usuario</legend>
            <div class="container-fluid">
                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[0-9-]{6,20}" class="form-text" name="cedula_usuario_reg" id="cedula_usuario" maxlength="150" required="">
                            <span class="bar"></span>
                            <label for="cedula_usuario">Cedula Usuario</label>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <input type="text" pattern="[a-zA-Z0-9- ]{1,70}" class="form-text" name="codigo_equipo_reg" id="codigo_equipo" maxlength="300" required="">
                            <span class="bar"></span>
                            <label for="codigo_equipo">Codigo Equipo</label>
                        </div>
                    </div>
                    
                     <div class="col-md-6">
                    <label for="paso_nombre">Vincular / Desvincular</label>
                       <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <select class="form-control btn-round" name="tipo_reg" required="">
                                <option value="" selected="">Seleccione una opcion</option>
                                <option value="1">VINCULAR</option>
                                <option value="2">DESVINCULAR</option>

                              

                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group form-animate-text" style="margin-top:20px !important;">
                            <textarea type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,500}" class="form-text" name="descripcion_reg" id="descripcion" maxlength="500" required=""></textarea>
                            <span class="bar"></span>
                            <label for="descripcion">Descripcion</label>
                        </div>
                    </div>


                </div>
            </div>
        </fieldset>
        
        
        <p class="text-center" style="margin-top: 20px;">
            <button type="reset" class="btn btn-3d btn-warning btn-sm"><i class="fa-refresh fa"></i> &nbsp; LIMPIAR</button>
            &nbsp; &nbsp;
            <button type="submit" class="btn btn-3d btn-info btn-sm"><i class="fa-save fa"></i> &nbsp; GUARDAR</button>
        </p>
    </form>
</div>