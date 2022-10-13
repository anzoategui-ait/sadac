<?php
$peticionAjax=true;
require_once "../config/APP.php";

if(isset($_POST['paso_nombre_reg']) || isset($_POST['paso_id_del']) || isset($_POST['paso_id_up'])){
    /*------------- Instancia al controlador -----------------*/
    require_once "../controladores/pasoControlador.php";
    $ins_paso = new pasoControlador();

    /*-------- Agregar una paso ----------*/
    if(isset($_POST['paso_nombre_reg'])){
      echo $ins_paso->agregar_paso_controlador();
    }

    /*-------- Eliminar una paso ----------*/
    if(isset($_POST['paso_id_del'])){
      echo $ins_paso->eliminar_paso_controlador(isset($_POST['paso_id_del']));
    }

    /*-------  Actualizar una paso-------*/
    if(isset($_POST['paso_id_up'])){
      echo $ins_paso->actualizar_paso_controlador();
    }

}else{
    session_start(['name'=>'TOR']);
    session_unset(); //vacia sesion
    session_destroy();//cerrar sesion
    header("Location: ".SERVERURL."login/");//redirigir a otra pagina
    exit();//salir del script
}
