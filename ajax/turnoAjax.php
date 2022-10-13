<?php
$peticionAjax=true;
require_once "../config/APP.php";

if(isset($_POST['turno_id_atender']) || isset($_POST['turno_id_finalizar']) ||  isset($_POST['turno_nombre_reg']) || isset($_POST['turno_id_del']) || isset($_POST['turno_id_up'])){
    /*------------- Instancia al controlador -----------------*/
    require_once "../controladores/turnoControlador.php";
    $ins_turno = new turnoControlador();

    /*-------- Agregar una turno ----------*/
    if(isset($_POST['turno_nombre_reg'])){
      echo $ins_turno->agregar_turno_controlador();
    }

    /*-------- Eliminar una turno ----------*/
    if(isset($_POST['turno_id_del'])){
      echo $ins_turno->eliminar_turno_controlador(isset($_POST['turno_id_del']));
    }

    /*-------- Atender un turno ----------*/
    if(isset($_POST['turno_id_atender'])){
      echo $ins_turno->atender_turno_controlador(isset($_POST['turno_id_atender']));
    }

    /*-------- Atender un turno ----------*/
    if(isset($_POST['turno_id_finalizar'])){
      echo $ins_turno->finalizar_turno_controlador(isset($_POST['turno_id_finalizar']));
    }

    /*-------  Actualizar una turno-------*/
    if(isset($_POST['turno_id_up'])){
      echo $ins_turno->actualizar_turno_controlador();
    }

}else{
    session_start(['name'=>'TOR']);
    session_unset(); //vacia sesion
    session_destroy();//cerrar sesion
    header("Location: ".SERVERURL."login/");//redirigir a otra pagina
    exit();//salir del script
}