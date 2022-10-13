<?php
$peticionAjax=true;
require_once "../config/APP.php";

if(isset($_POST['token']) && isset($_POST['usuario'])){
    /*------------- Instancia al controlador -----------------*/
    require_once "../controladores/loginControlador.php";
    $ins_login = new loginControlador();
    
echo $ins_login->cerrar_sesion_controlador();
}else{
    session_start(['name'=>'TOR']);
    session_unset(); //vacia sesion
    session_destroy();//cerrar sesion
    header("Location: ".SERVERURL."login/");//redirigir a otra pagina
    exit();//salir del script
}