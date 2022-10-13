<?php
$peticionAjax=true;
require_once "../config/APP.php";

if(isset($_POST['pdf_id_del']) || isset($_POST['solicitud_actividad_reg']) || isset($_POST['asignacion_id_del']) || isset($_POST['asignacion_id_up'])){
    /*------------- Instancia al controlador -----------------*/
    require_once "../controladores/asignacionControlador.php";
    $ins_asignacion = new asignacionControlador();

    /*-------- Agregar una asignacion ----------*/
    if(isset($_POST['solicitud_actividad_reg'])){
      echo $ins_asignacion->agregar_asignacion_controlador();
    }

    /*-------- Eliminar una asignacion ----------*/
    if(isset($_POST['asignacion_id_del'])){
      echo $ins_asignacion->eliminar_asignacion_controlador(isset($_POST['asignacion_id_del']));
    }

    /*-------  Actualizar una asignacion-------*/
    if(isset($_POST['asignacion_id_up'])){
      echo $ins_asignacion->actualizar_asignacion_controlador();
    }
    
     /*-------- Eliminar una anexo en pdf ----------*/
    if(isset($_POST['pdf_id_del'])){
      echo $ins_asignacion->eliminar_anexo_controlador(isset($_POST['pdf_id_del']));
    }

}else{
    session_start(['name'=>'TOR']);
    session_unset(); //vacia sesion
    session_destroy();//cerrar sesion
    header("Location: ".SERVERURL."login/");//redirigir a otra pagina
    exit();//salir del script
}
