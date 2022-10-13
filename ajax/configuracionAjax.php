<?php
$peticionAjax=true;
require_once "../config/APP.php"; 

if(isset($_POST['configuracion_descripcion_reg']) || isset($_POST['configuracion_valor_reg']) || isset($_POST['configuracion_id_up']) || isset($_POST['configuracion_id_del'])){
    /*------------- Instancia al controlador -----------------*/
    require_once "../controladores/configuracionControlador.php";
    $ins_configuracion = new configuracionControlador();
    
    /*-------- Agregar una configuracion ----------*/
    if(isset($_POST['configuracion_descripcion_reg']) && isset($_POST['configuracion_valor_reg'])){
      echo $ins_configuracion->agregar_configuracion_controlador();  
    
    }
    
    /*-------- Eliminar un configuracion ----------*/
    if(isset($_POST['configuracion_id_del'])){
      echo $ins_configuracion->eliminar_configuracion_controlador(isset($_POST['configuracion_id_del']));  
    }
    
    /*-------  Actualizar o Editar una configuracion-------*/
    if(isset($_POST['configuracion_id_up'])){
      echo $ins_configuracion->actualizar_configuracion_controlador();  
    }
    
}else{
    session_start(['name'=>'TOR']);
    session_unset(); //vacia sesion
    session_destroy();//cerrar sesion
    header("Location: ".SERVERURL."login/");//redirigir a otra pagina
    exit();//salir del script
}