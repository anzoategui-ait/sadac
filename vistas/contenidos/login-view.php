<div class="container ">

    <form action="" method="POST" autocomplete="off" class="form-signin">
        <div class="panel periodic-login">
            
            <div class="panel-body text-center">
                <h1>SADAC</h1>
                <p class="element-name">Control Actividades</p>
                <p class="atomic-mass">Iniciar Sesion</p>
                
                <i class="icons icon-arrow-down"></i>
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="text" class="form-text" id="UserName" name="usuario_log" pattern="[a-zA-Z0-9]{4,50}" maxlength="50" required="">
                    <span class="bar"></span>
                    <label>Nombre de usuario</label>
                </div>
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="password" class="form-text" id="UserPassword" name="clave_log" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required="">
                    <span class="bar"></span>
                    <label>Clave de Acceso</label>
                </div>
                <input type="submit" class="btn col-md-12" value="SignIn"/>
            </div>
           
        </div>
    </form>

</div>
<?php
if(isset($_POST['usuario_log']) && isset($_POST['clave_log'])){
    require_once "./controladores/loginControlador.php";
    
    $ins_login = new loginControlador();
    
    /*$nueva_url = $ins_login->iniciar_sesion_controlador();
    echo $nueva_url;*/
    $ins_login->iniciar_sesion_controlador();
    
}
?>