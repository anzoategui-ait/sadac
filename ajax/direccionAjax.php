<?php
$peticionAjax=true;
require_once "../config/APP.php";

if(isset($_POST['direccion_nombre_reg']) || isset($_POST['direccion_id_del']) || isset($_POST['direccion_id_up'])){
    /*------------- Instancia al controlador -----------------*/
    require_once "../controladores/direccionControlador.php";
    $ins_direccion = new direccionControlador();

    /*-------- Agregar una direccion ----------*/
    if(isset($_POST['direccion_nombre_reg'])){
      echo $ins_direccion->agregar_direccion_controlador();
    }

    /*-------- Eliminar una direccion ----------*/
    if(isset($_POST['direccion_id_del'])){
      echo $ins_direccion->eliminar_direccion_controlador(isset($_POST['direccion_id_del']));
    }

    /*-------  Actualizar una direccion-------*/
    if(isset($_POST['direccion_id_up'])){
      echo $ins_direccion->actualizar_direccion_controlador();
    }

}else{
    session_start(['name'=>'TOR']);
    session_unset(); //vacia sesion
    session_destroy();//cerrar sesion
    header("Location: ".SERVERURL."login/");//redirigir a otra pagina
    exit();//salir del script
}
