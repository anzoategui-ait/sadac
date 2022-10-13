<?php
$peticionAjax=true;
require_once "../config/APP.php";

if(isset($_POST['indicador_nombre_reg']) || isset($_POST['indicador_id_del']) || isset($_POST['indicador_id_up'])){
    /*------------- Instancia al controlador -----------------*/
    require_once "../controladores/indicadorControlador.php";
    $ins_indicador = new indicadorControlador();

    /*-------- Agregar una indicador ----------*/
    if(isset($_POST['indicador_nombre_reg'])){
      echo $ins_indicador->agregar_indicador_controlador();
    }

    /*-------- Eliminar una indicador ----------*/
    if(isset($_POST['indicador_id_del'])){
      echo $ins_indicador->eliminar_indicador_controlador(isset($_POST['indicador_id_del']));
    }

    /*-------  Actualizar una indicador-------*/
    if(isset($_POST['indicador_id_up'])){
      echo $ins_indicador->actualizar_indicador_controlador();
    }

}else{
    session_start(['name'=>'TOR']);
    session_unset(); //vacia sesion
    session_destroy();//cerrar sesion
    header("Location: ".SERVERURL."login/");//redirigir a otra pagina
    exit();//salir del script
}
