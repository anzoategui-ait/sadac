<?php
$peticionAjax=true;
require_once "../config/APP.php";

if(isset($_POST['cubiculo_nombre_reg']) || isset($_POST['cubiculo_id_del']) || isset($_POST['usuario_cubiculo_id_del']) || isset($_POST['cubiculo_id_up'])){
    /*------------- Instancia al controlador -----------------*/
    require_once "../controladores/cubiculoControlador.php";
    $ins_cubiculo = new cubiculoControlador();

    /*-------- Agregar una cubiculo ----------*/
    if(isset($_POST['cubiculo_nombre_reg'])){
      echo $ins_cubiculo->agregar_cubiculo_controlador();
    }

    /*-------- Eliminar una cubiculo ----------*/
    if(isset($_POST['cubiculo_id_del'])){
      echo $ins_cubiculo->eliminar_cubiculo_controlador(isset($_POST['cubiculo_id_del']));
    }
    /* Eliminar relacion usuario cubiculo*/
    if(isset($_POST['usuario_cubiculo_id_del'])){
      echo $ins_cubiculo->eliminar_usuario_cubiculo_controlador(isset($_POST['usuario_cubiculo_id_del']));
    }

    /*-------  Actualizar una cubiculo-------*/
    if(isset($_POST['cubiculo_id_up'])){
      echo $ins_cubiculo->actualizar_cubiculo_controlador();
    }

}else{
    session_start(['name'=>'TOR']);
    session_unset(); //vacia sesion
    session_destroy();//cerrar sesion
    header("Location: ".SERVERURL."login/");//redirigir a otra pagina
    exit();//salir del script
}
