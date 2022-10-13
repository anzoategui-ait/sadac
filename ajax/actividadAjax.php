<?php
$peticionAjax=true;
require_once "../config/APP.php";

if(isset($_POST['actividad_nombre_reg']) || isset($_POST['actividad_id_del']) || isset($_POST['actividad_id_up'])){
    /*------------- Instancia al controlador -----------------*/
    require_once "../controladores/actividadControlador.php";
    $ins_actividad = new actividadControlador();

    /*-------- Agregar una actividad ----------*/
    if(isset($_POST['actividad_nombre_reg'])){
      echo $ins_actividad->agregar_actividad_controlador();
    }

    /*-------- Eliminar una actividad ----------*/
    if(isset($_POST['actividad_id_del'])){
      echo $ins_actividad->eliminar_actividad_controlador(isset($_POST['actividad_id_del']));
    }

    /*-------  Actualizar una actividad-------*/
    if(isset($_POST['actividad_id_up'])){
      echo $ins_actividad->actualizar_actividad_controlador();
    }

}else{
    session_start(['name'=>'TOR']);
    session_unset(); //vacia sesion
    session_destroy();//cerrar sesion
    header("Location: ".SERVERURL."login/");//redirigir a otra pagina
    exit();//salir del script
}
