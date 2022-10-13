<?php
$peticionAjax=true;
require_once "../config/APP.php"; 

if(isset($_POST['municipio_nombre_reg']) || isset($_POST['municipio_id_del']) || isset($_POST['municipio_id_up'])){
    /*------------- Instancia al controlador -----------------*/
    require_once "../controladores/municipioControlador.php";
    $ins_municipio = new municipioControlador();
    
    /*-------- Agregar un municipio ----------*/
    if(isset($_POST['municipio_nombre_reg'])){
      echo $ins_municipio->agregar_municipio_controlador();  
    }
    
    /*-------- Eliminar una municipio ----------*/
    if(isset($_POST['municipio_id_del'])){
      echo $ins_municipio->eliminar_municipio_controlador(isset($_POST['municipio_id_del']));  
    }
    
    /*-------  Actualizar Editar un municipio-------*/
    if(isset($_POST['municipio_id_up'])){
      echo $ins_municipio->actualizar_municipio_controlador();  
    }
    
}else{
    session_start(['name'=>'FB']);
    session_unset(); //vacia sesion
    session_destroy();//cerrar sesion
    header("Location: ".SERVERURL."login/");//redirigir a otra pagina
    exit();//salir del script
}