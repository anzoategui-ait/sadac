<?php
$peticionAjax=true;
require_once "../config/APP.php"; 

if(isset($_POST['relacion_usuario_id_reg']) || isset($_POST['relacion_usuario_id_reg']) || isset($_POST['usuario_dni_reg']) || isset($_POST['usuario_id_del']) || isset($_POST['usuario_id_up'])){
    /*------------- Instancia al controlador -----------------*/
    require_once "../controladores/usuarioControlador.php";
    $ins_usuario = new usuarioControlador();
    
    /*-------- Agregar un usuario ----------*/
    if(isset($_POST['usuario_dni_reg']) && isset($_POST['usuario_nombre_reg'])){
      echo $ins_usuario->agregar_usuario_controlador();  
    }
    
    /*-------- Agregar relacion usuario cargo ----------*/
    if(isset($_POST['relacion_cargo_id_reg']) && isset($_POST['relacion_usuario_id_reg'])){
      echo $ins_usuario->agregar_usuario_cargo_controlador();  
    }
    
    /*-------- Agregar relacion usuario direccion: municipio, parroquia, sector ----------*/
    if(isset($_POST['relacion_usuario_id_reg']) && isset($_POST['municipio_nombre_reg'])){
      echo $ins_usuario->relacion_usuario_direccion_controlador();  
    }
    
    /*-------- Eliminar un usuario ----------*/
    if(isset($_POST['usuario_id_del'])){
      echo $ins_usuario->eliminar_usuario_controlador(isset($_POST['usuario_id_del']));  
    }
    
    /*-------- Eliminar un usuario ----------*/
    if(isset($_POST['usuario_cargo_id_del'])){
      echo $ins_usuario->eliminar_usuario_cargo_controlador(isset($_POST['usuario_cargo_id_del']));  
    }
    
    /*-------  Actualizar Editar un usuario-------*/
    if(isset($_POST['usuario_id_up'])){
      echo $ins_usuario->actualizar_usuario_controlador();  
    }
    
}else{
    session_start(['name'=>'TOR']);
    session_unset(); //vacia sesion
    session_destroy();//cerrar sesion
    header("Location: ".SERVERURL."login/");//redirigir a otra pagina
    exit();//salir del script
}