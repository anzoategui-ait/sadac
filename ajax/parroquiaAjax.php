<?php
$peticionAjax=true;
require_once "../config/APP.php";

if(isset($_POST['parroquia_nombre_reg']) || isset($_POST['parroquia_id_del']) || isset($_POST['usuario_parroquia_id_del']) || isset($_POST['parroquia_id_up'])){
    /*------------- Instancia al controlador -----------------*/
    require_once "../controladores/parroquiaControlador.php";
    $ins_parroquia = new parroquiaControlador();

    /*-------- Agregar una parroquia ----------*/
    if(isset($_POST['parroquia_nombre_reg'])){
      echo $ins_parroquia->agregar_parroquia_controlador();
    }

    /*-------- Eliminar una parroquia ----------*/
    if(isset($_POST['parroquia_id_del'])){
      echo $ins_parroquia->eliminar_parroquia_controlador(isset($_POST['parroquia_id_del']));
    }
    /* Eliminar relacion usuario parroquia*/
    if(isset($_POST['usuario_parroquia_id_del'])){
      echo $ins_parroquia->eliminar_usuario_parroquia_controlador(isset($_POST['usuario_parroquia_id_del']));
    }

    /*-------  Actualizar una parroquia-------*/
    if(isset($_POST['parroquia_id_up'])){
      echo $ins_parroquia->actualizar_parroquia_controlador();
    }

}else{
    session_start(['name'=>'TOR']);
    session_unset(); //vacia sesion
    session_destroy();//cerrar sesion
    header("Location: ".SERVERURL."login/");//redirigir a otra pagina
    exit();//salir del script
}