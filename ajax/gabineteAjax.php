<?php
$peticionAjax=true;
require_once "../config/APP.php";

if(isset($_POST['gabinete_nombre_reg']) || isset($_POST['gabinete_id_del']) || isset($_POST['gabinete_id_up'])){
    /*------------- Instancia al controlador -----------------*/
    require_once "../controladores/gabineteControlador.php";
    $ins_gabinete = new gabineteControlador();

    /*-------- Agregar una gabinete ----------*/
    if(isset($_POST['gabinete_nombre_reg'])){
      echo $ins_gabinete->agregar_gabinete_controlador();
    }

    /*-------- Eliminar una gabinete ----------*/
    if(isset($_POST['gabinete_id_del'])){
      echo $ins_gabinete->eliminar_gabinete_controlador(isset($_POST['gabinete_id_del']));
    }

    /*-------  Actualizar una gabinete-------*/
    if(isset($_POST['gabinete_id_up'])){
      echo $ins_gabinete->actualizar_gabinete_controlador();
    }

}else{
    session_start(['name'=>'TOR']);
    session_unset(); //vacia sesion
    session_destroy();//cerrar sesion
    header("Location: ".SERVERURL."login/");//redirigir a otra pagina
    exit();//salir del script
}