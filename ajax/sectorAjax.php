<?php
$peticionAjax=true;
require_once "../config/APP.php";

if(isset($_POST['sector_nombre_reg']) || isset($_POST['sector_id_del']) || isset($_POST['usuario_sector_id_del']) || isset($_POST['sector_id_up'])){
    /*------------- Instancia al controlador -----------------*/
    require_once "../controladores/sectorControlador.php";
    $ins_sector = new sectorControlador();

    /*-------- Agregar una sector ----------*/
    if(isset($_POST['sector_nombre_reg'])){
      echo $ins_sector->agregar_sector_controlador();
    }

    /*-------- Eliminar una sector ----------*/
    if(isset($_POST['sector_id_del'])){
      echo $ins_sector->eliminar_sector_controlador(isset($_POST['sector_id_del']));
    }
    /* Eliminar relacion usuario sector*/
    if(isset($_POST['usuario_sector_id_del'])){
      echo $ins_sector->eliminar_usuario_sector_controlador(isset($_POST['usuario_sector_id_del']));
    }

    /*-------  Actualizar una sector-------*/
    if(isset($_POST['sector_id_up'])){
      echo $ins_sector->actualizar_sector_controlador();
    }

}else{
    session_start(['name'=>'TOR']);
    session_unset(); //vacia sesion
    session_destroy();//cerrar sesion
    header("Location: ".SERVERURL."login/");//redirigir a otra pagina
    exit();//salir del script
}
