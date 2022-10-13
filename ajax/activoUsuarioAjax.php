<?php
$peticionAjax=true;
require_once "../config/APP.php";

if(isset($_POST['cedula_usuario_reg']) || isset($_POST['relacion_activo_usuario_id_del'])){
    /*------------- Instancia al controlador -----------------*/
    require_once "../controladores/activoUsuarioControlador.php";
    $ins_activo_usuario = new activoUsuarioControlador();

    /*-------- Agregar una relacion actividad usuario ----------*/
    if(isset($_POST['cedula_usuario_reg'])){
      echo $ins_activo_usuario->agregar_activo_usuario_controlador();
    }

    /*-------- Eliminar una relacion activo usuario ----------*/
    if(isset($_POST['relacion_activo_usuario_id_del'])){
      echo $ins_activo_usuario->eliminar_activo_usuario_controlador(isset($_POST['relacion_activo_usuario_id_del']));
    }

   

}else{
    session_start(['name'=>'TOR']);
    session_unset(); //vacia sesion
    session_destroy();//cerrar sesion
    header("Location: ".SERVERURL."login/");//redirigir a otra pagina
    exit();//salir del script
}
