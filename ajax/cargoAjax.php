<?php
$peticionAjax=true;
require_once "../config/APP.php";

if(isset($_POST['cargo_nombre_reg']) || isset($_POST['cargo_id_del']) || isset($_POST['usuario_cargo_id_del']) || isset($_POST['cargo_id_up'])){
    /*------------- Instancia al controlador -----------------*/
    require_once "../controladores/cargoControlador.php";
    $ins_cargo = new cargoControlador();

    /*-------- Agregar una cargo ----------*/
    if(isset($_POST['cargo_nombre_reg'])){
      echo $ins_cargo->agregar_cargo_controlador();
    }

    /*-------- Eliminar una cargo ----------*/
    if(isset($_POST['cargo_id_del'])){
      echo $ins_cargo->eliminar_cargo_controlador(isset($_POST['cargo_id_del']));
    }
    /* Eliminar relacion usuario cargo*/
    if(isset($_POST['usuario_cargo_id_del'])){
      echo $ins_cargo->eliminar_usuario_cargo_controlador(isset($_POST['usuario_cargo_id_del']));
    }

    /*-------  Actualizar una cargo-------*/
    if(isset($_POST['cargo_id_up'])){
      echo $ins_cargo->actualizar_cargo_controlador();
    }

}else{
    session_start(['name'=>'TOR']);
    session_unset(); //vacia sesion
    session_destroy();//cerrar sesion
    header("Location: ".SERVERURL."login/");//redirigir a otra pagina
    exit();//salir del script
}
